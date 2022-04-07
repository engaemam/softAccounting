<?php

namespace App\Http\Controllers\Admin;


use App\Admin;
use App\DataTables\BillsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Billdevicesitems;
use App\Model\Billdevies;
use App\Model\Billitems;
use App\Model\Bills;
use App\Model\Billspdf;
use App\Model\Clients;
use App\Model\Currencies;
use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\itemsColors;
use App\Model\Invoicedeviceitems;
use App\Model\Invoicedevices;
use App\Model\Invoiceitems;
use App\Model\Invoices;
use App\Model\InvoiceSources;
use App\Model\Invoicespdf;
use App\Model\Items;
use App\Model\Currencyrates;
use App\Http\Controllers\Admin\generalcontroller;
use App\Model\Colors;
use App\Model\Sizes;
use App\Model\ReturnedBill;
use App\Model\ReturnedBillItem;
use App\Model\ReturnedInvoices;
use App\Model\ReturnedInvoicesItems;
use App\Model\Specifications;
use App\Model\Suppliers;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\Fractal\Resource\Item;
use Storage;
use Excel;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ReturnedBillsController extends Controller
{

    public function index()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $returned_bills = ReturnedBill::orderBy('date','desc')->paginate(15);

        }else {

            $returned_bills = ReturnedBill::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy('date','desc')->paginate(15);

        }

        return view('admin.returned_bills.index', ['title' => trans('bills.show')],compact('returned_bills'));
    }
    public function search(Request $request){


        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $clients = Clients::get();
            $invoicesQuery = ReturnedInvoices::with('Invoicespdf','clients');

        }else {

            $clients = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $invoicesQuery = ReturnedInvoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('Invoicespdf','clients');

        }
        if($request->name_client != ''){
            $invoicesQuery = $invoicesQuery->whereHas('clients', function ($query){
                {
                    $query->where('name_client', 'LIKE', '%' . request()->name_client . '%');
                }
            });
        }

        if($request->from != ''){
            $from = date("Y-m-d H:i:s",strtotime($request->created_at));
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d H:i:s", strtotime($request->created_at));
            $invoicesQuery->where("date","<=",$to);
        }



        $invoices = $invoicesQuery->orderBy('date','desc')->paginate(20);



        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $getowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();

        $temp = [];
        foreach ($getowRoles as $role)
        {
            $temp[] = $role->getow;
        }
        // End Role Show And Hidden
        return view('admin.returned_bills.index',compact('invoices','temp','clients'));
    }
    public function createtwo($id,Request $request)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $items = Items::get();
            $supplier    = Suppliers::find($id);
            $currencies=Currencies::get();



        }else {

            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $supplier    = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($id);
            $currencies=Currencies::get();

        }





        $statement = DB::select("show table status like 'suppliers'");
        $modelid =  $statement[0]->Auto_increment;

        return view('admin.returned_bills.create2',compact('items','supplier','currencies','modelid'));
    }
   
    public function create()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){
            $invoices = Invoices::orderBy('id','desc')->pluck('id');

        }else {

            $invoices = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy('id','desc')->pluck('id');


        }
        return view('admin.returned_bills.create',compact('invoices'));
    }
    public function createRetured(Request $request)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $invoices      = Invoices::find($request->invoice_id);
            $invoiceitem      = Invoices::find($request->invoice_id);
            $invoiceitems = Invoiceitems::where('invoice_id',$request->invoice_id)->get();
            $items      = Items::get();
            $itemsizes = Sizes::get();
            $itemscolors = ItemsColors::get();
            $itemSizes = Specifications::with('specificsize2')->get();
            $invoicesources    = InvoiceSources::get();


        }else {
            $invoices      = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($request->invoice_id);
            $invoiceitem      = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($request->invoice_id);
            $invoiceitems = Invoiceitems::where('invoice_id',$request->invoice_id)->get();
            $items      = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemsizes = Sizes::get();
            $itemscolors = ItemsColors::get();
            $itemSizes = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificsize2')->get();
            $invoicesources    = InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();


        }


        return view('admin.returned_bills.createfinal',compact('invoices','invoiceitems','invoiceitem','invoicesources','items','itemscolors','itemsizes','itemSizes'));
    }



    public function store(Request $request)
    {

//dd('dd');
        $data = request()->validate(
            [
                //'bill_number' => 'required',
                'date' => '',
                'color' => 'required',
                'shipping_costs' => '',
                'afterdiscount' => '',
                'size' => 'required',
                'supplier_id' => '',
                'price_eg' => '',


            ], [], [
            //'bill_number' => trans('bills.bill_number'),
            'date' => trans('bills.date'),
            'shipping_costs' => trans('bills.shipping_costs'),
            'afterdiscount' => trans('bills.afterdiscount'),
            'color' => trans('bills.color'),
            'size' => trans('bills.size'),
            'supplier_id' =>trans('bills.supplier_id'),
            'price_before_doller' =>trans('bills.price_before_doller'),
            'price_doller' =>trans('bills.price_doller'),
            'price_eg' =>trans('bills.price_eg'),

        ]);
        $data = request()->except(['_token', '_method','total_price1']);

//dd($request->savedraft);

        if($request->hasfile('pdf'))
        {

            foreach($request->file('pdf') as $file)
            {
                $name= rand(1,1000 ).time().'-'.$file->getClientOriginalName() ;
                $file->move(public_path().'/upload/returnedbills/', $name);
                $dataa[] = $name;
            }
        }
        if(empty($request->file('pdf'))){
            $dataa='';
        }
        $imageName = str_random(10).'.'.'png';
        $mytime = Carbon::now();
        $date = $mytime->toDateTimeString();
        $today = date("Y/m/d",strtotime($date));
        $returned_bill = ReturnedBill::create([
            //'bill_number'           => $request->bill_number,
            'savedraft'             => $request->savedraft,
            'barcode'               => $imageName,
            'date'                  => $today,
            'Seller_id'                  => Auth::guard('admin')->user()->Seller_id,
            'notes'                 => $request->notes,
            'supplier_id'           => $request->supplier_id,
            'price_before_doller'   => round($request->price_before_doller,2),
            'currency_id'           => $request->currency_id,
            'total_final_mgza'      => round($request->total_final_mgza,2),
            'total_final_mogma3'    => round($request->total_final_mogma3,2),
            'total_final_bill'      => $request->total_final_bill = round($request->total_final_mgza + $request->total_final_mogma3,2),
            'total_final_mogma3_egy'=> round($request->total_final_mogma3 * $request->price_before_doller,2),
            'total_final_mgza_egy'  => round($request->total_final_mgza * $request->price_before_doller,2),
            'total_final_bill_egy'  => round($request->price_before_doller * ($request->total_final_mgza + $request->total_final_mogma3),2) ,
        ]);
        if(!empty($request->pdf)) {
            foreach ($dataa as $key => $item) {
                $invoicesPDF = Billspdf::create([
                    'id_bills' => $returned_bill->id,
                    'pdf' => $item,
                ]);
            }
        }

//Strart Save Image Barcode


        $barcode = \DNS1D::getBarcodePNG( $returned_bill->id, 'C39');
        $image = $barcode; // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        \File::put(public_path('upload/barcodebills'). '/' . $imageName, base64_decode($image));

        //End Save Image Barcode

        $item_id_devices        = generalcontroller::notnull($request->input('item_id_devices'));
        if(!empty($request->item_id)){
            foreach ($request->item_id as $key => $item){
                $returned_billitems = ReturnedBillItem::create([
                    'bill_id'                       => $returned_bill->id,
                    'item_id'                       => $item,
                    'shipping_costs'                => $request->input('shipping_costs')[$key],
                    'afterdiscount'                 => $request->input('total_final_mgza') - $request->input('discount'),
                    'color'                         => $request->input('color')[$key],
                    'size'                          => $request->input('size')[$key],
                    //'barcode'                       => $imageName,
                    'quantity_b'                    => $request->input('quantity_b')[$key],
                    'price_b'                       => round($request->input('price_b')[$key],2),
                    'total_price_b'                 => round($request->input('total_price_b')[$key],2),
                    'price_b_egy'                   => round(($request->input('price_b')[$key] * ($returned_bill->price_before_doller)),2),
                    'total_price_b_egy'             => round(($request->input('total_price_b')[$key]),2),
                ]);

                if($request->savedraft == 1) {
                    if ($request->input('price_b')[$key] == 0) {
                        if ($item = Items::find($item)) {
                            $item->quantity += $request->quantity_b[$key];
                            $item->save();
                        }
                    } else {
                        if ($item = Items::find($item)) {
                            $item->quantity += $request->quantity_b[$key];
                            $item->price = round(($request->price_b[$key] ), 2);
                            $item->save();
                        }

                    }
                }

            }
        }
        if (!empty($request->devices)){
            foreach ($request->devices as $device_id => $device)
            {

                // single device
                $returned_billdevies = Billdevies::create([
                    'bill_id'                    => $returned_bill->id,
                    'device_id'                     => $device['device_id'],
                    'quantity'                      => $device['device_quantity'],
                    'onedevices'                    => round(($device['device_total_price'] / $device['device_quantity']),2),
                    'onedevices_egy'                => round((($device['device_total_price'] / $device['device_quantity'])*($returned_bill->price_before_doller)),2),
                    'total_price'                   => round($device['device_total_price'],2),
                    'total_price_egy'               => round($device['device_total_price']*($returned_bill->price_before_doller),2),
                ]);
                foreach ($device['device_items'] as $item_id => $item) {
                    $returned_billdevicesitems = Billdevicesitems::create([
                        'bill_id' => $returned_bill->id,
                        'device_id' => $device['device_id'],
                        'item_id_devices' => $item['id'],
                        'quantity_devices' => round((( $item['qu'])), 2),
                        'price_devices' => round(($item['p']), 2),
                        'total_devices' => round(($item['total_p'] ), 2),

                        'price_devices_egy' => round(($item['p']* ($returned_bill->price_before_doller)),2),
                        'total_devices_egy' => round(($item['total_p']* ($returned_bill->price_before_doller)),2),
                        'quantity_old'      => round(($item['quantity_old']),2),
                    ]);
                }
            }
        }
        if($request->savedraft == 1){
            generalcontroller::countdiv($returned_bill->id);
        }
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('returnedbills'));
    }


    public function show($id)
    {
        //
    }




    public function update(Request $request, $id)
    {
      //  dd($request->get());
        $data = request()->validate(
            [
                //'invoice_number'   => 'required',
                'date'              => '',
                'client_id'         => 'required',
                'afterdiscount'       => '',
                // 'city'         => 'required',
               // 'color'         => 'required',
               // 'size'         => 'required',
                // 'invoice_source_id'         => 'required',

            ], [], [
            //'invoice_number'   => trans('invoices.invoice_number'),
            'date'              => trans('invoices.date'),
            'client_id'         => trans('invoices.client_id'),
            'afterdiscount'     => trans('invoices.afterdiscount'),
            'city'         => trans('invoices.city'),
           // 'color'         => trans('invoices.color'),
           // 'size'         => trans('invoices.size'),
            'invoice_source_id'         => trans('invoices.bill_source'),


        ]);
        $data = request()->except(['_token', '_method']);
        if($request->city == null){
            $city = "لا يوجد";
        }else{
            $city = $request->city;
        }
         if($request->invoice_source_id == null){
            $source = 0;
        }else{
            $source = $request->invoice_source_id;
        }
       
        //dd($request->afterdiscount);
        $imageName = str_random(10).'.'.'png';
        $invoices = ReturnedInvoices::create([
            //'invoice_number'        => $request->invoice_number,
            'invice_id'             => $id,
            'savedraft'             => $request->savedraft,
            'client_id'             => $request->client_id,
            //'date'                  => $request->date,
            'city'                  => $city,
            // 'shipping_costs'        => $request->shipping_costs,
            // 'discount'              => $request->discount,
            // 'afterdiscount'          => $request->afterdiscount,
            'invoice_source_id'        => $source,
            'barcode'               => $imageName,
            
            'currency_id'           => round($request->currency_id,2),
            'notes'                 => $request->notes,
            'total_final_mgza'      => round(($request->total_final_mgza),2),
            'total_final_mogma3'    => round(($request->total_final_mogma3),2),
            'total_invoice'         => round(($request->total_invoice = $request->total_final_mgza + $request->total_final_mogma3),2),
        ]);
        //Strart Save Image Barcode


        $barcode = \DNS1D::getBarcodePNG( $invoices->id, 'C39');
        $image = $barcode; // your base64 encoded
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        \File::put(public_path('upload/barcode'). '/' . $imageName, base64_decode($image));

        //End Save Image Barcode

        if(!empty($request->item_id)){

            foreach ($request->item_id as $key => $item){
                $invoiceItems = ReturnedInvoicesItems::insert([
                    'invoice_id'                        => $invoices->id,
                    'item_id'                           => $item,
                    'afterdiscount'                     => $request->input('total_final_mgza') - $request->input('discount'),
                   'color'                             =>$request->input('color')[$key],
                    'size'                              => $request->input('size')[$key],
                    'quantity_b'                        => $request->quantity_b[$key],
                    'price_b'                           => round($request->price_b[$key],2),
                    'total_price_b'                     => round($request->total_price_b[$key],2),
                ]);

                    if($item = Items::find($item)){
                        if(empty($request->quantity_b[$key])){

                        }else{
                            //$item->quantity = $item->quantity + $request->quantity_b[$key];
                            $item->quantity += $request->quantity_b[$key];
                            $item->save();
                        }

                    }
                $color = $request->input('color')[$key];
                $size = $request->input('size')[$key];
                $idSpecific = Specifications::where('item_id', $item->id)->where('size', $size)->where('color_id', $color)->pluck('id');
                //dd($idSpecific);
                if ($specific = Specifications::find($idSpecific)->first()) {
                    $specific->quantity += $request->quantity_b[$key];
                    //dd($specific);
                    $specific->save();
                }

            }
        }

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('returnedbills'));
    }



    public function destroy($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            generalcontroller::DeleteBill($id);
            ReturnedBill::find($id)->delete();
        }else {
            generalcontroller::DeleteBill($id);
            ReturnedBill::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($id)->delete();
        }

        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('returnedbills'));
    }



    public function bill($id = null, $from_cur = null, $to_cur = null){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $invoices      = ReturnedInvoices::find($id);
            $invoiceitem      = ReturnedInvoices::find($id);
            $invoicess     = ReturnedInvoicesItems::with('invoices')->where('invoice_id',$id)->get();
            $invoiceitems = ReturnedInvoicesItems::where('invoice_id',$id)->get();
            $items      = Items::get();
            $itemscolors = ItemsColors::get();
            $devices   = Devices::get();
            $itemSizes = Specifications::with('specificsize2')->get();
            $invoicesources    = InvoiceSources::get();



        }else {

            $invoices      = ReturnedInvoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($id);
            $invoiceitem      = ReturnedInvoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($id);
            $invoicess     = ReturnedInvoicesItems::with('invoices')->where('invoice_id',$id)->get();
            $invoiceitems = ReturnedInvoicesItems::where('invoice_id',$id)->get();
            $items      = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemSizes = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificsize2')->get();
            $invoicesources    = InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }
        return view('admin.returned_bills.show',compact('invoicess','invoices','invoiceitems','invoiceitem','invoicesources','items','itemscolors','itemSizes'));

        //return view("admin.returned_bills.show",compact('returned_bills','suppliers','returned_billitems','rate','currencies','returned_billdevies','items','billdeviesitems','currencyrates','percentageTax','afterdis','returned_billscolor','returned_billsize','count'));
    }




}
