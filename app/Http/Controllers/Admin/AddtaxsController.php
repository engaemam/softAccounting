<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Addtaxnames;
use App\Model\Addtaxs;
use App\Model\Billdevicesitems;
use App\Model\Billitems;
use App\Model\Bills;
use App\Model\Items;
use Storage;
use Illuminate\Http\Request;
class AddtaxsController extends Controller
{

    public function index(Request $request)
    {
        $search      = $request['search'];
        $addtaxs = Addtaxs::orderBy("id","desc")->paginate(20);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view('admin.addtaxs.index',compact('addtaxs','temp'));

    }

    public function create()
    {
        $addtaxs = new Addtaxs(\Request::old());
        $bills = Bills::get();


        $addtaxnames = Addtaxnames::get();

        return view('admin.addtaxs.create', ['title' => trans('addtaxs.create')],compact('addtaxs','bills','addtaxnames'));
    }


    public function addnew($billId)
    {

        $addtaxs        = new Addtaxs(\Request::old());
        $bills          = Bills::get();
        $bill           = Bills::where('id',$billId)->first();
        $addtaxnames    = Addtaxnames::get();
        return view('admin.addtaxs.create',compact('billId', 'addtaxs','bills','addtaxnames','bill'));
    }

    public function show($bills_id=null)
    {

        $addtaxsQuery = Addtaxs::with('addtaxnames','bills');
        $bill=Bills::where('id',$bills_id)->first();

        if(!empty($bills_id))
        {
            $addtaxsQuery->where('bill_id',$bills_id);
        }

        $addtaxs = $addtaxsQuery->orderBy("id","DESC")->get();
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view("admin.addtaxs.show", compact('addtaxs','bill','temp'));
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'addtaxnames_id' => 'required',
                'price' => 'required',
                'bill_id' => 'required',

            ], [], [
            'addtaxnames_id' => trans('addtaxs.addtaxnames_id'),
            'price' => trans('addtaxs.price'),
            'bill_id' =>trans('addtaxs.bill_id'),

        ]);
        $data = request()->except(['_token', '_method']);


        foreach ($request->addtaxnames_id as $key => $item){
            $addtaxs = Addtaxs::create([
                'bill_id'           => $request->bill_id,
                'addtaxnames_id'    => $item,
                'price'             => round($request->price[$key],2),
            ]);
        }
        $this->billTaxCalculate($request->bill_id);
        $this->UpdateItems($request->bill_id);


        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('addtaxs/'.$request->bill_id));
    }
    function billTaxCalculate($bill_id){
        $bill = Bills::find($bill_id);

        $bill->total_addtaxs = 0;
        $bill->total_addtaxs_egy = 0;
        $Addtaxs = Addtaxs::where('bill_id', $bill_id)->get();
        foreach ($Addtaxs as $item){
            $bill->total_addtaxs     += $item->price / $bill->price_before_doller;
            $bill->total_addtaxs_egy += $item->price ;
        }

        $bill->save();
    }

     function UpdateItems($id){

        $bills =      Bills::with('suppliers')->find($id);
         //$bills['percentageTax']   = ceil((($bills['total_shipments_egy'] - $bills['total_addtaxs_egy']) / ($bills['total_final_bill_egy'] + ($bills['total_shipments_egy']-$bills['total_addtaxs_egy']))) * 100); // old
         @$bills['percentageTax']    = round(( ($bills['total_shipments_egy'] - $bills['total_addtaxs_egy']) * 100) / $bills['total_final_bill_egy'] ,2);//new

        $billitems = Billitems::with('items')->where('bill_id',$id)->orderBy('created_at', 'desc')->get();
//dd($billitems);
        foreach ($billitems as $key => $value){
            if($value->price_b_egy== 0){

            }else{
                $zz = round( $value->price_b_egy * $bills->percentageTax/100 + $value->price_b_egy,2);
                //dd($zz);
                $items = Items::where('id',$value->item_id)->update(['newprice'=>$zz]);
            }
        }
        $billdevicesitems = Billdevicesitems::with('items')->where('bill_id',$id)->orderBy('created_at', 'desc')->get();

        foreach ($billdevicesitems as $billdevicesitem){
            if($billdevicesitem->price_devices_egy== 0){

            }else{
                $zz = round($billdevicesitem->price_devices_egy * $bills->percentageTax/100 + $billdevicesitem->price_devices_egy,2);
                $items = Items::where('id',$billdevicesitem->item_id_devices)->update(['newprice'=>$zz]);
            }


        }

    }





    public function edit($id)
    {
        $addtaxs  = Addtaxs::find($id);
        $bill = Bills::where('id',$addtaxs->bill_id)->first();
        $bills      = Bills::get();
        $shippings  =   Addtaxnames::get();

        $title = trans('addtaxs.edit');
        return view('admin.addtaxs.edit', compact('addtaxs', 'title','bills','shippings','bill'));
    }


    public function update(Request $request, $id)
    {

        $data = request()->validate(
            [
                'addtaxnames_id' => 'required',
                'price' => 'required',
                'bill_id' => 'required',

            ], [], [
            'addtaxnames_id' => trans('addtaxs.addtaxnames_id'),
            'price' => trans('addtaxs.price'),
            'bill_id' =>trans('addtaxs.bill_id'),

        ]);

        $data = request()->except(['_token', '_method']);
        foreach ($request->addtaxnames_id as $key => $item) {
            $addtaxs = Addtaxs::find($id);
            $addtaxs->bill_id = $request->bill_id;
            $addtaxs->addtaxnames_id = $item;
            $addtaxs->price =  round($request->price[$key],2);
            $addtaxs->save();
        }
        $this->billTaxCalculate($request->bill_id);
        $this->UpdateItems($request->bill_id);


        session()->flash('success', trans('admin.updated_record'));
        //return redirect(aurl('addtaxs'));
        return redirect(aurl('addtaxs')."/".$request->bill_id);
    }

    public function destroy($id, Request $request)
    {

        $this->billTaxdelete($request->bill_id,$id);
        Addtaxs::find($id)->delete();

        session()->flash('success', trans('admin.deleted_record'));

        return redirect(aurl('addtaxs')."/".$request->bill_id);
    }
    function billTaxdelete($bill_id,$id){
        $bill = Bills::find($bill_id);

        $Addtaxs = Addtaxs::where('id', $id)->get();

        foreach ($Addtaxs as $item){
            $bill->total_addtaxs     = ($bill->total_addtaxs * $bill->price_before_doller) - $item->price;
            $bill->total_addtaxs_egy = $bill->total_addtaxs_egy - $item->price;
        }
        $bill->save();

    }






    public function search(Request $request){
        $search      = $request['search'];
        $addtaxs = Addtaxs::orderBy("id","desc")->paginate(20);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view('admin.addtaxs.index',compact('addtaxs','temp'));
    }
}