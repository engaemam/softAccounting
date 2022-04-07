<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\ShippingDatatable;
use App\Http\Controllers\Controller;
use App\Model\Shipments;
use App\Model\Shipping;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ShippingController extends Controller
{

    public function index(ShippingDatatable $admin)
    {
        $shippings = Shipping::orderBy('created_at','desc')->paginate(15);
        return $admin->render('admin.shipping.index', compact('shippings'));
    }

    public function create()
    {
        return view('admin.shipping.create', ['title' => trans('shipping.create')]);
    }


    public function store()
    {
        $data = request()->validate(
            [
                'type_expense' => 'required',



            ], [], [
            'type_expense' => trans('shipping.type_expense'),



        ]);
        $data = request()->except(['_token', '_method']);


        Shipping::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('shipping'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $shipping = Shipping::find($id);
        $title = trans('shipping.edit');
        return view('admin.shipping.edit', compact('shipping', 'title'));
    }


    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'type_expense' => 'required',

            ], [], [
                'type_expense' => trans('shipping.type_expense'),


            ]);
        $data = request()->except(['_token', '_method']);


        Shipping::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('shipping'));
    }

    public function destroy($id)
    {
        if (self::alreadycheck($id)== '1') {
            session()->flash('error', trans('admin.deleted_record_cant'));
            return redirect(aurl('shipping'));

        } else {
            Shipping::find($id)->delete();
            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('shipping'));
        }


    }
    public function alreadycheck($id){
        $Shipments       = Shipments::where('shipping_id',$id)->value('shipping_id');

        if($Shipments){
            return '1';

        }
    }


    public function multi_delete()
    {
        if (is_array(request('shipping'))) {
            Shipping::destroy(request('shipping'));
        } else {
            Shipping::find(request('shipping'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('shipping'));
    }
    public function search(){
        $shippings = Shipping::where('type_expense','LIKE','%'.request()->search.'%')->orderBy('created_at','desc')->paginate(15);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.shipping.index',compact('shippings','temp'));
    }
}