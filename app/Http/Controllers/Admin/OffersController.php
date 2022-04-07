<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\Http\Controllers\Controller;
use App\Model\Category;
use App\Model\City;
use App\Model\req;
use App\Model\Clients;
use App\Model\Currencies;
use App\Model\Currencyrates;
use App\Model\Devices;
use App\Model\Colors;
use App\Model\Inovice_status;
use App\Model\Invoicedeviceitems;
use App\Model\Invoicedevices;
use App\Model\InvoiceSources;
use App\Model\Invoiceitems;
use App\Model\Invoices;
use App\Model\ItemsSize;
use App\Model\Invoicespdf;
use App\Model\ReturnedInvoices;
use App\Model\ReturnedInvoicesItems;
use App\Model\Sizes;
use App\Model\Specifications;
use App\Model\Items;
use App\Offers;
use Excel;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Http\Request;

class OffersController extends Controller
{

    public function index(Request $request)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $items = Offers::where('name', 'like', '%' . request()->search . '%')
                ->orwhere('specifications', 'like', '%' . request()->search . '%')


                //->orderBy("`quantity`= 0,`quantity`")
                ->orderBy('id', 'DESC')
                ->paginate(20);



        }else {

            $items = Offers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('name', 'like', '%' . request()->search . '%')
                ->orwhere('specifications', 'like', '%' . request()->search . '%')


                //->orderBy("`quantity`= 0,`quantity`")
                ->orderBy('id', 'DESC')
                ->paginate(20);

        }



        $items->appends(['search' => $request]);

        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role) {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        //generalcontroller::checkbill();

        return view('admin.offers.index', compact('items', 'temp'));
    }
    

    public function create()
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $items_cates = Category::get();
            $items = Items::get();




        }else {

            $items_cates = Category::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->
            get();
            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->
            get();


        }
        $statement = DB::select("show table status like 'items'");
        $modelid = $statement[0]->Auto_increment;
        //$currencies=Currencies::get();
        return view('admin.offers.create', ['title' => trans('items.create')], compact('items_cates', 'items', 'modelid'));
    }

    public function show($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){
            $offer = Offers::findOrFail($id);
            $items = $offer->items;
            $specifications = Specifications::with('specificolor')->with('specificsize')->where('item_id', $id)->get();

        }else {
            $offer = Offers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);
            $items = $offer->items;
            $specifications = Specifications::with('specificolor')->with('specificsize')->where('item_id', $id)->get();
        }
        $title = trans('items.edit');
        return view('admin.offers.show', compact('items', 'title',  'specifications', 'offer'));

    }

    public function store(Request $request)
    {
        //dd($request->get());
        $data = request()->validate(
            [
                'name' => 'required|unique:offers',
                'price' => '',
                'newprice' => '',
                'specifications' => '',
                'quantity' => '',
                'selling_price' => '',
                'count' => '',

            ], [], [
            'name' => trans('items.name_ar'),
            'specifications' => trans('items.specifications'),
            'selling_price' => trans('specific.selling_price'),
            'count' => trans('specific.count'),
        ]);
        if(request()->hasFile('image')) {
            $file = request()->file('image');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/offers/'), $name);
            $data['image'] =  $name;

        }
        $data = request()->except(['_token', '_method']);
        if(request()->hasFile('image')){
            $image = $name;
        }else{
            $image = '';
        }
        $data = request()->except(['_token', '_method']);
        // Offers::insert([
        //     'name' => $request->name,
        // //    'item_id' => $item,
        //     'specifications' => $request->specifications,
        //     'price' => $request->price,
        //     'image' => $image,
        //     'notes' => $request->notes,
        //     // 'selling_price' => $request->selling_price[$key],
        //     // 'total_price_b' => $request->total_price_b[$key],
        //     // 'quantity_b' => $request->quantity_b[$key],
        // ]);
        
        foreach ($request->item_id as $key => $item)
       // dd($request->item_id );
          
        {   
           //dd($request->get());
            Offers::insert([
              
                'name' => $request->name,
                'item_id' => $item,
                'specifications' => $request->specifications,
                'price' => $request->price,
                'Seller_id' => Auth::guard('admin')->user()->Seller_id,
                'image' => $image,
                'notes' => $request->notes,
                 'selling_price' => $request->selling_price[$key],
                 'total_price_b' => $request->total_price_b[$key],
                 'quantity_b' => $request->quantity_b[$key],
            ]);
        }
      
        //dd($request->get());
        //dd(Offers::latest()->first()->items()->attach($request->item_id));
        Offers::latest()->first()->items()->attach($request->item_id);
      
        session()->flash('success', trans('admin.record_added'));

        return redirect(url('admin/offers'));
    }


    public function edit($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $items = Items::with('Items')->find($id);
            $specifications = Specifications::with('specificolor')->with('specificsize')->where('item_id', $id)->get();
        }else {
            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('Items')->find($id);
            $specifications = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificolor')->with('specificsize')->where('item_id', $id)->get();


        }


        $title = trans('items.edit');
        return view('admin.items.edit', compact('items', 'title', 'specifications', 'items_colors'));
    }


    public function update(Request $request, $id)
    {
        $items = Items::find($id);
        if ($items->item_name == $request->item_name) {
            $data = $this->validate(request(),
                [
                    'item_name' => 'required',
                    'category_id' => 'required',
                    'color_id' => 'required',
                    'size' => 'required',
                    'count' => '',
                    'selling_price' => 'required',
                    'specifications' => '',
                    'image' => '',
                    'quantity' => '',

                ], [], [
                    'item_name' => trans('items.name'),
                    'color_id' => trans('specific.color'),
                    'size' => trans('specific.size'),
                    'size' => trans('specific.selling_price'),
                    'count' => trans('specific.count'),
                    'category_id' => trans('items.item_cates'),
                ]);
        } else {
            $data = $this->validate(request(),
                [
                    'item_name' => 'required|unique:items',
                    'category_id' => 'required',
                    'color_id' => 'required',
                    'size' => 'required',
                    'count' => '',
                    'selling_price' => 'required',
                    'specifications' => '',
                    'image' => '',
                    'quantity' => '',

                ], [], [
                    'item_name' => trans('items.name'),
                    'category_id' => trans('items.item_cates'),
                    'selling_price' => trans('items.selling_price'),
                    'color_id' => trans('specific.color'),
                    'size' => trans('specific.size'),
                    'count' => trans('specific.count'),
                ]);
        }

        $data = $this->validate(request(),
            [
                'item_name' => 'required',
                'category_id' => 'required',
                'specifications' => '',
                'image' => '',
                'quantity' => '',


            ], [], [
                'item_name' => trans('items.name'),
                'category_id' => trans('items.item_cates'),


            ]);
        $data = request()->except(['_token', '_method']);
        if (request()->hasFile('image')) {
            $file = request()->file('image');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/items/'), $name);
            $data['image'] = $name;

        }
        // Items::where('id', $id)->update($data);
        $idSpecific = Specifications::where('item_id', $id)->sum('quantity');
        $all = Items::find($id);
        $all->id = $id;
        $all->category_id = $request->category_id;
        $all->item_name = $request->item_name;
        $all->specifications = $request->specifications;
        if (request()->hasFile('image')) {
            $all->image = $name;
        }
        //$all->city= $request->city;
        $all->quantity = $idSpecific;
        $all->price = 0;
        $all->newprice = 0;
        $all->save();
        $deletedRows = Specifications::where('item_id', $all->id)->delete();
        if (!empty($request->color_id)) {
            foreach ($request->color_id as $key => $item) {
                //$quantity = 0;
                $specifications = Specifications::create([
                    'item_id' => $all->id,
                    'quantity' => $request->input('quantity')[$key],
                    'color_id' => $request->input('color_id')[$key],
                    'selling_price' => $request->input('selling_price')[$key],
                    'size' => $request->input('size')[$key],
                ]);

            }
        }
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('items'));
    }

    public function destroy($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            if (generalcontroller::alreadycheck($id) == '1') {
                session()->flash('error', trans('admin.deleted_record_cant'));
                return redirect(aurl('items'));

            } else {

                Offers::find($id)->delete();
                DB::table('items_offers')->where('offers_id', $id)->delete();


                session()->flash('success', trans('admin.deleted_record'));
                return redirect(aurl('offers'));
            }


        }else {

            if (generalcontroller::alreadycheck($id) == '1') {
                session()->flash('error', trans('admin.deleted_record_cant'));
                return redirect(aurl('items'));

            } else {

                Offers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($id)->delete();
                DB::table('items_offers')->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('offers_id', $id)->delete();


                session()->flash('success', trans('admin.deleted_record'));
                return redirect(aurl('offers'));
            }

        }


    }





   

    public function requests(Request $request){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $clients = Clients::pluck('name_client','id');
            $clients_phone = Clients::pluck('phone','id');
            $cities = City::pluck('name','id');
            $users = Admin::pluck('name','id');
            $reqs = req::pluck('id');
            $invoicesStatus = Inovice_status::pluck('name','id');
            $sources = InvoiceSources::get();
            $invoicesQuery = Invoices::with('Invoicespdf','clients')->where('validate',false);



        }else {

            $clients = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->pluck('name_client','id');
            $clients_phone = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->pluck('phone','id');
            $cities = City::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->pluck('name','id');
            $users = Admin::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->pluck('name','id');
            $reqs = req::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->pluck('id');
            $invoicesStatus = Inovice_status::pluck('name','id');
            $sources = InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

            $invoicesQuery = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('Invoicespdf','clients')->where('validate',false);


        }

        $user_id = Auth::guard('admin')->user()->id;
        $data = DB::select('select clients_id,COUNT(*) as count from requests where status = 0 GROUP BY clients_id');

        if($request->city != ''){
            $invoicesQuery = $invoicesQuery->whereHas('clients', function ($query){
                {
                    $query->where('city', 'LIKE', '%' . request()->city . '%');
                }
            });
        }
        if($request->name_client != ''){
            $invoicesQuery->where("client_id","=",$request->name_client);
        }
        if($request->client_phone != ''){
            $invoicesQuery->where("client_id","=",$request->client_phone);
        }
        if($request->user_id != ''){
            $invoicesQuery->where("user_id","=",$request->user_id);
        }

        if($request->from != ''){
            $from = date("Y-m-d",strtotime($request->from));
            //dd($from);
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d", strtotime($request->to));
            $invoicesQuery->where("date","<=",$to);
        }
        if($request->exports){
            //$this->export($invoicesQuery->get()->get());
            $this->exportInvoices($invoicesQuery->get()->get());
        }
        $invoices = $invoicesQuery->orderBy('date','desc')->paginate(20);
      //  dd($invoices);
       // dd($invoices);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        
        return view('admin.offers.requests',compact('data','reqs','sources','invoices','temp','clients','invoicesStatus','cities','users','clients_phone'));
    }

    

    public function confirmRequest(Request $request)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $invoice = Invoices::find($request->id);
            $invoice->validate = true;
            $invoice->save();


        }else {

            $invoice = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($request->id);
            $invoice->validate = true;
            $invoice->save();

        }

        session()->flash('success', 'تم تأكيد الطلب بنجاح');
        return redirect(aurl('offer/requests'));
    }
    public function changestatues($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $mytime = Carbon::now();
            $date = $mytime->toDateTimeString();
            $today = date("Y-m-d",strtotime($date));
            $reqs = req::findOrFail($id);
            $reqs['status'] = 0;
            $reqs['updated_at'] = $today;
            $reqs->save();



        }else {

            $mytime = Carbon::now();
            $date = $mytime->toDateTimeString();
            $today = date("Y-m-d",strtotime($date));
            $reqs = req::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);
            $reqs['status'] = 0;
            $reqs['updated_at'] = $today;
            $reqs->save();

        }

        return redirect(aurl('offer/requests'));
    }
    public function destroyreq($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $this->DeleteBill($id);
            $this->DeleteSpecific($id);
            Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();


        }else {
            $this->DeleteBill($id);
            $this->DeleteSpecific($id);
            Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();


        }

        session()->flash('success', 'تم رفض طلب الزبون بنجاح');
        return redirect(aurl('offer/requests'));
    }
    //Delete Bill
    public  function DeleteBill($id){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $ReturnedInvoices = ReturnedInvoices::where('invice_id',$id)->get()->pluck('id');

            $ReturnedInvoicesItems  = ReturnedInvoicesItems::whereIn('invoice_id',$ReturnedInvoices)->sum('quantity_b');
            //dd($ReturnedInvoicesItems);
            $invoiceitems = Invoiceitems::where('invoice_id',$id)->get();
            foreach ( $invoiceitems as $invoiceitem)
            {
                $getitem = Items::where('id',$invoiceitem->item_id)->value('quantity');
                $sub = $getitem + $invoiceitem->quantity_b  - $ReturnedInvoicesItems ;

                $updatequantiy = Items::where('id',$invoiceitem->item_id)->update(['quantity'=>$sub]);

                //Invoiceitems::find($invoiceitem->id)->delete();

            }

            $Invoicespdf = Invoicespdf::where('id_invoices',$id)->get();
            foreach ($Invoicespdf as $value2)
            {
                Invoicespdf::find($value2->id)->delete();
            }





        }else {



            $ReturnedInvoices = ReturnedInvoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('invice_id',$id)->get()->pluck('id');

            $ReturnedInvoicesItems  = ReturnedInvoicesItems::whereIn('invoice_id',$ReturnedInvoices)->sum('quantity_b');
            //dd($ReturnedInvoicesItems);
            $invoiceitems = Invoiceitems::where('invoice_id',$id)->get();
            foreach ( $invoiceitems as $invoiceitem)
            {
                $getitem = Items::where('id',$invoiceitem->item_id)->value('quantity');
                $sub = $getitem + $invoiceitem->quantity_b  - $ReturnedInvoicesItems ;

                $updatequantiy = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id',$invoiceitem->item_id)->update(['quantity'=>$sub]);

                //Invoiceitems::find($invoiceitem->id)->delete();

            }

            $Invoicespdf = Invoicespdf::where('id_invoices',$id)->get();
            foreach ($Invoicespdf as $value2)
            {
                Invoicespdf::find($value2->id)->delete();
            }


        }


    }
    public  function DeleteSpecific($id){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $invoices = ReturnedInvoices::where('invice_id',$id)->get()->pluck('id');

            $ReturnedInvoicesItems  = ReturnedInvoicesItems::whereIn('invoice_id',$invoices)->sum('quantity_b');
            $invoiceitems = Invoiceitems::where('invoice_id',$id)->get();




        }else {
            $invoices = ReturnedInvoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('invice_id',$id)->get()->pluck('id');

            $ReturnedInvoicesItems  = ReturnedInvoicesItems::whereIn('invoice_id',$invoices)->sum('quantity_b');
            $invoiceitems = Invoiceitems::where('invoice_id',$id)->get();



        }

        foreach ( $invoiceitems as $invoiceitem)
        {
            $getitem = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id',$invoiceitem->item_id)->where('color_id',$invoiceitem->color)
                ->where('size',$invoiceitem->size)->value('quantity');

            $sub = $getitem + $invoiceitem->quantity_b - $ReturnedInvoicesItems  ;
            $updatequantiy = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id',$invoiceitem->item_id)->where('color_id',$invoiceitem->color)
                ->where('size',$invoiceitem->size)->update(['quantity'=>$sub]);

            Invoiceitems::find($invoiceitem->id)->delete();

        }

    }



    public function showreq($id=null, $from_cur = null, $to_cur = null){


        if (Auth::guard('admin')->user()->Seller_id == 0 ){




            $invoices             = Invoices::with('clients','currencies')->find($id);
            $invoiceitems         = Invoiceitems::with('items')->where('invoice_id',$id)->get();
            $invoicedevices       = Invoicedevices::with('devices')->where('invoice_id',$id)->get();
            $invoicedeviceitems   = Invoicedeviceitems::with('items')->where('invoice_id',$id)->get();
            $itemSizes = Specifications::with('specificsize')->get();
            @$currencies           = Currencies::where('id', '!=', $invoices->currency_id)->get();
            $currencyrates        = Currencyrates::get();
            $billsize = ItemsSize::get();
            $rate                 = $this->cur($id, $from_cur, $to_cur);
            $items                = Items::get();
            $req=true;
            $offer = Offers::find($invoices->offer_id);

        }else {

            $invoices             = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('clients','currencies')->find($id);
            $invoiceitems         = Invoiceitems::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('items')->where('invoice_id',$id)->get();
            $invoicedevices       = Invoicedevices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('devices')->where('invoice_id',$id)->get();
            $invoicedeviceitems   = Invoicedeviceitems::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('items')->where('invoice_id',$id)->get();
            $itemSizes = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificsize')->get();
            @$currencies           = Currencies::where('id', '!=', $invoices->currency_id)->get();
            $currencyrates        = Currencyrates::get();
            $billsize = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $rate                 = $this->cur($id, $from_cur, $to_cur);
            $items                = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $req=true;
            $offer = Offers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($invoices->offer_id);

        }


        return view("admin.invoices.show",compact('billsize','offer','req','invoices','invoiceitems','rate','currencies','invoicedevices','items','invoicedeviceitems','currencyrates','itemSizes'));
    }
    public function cur($id = null, $from_cur = null, $to_cur = null){
        @$rate = Currencyrates::where('currency_id',$from_cur)->where('to_currency_id',$to_cur)->first();

        return $rate;

    }



}
