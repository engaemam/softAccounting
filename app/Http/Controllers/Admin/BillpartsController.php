<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\BillpartsDatatable;
use App\Http\Controllers\Controller;

use App\Model\Billparts;
use App\Model\Bills;
use App\Model\Items;

use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class BillpartsController extends Controller
{

    public function index(BillpartsDatatable $admin)
    {
        return $admin->render('admin.billparts.index', ['title' => trans('billparts.billparts')]);
    }

    public function create()
    {
        $billparts = new Billparts(\Request::old());
        $items = Items::get();
        $bills = Bills::get();
        return view('admin.billparts.create', ['title' => trans('billparts.create')],compact('billparts','items','bills'));
    }


    public function store()
    {
        $data = request()->validate(
            [
                'item_id' => 'required',
                'numbers' => 'required',
                'bill_id' => 'required',

            ], [], [
            'item_id' => trans('billparts.item_id'),
            'numbers' => trans('billparts.numbers'),
            'bill_id' =>trans('billparts.bill_id'),

        ]);
        $data = request()->except(['_token', '_method']);


        Billparts::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('billparts'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $billparts = Billparts::find($id);

        $items = Items::get();
        $bills = Bills::get();
        $title = trans('billparts.edit');
        return view('admin.billparts.edit', compact('billparts', 'title','bills','suppliers'));
    }


    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'item_id' => 'required',
                'numbers' => 'required',
                'bill_id' => 'required',

            ], [], [
                'item_id' => trans('billparts.item_id'),
                'numbers' => trans('billparts.numbers'),
                'bill_id' =>trans('billparts.bill_id'),
            ]);
        $data = request()->except(['_token', '_method']);


        Billparts::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('billparts'));
    }

    public function destroy($id)
    {
        //dd($id);
        Billparts::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('billparts'));
    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Billparts::destroy(request('item'));
        } else {
            Billparts::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('billparts'));
    }
}