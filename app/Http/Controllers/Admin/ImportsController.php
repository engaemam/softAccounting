<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Billdevicesitems;
use App\Model\Billdevies;
use App\Model\Billitems;
use App\Model\Bills;
use App\Model\Currencies;
use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\Importdeviceitems;
use App\Model\Importdevices;
use App\Model\Importexpenses;
use App\Model\Importitems;
use App\Model\Imports;
use App\Model\Items;
use App\Model\Currencyrates;
use App\Http\Controllers\Admin\generalcontroller;
use App\Model\Shipments;
use App\Model\Subdevices;
use App\Model\Suppliers;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Item;
use Storage;
use Excel;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ImportsController extends Controller
{

    public function index()
    {
        $imports = Imports::orderBy('id','DESC')->paginate(15);
        return view('admin.imports.index',compact('imports'));
    }

    public function create()
    {
        $imports    = new Imports(\Request::old());
        $suppliers  = Suppliers::get();
        $items      = Items::get();
        $devices    = Devices::get();
        $currencies = Currencies::get();
        return view('admin.imports.create',compact('imports','items','suppliers','devices','currencies'));
    }




    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'number'            => 'required',
                'date'              => 'required',
                'supplier_id'       => 'required',
                'price_eg'          => '',


            ], [], [
            'number'                =>trans('imports.number'),
            'date'                  =>trans('imports.date'),
            'supplier_id'           =>trans('imports.supplier_id'),
            'price_before_doller'   =>trans('imports.price_before_doller'),
            'price_doller'          =>trans('imports.price_doller'),
            'price_eg'              =>trans('imports.price_eg'),

        ]);
        $data = request()->except(['_token', '_method','total_price1']);

        $allMIME = [
            "application/vnd.openxmlformats-officedocument.wordprocessingml.document",
            "application/pdf",
            "application/msword"
        ];

        if ($request->hasFile('pdf')) {
            $file = $request->file('pdf');
            if (in_array($file->getClientMimeType(), $allMIME)) {
                $filename = hash('haval128,4',
                        $file->getClientOriginalName() . mt_rand()) . '.' . $file->getClientOriginalExtension();
                $file->move(public_path("upload/bills/"), $filename);
                $inputs['pdf'] = $filename;
            }
        }
        if(empty($filename)){
            $filename='';
        }

        $import = Imports::create([
            'number'                => $request->number,
            'transfer'              => $request->transfer=0,
            'date'                  => $request->date,
            'pdf'                   => $filename,
            'notes'                 => $request->notes,
            'supplier_id'           => $request->supplier_id,
            'price_before_doller'   => $request->price_before_doller,
            'currency_id'           => round($request->currency_id,2),
            'total_final_mgza'      => round($request->total_final_mgza,2),
            'total_final_mogma3'    => round($request->total_final_mogma3,2),
            'price_doller'          => round($request->price_doller,2),
            'total_final'           => round($request->total_final = $request->total_final_mgza + $request->total_final_mogma3,2),
            'total_final_mogma3_egy'=> round($request->total_final_mogma3 * $request->price_doller,2),
            'total_final_mgza_egy'  => round($request->total_final_mgza * $request->price_doller,2),
            'total_final_bill_egy'  => round($request->price_doller * ($request->total_final_mgza + $request->total_final_mogma3),2) ,
        ]);


        if(!empty($request->item_id)){
            foreach ($request->item_id as $key => $item){
                $importitems = Importitems::create([
                    'import_id'                    => $import->id,
                    'item_id'                      => $item,
                    'quantity_b'                   => $request->input('quantity_b')[$key],
                    'price_b'                      => round($request->input('price_b')[$key],2),
                    'total_price_b'                =>  round($request->input('total_price_b')[$key],2),
                    'price_b_egy'                  => round(($request->input('price_b')[$key] * ($import->price_doller)),2),
                    'total_price_b_egy'            => round(($request->input('total_price_b')[$key]* ($import->price_doller)),2),



                ]);
            }
        }




        if (!empty($request->devices)){
            foreach ($request->devices as $device_id => $device)
            {

                // single device
                $Importdevices = Importdevices::create([
                    'import_id'                    => $import->id,
                    'device_id'                     => $device['device_id'],
                    'quantity'                      => $device['device_quantity'],
                    'onedevices'                    => round(($device['device_total_price'] / $device['device_quantity']),2),
                    'onedevices_egy'                => round((($device['device_total_price'] / $device['device_quantity'])*($import->price_doller)),2),
                    'total_price'                   => round($device['device_total_price'],2),
                    'total_price_egy'               => round($device['device_total_price']*($request->price_doller),2),
                ]);
                foreach ($device['device_items'] as $item_id => $item) {
                    $Importdeviceitems = Importdeviceitems::create([
                        'import_id'         => $import->id,
                        'device_id'         => $device['device_id'],
                        'item_id_devices'   => $item['id'],
                        'quantity_devices'  => round((( $item['qu'])), 2),
                        'price_devices'     => round(($item['p']), 2),
                        'total_devices'     => round(($item['total_p'] ), 2),
                        'price_devices_egy' => round(($item['p']* ( $request->price_doller)),2),
                        'total_devices_egy' => round(($item['total_p']* ( $request->price_doller)),2),
                        'quantity_old'      => round(($item['quantity_old']),2),
                    ]);
                }
            }
        }


        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('imports'));
    }




    public function edit($id)
    {
        $imports            = Imports::find($id);
        $suppliers          = Suppliers::get();
        $currencies         = Currencies::get();
        $devices            = Devices::get();
        $items              = Items::get();
        $importitems        = Importitems::where('import_id',$imports->id)->get();
        $billId = $imports->id;
        $importdevices      = Importdevices::where('import_id',$imports->id)->with(['Importdeviceitems' => function ($query) use ($billId){
            $query->where('import_id', $billId);
        }])->get();
        //dd($importdevices);
        $importdeviceitems  = Importdeviceitems::where('import_id',$imports->id)->get();

        return view('admin.imports.edit', compact('imports','suppliers','items','devices','importdevices','importitems','importdeviceitems','currencies'));
    }
    public function deviceid($id,Request $request){
        $DeviceId = Deviceitems::with('items')->where('devices_id',$id)->get();
        $sbudevic = Subdevices::where('device_id',$id)->pluck('subdevice_id');
        $sbudevicz = Subdevices::where('device_id',$id)->get();
        $ItemsId = items::where('id',$id)->get();




        if (!empty($DeviceId)) {
            if(!empty($sbudevicz[0])){
                $subid = Deviceitems::with('items')->wherein('devices_id',$sbudevic)->get();


                return view("admin.imports.ajax",compact('DeviceId','id','subid','sbudevicz','ItemsId'));

            }
            return view("admin.imports.ajax",compact('DeviceId','id','sbudevicz'));

        }else{
            return "Undefined";
        }

    }
    public function deviceidEdit($id,Request $request){
        $DeviceId = Deviceitems::with('items')->where('devices_id',$id)->get();
        $sbudevic = Subdevices::where('device_id',$id)->pluck('subdevice_id');
        $sbudevicz = Subdevices::where('device_id',$id)->get();
        $ItemsId = items::where('id',$id)->get();




        if (!empty($DeviceId)) {
            if(!empty($sbudevicz[0])){
                $subid = Deviceitems::with('items')->wherein('devices_id',$sbudevic)->get();


                return view("admin.imports.ajaxEdit",compact('DeviceId','id','subid','sbudevicz','ItemsId'));

            }
            return view("admin.imports.ajaxEdit",compact('DeviceId','id','sbudevicz'));

        }else{
            return "Undefined";
        }

    }

    public function update(Request $request, $id =  null)
    {

        $data = request()->validate(
            [
                'number'            => 'required',
                'date'              => 'required',
                'supplier_id'       => 'required',
                'price_eg'          => '',


            ], [], [
            'number'                =>trans('imports.number'),
            'date'                  =>trans('imports.date'),
            'supplier_id'           =>trans('imports.supplier_id'),
            'price_before_doller'   =>trans('imports.price_before_doller'),
            'price_doller'          =>trans('imports.price_doller'),
            'price_eg'              =>trans('imports.price_eg'),

        ]);

        $data = request()->except(['_token', '_method']);
        $import                           = Imports::find($id);
        $import->number                 = $request->number;
        $import->transfer               = $request->transfer=0;
        $import->date                   = $request->date;
        $import->notes                  = $request->notes;
        $import->supplier_id            = $request->supplier_id;
        //$import->price_before_doller    = $request->price_before_doller;
        $import->currency_id            = round($request->currency_id,2);
        $import->total_final_mgza       = round($request->total_final_mgza,2);
        $import->total_final_mogma3     = round($request->total_final_mogma3,2);
        $import->price_doller           = round($request->price_doller,2);
        $import->total_final            = round($request->total_final = $request->total_final_mgza + $request->total_final_mogma3,2);
        $import->total_final_mogma3_egy = round($request->total_final_mogma3 * $request->price_doller,2);
        $import->total_final_mgza_egy   = round($request->total_final_mgza * $request->price_doller,2);
        $import->total_final_bill_egy   = round($request->price_doller * ($request->total_final_mgza + $request->total_final_mogma3),2) ;



        $import->save();

        $deletedRows = Importitems::where('import_id', $import->id)->delete();

        if(!empty($request->item_id)){
            foreach ($request->item_id as $key => $item){
                $importitems = Importitems::create([
                    'import_id'                    => $import->id,
                    'item_id'                      => $item,
                    'quantity_b'                   => $request->input('quantity_b')[$key],
                    'price_b'                      => round($request->input('price_b')[$key],2),
                    'total_price_b'                =>  round($request->input('total_price_b')[$key],2),
                    'price_b_egy'                  => round(($request->input('price_b')[$key] * ($import->price_doller)),2),
                    'total_price_b_egy'            => round(($request->input('total_price_b')[$key]* ($import->price_doller)),2),



                ]);
            }
        }





        $deletedRows = Importdevices::where('import_id', $import->id)->delete();
        $deletedRows = Importdeviceitems::where('import_id', $import->id)->delete();

        if (!empty($request->devices)){
            foreach ($request->devices as $device_id => $device)
            {

                // single device
                $Importdevices = Importdevices::create([
                    'import_id'                     => $import->id,
                    'device_id'                     => $device['device_id'],
                    'quantity'                      => $device['device_quantity'],
                    'onedevices'                    => round(($device['device_total_price'] / $device['device_quantity']),2),
                    'onedevices_egy'                => round((($device['device_total_price'] / $device['device_quantity'])*($import->price_doller)),2),
                    'total_price'                   => round($device['device_total_price'],2),
                    'total_price_egy'               => round($device['device_total_price']*($request->price_doller),2),
                ]);
                foreach ($device['device_items'] as $item_id => $item) {
                    $Importdeviceitems = Importdeviceitems::create([
                        'import_id'         => $import->id,
                        'device_id'         => $device['device_id'],
                        'item_id_devices'   => $item['id'],
                        'quantity_devices'  => round((( $item['qu'])), 2),
                        'price_devices'     => round(($item['p']), 2),
                        'total_devices'     => round(($item['total_p'] ), 2),
                        'price_devices_egy' => round(($item['p']* ( $request->price_doller)),2),
                        'total_devices_egy' => round(($item['total_p']* ( $request->price_doller)),2),
                        'quantity_old'      => round(($item['quantity_old']),2),
                    ]);
                }
            }
        }


        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('imports'));
    }


    public function destroy($id)
    {

        $this->DeleteShow($id);
        Imports::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('imports'));
    }
    //Delete Imports
    public  function DeleteShow($id){


        $importitems = Importitems::where('import_id',$id)->get();
        foreach ( $importitems as $importitem)
        {
            Importitems::find($importitem->id)->delete();
        }
        $importdevices  = Importdevices::where('import_id',$id)->get();
        foreach ($importdevices as $importdevice)
        {
            Importdevices::find($importdevice->id)->delete();
        }
        $importdeviceitems = Importdeviceitems::where('import_id',$id)->get();
        foreach ($importdeviceitems as  $key => $value){
            Importdeviceitems::find($value->id)->delete();
        }
        $importexpenses = Importexpenses::where('import_id',$id)->get();
        foreach ($importexpenses as $importexpens)
        {
            Importexpenses::find($importexpens->id)->delete();
        }

    }



    public function show($id=null, $from_cur = null, $to_cur = null){
        $imports = Imports::with('suppliers')->find($id);
        //$imports['percentage'] = ceil(($imports['total_import'] / ($imports['total_final'] + $imports['total_import'])) * 100);
        @$imports['percentage']    = round(($imports['total_import'] * 100 ) / $imports['total_final'] ,2);//new

        //dd($imports['percentage']);
        $importdevices      = Importdevices::with('devices')->where('import_id',$id)->get();

        $currencies           = Currencies::where('id', '!=', $imports->currency_id)->get();
        $currencyrates        = Currencyrates::get();
        $rate                 = $this->cur($id, $from_cur, $to_cur);

        $items              = Items::get();
        $importitems        = Importitems::with('items')->where('import_id',$id)->get();
        $importdeviceitems  = Importdeviceitems::with('items')->where('import_id',$id)->get();



        return view("admin.imports.show",compact('imports','suppliers','importitems','rate','currencies','importdevices','items','importdeviceitems','currencyrates'));
    }
    public function showEgypt($id = null, $from_cur = null, $to_cur = null){
        $bills                  = Imports::with('suppliers','currency')->find($id);
        //@$bills['percentage']    = ceil(($bills['total_shipments_egy'] / ($bills['total_final_bill_egy'] + $bills['total_shipments_egy'])) * 100); // old
        @$bills['percentage']    = round(($bills['total_import_egy'] * 100 ) / $bills['total_final_bill_egy'] ,2);//new
        //@$bills['percentageTax'] = ceil((($bills['total_shipments_egy'] - $bills['total_addtaxs_egy']) / ($bills['total_final_bill_egy'] + ($bills['total_shipments_egy']-$bills['total_addtaxs_egy']))) * 100);//old
        @$bills['percentageTax']    = round(( ($bills['total_import_egy'] - $bills['total_addtaxs_egy']) * 100) / $bills['total_final_bill_egy'] ,2);//new

        $billdevies             = Importdevices::with('devices')->where('import_id',$id)->get();
        $currencies             = Currencies::where('id', '!=', $bills->currency_id)->get();
        $currencyrates          = Currencyrates::get();
        $rate                   = $this->cur($id, $from_cur, $to_cur);
        $items                  = Items::get();
        $billitems              = Importitems::with('items')->where('import_id',$id)->get();
        $billdeviesitems        = Importdeviceitems::with('items')->where('import_id',$id)->get();

        return view("admin.imports.EgyptShow",compact('bills','suppliers','billitems','rate','currencies','billdevies','items','billdeviesitems','currencyrates','percentageTax'));
    }

    public function cur($id = null, $from_cur = null, $to_cur = null){
        @$rate = Currencyrates::where('currency_id',$from_cur)->where('to_currency_id',$to_cur)->first();
        return $rate;

    }

    public function search(Request $request){
        $imports = Imports::where('number', 'like', '%'.request()->search.'%')->orderBy("id","desc")->paginate(20);
// Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.imports.index',compact('imports','temp'));
    }

    public function export()
    {
        $imports = Imports::orderBy("id","DESC")->get();
        $importsData = [];
        foreach($imports as $item){
            $importsData[] = [
                'ID'                                       => $item->id,
                trans('imports.number')               => $item->number,
                trans('imports.date')                 => $item->date,
                trans('imports.supplier_id')          => $item->suppliers->suppliers_name,
                trans('imports.price_before_doller')  => $item->price_doller,
                trans('imports.notes')                => $item->notes,
            ];
        }

        if(count($importsData) > 0){
            Excel::create("تصدير فواتير شراء(".date("d-M-Y").")", function($excel) use($importsData) {
                $excel->sheet('sheet1', function($sheet) use($importsData) {
                    $sheet->fromArray($importsData);

                    $sheet->cell('A1:F1',function($cell){
                        $cell->setBackground('#e8e8e8');
                        $cell->setFontWeight('bold');
                    });
                });

            })->export('xls');
        }
    }
    public function importToBill(Request $request)
    {
        //dd($request->id);
        $import = Imports::find($request->id);


        $import['transfer']             = $import->transfer = 1;
        $import->save();

        $data['bill_number']            = $request->noBills;
        //$data['pdf']                    = $import->pdf;
        $data['savedraft']              = $import->savedraft = 1;
        $data['supplier_id']            = $import->supplier_id;
        $data['date']                   = $import->date;
        $data['price_before_doller']    = round($import->price_doller,2);
        $data['notes']                  = $import->notes;
        $data['currency_id']            = $import->currency_id;
        $data['total_final_mgza']       = $import->total_final_mgza;
        $data['total_final_mogma3']     = $import->total_final_mogma3;
        $data['total_final_bill']       = $import->total_final;
        $data['total_shipments']        = $import->total_import;
        $data['total_shipments_egy']    = $import->total_import_egy;
        $data['total_final_mogma3_egy'] = round($import->total_final_mogma3_egy,2);
        $data['total_final_mgza_egy']   = round($import->total_final_mgza_egy,2);
        $data['total_final_bill_egy']   = round($import->total_final_bill_egy,2) ;
        $data['created_at']             = $import->created_at;
        $data['updated_at']             = $import->updated_at;


        $bill = Bills::create($data);




        $importitems = Importitems::where('import_id',$request->id)->get();
        //dd($item = Items::find($importitems->item_id));
        foreach ( $importitems as $key =>$importitem)

        {

            $dataitems['bill_id']               = $bill->id;
            $dataitems['item_id']               = $importitem->item_id;
            $dataitems['quantity_b']            = $importitem->quantity_b;
            $dataitems['price_b']               = round($importitem->price_b,2);
            $dataitems['total_price_b']         = round($importitem->total_price_b,2);
            $dataitems['price_b_egy']           = round($importitem->price_b * $import->price_doller,2);
            $dataitems['total_price_b_egy']     = round($importitem->total_price_b * $import->price_doller,2);



            billitems::create($dataitems);
            if($importitem->price_b == 0) {
                if ($item = Items::find($importitem->item_id)) {
                    $item->quantity += $importitem->quantity_b;

                    $item->save();
                }
            }else{
                if ($item = Items::find($importitem->item_id)) {
                    $item->quantity += $importitem->quantity_b;
                    $item->price = round($importitem->price_b * $import->price_doller,2);
                    $item->save();
                }

            }

        }
        $importdevices  = Importdevices::where('import_id',$request->id)->get();

        foreach ($importdevices as $importdevice)
        {
            $datadevices['bill_id']             = $bill->id;
            $datadevices['device_id']           = $importdevice->device_id;
            $datadevices['quantity']            = $importdevice->quantity;
            $datadevices['total_price']         = round($importdevice->total_price,2);
            $datadevices['total_price_egy']         = round($importdevice->total_price * $import->price_doller,2);
            $datadevices['onedevices']          = round($importdevice->total_price/$importdevice->quantity,2);
            $datadevices['onedevices_egy']          = round(($importdevice->total_price/$importdevice->quantity)* $import->price_doller,2);


            Billdevies::create($datadevices);

        }
        $importdeviceitems = Importdeviceitems::where('import_id',$request->id)->get();

        foreach ($importdeviceitems as  $key => $value){
            $dataddeviceitems['bill_id']                = $bill->id;
            $dataddeviceitems['device_id']              = $value->device_id;
            $dataddeviceitems['item_id_devices']        = $value->item_id_devices;
            $dataddeviceitems['quantity_devices']       = $value->quantity_devices;
            $dataddeviceitems['price_devices']          = round($value->price_devices,2);
            $dataddeviceitems['total_devices']          = round($value->total_devices,2);
            $dataddeviceitems['price_devices_egy']      = round($value->price_devices * $import->price_doller,2);
            $dataddeviceitems['total_devices_egy']      = round($value->total_devices * $import->price_doller,2);


            Billdevicesitems::create($dataddeviceitems);

        }
        generalcontroller::countdiv($bill->id);


        $Importexpenses = Importexpenses::where('import_id',$request->id)->get();
        foreach ($Importexpenses as $importexpens)
        {
            $dataexpens['bill_id']          = $bill->id;
            $dataexpens['shipping_id']      = 1;
            $dataexpens['value']            = $importexpens->value;
            Shipments::create($dataexpens);
        }
        ImportexpensesController::changePrice($request->id);
        return redirect(aurl('imports'));


    }


}
