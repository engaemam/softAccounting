<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Billitems;
use App\Model\Bills;
use App\Model\Items;
use App\Model\ReturnedBill;
use App\Model\ReturnedBillItem;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ReturnedBillItemsController extends Controller
{

    public function index(BillpartsDatatable $admin)
    {
        return $admin->render('admin.returned_billitems.index', ['title' => trans('billitems.show')]);
    }

    public function create()
    {
        $returned_billitems = new Billitems(\Request::old());
        $items = Items::get();
        $bills = ReturnedBill::get();
        return view('admin.returned_billitems.create', ['title' => trans('billitems.create')],compact('returned_billitems','items','bills'));
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


        ReturnedBillItem::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('bills'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $returned_billitems = ReturnedBillItem::find($id);

        $items = Items::get();
        $bills = ReturnedBill::get();
        $title = trans('billitems.edit');
        return view('admin.returned_billitems.edit', compact('returned_billitems', 'title','bills','suppliers','items'));
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


        ReturnedBillItem::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('returned_billitems'));
    }

    public function destroy($id)
    {

        ReturnedBillItem::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('returned_billitems'));
    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            ReturnedBillItem::destroy(request('item'));
        } else {
            ReturnedBillItem::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('returned_billitems'));
    }
}