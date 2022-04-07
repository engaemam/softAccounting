<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Model\Billdevicesitems;
use App\Model\Billitems;
use App\Model\Bills;
use App\Model\Currencies;
use App\Model\Invoicedeviceitems;
use App\Model\Invoicedevices;
use App\Model\Invoiceitems;
use App\Model\Moneyorders;
use App\Model\Invoices;
use App\Model\ReturnedInvoices;
use App\Model\Companyexpenses;
use App\Model\Items;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Model\Token;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\DB;
use Excel;

//use Illuminate\Http\Request;
class ReportsController extends Controller
{
    public function index(Request $request){
        $clients = Clients::get();
        $cities = City::get();
        $invoicesStatus = Inovice_status::get();
        $invoicesQuery = Invoices::with('Invoicespdf','clients');

//        if($request->invoice_number != ''){
//            $invoicesQuery->where('invoice_number', 'LIKE', '%' . request()->invoice_number . '%');
//        }
        if($request->city != ''){
            $invoicesQuery = $invoicesQuery->whereHas('clients', function ($query){
                {
                    $query->where('city', 'LIKE', '%' . request()->city . '%');
                }
            });
        }
        if($request->name_client != ''){
            $invoicesQuery = $invoicesQuery->whereHas('clients', function ($query){
                {
                    $query->where('name_client', 'LIKE', '%' . request()->name_client . '%');
                }
            });
        }

        if($request->from != ''){
            $from = date("Y-m-d",strtotime($request->from));
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d", strtotime($request->to));
            $invoicesQuery->where("date","<=",$to);
        }



        if($request->exports){
            $this->export($invoicesQuery->get()->get());
        }
        $invoices = $invoicesQuery->orderBy('date','desc')->paginate(20);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.invoices.index',compact('invoices','temp','clients','invoicesStatus','cities'));
    }
    public function items( $id = null , Request $request)
    {
//Bills
        $ItemsQuery = Items::with('billitems','Billdevicesitems','Invoiceitems','Invoicedeviceitems');



        if($request->from != ''){
            $from = date("Y-m-d H:i:s",strtotime($request->from));
            $ItemsQuery->where("created_at",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d H:i:s", strtotime($request->to));
            $ItemsQuery->where("created_at","<=",$to);
        }



        $items = $ItemsQuery->get();
        //dd($items);

        $item = $ItemsQuery->find($id);

        $billitems = Billitems::where('item_id',$id)->sum("quantity_b");
        $Billdevicesitems = Billdevicesitems::where('item_id_devices',$id)->sum("quantity_devices");
        $sumBills = $billitems + $Billdevicesitems;
      

        $Invoicedevices = Invoiceitems::where('item_id',$id)->sum("quantity_b");
        $Invoicedeviceitems = Invoicedeviceitems::where('item_id_devices',$id)->sum("quantity_devices");
        $sumInvoice = $Invoicedevices + $Invoicedeviceitems;
        //dd($Invoicedeviceitems);
        return view('admin.report.items',compact('items','item','id','sumBills','sumInvoice'));
    }
    public function store($id = null , Request $request){
        $currencies = Currencies::get();
        $ItemsQuery = Items::with('billitems','Billdevicesitems','Invoiceitems','Invoicedeviceitems');



        if($request->from != ''){
            $from = date("Y-m-d H:i:s",strtotime($request->from));
            $ItemsQuery->where("created_at",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d H:i:s", strtotime($request->to));
            $ItemsQuery->where("created_at","<=",$to);
        }


        $sumBillsprice =0;
        $items = $ItemsQuery->get();
        //dd($items);

        $item = $ItemsQuery->find($id);

        $billitems = Billitems::where('item_id',$id)->sum("quantity_b");
        $Billdevicesitems = Billdevicesitems::where('item_id_devices',$id)->sum("quantity_devices");
        $sumBills = $billitems + $Billdevicesitems;
        $price = Billitems::where('item_id',$id)->sum("price_b");
        $priced = Billitems::where('item_id',$id)->sum("quantity_b");
        $sumBillsprice = $sumBillsprice + $price ;

        $Invoicedevices = Invoiceitems::where('item_id',$id)->sum("quantity_b");
        $Invoicedeviceitems = Invoicedeviceitems::where('item_id_devices',$id)->sum("quantity_devices");
        $sumInvoice = $Invoicedevices + $Invoicedeviceitems;

        $priceInvoice= Invoiceitems::where('item_id',$id)->sum("price_b");
        $priceInvoicedevice = Invoicedeviceitems::where('item_id_devices',$id)->sum("price_devices");
        $sumInvoiceprice = $priceInvoice + $priceInvoicedevice;
        return view('admin.report.store',compact('items','item','id','sumBills','sumInvoice','sumBillsprice','sumInvoiceprice','currencies'));

    }

    public function daily($id = null , Request $request){
        $users = Admin::get();
        $mytime = Carbon::now();
        $date = $mytime->toDateTimeString();
        $today = date("Y/m/d",strtotime($date));

        $userd = Invoices::withCount('Admin')->where('user_id',$id)->where('date',$today)->pluck('user_id');
        $userdd = count($userd);
        if($userdd){
            $dd = Invoices::where('user_id',$id)->where('date',$today)->pluck('id');
            $itemsDev = Invoices::where('user_id',$id)->where('date',$today)->where('status_id',2)->pluck('status_id');
            $itemsDev2 = Invoices::where('user_id',$id)->where('date',$today)->where('status_id',3)->pluck('status_id');
            $userds = Invoiceitems::whereIn('invoice_id',$dd)->pluck('item_id');
            $items = Items::whereIn('id',$userds)->get();
            $countItems = count($itemsDev);
            $countItems2 = count($itemsDev2);
            //dd($countItems);
            $itemsCount = count($items);
        }else{
            $itemsCount = 0;
            $countItems = 0;
            $countItems2 = 0;
        }
        $items = Items::get();
        $invoicesitems = Invoiceitems::get();

        $invoices = Invoices::withCount('Admin')->where('user_id',$id)->get();
        $invoicesQuery = Invoices::where('date',$today);
        if($request->exports){
            $this->exportInvoicesDaily($invoicesQuery->where('user_id',$request->user_id)->get()->get());

        }

        return view('admin.report.daily',compact('id',
            'users','invoices','today','userdd','items','invoicesitems','itemsCount','countItems','countItems2'));

    }
    public function exportInvoicesDaily($data)
    {
        //dd('dd');
        if(!empty($data)){

            $invoices = Invoices::with('invoiceItem')->orderBy("id","DESC")->get();
            $invoicesData = [];
            foreach($data as $item){
                $invoicesitems = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->get();
                $names ='';
                $quantities ='';
                $prices ='';
                $colors ='';
                $sizes ='';
                foreach ($invoicesitems as $invoiceItem){
                    $names.= $invoiceItem->items->item_name . ',';
                    $quantities.= $invoiceItem->quantity_b . ',';
                    $prices.= $invoiceItem->price_b . ',';
                    $colors.= $invoiceItem->ItemColor->name . ',';
                    $sizes.= $invoiceItem->ItemSize->name . ',';


//                    $invoicesData[] = [
//                        trans('invoices.invoices_number')      => '',
//                        trans('invoices.date')                 => '',
//                        trans('clients.name_client')           => '',
//                        trans('clients.phone')                 => '',
//                        trans('clients.city')                  => '',
//                        trans('clients.notes')                 => '',
//                        trans('invoices.total_invoice')        => '',
//                        trans('invoices.notes')                => '',
//                        trans('invoices.item_name')            => $invoiceItem->items->item_name,
//                        trans('invoices.quantity')             => $invoiceItem->quantity_b,
//                        trans('invoices.price')                => $invoiceItem->price_b,
//                        trans('invoices.color')                => $invoiceItem->ItemColor->name,
//                        trans('invoices.size')                 => $invoiceItem->ItemSize->name,
//                    ];
                }

                $names = substr_replace($names, "", -1);
                $quantities = substr_replace($quantities, "", -1);
                $prices = substr_replace($prices, "", -1);
                $colors = substr_replace($colors, "", -1);
                $sizes = substr_replace($sizes, "", -1);
                $invoicesData[] = [
                    trans('invoices.invoices_number')      => $item->id,
                    trans('invoices.date')                 => date("Y/m/d",strtotime($item->created_at)),
                    trans('clients.name_client')           => $item->clients->name_client,
                    trans('clients.phone')                 => $item->clients->phone,
                    trans('clients.city')                  => $item->clients->city,
                    trans('clients.notes')                 => $item->clients->notes,
                    trans('invoices.total_invoice')        => $item->total_invoice,
                    trans('invoices.notes')                => $item->notes,
                    trans('invoices.item_name')            => $names,
                    trans('invoices.quantity')             => $quantities,
                    trans('invoices.price')                => $prices,
                    trans('invoices.color')                => $colors,
                    trans('invoices.size')                 => $sizes,
                ];

            }

            if(count($invoicesData) > 0){
                Excel::create("تصدير فواتير البيع(".date("d-M-Y").")", function($excel) use($invoicesData) {
                    $excel->sheet('sheet1', function($sheet) use($invoicesData) {
                        $sheet->fromArray($invoicesData);

                        $sheet->cell('A1:F1',function($cell){
                            $cell->setBackground('#e8e8e8');
                            $cell->setFontWeight('bold');
                        });
                    });

                })->export('xls');
            }
        }else{
            //dd('dd');
            return redirect(aurl('invoices'));
        }

    }
    public function monthly($id = null , Request $request){
        $users = Admin::get();
        $mytime = Carbon::now();
        $date = $mytime->toDateTimeString();
        $today = date("Y/m/d",strtotime($date));

        $userd = Invoices::withCount('Admin')->where('user_id',$id)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('user_id');
        $userdd = count($userd);
        if($userdd != 0){
            $dd = Invoices::where('user_id',$id)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('id');
            $itemsDev = Invoices::where('user_id',$id)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',2)->pluck('status_id');
            $itemsDev2 = Invoices::where('user_id',$id)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',3)->pluck('status_id');
            $userds = Invoiceitems::whereIn('invoice_id',$dd)->pluck('item_id');
            //dd(count($userds));
            $items = Items::whereIn('id',$userds)->get();
            $countItems = count($itemsDev);
            $countItems2 = count($itemsDev2);
            //dd($countItems);
            $itemsCount = count($userds);
        }else{
            $itemsCount = 0;
            $countItems = 0;
            $countItems2 = 0;
        }

        $items = Items::get();
        $invoicesitems = Invoiceitems::get();
        $invoicesQuery = Invoices::with('Invoicespdf','clients')->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id);
        $invoices = Invoices::withCount('Admin')->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id)->get();
        if($request->save_value != ''){
            $invoicesQuery->where("savedraft","=",$request->save_value);
        }
        if($request->from != ''){
            $from = date("Y-m-d",strtotime($request->from));
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d", strtotime($request->to));
            $invoicesQuery->where("date","<=",$to);
        }

        if($request->exports){
            //$this->export($invoicesQuery->get()->get());
            if($request->save_value){
                $this->exportInvoices($invoicesQuery->where('user_id',$request->user_id)->where("savedraft","=",$request->save_value)->get()->get());
            }else{
                $this->exportInvoices($invoicesQuery->where('user_id',$request->user_id)->get()->get());
            }
        }
        $invoices = $invoicesQuery->orderBy('date','desc')->paginate(25);
       
        return view('admin.report.monthly',compact('id',
            'users','invoices','today','userdd','items','invoicesitems','itemsCount','countItems','countItems2'));

    }
   
    public function locker($id = null , Request $request){
        $users = Admin::get();
        $mytime = Carbon::now();
        $getmoneys = Moneyorders::where('type','1')->sum('value');
       
        $paymoneys = Moneyorders::where('type','2')->sum('value');
      
      
        $date = $mytime->toDateTimeString();
        $today = date("Y/m/d",strtotime($date));

        $userd = Invoices::withCount('Admin')->where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('user_id');
        $userdd = count($userd);
        if($userdd != 0){
            $dd = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('id');
            $itemsDev = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',2)->pluck('status_id');
            $itemsDev2 = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',3)->pluck('status_id');
            $userds = Invoiceitems::whereIn('invoice_id',$dd)->pluck('item_id');
            //dd(count($userds));
            $items = Items::whereIn('id',$userds)->get();
            $countItems = count($itemsDev);
            $countItems2 = count($itemsDev2);
            //dd($countItems);
            $itemsCount = count($userds);
        }else{
            $itemsCount = 0;
            $countItems = 0;
            $countItems2 = 0;
        }

        $items = Items::get();
        $invoicesitems = Invoiceitems::get();
        $invoicesQuery = Invoices::with('Invoicespdf','clients')->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id);
        $suminvoices = Invoices::with('Invoicespdf','clients')->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id)->sum('afterdiscount');    
       // dd($suminvoices);
        $invoices = Invoices::withCount('Admin')->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id)->where('direct',1)->get();
        if($request->save_value != ''){
            $invoicesQuery->where("savedraft","=",$request->save_value);
        }
        if($request->from != ''){
            $from = date("Y-m-d",strtotime($request->from));
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d", strtotime($request->to));
            $invoicesQuery->where("date","<=",$to);
        }

        if($request->exports){
            //$this->export($invoicesQuery->get()->get());
            if($request->save_value){
                $this->exportInvoices($invoicesQuery->where('user_id',$request->user_id)->where("savedraft","=",$request->save_value)->get()->get());
            }else{
                $this->exportInvoices($invoicesQuery->where('user_id',$request->user_id)->get()->get());
            }
        }
        $invoices = $invoicesQuery->orderBy('date','desc')->paginate(25);
     //--------------------------------------------------------Nawares
        $gettoken = Token::find(1);
        $t = $gettoken->pluck('token');
        $token = $t[0];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.
        
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $token,        
            'Accept'        => 'application/json',
        ];
        // $id = 1;
        $response = $client->request('GET', 'api/newApi/get-bills', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();

        $json =  json_decode($data);
        //    dd($json);
        $bills =   $json->data->bills;
        $bills = $bills->data;
        $sumSh =0;
        foreach($bills as $key=>$bill){
            if($bills[$key]->status_id == 4){
            $sumSh += $bills[$key]->pirceatt;
            }
        }
        
        $final = ($getmoneys + $suminvoices + $sumSh ) - $paymoneys;
        return view('admin.report.locker',compact('id','final','suminvoices','getmoneys','paymoneys','sumSh',
            'users','invoices','today','userdd','items','invoicesitems','itemsCount','countItems','countItems2'));

    }

    public function lockermonthly($id = null , Request $request){
        $users = Admin::get();
        $mytime = Carbon::now();
  
        $date = $mytime->toDateTimeString();
        $today = date("Y/m/d",strtotime($date));

        $userd = Invoices::withCount('Admin')->where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('user_id');
        $getmoneys = Moneyorders::where('type','1')->whereBetween('dates', [$request->from, $request->to])->sum('value');
       
        $paymoneys = Moneyorders::where('type','2')->whereBetween('dates', [$request->from, $request->to])->sum('value');
       
        $userdd = count($userd);
        if($userdd != 0){
            $dd = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('id');
            $itemsDev = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',2)->pluck('status_id');
            $itemsDev2 = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',3)->pluck('status_id');
            $userds = Invoiceitems::whereIn('invoice_id',$dd)->pluck('item_id');
            //dd(count($userds));
            $items = Items::whereIn('id',$userds)->get();
            $countItems = count($itemsDev);
            $countItems2 = count($itemsDev2);
            //dd($countItems);
            $itemsCount = count($userds);
        }else{
            $itemsCount = 0;
            $countItems = 0;
            $countItems2 = 0;
        }

        $items = Items::get();
        $invoicesitems = Invoiceitems::get();
        $invoicesQuery = Invoices::with('Invoicespdf','clients')->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id);
        $suminvoices = Invoices::with('Invoicespdf','clients')->whereBetween('date', [$request->from, $request->to])->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id)->sum('afterdiscount');    
       
        $invoices = Invoices::withCount('Admin')->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id)->get();
        if($request->save_value != ''){
            $invoicesQuery->where("savedraft","=",$request->save_value);
        }
        if($request->from != ''){
            $from = date("Y-m-d",strtotime($request->from));
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d", strtotime($request->to));
            $invoicesQuery->where("date","<=",$to);
        }

        if($request->exports){
            //$this->export($invoicesQuery->get()->get());
            if($request->save_value){
                $this->exportInvoices($invoicesQuery->where('user_id',$request->user_id)->where("savedraft","=",$request->save_value)->get()->get());
            }else{
                $this->exportInvoices($invoicesQuery->where('user_id',$request->user_id)->get()->get());
            }
        }
        $invoices = $invoicesQuery->orderBy('date','desc')->paginate(25);
        $final = ($getmoneys + $suminvoices) - $paymoneys;
        return view('admin.report.locker',compact('id','suminvoices','getmoneys','paymoneys','final',
            'users','invoices','today','userdd','items','invoicesitems','itemsCount','countItems','countItems2'));

    }



    public function revenu($id = null , Request $request){
        $users = Admin::get();
        $mytime = Carbon::now();

      
       // dd($paymoney);
        $date = $mytime->toDateTimeString();
        $today = date("Y/m/d",strtotime($date));

        $userd = Invoices::withCount('Admin')->where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('user_id');
        $userdd = count($userd);
        if($userdd != 0){
            $dd = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('id');
            $itemsDev = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',2)->pluck('status_id');
            $itemsDev2 = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',3)->pluck('status_id');
            $userds = Invoiceitems::whereIn('invoice_id',$dd)->pluck('item_id');
            //dd(count($userds));
            $items = Items::whereIn('id',$userds)->get();
            $countItems = count($itemsDev);
            $countItems2 = count($itemsDev2);
            //dd($countItems);
            $itemsCount = count($userds);
        }else{
            $itemsCount = 0;
            $countItems = 0;
            $countItems2 = 0;
        }

        $items = Items::get();
        $invoicesitems = Invoiceitems::get();
        $invoicesQuery = Invoices::with('Invoicespdf','clients')->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id);
        $suminvoices = Invoices::with('Invoicespdf','clients')->where('status_id','!=',3)->where('user_id',$id)->sum('afterdiscount');   
        $sumbills = Bills::get()->sum('total_final_bill');
        $shipping = Invoices::with('Invoicespdf','clients')->where('status_id','!=',3)->where('user_id',$id)->sum('shipping_costs');   
        $companyexp = Companyexpenses::get()->sum('price');
        
        //dd($suminvoices);
        $invoices = Invoices::withCount('Admin')->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id)->where('direct',1)->get();
        if($request->save_value != ''){
            $invoicesQuery->where("savedraft","=",$request->save_value);
        }
        if($request->from != ''){
            $from = date("Y-m-d",strtotime($request->from));
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d", strtotime($request->to));
            $invoicesQuery->where("date","<=",$to);
        }

        if($request->exports){
            //$this->export($invoicesQuery->get()->get());
            if($request->save_value){
                $this->exportInvoices($invoicesQuery->where('user_id',$request->user_id)->where("savedraft","=",$request->save_value)->get()->get());
            }else{
                $this->exportInvoices($invoicesQuery->where('user_id',$request->user_id)->get()->get());
            }
        }
        $invoices = $invoicesQuery->orderBy('date','desc')->paginate(25);
        $final = $suminvoices - ($sumbills + $shipping +$companyexp);
        //dd($final);
        return view('admin.report.revenu',compact('id','final','suminvoices','sumbills','shipping','companyexp',
            'users','invoices','today','userdd','items','invoicesitems','itemsCount','countItems','countItems2'));

    }


    public function revenumonthly($id = null , Request $request){
        $users = Admin::get();
        $mytime = Carbon::now();

        $date = $mytime->toDateTimeString();
        $today = date("Y/m/d",strtotime($date));

        $userd = Invoices::withCount('Admin')->where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('user_id');
        // $getmoneys = Moneyorders::where('type','1')->where( DB::raw('MONTH(date)'), '=', date('n') )->sum('value');
        // $paymoneys = Moneyorders::where('type','2')->where( DB::raw('MONTH(date)'), '=', date('n') )->sum('value');
        $userdd = count($userd);
        if($userdd != 0){
            $dd = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('id');
            $itemsDev = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',2)->pluck('status_id');
            $itemsDev2 = Invoices::where('user_id',$id)->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',3)->pluck('status_id');
            $userds = Invoiceitems::whereIn('invoice_id',$dd)->pluck('item_id');
            //dd(count($userds));
            $items = Items::whereIn('id',$userds)->get();
            $countItems = count($itemsDev);
            $countItems2 = count($itemsDev2);
            //dd($countItems);
            $itemsCount = count($userds);
        }else{
            $itemsCount = 0;
            $countItems = 0;
            $countItems2 = 0;
        }

        $items = Items::get();
        $invoicesitems = Invoiceitems::get();
        $invoicesQuery = Invoices::with('Invoicespdf','clients')->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id);
        
        $suminvoices = Invoices::with('Invoicespdf','clients')->where('status_id','!=',3)->whereBetween('date', [$request->from, $request->to])->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id)->sum('total_invoice'); 
          $shipping = Invoices::with('Invoicespdf','clients')->where('status_id','!=',3)->whereBetween('date', [$request->from, $request->to])->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id)->sum('shipping_costs'); 
        $sumbills = Bills::whereBetween('date', [$request->from, $request->to])->sum('total_final_bill');  
       
        $companyexp = Companyexpenses::whereBetween('date', [$request->from, $request->to])->sum('price');

        $invoices = Invoices::withCount('Admin')->where('direct',1)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id)->get();
        if($request->save_value != ''){
            $invoicesQuery->where("savedraft","=",$request->save_value);
        }
        if($request->from != ''){
            $from = date("Y-m-d",strtotime($request->from));
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d", strtotime($request->to));
            $invoicesQuery->where("date","<=",$to);
        }

        if($request->exports){
            //$this->export($invoicesQuery->get()->get());
            if($request->save_value){
                $this->exportInvoices($invoicesQuery->where('user_id',$request->user_id)->where("savedraft","=",$request->save_value)->get()->get());
            }else{
                $this->exportInvoices($invoicesQuery->where('user_id',$request->user_id)->get()->get());
            }
        }
       
       $final = $suminvoices - ($sumbills + $shipping +$companyexp);
        $invoices = $invoicesQuery->orderBy('date','desc')->paginate(25);
        return view('admin.report.revenu',compact('id','suminvoices','sumbills','final','companyexp','shipping',
            'users','invoices','today','userdd','items','invoicesitems','itemsCount','countItems','countItems2'));

    }





    public function exportInvoicesOld($data)
    {
        //dd($request->user_id);
        if(!empty($data)){

            $invoices = Invoices::with('invoiceItem')->orderBy("id","DESC")->get();
            $invoicesData = [];
            foreach($data as $item){
                $invoicesData[] = [
                    trans('invoices.invoices_number')      => $item->id,
                    trans('invoices.date')                 => date("Y/m/d",strtotime($item->created_at)),
                    trans('clients.name_client')           => $item->clients->name_client,
                    trans('clients.phone')                 => $item->clients->phone,
                    trans('clients.city')                  => $item->clients->city,
                    trans('clients.notes')                 => $item->clients->notes,
                    trans('invoices.total_invoice')        => $item->total_invoice,
                    trans('invoices.notes')                => $item->notes,
                    trans('invoices.item_name')            => '',
                    trans('invoices.quantity')             => '',
                    trans('invoices.price')                => '',
                    trans('invoices.color')                => '',
                    trans('invoices.size')                 => '',
                ];
                $invoicesitems = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->get();
                foreach ($invoicesitems as $invoiceItem){
                    $invoicesData[] = [
                        trans('invoices.invoices_number')      => '',
                        trans('invoices.date')                 => '',
                        trans('clients.name_client')           => '',
                        trans('clients.phone')                 => '',
                        trans('clients.city')                  => '',
                        trans('clients.notes')                 => '',
                        trans('invoices.total_invoice')        => '',
                        trans('invoices.notes')                => '',
                        trans('invoices.item_name')            => $invoiceItem->items->item_name,
                        trans('invoices.quantity')             => $invoiceItem->quantity_b,
                        trans('invoices.price')                => $invoiceItem->price_b,
                        trans('invoices.color')                => $invoiceItem->ItemColor->name,
                        trans('invoices.size')                 => $invoiceItem->ItemSize->name,
                    ];
                }
            }

            if(count($invoicesData) > 0){
                Excel::create("تصدير فواتير البيع(".date("d-M-Y").")", function($excel) use($invoicesData) {
                    $excel->sheet('sheet1', function($sheet) use($invoicesData) {
                        $sheet->fromArray($invoicesData);

                        $sheet->cell('A1:F1',function($cell){
                            $cell->setBackground('#e8e8e8');
                            $cell->setFontWeight('bold');
                        });
                    });

                })->export('xls');
            }
        }else{
            //dd('dd');
            return redirect(aurl('invoices'));
        }

    }

    public function exportInvoices($data)
    {
  
        if(!empty($data)){

            $invoices = Invoices::with('invoiceItem')->orderBy("id","DESC")->get();
            $invoicesData = [];
            foreach($data as $item){
                $invoicesitems = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->get();
                $names ='';
                $quantities ='';
                $prices ='';
                $colors ='';
                $sizes ='';
                foreach ($invoicesitems as $invoiceItem){
                    $names.= $invoiceItem->items->item_name . ',';
                    $quantities.= $invoiceItem->quantity_b . ',';
                    $prices.= $invoiceItem->price_b . ',';
                    $colors.= $invoiceItem->ItemColor->name . ',';
                    $sizes.= $invoiceItem->ItemSize->name . ',';


//                    $invoicesData[] = [
//                        trans('invoices.invoices_number')      => '',
//                        trans('invoices.date')                 => '',
//                        trans('clients.name_client')           => '',
//                        trans('clients.phone')                 => '',
//                        trans('clients.city')                  => '',
//                        trans('clients.notes')                 => '',
//                        trans('invoices.total_invoice')        => '',
//                        trans('invoices.notes')                => '',
//                        trans('invoices.item_name')            => $invoiceItem->items->item_name,
//                        trans('invoices.quantity')             => $invoiceItem->quantity_b,
//                        trans('invoices.price')                => $invoiceItem->price_b,
//                        trans('invoices.color')                => $invoiceItem->ItemColor->name,
//                        trans('invoices.size')                 => $invoiceItem->ItemSize->name,
//                    ];
                }

                $names = substr_replace($names, "", -1);
                $quantities = substr_replace($quantities, "", -1);
                $prices = substr_replace($prices, "", -1);
                $colors = substr_replace($colors, "", -1);
                $sizes = substr_replace($sizes, "", -1);
                $invoicesData[] = [
                    trans('invoices.invoices_number')      => $item->id,
                    trans('invoices.date')                 => date("Y/m/d",strtotime($item->created_at)),
                    trans('clients.name_client')           => $item->clients->name_client,
                    trans('clients.phone')                 => $item->clients->phone,
                    trans('clients.city')                  => $item->clients->city,
                    trans('clients.notes')                 => $item->clients->notes,
                    trans('invoices.total_invoice')        => $item->total_invoice,
                    trans('invoices.notes')                => $item->notes,
                    trans('invoices.item_name')            => $names,
                    trans('invoices.quantity')             => $quantities,
                    trans('invoices.price')                => $prices,
                    trans('invoices.color')                => $colors,
                    trans('invoices.size')                 => $sizes,
                ];

            }

            if(count($invoicesData) > 0){
                Excel::create("تصدير فواتير البيع(".date("d-M-Y").")", function($excel) use($invoicesData) {
                    $excel->sheet('sheet1', function($sheet) use($invoicesData) {
                        $sheet->fromArray($invoicesData);

                        $sheet->cell('A1:F1',function($cell){
                            $cell->setBackground('#e8e8e8');
                            $cell->setFontWeight('bold');
                        });
                    });

                })->export('xls');
            }
        }else{
            //dd('dd');
            return redirect(aurl('invoices'));
        }

    }
    public function show($id = null , Request $request){
        //dd('k');
        $users = Admin::get();
        $mytime = Carbon::now();
        $date = $mytime->toDateTimeString();
        $today = date("Y/m/d",strtotime($date));

        $userd = Invoices::withCount('Admin')->where('user_id',$id)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('user_id');
        $userdd = count($userd);
        if($userdd != 0){
            $dd = Invoices::where('user_id',$id)->where( DB::raw('MONTH(date)'), '=', date('n') )->pluck('id');
            $itemsDev = Invoices::where('user_id',$id)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',2)->pluck('status_id');
            $itemsDev2 = Invoices::where('user_id',$id)->where( DB::raw('MONTH(date)'), '=', date('n') )->where('status_id',3)->pluck('status_id');
            $userds = Invoiceitems::whereIn('invoice_id',$dd)->pluck('item_id');
            $items = Items::whereIn('id',$userds)->get();
            $countItems = count($itemsDev);
            $countItems2 = count($itemsDev2);
            //dd($countItems);
            $itemsCount = count($items);
        }else{
            $itemsCount = 0;
            $countItems = 0;
            $countItems2 = 0;
        }

        $items = Items::get();
        $invoicesitems = Invoiceitems::get();
        //dd($request->user_id);
        if($request->user_id == ''){
            $invoicesQuery = Invoices::withCount('Admin')->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$id)->get();
        }else{
            $invoicesQuery = Invoices::withCount('Admin')->where( DB::raw('MONTH(date)'), '=', date('n') )->where('user_id',$request->user_id)->get();
        }

        if($request->from != ''){
            $from = date("Y-m-d H:i:s",strtotime($request->from));
            $invoicesQuery->where("created_at",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d H:i:s", strtotime($request->to));
            $invoicesQuery->where("created_at","<=",$to);
        }
        //dd($id);
        //$invoices = $invoicesQuery->orderBy('date','desc')->paginate(20);
        $invoices = $invoicesQuery;
        //dd($invoicesQuery);
        return view('admin.report.monthly',compact('items','item','id','sumBills','sumInvoice','sumBillsprice','sumInvoiceprice','currencies',
            'users','invoices','today','userdd','items','invoicesitems','itemsCount','countItems','countItems2'));

    }

}
