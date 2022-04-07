<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Http\Controllers\Controller;


use App\Model\BillSource;
use App\Model\Clients;
use App\Model\Currencies;
use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\Inovice_status;
use App\Model\Invoicedeviceitems;
use App\Model\Invoicedevices;
use App\Model\Invoiceitems;
use App\Model\Invoices;
use App\Model\InvoiceSources;
use App\Model\Invoicespdf;
use App\Model\Items;
use App\Model\ReturnedInvoices;
use App\Model\ReturnedInvoicesItems;
use App\Model\Specifications;
use App\Model\Subdevices;
use App\Model\Suppliers;
use App\Model\Currencyrates;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use League\Fractal\Resource\Item;
use phpDocumentor\Reflection\Types\Null_;
use Storage;
use Excel;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ReturnedInvoicesController extends Controller
{

    public function index()
    {
        $clients = Admin::get();
        $invoices = Invoices::with('invoiceSource')->orderBy('date','desc')->paginate(15);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.returned_invoices.index',compact('invoices','temp','clients'));
    }
    public function search(Request $request){
        $clients = Admin::get();
        $invoicesQuery = Invoices::with('Invoicespdf','clients');

//        if($request->invoice_number != ''){
//            $invoicesQuery->where('invoice_number', 'LIKE', '%' . request()->invoice_number . '%');
//        }
        if($request->name_client != ''){
            $invoicesQuery = $invoicesQuery->whereHas('clients', function ($query){
                {
                    $query->where('name_client', 'LIKE', '%' . request()->name_client . '%');
                }
            });
        }

        if($request->from != ''){
            $from = date("Y-m-d H:i:s",strtotime($request->from));
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d H:i:s", strtotime($request->to));
            $invoicesQuery->where("date","<=",$to);
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
        return view('admin.returned_invoices.index',compact('invoices','temp','clients'));
    }
    // Start GET ITEMS [Quantity , Price]

    public function itemsid( $id , Request $request){
        $ItemsId = items::where('id',$id)->get();

        if (!empty($ItemsId)) {

            return view("admin.returned_invoices.mgza.getitem",compact('ItemsId','id'));
        }else{
            return "Undefined";
        }

    }
    public function getItemsQuantity( $id , Request $request){
        $ItemsId = items::where('id',$id)->get();

        if (!empty($ItemsId)) {
            return view("admin.returned_invoices.mgza.getQuantity",compact('ItemsId','id'));
        }else{
            return "Undefined";
        }

    }
    // End GET ITEMS [Quantity , Price]

    public function deviceid($id,Request $request){
        $DeviceId = Deviceitems::with('items')->where('devices_id',$id)->get();
        $sbudevic = Subdevices::where('device_id',$id)->pluck('subdevice_id');
        $sbudevicz = Subdevices::where('device_id',$id)->get();
        $ItemsId = items::where('id',$id)->get();




        if (!empty($DeviceId)) {
            if(!empty($sbudevicz[0])){
                $subid = Deviceitems::with('items')->wherein('devices_id',$sbudevic)->get();

                return view("admin.returned_invoices.ajax",compact('DeviceId','id','subid','sbudevicz','ItemsId'));

            }
            return view("admin.returned_invoices.ajax",compact('DeviceId','id','sbudevicz'));

        }else{
            return "Undefined";
        }

    }
    public function createtwo($id,Request $request)
    {
        $invoices   = new Invoices(\Request::old());
        //$id = $data['id'] = $id;
        $client    = Clients::find($id);
        $items      = Items::get();
        $devices    = Devices::get();
        $currencies = Currencies::get();
        $invoicesources    = InvoiceSources::get();
        $statement = DB::select("show table status like 'clients'");
        $modelid =  $statement[0]->Auto_increment;
        return view('admin.returned_invoices.create2',compact('items','client','invoices','devices','currencies','invoicesources','modelid'));
    }
    public function create(Request $request)
    {
        $invoices   = new Invoices(\Request::old());
        $clients    = Clients::get();
        $items      = Items::get();
        $devices    = Devices::get();
        $currencies = Currencies::get();
        $invoicesources    = InvoiceSources::get();
        $statement = DB::select("show table status like 'clients'");
        $modelid =  $statement[0]->Auto_increment;
        return view('admin.returned_invoices.create',compact('items','clients','invoices','devices','currencies','invoicesources','modelid'));
    }




    public function store(Request $request)
    {
        //DD($_POST);

        $data = request()->validate(
            [
                //'invoice_number'   => 'required',
                'date'              => 'required',
                'client_id'         => 'required',
                'city'         => 'required',
                'invoice_source_id'         => 'required',

            ], [], [
            //'invoice_number'   => trans('invoices.invoice_number'),
            'date'              => trans('invoices.date'),
            'client_id'         => trans('invoices.client_id'),
            'city'         => trans('invoices.city'),
            'invoice_source_id'         => trans('invoices.bill_source'),


        ]);
        $data = request()->except(['_token', '_method']);

        if($request->hasfile('pdf'))
        {

            foreach($request->file('pdf') as $file)
            {
                $name= rand(1,1000 ).time().'-'.$file->getClientOriginalName() ;
                $file->move(public_path().'/upload/invoices/', $name);
                $dataa[] = $name;
            }
        }
        if(empty($request->file('pdf'))){
            $dataa='';
        }
        $imageName = str_random(10).'.'.'png';
        $invoices = Invoices::create([
            //'invoice_number'        => $request->invoice_number,
            'savedraft'             => $request->savedraft,
            'client_id'             => $request->client_id,
            'date'                  => $request->date,
            'city'                  => $request->city,
            'invoice_source_id'        => $request->invoice_source_id,
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
        if(!empty($request->pdf)) {
            foreach ($dataa as $key => $item) {
                $invoicesPDF = Invoicespdf::create([
                    'id_invoices' => $invoices->id,
                    'pdf' => $item,
                ]);
            }
        }
        if(!empty($request->item_id)){

            foreach ($request->item_id as $key => $item){
                $invoiceItems = Invoiceitems::insert([
                    'invoice_id'                        => $invoices->id,
                    'item_id'                           => $item,
                    'quantity_b'                        => $request->quantity_b[$key],
                    'price_b'                           => round($request->price_b[$key],2),
                    'total_price_b'                     => round($request->total_price_b[$key],2),
                ]);
                if($request->savedraft == 1){
                    if($item = Items::find($item)){
                        $item->quantity -= $request->quantity_b[$key];
                        $item->save();
                    }
                }
            }
        }

        if (!empty($request->devices)){
            foreach ($request->devices as $device_id => $device)
            {
                // single device
                $invoiceDevices = Invoicedevices::create([
                    'invoice_id'                    => $invoices->id,
                    'device_id'                     => $device_id,
                    'quantity'                      => $device['device_quantity'],
                    'onedevice'                     => round($device['device_price'],2),
                    'total_price'                   => round($device['device_total_price'],2),
                ]);
                foreach ($device['device_items'] as $item_id => $item) {
                    $InvoiceDeviceItems = Invoicedeviceitems::create([
                        'invoice_id'        => $invoices->id,
                        'device_id'         => $device_id,
                        'item_id_devices'   => $item['id'],
                        'quantity_devices'  => round((($device['device_quantity'] * $item['qu'])), 2),
                        'quantity_old'      => round((($item['quantity_old'])), 2),
                        'price_devices'     => round(($item['p']), 2),
                        'total_devices'     => round(($device['device_quantity'] * $item['qu'] * $item['p']), 2),
                    ]);
                }
            }
        }

        if($request->savedraft == 1){
            $this->subtract($invoices->id);
        }
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('returned_invoices'));

    }


    public function savedraftTosave(Request $request)
    {
        $invoices = Invoices::findOrFail($request->id);
        $invoices['savedraft'] = 1;
        $invoices->save();


        $Invoiceitems = Invoiceitems::where('invoice_id',$request->id)->get();

        foreach ($Invoiceitems as $key => $invoiceitem)
        {
            $dataitems['invoice_id']            = $request->id;
            $dataitems['item_id']               = $invoiceitem->item_id;
            $dataitems['quantity_b']            = $invoiceitem->quantity_b;
            $dataitems['price_b']               = $invoiceitem->price_b;
            $dataitems['total_price_b']         = $invoiceitem->total_price_b;

            if($item = Items::find($invoiceitem->item_id)){
                $item->quantity -= $invoiceitem->quantity_b;
                $item->save();
            }
        }

        $Invoicedeviceitems = Invoicedeviceitems::where('invoice_id',$request->id)->get();


        foreach ($Invoicedeviceitems as $key => $items) {
            $dataddeviceitems['invoice_id']                = $request->id;
            $dataddeviceitems['device_id']              = $items->device_id;
            $dataddeviceitems['item_id_devices']        = $items->item_id_devices;
            $dataddeviceitems['quantity_devices']       = $items->quantity_devices;
            $dataddeviceitems['price_devices']          = $items->price_devices;
            $dataddeviceitems['total_devices']          = $items->total_devices;

        }
        $this->subtract($request->id);

        return redirect(aurl('returned_invoices'));
    }
    public  function subtract($id){

        $subtracts = Invoicedeviceitems::where('invoice_id',$id)->get();
        foreach ($subtracts as  $key => $subtract){

            $items              = Items::where('id',$subtract->item_id_devices)->value('quantity');
            $subtractitems      = $items - $subtract->quantity_devices    ;
            $sub                = Items::where('id',$subtract->item_id_devices)
                ->update(['quantity'=>$subtractitems]);

        }
    }
    public function Addtaxi(Request $request){

        $invoice = Invoices::find($request->id);
        $invoice->taxes = round($invoice->total_invoice +($invoice->total_invoice * (14/100)),2);
        $invoice->save();
        session()->flash('success', trans('admin.taxs'));
        return back();

    }




    public function edit($id)
    {
        $invoices       = Invoices::find($id);
        $statuses       = Inovice_status::get();
        $currencies     = Currencies::get();
        $devices        = Devices::get();
        $items          = Items::get();
        $clients        = Clients::get();
        $invoiceitems   = Invoiceitems::where('invoice_id',$invoices->id)->get();

        $invoiceId = $invoices->id;
        $invoicedevices  = Invoicedevices::where('invoice_id', $invoiceId)->with(['Invoicedeviceitems' => function ($query) use ($invoiceId){
            $query->where('invoice_id', $invoiceId);
        }])->get();
        $invoicesources    = InvoiceSources::get();
        $invoicedeviceitems   = Invoicedeviceitems::with('Deviceitems')->where('invoice_id',$invoices->id)->get();

        return view('admin.returned_invoices.edit', compact('invoices', 'title','suppliers','items','devices','currencies','clients','invoiceitems','invoicedevices','invoicedeviceitems','invoicesources','statuses'));
    }

    public function update(Request $request, $id)
    {

        $data = request()->validate(
            [
                //'invoice_number' => 'required',
                'date'             => 'required',
                'client_id'        => 'required',
                'city'             => 'required',
                'invoice_source_id'   => 'required',
                'status_id'   => 'required',

            ], [], [
            //'invoice_number'  => trans('invoices.invoice_number'),
            'date'              => trans('invoices.date'),
            'client_id'         => trans('invoices.client_id'),
            'city'              => trans('invoices.city'),
            'invoice_source_id'    => trans('invoices.bill_source'),
            'status_id'    => trans('invoices.status'),
        ]);

        $data = request()->except(['_token', '_method']);
        $imageName = str_random(10).'.'.'png';
        $invoices       = Invoices::find($id);
        //$invoices->invoice_number = $request->invoice_number;
        $invoices->savedraft = 0;

//Strart Save Image Barcode




        //End Save Image Barcode
        // $invoices->barcode = $imageName;
        $invoices->client_id = $request->client_id;
        $invoices->date = $request->date;
        $invoices->city = $request->city;
        $invoices->status_id = $request->status_id;
        $invoices->invoice_source_id = $request->invoice_source_id;
        $invoices->currency_id = round(($request->currency_id),2);
        $invoices->notes = $request->notes;
        $invoices->total_final_mgza = round(($request->total_final_mgza),2);
        $invoices->total_final_mogma3 = round(($request->total_final_mogma3),2);
        $invoices->total_invoice = round(($request->total_invoice = $request->total_final_mgza + $request->total_final_mogma3),2);


        $invoices->save();

        $deletedRows = Invoiceitems::where('invoice_id', $invoices->id)->delete();
        if(!empty($request->item_id)){
            foreach ($request->item_id as $key => $item){
                $invoiceItems = Invoiceitems::create([
                    'invoice_id'                        => $invoices->id,
                    'item_id'                           => $item,
                    'quantity_b'                        => $request->quantity_b[$key],
                    'price_b'                           => round(($request->price_b[$key]),2),
                    'total_price_b'                     => round(($request->total_price_b[$key]),2),
                ]);

            }
        }
        $deletedRows = Invoicedevices::where('invoice_id', $invoices->id)->delete();
        $deletedRows = Invoicedeviceitems::where('invoice_id', $invoices->id)->delete();

        if (!empty($request->devices)){
            foreach ($request->devices as $device_id => $device)
            {
                // single device
                $invoiceDevices = Invoicedevices::create([
                    'invoice_id'                    => $invoices->id,
                    'device_id'                     => $device['device_id'],
                    'quantity'                      => $device['device_quantity'],
                    'onedevice'                     => round($device['device_price'],2),
                    'total_price'                   => round($device['device_total_price'],2),
                ]);
                foreach ($device['device_items'] as $item_id => $item) {
                    $InvoiceDeviceItems = Invoicedeviceitems::create([
                        'invoice_id'        => $invoices->id,
                        'device_id'         => $device['device_id'],
                        'item_id_devices'   => $item['id'],
                        'quantity_devices'  => round((($device['device_quantity'] * $item['qu'])), 2),
                        'quantity_old'      => round((($item['quantity_old'])), 2),
                        'price_devices'     => round(($item['p']), 2),
                        'total_devices'     => round(($device['device_quantity'] * $item['qu'] * $item['p']), 2),
                    ]);
                }
            }
        }




        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('returned_invoices'));
    }


    public function destroy($id)
    {
//dd('sss');
        $this->DeleteBill($id);
        $this->DeleteSpecific($id);
        ReturnedInvoices::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('returnedbills'));
    }
    //Delete Bill
    public  function DeleteBill($id){
            $invoices       = ReturnedInvoices::find($id);

            $invoiceitems = ReturnedInvoicesItems::where('invoice_id',$id)->get();

            foreach ( $invoiceitems as $invoiceitem)
            {
                $getitem = Items::where('id',$invoiceitem->item_id)->value('quantity');
                $sub = $getitem - $invoiceitem->quantity_b   ;
                $updatequantiy = Items::where('id',$invoiceitem->item_id)->update(['quantity'=>$sub]);

               // ReturnedInvoicesItems::find($invoiceitem->id)->delete();

            }

    }
    public  function DeleteSpecific($id){
        $invoices       = ReturnedInvoices::find($id)->pluck('invice_id');
        $invoice = $invoices[0];
        $invoiceitems = ReturnedInvoicesItems::where('invoice_id',$id)->get();
        //dd($invoices[0]);

        foreach ( $invoiceitems as $invoiceitem)
        {
            $getitem = Specifications::where('item_id',$invoiceitem->item_id)->where('color_id',$invoiceitem->color)
                ->where('size',$invoiceitem->size)->value('quantity');

            $sub = $getitem - $invoiceitem->quantity_b   ;
            $updatequantiy = Specifications::where('item_id',$invoiceitem->item_id)->where('color_id',$invoiceitem->color)
                ->where('size',$invoiceitem->size)->update(['quantity'=>$sub]);

            ReturnedInvoicesItems::find($invoiceitem->id)->delete();

        }

    }



    public function show($id=null, $from_cur = null, $to_cur = null){
        $invoices             = Invoices::with('clients','currencies')->find($id);
        $invoiceitems         = Invoiceitems::with('items')->where('invoice_id',$id)->get();
        $invoicedevices       = Invoicedevices::with('devices')->where('invoice_id',$id)->get();
        $invoicedeviceitems   = Invoicedeviceitems::with('items')->where('invoice_id',$id)->get();

        @$currencies           = Currencies::where('id', '!=', $invoices->currency_id)->get();
        $currencyrates        = Currencyrates::get();
        $rate                 = $this->cur($id, $from_cur, $to_cur);
        $items                = Items::get();
        return view("admin.returned_invoices.show",compact('invoices','invoiceitems','rate','currencies','invoicedevices','items','invoicedeviceitems','currencyrates'));
    }

    public function cur($id = null, $from_cur = null, $to_cur = null){
        @$rate = Currencyrates::where('currency_id',$from_cur)->where('to_currency_id',$to_cur)->first();

        // @$invoices = Invoices::with('clients')->find($id);
        // @$final = $curammout->currency_ammount * $invoices->total_invoice;
        //dd($final);
        return $rate;

    }


    public function export()
    {
        $invoices = Invoices::orderBy("id","DESC")->get();
        $invoicesData = [];
        foreach($invoices as $item){
            $invoicesData[] = [
                'ID'                                        => $item->id,
                //trans('invoices.invoices_number')      => $item->invoice_number,
                trans('invoices.date')                 => $item->date,
                trans('invoices.client_id')            => $item->clients->name_client,
                trans('invoices.currency_id')          => $item->currencies->currency_name,
                trans('invoices.total_invoice')        => $item->total_invoice,
                trans('invoices.notes')                => $item->notes,
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
    }
# Start GET Device [price,Quantity]#
    public function sumDevices($id,Request $request){

        $DeviceId = Deviceitems::with('items')->where('devices_id',$id)->get();

        $sbudevic = Subdevices::where('device_id',$id)->pluck('subdevice_id');
        $sbudevicz = Subdevices::where('device_id',$id)->get();
        $ItemsId = items::where('id',$id)->get();




        if (!empty($DeviceId)) {
            if(!empty($sbudevicz[0])){
                $subid = Deviceitems::with('items')->wherein('devices_id',$sbudevic)->get();

                return view("admin.returned_invoices.mogma3.sumDevicesIndex",compact('DeviceId','id','subid','sbudevicz','ItemsId'));

            }
            return view("admin.returned_invoices.mogma3.sumDevicesIndex",compact('DeviceId','id','sbudevicz'));

        }else{
            return "Undefined";
        }
    }
    public function sumDevicesQuantity($id,Request $request){


        $devices = Devices::with('Subdevice','deviceitems')->where('id',$id)->get();
        //dd($devices);

        foreach ($devices as $device){
            $itemsMin = $this->getcount($device->id);
            $subDevicesMin = [];
            $devicMin = 0;
            if(count($device->subdevice) > 0){
                foreach ($device->subdevice as $d){
                    $subDevicesMin[] = $this->getcount($d->id);
                }

            }
            if(!empty($subDevicesMin)){
                $devicMin = min($itemsMin, min($subDevicesMin));
            }else{
                $devicMin = $itemsMin;
            }
            $dd = Devices::where('id',$device->id)->update(['quantity'=>$devicMin]);

            //echo $device->id.'  '.$devicMin.'<br>';
        }


        if (!empty($devices)) {
            return view("admin.returned_invoices.mogma3.sumDevicesQuantity",compact('devices'));

        }else{
            return "Undefined";
        }
    }
    public static function getcount($id = null){

        $device = Devices::with('Subdevice','deviceitems')->find($id);

        $devic_items = Deviceitems::where("devices_id", $id)->get();

        $Arrays = [];
        foreach ($devic_items as $item)
        {
            $itemQty = Items::where("id", $item->item_id)->value('quantity');
            //dd($item->number_items);
            $Arrays[] =  floor($itemQty /  $item->number_items);
        }
        //Sub Devices

        # items min
        return empty($Arrays) ? 0 : min($Arrays);

        //$dd = Devices::where('id',$id)->update(['quantity'=>$min]);
//    echo $id.' '.$min."<br>";
//        return false;


    }

#END GET Device [price,Quantity]#

// Start PDF //


}
