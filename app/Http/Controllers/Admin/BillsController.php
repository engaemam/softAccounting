<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\BillsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Billdevicesitems;
use App\Model\Billdevies;
use App\Model\Billitems;
use App\Model\Bills;
use App\Model\Billspdf;
use App\Model\Currencies;
use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\Items;
use App\Model\Currencyrates;
use App\Http\Controllers\Admin\generalcontroller;
use App\Model\Colors;
use App\Model\itemsColors;
use App\Model\ItemsSize;
use App\Model\Sizes;
use App\Model\Specifications;
use App\Model\Suppliers;
use App\Model\Token;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\Fractal\Resource\Item;
use Storage;
use Excel;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class BillsController extends Controller
{

    private function addmoreforsouq($q,$id){

        $gettoken = Token::find(2);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'content-type' => 'application/x-www-form-urlencoded',
        ];

        $body= [

            'Simple_account_id'=>$id,
            'qty'=>$q,
        ];
        $response = $client->request('post', 'api/Simple_accounting/products/products/q', [
            'headers' => $headers,
            'form_params' => $body
        ]);


    }
    public function index()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $bills = Bills::orderBy('date', 'desc')->paginate(15);


        }else{
            $bills = Bills::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->orderBy('date', 'desc')->paginate(15);
        }

        return view('admin.bills.index', ['title' => trans('bills.show')], compact('bills'));
    }

    public function search(Request $request)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $suppliers = Suppliers::get();
            $billsQuery = Bills::with('suppliers');
        }else{
            $suppliers = Suppliers::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->get();
            $billsQuery = Bills::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->with('suppliers');
        }
//        if($request->bill_number != ''){
//            $billsQuery->where('bill_number', 'LIKE', '%' . request()->bill_number . '%');
//        }
        if ($request->suppliers_name != '') {
            $billsQuery = $billsQuery->whereHas('suppliers', function ($query) {
                {
                    $query->where('suppliers_name', 'LIKE', '%' . request()->suppliers_name . '%');
                }
            });
        }

        if ($request->from != '') {
            $from = date("Y-m-d H:i:s", strtotime($request->from));
            $billsQuery->where("created_at", ">=", $from);
        }
        if ($request->to != '') {
            $to = date("Y-m-d H:i:s", strtotime($request->to));
            $billsQuery->where("created_at", "<=", $to);
        }


        $bills = $billsQuery->orderBy('date', 'desc')->paginate(20);
        //dd($bills);
// Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role) {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.bills.index', compact('bills', 'temp', 'suppliers'));
    }

    public function createtwo($id, Request $request)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){
            $bills = new Bills(\Request::old());
            $itemsizes = ItemsSize::get();
            $itemscolors = Colors::get();
            $items = Items::get();
            $supplier = Suppliers::find($id);
            $devices = Devices::orderBy('created_at', 'desc')->get();
            $currencies = Currencies::get();
            $statement = DB::select("show table status like 'suppliers'");
            $modelid = $statement[0]->Auto_increment;

        }else{
            $bills = new Bills(\Request::old());
            //$suppliers = Suppliers::get();
            $itemsizes = ItemsSize::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = Colors::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->get();
            $items = Items::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->get();
            $supplier = Suppliers::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->find($id);
            $devices = Devices::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->orderBy('created_at', 'desc')->get();
            $currencies = Currencies::get();
            $statement = DB::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->select("show table status like 'suppliers'");
            $modelid = $statement[0]->Auto_increment;
        }
        return view('admin.bills.create2', compact('items', 'supplier', 'devices', 'currencies', 'modelid', 'bills', 'itemscolors', 'itemsizes'));
    }

    public function create()
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $itemsizes = ItemsSize::get();
            $itemscolors = Colors::get();
            $suppliers = Suppliers::get();
            $items = Items::get();
            $devices = Devices::orderBy('created_at', 'desc')->get();
            $currencies = Currencies::get();
            $statement = DB::select("show table status like 'suppliers'");
            $modelid = $statement[0]->Auto_increment;

        }else{



            $suppliers = Suppliers::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->get();
            $items = Items::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->get();
            $devices = Devices::orderBy('created_at', 'desc')->get();
            $currencies = Currencies::get();
            $statement = DB::select("show table status like 'suppliers'");
            $modelid = $statement[0]->Auto_increment;
        }

        return view('admin.bills.create', compact( 'items', 'suppliers',
            //            'bills1',
            'devices', 'currencies', 'modelid', 'itemsizes', 'itemscolors'));
    }


    public function store(Request $request)
    {


        $data = request()->validate(
            [
                //'bill_number' => 'required',
                'date' => '',
                //'color' => 'required',
                'shipping_costs' => '',
                'afterdiscount' => '',
                'discount' => '',
                'supplier_id' => 'required',
                'price_eg' => '',


            ], [], [
            //'bill_number' => trans('bills.bill_number'),
            'date' => trans('bills.date'),
            'shipping_costs' => trans('bills.shipping_costs'),
            'afterdiscount' => trans('bills.afterdiscount'),
            'discount' => trans('bills.discount'),
            'color' => trans('bills.color'),
            'size' => trans('bills.size'),
            'supplier_id' => trans('bills.supplier_id'),
            'price_before_doller' => trans('bills.price_before_doller'),
            'price_doller' => trans('bills.price_doller'),
            'price_eg' => trans('bills.price_eg'),

        ]);
        $data = request()->except(['_token', '_method', 'total_price1']);

//dd($request->get());

        if ($request->hasfile('pdf')) {

            foreach ($request->file('pdf') as $file) {
                $name = rand(1, 1000) . time() . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/upload/bills/', $name);
                $dataa[] = $name;
            }
        }
        if (empty($request->file('pdf'))) {
            $dataa = '';
        }
        //dd($request->get());
        $mytime = Carbon::now();
        $date = $mytime->toDateTimeString();
        $today = date("Y/m/d", strtotime($date));
        // $imageName = str_random(10) . '.' . 'png';

        $bill = Bills::create([
            //'bill_number'           => $request->bill_number,
            'savedraft' => $request->savedraft,
            'Seller_id' => Auth::guard('admin')->user()->Seller_id,
            'barcode' => '9NQj64nZE8.png',
            'shipping_costs' => $request->shipping_costs,
            'afterdiscount' => (round($request->total_final_mgza, 2) + $request->shipping_costs) - $request->discount,
            'discount' => $request->discount,
            'date' => $today,
            'notes' => $request->notes,
            'supplier_id' => $request->supplier_id,
            'price_before_doller' => round($request->price_before_doller, 2),
            'currency_id' => $request->currency_id,
            'total_final_mgza' => round($request->total_final_mgza, 2),
            'total_final_mogma3' => round($request->total_final_mogma3, 2),
            'total_final_bill' => $request->total_final_bill = round($request->total_final_mgza + $request->total_final_mogma3, 2),
            'total_final_mogma3_egy' => round($request->total_final_mogma3 * $request->price_before_doller, 2),
            'total_final_mgza_egy' => round($request->total_final_mgza * $request->price_before_doller, 2),
            'total_final_bill_egy' => round($request->price_before_doller * ($request->total_final_mgza + $request->total_final_mogma3), 2),
        ]);

        if (!empty($request->pdf)) {
            foreach ($dataa as $key => $item) {
                $invoicesPDF = Billspdf::create([
                    'id_bills' => $bill->id,
                    'pdf' => $item,
                ]);
            }
        }

//Strart Save Image Barcode

        //dd($bill->barcode);
//        $barcode = \DNS1D::getBarcodePNG($bill->id, 'C39');
//        $image = $bill->barcode; // your base64 encoded
//        $image = str_replace('data:image/png;base64,', '', $image);
//        $image = str_replace(' ', '+', $image);
//        //dd($image);
//        \File::put(public_path('upload/barcodebills') . '/' . $imageName, base64_decode($image));

        //End Save Image Barcode
        //dd($request->get());

        $item_id_devices = generalcontroller::notnull($request->input('item_id_devices'));
        $i=0;
        if (!empty($request->item_id)) {
            //dd($request->get());
            foreach ($request->item_id as $k_item=>$item){
                if ($request->color[$k_item] != 20){
                    foreach ($request->u_size[$item][$request->color[$k_item]] as $k_size => $itemSize) {
                        $fire []=$itemSize;
                        $zz =round($request->u_price[$item][$request->color[$k_item]][$k_size], 2);
                        $items = Items::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->where('id',$item)->update(['price'=>$zz]);
                        $billitems = Billitems::create([
                            'bill_id' => $bill->id,
                            'item_id' => $item,
                            'color' => $request->color[$k_item],
                            'size' =>  $itemSize,
                            'quantity_b' => $request->u_quantity[$item][$request->color[$k_item]][$k_size],
                            'price_b' => round($request->u_price[$item][$request->color[$k_item]][$k_size], 2) ,
                            'total_price_b' => round($request->u_price[$item][$request->color[$k_item]][$k_size], 2)* $request->u_quantity[$item][$request->color[$k_item]][$k_size],
                            'price_b_egy' => round(($request->input('price_b')[$k_item] * ($bill->price_before_doller)), 2),
                            'total_price_b_egy' => round(($request->input('total_price_b')[$k_item]), 2),

                        ]);
                    }
                }else{


                    $zz =round($request->price[$k_item], 2);
                    $items = Items::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->where('id',$item)->update(['price'=>$zz]);
                    $billitems = Billitems::create([
                        'bill_id' => $bill->id,
                        'item_id' => $item,
                        'color' => $request->color[$k_item],
                        'size' =>  27,
                        'quantity_b' => $request->quantity[$k_item],
                        'price_b' => round($request->price[$k_item], 2) ,
                        'total_price_b' => round($request->price[$k_item], 2)* $request->quantity[$k_item],
                        'price_b_egy' => round(($request->price_b[$k_item] * ($bill->price_before_doller)), 2),
                        'total_price_b_egy' => round(($request->input('total_price_b')[$k_item]), 2),

                    ]);

                }
            }}
        //     foreach ($request->item_id as $key => $item) {

        //         $billitems = Billitems::create([
        //             'bill_id' => $bill->id,
        //             'item_id' => $item,
        //             //'shipping_costs'                => $request->input('shipping_costs')[$key],
        //             //'afterdiscount'                 => $request->input('total_final_mgza') - $request->input('discount'),
        //             'color' => 1,

        //             'size' =>  2,

        //             //'barcode'                       => $imageName,
        //             'quantity_b' => $request->input('quantity_b')[$key],
        //             'price_b' => round($request->input('price_b')[$key], 2),
        //             'total_price_b' => round($request->input('total_price_b')[$key], 2),
        //             'price_b_egy' => round(($request->input('price_b')[$key] * ($bill->price_before_doller)), 2),
        //             'total_price_b_egy' => round(($request->input('total_price_b')[$key]), 2),

        //         ]);

        // }
        // }





        if ($request->savedraft == 1) {

            if(!empty($request->item_id)) {
                //dd($request->quantity);
                foreach ($request->item_id as $key => $value) {

                    if ($request->color[$key] != "20"){
                        foreach ($request->u_size[$value][$request->color[$key]] as $key_size => $size_id){
                            if($Specifications = Specifications::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->where('item_id', $value)->where('size', $size_id)->where('color_id', $request->color[$key])->first()) {
                                $Specifications->quantity += $request->u_quantity[$value][$request->color[$key]][$key_size];
                                $Specifications->selling_price = round($request->u_price[$value][$request->color[$key]][$key_size], 2);
                                $Specifications->save();
                                if ($Items = Items::find($value)) {
                                    $this->addmoreforsouq($request->u_quantity[$value][$request->color[$key]][$key_size],$value);
                                    $Items->quantity += $request->u_quantity[$value][$request->color[$key]][$key_size];
                                    $Items->save();



                                }
                                if ($Items_bill = Bills::find($bill->id)) {
                                    $Items_bill->total_final_bill = round($request->total_final_mgza, 2);
                                    $Items_bill->afterdiscount = round($request->total_final_mgza, 2);
                                    $Items_bill->save();
                                }

                            }

                        }
                    }else{
                        if($Specifications = Specifications::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->where('item_id', $value)->where('size', 27)->where('color_id', $request->color[$key])->first()) {

                            $Specifications->quantity += $request->quantity[$key];
                            $Specifications->selling_price = $request->price[$key];
                            $Specifications->save();
                            if ($Items = Items::find($value)) {
                                $this->addmoreforsouq($request->quantity[$key],$value);
                                dd('ff');

                                $Items->quantity += $request->quantity[$key];
                                $Items->save();
                            }
                        }
                    }

                }
            }
        }












        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('bills'));

    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){
            $bill = Bills::find($id);
            $itemSizes = Specifications::with('specificsize')->get();
            $bills = Billitems::with('items')->where('bill_id', $id)->get();
            $afterdis = $bills[0]['afterdiscount'];
            $itemsizes = ItemsSize::get();
            $itemscolors = ItemsColors::get();
            $suppliers = Suppliers::get();
            $title = trans('bills.edit');
            $currencies = Currencies::get();
            $devices = Devices::get();
            $items = Items::get();
            $billitemsget = Billitems::where('bill_id', $bill->id)->get();
            $billdevies = Billdevies::where('bill_id', $bill->id)->get();
            $billitems = $billitemsget->groupBy('item_id');
            $billId = $bill->id;
            $billdevices = Billdevies::where('bill_id', $billId)->with(['Billdevicesitems' => function ($query) use ($billId) {
                $query->where('bill_id', $billId);
            }])->get();


        }else {
            $bill = Bills::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->
            where('id',$id)->first();
            $itemSizes = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificsize')->get();
            $bills = Billitems::with('items')->where('bill_id', $id)->get();
            $afterdis = $bills[0]['afterdiscount'];
            $itemsizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $title = trans('bills.edit');
            $currencies = Currencies::get();
            $devices = Devices::get();
            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

            $billitemsget = Billitems::where('bill_id', $bill->id)->get();
            $billitems = $billitemsget->groupBy('item_id');

            $billdevies = Billdevies::where('bill_id', $bill->id)->get();

            $billId = $bill->id;
            $billdevices = Billdevies::where('bill_id', $billId)->with(['Billdevicesitems' => function ($query) use ($billId) {
                $query->where('bill_id', $billId);
            }])->get();
        }
        return view('admin.bills.edit', compact('bill', 'title',
            'suppliers',
            'items', 'devices', 'billitems', 'billdevies', 'currencies',  'billdevices', 'itemscolors', 'itemsizes', 'afterdis', 'itemSizes'));
    }

    public function update(Request $request, $id)
    {


        $data = $this->validate(request(),
            [
                'supplier_id' => 'required',



            ], [], [
                //'bill_number'           => trans('bills.bill_number'),
                'date' => trans('bills.date'),
                'afterdiscount' => trans('bills.afterdiscount'),
                'discount' => trans('bills.discount'),
                'shipping_costs' => trans('bills.shipping_costs'),
                'color' => trans('bills.color'),
                'size' => trans('bills.size'),
                'supplier_id' => trans('bills.supplier_id'),
                'price_before_doller' => trans('bills.price_before_doller'),
                'price_doller' => trans('bills.price_doller'),
                'price_eg' => trans('bills.price_eg'),

            ]);
        $data = request()->except(['_token', '_method']);
        $bill = Bills::find($id);
        //$bill->bill_number              = $request->bill_number;
        $bill->savedraft = 0;
        //$bill->date                     = $request->date;
        $bill->notes = $request->notes;
        $bill->shipping_costs = $request->shipping_costs;
        $bill->afterdiscount = (round($request->total_final_mgza, 2) + $request->shipping_costs) - $request->discount;
        $bill->discount = $request->discount;
        $bill->supplier_id = $request->supplier_id;
        $bill->price_before_doller = round($request->price_before_doller, 2);
        $bill->currency_id = $request->currency_id;
        $bill->total_final_mgza = round($request->total_final_mgza, 2);
        $bill->total_final_mogma3 = round($request->total_final_mogma3, 2);
        $bill->total_final_bill = round(($request->total_final_mgza + $request->total_final_mogma3), 2);
        $bill->total_final_mgza_egy = round($request->total_final_mogma3 * $request->price_before_doller, 2);
        $bill->total_final_mogma3_egy = round($request->total_final_mgza * $request->price_before_doller, 2);
        $bill->total_final_bill_egy = round(($request->price_before_doller * ($request->total_final_mgza + $request->total_final_mogma3)), 2);


        $bill->save();
        $deletedRows = Billitems::where('bill_id', $bill->id)->delete();
        // $imageName = str_random(10) . '.' . 'png';
        if (!empty($request->item_id)) {
            //dd($request->get());
            foreach ($request->item_id as $k_item=>$item){
                if ($request->color[$k_item] != 20){
                    foreach ($request->u_size[$item][$request->color[$k_item]] as $k_size => $itemSize) {
                        $fire []=$itemSize;
                        $zz =round($request->u_price[$item][$request->color[$k_item]][$k_size], 2);
                        $items = Items::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->where('id',$item)->update(['price'=>$zz]);
                        $billitems = Billitems::updateOrCreate(['id'=>$request->bill_id],[
                            'bill_id' => $bill->id,
                            'item_id' => $item,
                            'color' => $request->color[$k_item],
                            'size' =>  $itemSize,
                            'quantity_b' => $request->u_quantity[$item][$request->color[$k_item]][$k_size],
                            'price_b' => round($request->u_price[$item][$request->color[$k_item]][$k_size], 2) ,
                            'total_price_b' => round($request->u_price[$item][$request->color[$k_item]][$k_size], 2)* $request->u_quantity[$item][$request->color[$k_item]][$k_size],
                            'price_b_egy' => round(($request->input('price_b')[$k_item] * ($bill->price_before_doller)), 2),
                            'total_price_b_egy' => round(($request->input('total_price_b')[$k_item]), 2),

                        ]);
                    }
                }else{


                    $billitems = Billitems::updateOrCreate(['id'=>$request->bill_id],[
                        'bill_id' => $bill->id,
                        'item_id' => $item,
                        'color' => $request->color[$k_item],
                        'size' =>  27,
                        'quantity_b' => $request->quantity[$k_item],
                        'price_b' => round($request->price[$k_item], 2) ,
                        'total_price_b' => round($request->price[$k_item], 2)* $request->quantity[$k_item],
                        'price_b_egy' => round(($request->price_b[$k_item] * ($bill->price_before_doller)), 2),
                        'total_price_b_egy' => round(($request->input('total_price_b')[$k_item]), 2),

                    ]);

                }
            }}




        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('bills'));
    }

    public function savedraftTosave(Request $request)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $bill = Bills::findOrFail($request->id);



        }else {

            $bill = Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($request->id);


        }

        $bill['savedraft'] = 1;
        $bill->save();

        $item_id_devices = generalcontroller::notnull($request->input('item_id_devices'));

        $billitems = Billitems::where('bill_id', $request->id)->get();


        foreach ($billitems as $key => $billitem) {
            $dataitems['bill_id'] = $request->id;
            $dataitems['item_id'] = $billitem->item_id;
            $dataitems['quantity_b'] = $billitem->quantity_b;
            $dataitems['price_b'] = $billitem->price_b;
            $dataitems['total_price_b'] = round($billitem->total_price_b, 2);
            $dataitems['price_b_egy'] = round(($billitem->price_b * ($bill->price_before_doller)), 2);
            $dataitems['total_price_b_egy'] = round(($billitem->total_price_b));

            if ($billitem->price_b == 0) {

                if ($item = Items::find($billitem->item_id)) {
                    $item->quantity += $billitem->quantity_b;
                    $item->save();
                }
            } else {
                if ($item = Items::find($billitem->item_id)) {
                    $item->quantity += $billitem->quantity_b;
                    $item->price = round(($billitem->price_b), 2);
                    $item->save();
                }
            }
        }

        $billdevicesitems = Billdevicesitems::where('bill_id', $request->id)->get();


        foreach ($billdevicesitems as $key => $items) {
            $dataddeviceitems['bill_id'] = $request->id;
            $dataddeviceitems['device_id'] = $items->device_id;
            $dataddeviceitems['item_id_devices'] = $items->item_id_devices;
            $dataddeviceitems['quantity_devices'] = $items->quantity_devices;
            $dataddeviceitems['price_devices'] = round($items->price_devices, 2);
            $dataddeviceitems['total_devices'] = round($items->total_devices, 2);
            $dataddeviceitems['price_devices_egy'] = round(($items->price_devices * ($bill->price_before_doller)), 2);
            $dataddeviceitems['total_devices_egy'] = round(($items->total_devices * ($bill->price_before_doller)), 2);


        }
        generalcontroller::countdiv($request->id);

        return redirect(aurl('bills'));
    }


    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            generalcontroller::DeleteBill($id);
            Bills::find($id)->delete();


        }else {

            generalcontroller::DeleteBill($id);
            Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($id)->delete();

        }

        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('bills'));
    }


    public function bill($id = null, $from_cur = null, $to_cur = null)
    {



        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $bills = Bills::with('suppliers', 'currency', 'billitems')->find($id);

            $billscolor = ItemsColors::get();
            $billsize = ItemsSize::get();

        }else {

            $bills = Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers', 'currency', 'billitems')->find($id);

            $billscolor = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $billsize = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
        }
        $ss = Billitems::where('bill_id', $id)->get();
        $count = count($ss);
        //  $afterdis = $ss[0]['afterdiscount'];
        //dd($count);

        //@$bills['percentage']  = round(($bills['total_shipments'] / ($bills['total_final_bill'] + $bills['total_shipments'])) * 100,2);//old
        @$bills['percentage'] = round(($bills['total_shipments'] * 100) / $bills['total_final_bill'], 2);//new

        //@$bills['percentageTax'] = ceil((($bills['total_shipments']-$bills['total_addtaxs']) / ($bills['total_final_bill'] + ($bills['total_shipments']-$bills['total_addtaxs']))) * 100); //old
        @$bills['percentageTax'] = round((($bills['total_shipments'] - $bills['total_addtaxs']) * 100) / $bills['total_final_bill'], 2);//new

        $billdevies = Billdevies::with('devices')->where('bill_id', $id)->get();
        $currencies = Currencies::where('id', '!=', $bills->currency_id)->get();
        $currencyrates = Currencyrates::get();
        //$bills     = Billitems::with('items')->where('bill_id',$id)->get();

        $rate = $this->cur($id, $from_cur, $to_cur);


        $itemSizes = Specifications::with('specificsize')->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
        $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();


        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $itemSizes = Specifications::with('specificsize')->get();
            $items = Items::get();




        }else {

            $itemSizes = Specifications::with('specificsize')->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }
        $billitems = Billitems::with('items')->where('bill_id', $id)->get();
        // dd($billitems);
        $billdeviesitems = Billdevicesitems::with('items')->where('bill_id', $id)->get();

        return view("admin.bills.show", compact('bills',
//            'suppliers',
            'billitems', 'rate', 'currencies', 'billdevies', 'items', 'billdeviesitems', 'currencyrates',
//            'percentageTax',
            'billscolor', 'billsize', 'count', 'itemSizes'));
    }

    public function cur($id = null, $from_cur = null, $to_cur = null)
    {

        @$rate = Currencyrates::where('currency_id', $from_cur)->where('to_currency_id', $to_cur)->first();
        // //dd($curammout);
        // @$bills = Bills::with('suppliers','billitems')->find($id);
        // @$final = $curammout->rate * $bills->total_final_bill;
        //
        // //dd($final);
        return $rate;

    }

    public function showEgypt($id = null, $from_cur = null, $to_cur = null)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $bills = Bills::with('suppliers', 'currency')->find($id);



        }else {


            $bills = Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers', 'currency')->find($id);
        }
        //@$bills['percentage']    = ceil(($bills['total_shipments_egy'] / ($bills['total_final_bill_egy'] + $bills['total_shipments_egy'])) * 100); // old
        @$bills['percentage'] = round(($bills['total_shipments_egy'] * 100) / $bills['total_final_bill_egy'], 2);//new
        //@$bills['percentageTax'] = ceil((($bills['total_shipments_egy'] - $bills['total_addtaxs_egy']) / ($bills['total_final_bill_egy'] + ($bills['total_shipments_egy']-$bills['total_addtaxs_egy']))) * 100);//old
        @$bills['percentageTax'] = round((($bills['total_shipments_egy'] - $bills['total_addtaxs_egy']) * 100) / $bills['total_final_bill_egy'], 2);//new

        $billdevies = Billdevies::with('devices')->where('bill_id', $id)->get();
        $currencies = Currencies::where('id', '!=', $bills->currency_id)->get();
        $currencyrates = Currencyrates::get();
        $rate = $this->cur($id, $from_cur, $to_cur);
        $items = Items::get();
        $billitems = Billitems::with('items')->where('bill_id', $id)->get();
        $billdeviesitems = Billdevicesitems::with('items')->where('bill_id', $id)->get();

        return view("admin.bills.EgyptShow", compact('bills', 'suppliers', 'billitems', 'rate', 'currencies', 'billdevies', 'items', 'billdeviesitems', 'currencyrates', 'percentageTax'));
    }


    public function export()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $bills = Bills::orderBy("id", "DESC")->get();



        }else {


            $bills = Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers', 'currency')->orderBy("id", "DESC")->get();
        }

        $billsData = [];
        foreach ($bills as $item) {
            $billsData[] = [
                trans('bills.bill_number') => $item->id,
                //trans('bills.bill_number')          => $item->bill_number,
                trans('bills.date') => date("Y/m/d", strtotime($item->created_at)),
                trans('bills.supplier_id') => $item->suppliers->suppliers_name,
                trans('bills.phone') => $item->suppliers->suppliers_number,
                trans('bills.country') => $item->suppliers->country,
                //trans('bills.price_before_doller')  => $item->price_before_doller,
                trans('bills.notes') => $item->notes,
            ];
        }

        if (count($billsData) > 0) {
            Excel::create("تصدير فواتير شراء(" . date("d-M-Y") . ")", function ($excel) use ($billsData) {
                $excel->sheet('sheet1', function ($sheet) use ($billsData) {
                    $sheet->fromArray($billsData);

                    $sheet->cell('A1:F1', function ($cell) {
                        $cell->setBackground('#e8e8e8');
                        $cell->setFontWeight('bold');
                    });
                });

            })->export('xls');
        }
    }

    // Start PDF //
    public function getPdf($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $bills = Bills::with('suppliers', 'currency')->find($id);

        }else {


            $bills = Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers', 'currency')->find($id);
        }
        $Invoicespdfs = Billspdf::where('id_bills', $id)->orderBy('created_at', 'desc')->paginate(30);

        return view("admin.bills.pdf.show", compact('Invoicespdfs', 'id', 'bills'));
    }

    public function createGetPdf($id = null)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $bills = Bills::with('suppliers', 'currency')->find($id);

        }else {


            $bills = Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers', 'currency')->find($id);
        }
        $Invoicespdfs = Billspdf::where('id_bills', $id)->first();


        return view("admin.bills.pdf.create", compact('Invoicespdfs', 'id', 'bills'));
    }

    public function editgetPdf($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $Invoicespdfs = Billspdf::with('suppliers', 'currency')->find($id);

        }else {


            $Invoicespdfs = Billspdf::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers', 'currency')->find($id);
        }

        return view("admin.bills.pdf.edit", compact('Invoicespdfs'));
    }


    public function stoneGetPdf($id, request $request)
    {
        $data = $this->validate(request(),
            [
                'pdf' => 'required',
            ], [], [

                'pdf' => trans('clients.name_company'),

            ]);
        $data = request()->except(['_token', '_method']);

        foreach ($request->file('pdf') as $file) {
            $name = rand(1, 1000) . time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/upload/bills/', $name);
            $dataa[] = $name;
        }

        if (empty($request->file('pdf'))) {
            $dataa = '';
        }

        if (!empty($request->pdf)) {
            foreach ($dataa as $key => $item) {
                $invoicesPDF = Billspdf::create([
                    'id_bills' => $request->id_bills,
                    'pdf' => $item,
                    'Seller_id' => Auth::guard('admin')->user()->Seller_id,
                ]);
            }
        }
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('bills/getpdf/') . "/" . $invoicesPDF->id_bills);

    }

    public function updateGetPdf($id, request $request)
    {
        $data = $this->validate(request(),
            [
                'pdf' => 'required',
            ], [], [

                'pdf' => trans('clients.name_company'),

            ]);
        $data = request()->except(['_token', '_method']);

        foreach ($request->file('pdf') as $file) {
            $name = rand(1, 1000) . time() . '-' . $file->getClientOriginalName();
            $file->move(public_path() . '/upload/bills/', $name);
            $dataa[] = $name;
        }

        if (empty($request->file('pdf'))) {
            $dataa = '';
        }

        foreach ($dataa as $key => $item) {
            $invoicesPDF = Billspdf::find($id);
            $invoicesPDF->pdf = $item;
            $invoicesPDF->save();
        }
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('bills/getpdf/') . "/" . $invoicesPDF->id_invoices);

    }

    public function destroyPdf($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $invoicesPDF = Billspdf::with('suppliers', 'currency')->find($id)->delete();

        }else {


            $invoicesPDF = Billspdf::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers', 'currency')->find($id)->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return back();
    }
    // End PDF //


}
