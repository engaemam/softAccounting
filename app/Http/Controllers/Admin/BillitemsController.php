<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Billitems;
use App\Model\Bills;
use App\Model\Items;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class BillitemsController extends Controller
{

    public function index(BillpartsDatatable $admin)
    {
        return $admin->render('admin.billitems.index', ['title' => trans('billitems.show')]);
    }

    public function create()
    {
        $billitems = new Billitems(\Request::old());
        $items = Items::get();
        $bills = Bills::get();
        return view('admin.billitems.create', ['title' => trans('billitems.create')],compact('billitems','items','bills'));
    }


    public function store()
    {
        $data = request()->validate(
            [
                'item_id' => 'required',
                //'bill_id' => 'required',

            ], [], [
            'item_id' => trans('billitems.item_id'),
            //'bill_id' =>trans('billitems.bill_id'),

        ]);
        $data = request()->except(['_token', '_method']);


        Billitems::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('bills'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $billitems = Billitems::find($id);

        $items = Items::get();
        $bills = Bills::get();
        $title = trans('billitems.edit');
        return view('admin.billitems.edit', compact('billitems', 'title','bills','suppliers','items'));
    }


    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'item_id' => 'required',
                'bill_id' => 'required',
                'device_id' => '',
                'quantity' => '',
                'price' => '',
                'total_price' => '',
                'type' => '',

            ], [], [
                'item_id' => trans('billitems.item_id'),

                'bill_id' =>trans('billitems.bill_id'),
            ]);
        $data = request()->except(['_token', '_method']);


        Billitems::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('billitems'));
    }

    public function destroy($id)
    {

        Billitems::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('billitems'));
    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Billitems::destroy(request('item'));
        } else {
            Billitems::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('billitems'));
    }
}