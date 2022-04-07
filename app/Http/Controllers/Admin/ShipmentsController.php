<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\ShipmentsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Bills;
use App\Model\Items;
use App\Model\Shipments;
use App\Model\Shipping;
use Storage;
use Illuminate\Http\Request;
class ShipmentsController extends Controller
{

    public function index(ShipmentsDatatable $admin)
    {
        $shipments = Shipments::with('shipping','bills')->get();

        return $admin->render('admin.shipments.index', ['title' => trans('shipments.show')],compact('shipments'));
    }

    public function create()
    {
        $shipments = new Shipments(\Request::old());

        $bills = Bills::get();

        $shippings=Shipping::get();
        return view('admin.shipments.create', ['title' => trans('shipments.create')],compact('shipments','bills','shippings'));
    }


    public function addnew($billId)
    {

        $shipments = new Shipments(\Request::old());

        $bills = Bills::get();
        $bill=Bills::where('id',$billId)->first();
        $shippings=Shipping::get();
        return view('admin.shipments.create',compact('billId', 'shipments','bills','shippings','bill'));
    }

    public function show($bills_id=null)
    {
        $shipmentsQuery = Shipments::with('shipping','bills');
        $bill=Bills::where('id',$bills_id)->first();

        if(!empty($bills_id))
        {
            $shipmentsQuery->where('bill_id',$bills_id);
        }

        $shipments = $shipmentsQuery->orderBy("id","DESC")->get();
        //dd($shipments);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view("admin.shipments.show", compact('shipments','bill','temp'));
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'shipping_id' => 'required',
                'value' => 'required',
                'bill_id' => 'required',

            ], [], [
            'shipping_id' => trans('shipments.shipping'),
            'value' => trans('shipments.value'),
            'bill_id' =>trans('shipments.bill_id'),

        ]);
        $data = request()->except(['_token', '_method']);


        foreach ($request->shipping_id as $key => $item){
            $shipments = Shipments::create([
                'bill_id'        => $request->bill_id,
                'shipping_id'    => $item,
                'value'          => round($request->value[$key],2),
            ]);
        }

        $this->billShipmentCalculate($request->bill_id);
        generalcontroller::showadd($request->bill_id);

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('shipments/'.$request->bill_id));
    }




    public function edit($id)
    {
        $shipments  = Shipments::find($id);
        $bill = Bills::where('id',$shipments->bill_id)->first();
        $bills      = Bills::get();
        $shippings  =   Shipping::get();

        $title = trans('shipments.edit');
        return view('admin.shipments.edit', compact('shipments', 'title','bills','shippings','bill'));
    }


    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'shipping_id' => 'required',
                'value' => 'required',
                'bill_id' => 'required',

            ], [], [
                'shipping_id' => trans('shipments.shipping'),
                'value' => trans('shipments.value'),
                'bill_id' =>trans('shipments.bill_id'),
            ]);

        $data = request()->except(['_token', '_method']);
        foreach ($request->shipping_id as $key => $item) {
            $shipments = Shipments::find($id);
            $shipments->bill_id = $request->bill_id;
            $shipments->shipping_id = $item;
            $shipments->value =  round($request->value[$key],2);
            $shipments->save();
        }

        $this->billShipmentCalculate($request->bill_id);
        generalcontroller::showadd($request->bill_id);


        session()->flash('success', trans('admin.updated_record'));
        //return redirect(aurl('shipments'));
        return redirect(aurl('shipments')."/".$request->bill_id);
    }

    public function destroy($id, Request $request)
    {

        $this->billShipmentSub($id);
        Shipments::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));



        return redirect(aurl('shipments')."/".$request->bill_id);

    }



    function billShipmentCalculate($bill_id){
        $bill = Bills::find($bill_id);

        $bill->total_shipments     = 0;
        $bill->total_shipments_egy = 0;
        $shipments = Shipments::where('bill_id', $bill_id)->get();
        foreach ($shipments as $item){
            $bill->total_shipments     += $item->value / $bill->price_before_doller;
            $bill->total_shipments_egy += $item->value  ;
        }

        $bill->save();
    }
    function billShipmentSub($bill_id){
        $shipmaents = Shipments::where('id', $bill_id)->value('bill_id');
        $bill = Bills::find($shipmaents);
        $shipments = Shipments::where('id', $bill_id)->value('value');
        $valuee = ($bill->total_shipments * $bill->price_before_doller) - $shipments;
        $valueeEgy = $bill->total_shipments_egy - $shipments;
        $update = Bills::where('id',$shipmaents)->update(['total_shipments'=>$valuee,'total_shipments_egy'=>$valueeEgy]);
    }


    public function search(Request $request){
        $search      = $request['search'];
        $shipments = Shipments::with('shipping','bills')->whereHas('bills', function ($query) use ($search){
            $query->where('bill_number', 'like', '%'.$search.'%');
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

        return view('admin.shipments.index',compact('shipments','temp'));
    }
}