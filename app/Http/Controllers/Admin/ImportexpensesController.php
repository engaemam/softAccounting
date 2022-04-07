<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\ShipmentsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Bills;
use App\Model\Importdeviceitems;
use App\Model\Importexpenses;
use App\Model\Importitems;
use App\Model\Importnames;
use App\Model\Imports;
use App\Model\Items;
use App\Model\Shipments;
use App\Model\Shipping;
use Storage;
use Illuminate\Http\Request;
class ImportexpensesController extends Controller
{

    public function index()
    {
        $importexpenses = Importexpenses::with('shipping','bills')->get();

        return view('admin.importexpenses.index',compact('importexpenses'));
    }

    public function create()
    {

        $importexpenses = new Importexpenses(\Request::old());
        $imports        = Imports::get();
        $importnames    = Importnames::get();

        return view('admin.importexpenses.create',compact('importexpenses','imports','importnames'));
    }


    public function addnew($importId)
    {

        $importexpenses = new Importexpenses(\Request::old());
        $imports        = Imports::get();
        $importnames    = Importnames::get();
        $currencyImports        = Imports::with('currency')->where('id',$importId)->first();
        return view('admin.importexpenses.create',compact('importexpenses','imports','importnames','importId','currencyImports'));
    }

    public function show($import_id = null)
    {


        $importexpensesQuery = Importexpenses::with('importnames','imports');
        $imports = Imports::where('id',$import_id)->first();

        if(!empty($import_id))
        {
            $importexpensesQuery->where('import_id',$import_id);
        }

        $importexpenses = $importexpensesQuery->orderBy("id","DESC")->get();
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view("admin.importexpenses.show", compact('imports','importexpenses','temp'));
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'importname_id'    => 'required',
                'value'            => 'required',
                'import_id'        => 'required',

            ], [], [
            'importname_id'         => trans('importexpenses.importname_id'),
            'value'                 => trans('importexpenses.value'),
            'import_id'             => trans('importexpenses.bill_id'),

        ]);
        $data = request()->except(['_token', '_method']);


        foreach ($request->importname_id as $key => $item){
            $importexpenses = Importexpenses::create([
                'import_id'        => $request->import_id,
                'importname_id'    => $item,
                'value'            => round($request->value[$key],2),
            ]);
        }

        $this->importShipmentCalculate($request->import_id);



        //$this->changePrice($request->import_id);

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('importexpenses/show/'.$request->import_id));
    }

    public static  function changePrice($id){

        $imports =      Imports::with('suppliers')->find($id);
        //dd($imports['total_import_egy']);
        if(empty($imports['total_import_egy'])){

        }else{

            @$imports['percentage']    = round(($imports['total_import_egy'] * 100 ) / $imports['total_final_bill_egy'] ,2);//new
            $Importitems = Importitems::with('items')->where('import_id',$id)->orderBy('created_at', 'desc')->get();
            foreach ($Importitems as $key => $value){
                if($value->price_b_egy == 0){

                }else{
                    $zz = round( $value->price_b_egy * $imports->percentage/100 + $value->price_b_egy,2);
                    $items = Items::where('id',$value->item_id)->update(['newprice'=>$zz]);
                }
            }
            $importdeviceitems = Importdeviceitems::with('items')->where('import_id',$id)->orderBy('created_at', 'desc')->get();

            foreach ($importdeviceitems as $billdevicesitem){
                if($billdevicesitem->price_devices_egy== 0){

                }else{
                    $zz = round($billdevicesitem->price_devices_egy * $imports->percentage/100 + $billdevicesitem->price_devices_egy,2);
                    $items = Items::where('id',$billdevicesitem->item_id_devices)->update(['newprice'=>$zz]);
                }


            }
        }


    }



    public function edit($id)
    {
        $importexpenses  = Importexpenses::find($id);
        $imports         = Imports::get();
        $importnames      = Importnames::get();
        $project        = Imports::with('currency')->where('id',$importexpenses->import_id)->first();

        return view('admin.importexpenses.edit', compact('importexpenses','imports','importnames','project'));
    }


    public function update(Request $request)
    {
        $data = $this->validate(request(),
            [
                'importname_id'    => 'required',
                'value'            => 'required',
                'import_id'        => 'required',

            ], [], [
                'importname_id'         => trans('importexpenses.importname_id'),
                'value'                 => trans('importexpenses.value'),
                'import_id'             => trans('importexpenses.bill_id'),
            ]);

        $data = request()->except(['_token', '_method']);
        foreach ($request->importname_id as $key => $item) {
            $importexpenses = Importexpenses::findOrFail($data['id']);
            $importexpenses->import_id      = $request->import_id;
            $importexpenses->importname_id  = $item;
            $importexpenses->value          =  round($request->value[$key],2);
            $importexpenses->save();;
        }

        $this->importShipmentCalculate($request->import_id);

        session()->flash('success', trans('admin.updated_record'));
        //return redirect(aurl('shipments'));
        //return back();
        return redirect(aurl('importexpenses/show/'.$importexpenses->import_id));

    }

    public function destroy($id, Request $request)
    {



        $this->importShipmentSub($id);
        Importexpenses::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));



        return back();
    }



    function importShipmentCalculate($import_id){
        $import = Imports::find($import_id);
        $import->total_import = 0;
        $import->total_import_egy = 0;
        $importexpenses = Importexpenses::where('import_id', $import_id)->get();
        foreach ($importexpenses as $item){
            $import->total_import     += $item->value / $import->price_doller;
            $import->total_import_egy += $item->value ;
        }

        $import->save();
    }
    function importShipmentSub($import_id){

        $shipmaents = Importexpenses::where('id', $import_id)->value('import_id');
        $bill = Imports::find($shipmaents);
        $shipments = Importexpenses::where('id', $import_id)->value('value');
        $valuee = ($bill->total_import * $bill->price_doller) - $shipments;
        $valueeEgy = $bill->total_import_egy - $shipments;
        $update = Imports::where('id',$shipmaents)->update(['total_import'=>$valuee,'total_import_egy'=>$valueeEgy]);
    }


    public function search(Request $request){
        $search      = $request['search'];
        $importexpenses = Importexpenses::with('importnames','imports')
            ->whereHas('imports', function ($query) use ($search){
            $query->where('number', 'like', '%'.$search.'%');
            })->orderBy("id","desc")
            ->paginate(20);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view('admin.importexpenses.index',compact('importexpenses','temp'));
    }
}