<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\BillpartsDatatable;
use App\Model\Billdevies;
use App\Model\Bills;
use App\Model\BillSource;
use App\Model\Category;
use App\Model\Invoicecolors;
use App\Model\Colors;
use App\Model\itemsColors;
use DB;
//use Maatwebsite\Excel\Excel;
use Excel;

use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ItemsColorsController extends Controller
{

    public function index(BillpartsDatatable $admin, $id=null)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $colors = ItemsColors::where('status',1)->where('name', 'like', '%'.request()->search.'%')
                ->orderBy("id","desc")
                ->paginate(20);



        }else {
            $colors = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('status',1)->where('name', 'like', '%'.request()->search.'%')
                ->orderBy("id","desc")
                ->paginate(20);


        }


        $title=trans('colors.colors');
        return $admin->render('admin.itemscolors.index',compact('colors','title'));
    }



    public function create()
    {
        return view('admin.itemscolors.create', ['title' => trans('colors.create')]);
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'name' => 'required|unique:items_colors',

            ], [], [
            'name' => trans('colors.name_ar'),

        ]);
        $data = request()->except(['_token', '_method']);
        $data['status']= 1;
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;
        ItemsColors::create($data);

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('itemscolors'));
    }





    public function edit($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $colors = ItemsColors::where('status',1)->find($id);




        }else {

            $colors = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('status',1)->findOrFail($id);


        }

        $title = trans('colors.edit');
        return view('admin.itemscolors.edit', compact('colors', 'title'));
    }


    public function update(Request $request, $id)
    {
        $invoicesource = ItemsColors::find($id);
        if($invoicesource->item_name == $request->item_name){
            $data = $this->validate(request(),
                [
                    'name' => 'required',
                ], [], [
                    'name' => trans('colors.name'),
                ]);
        }else{
            $data = $this->validate(request(),
                [
                    'name' => 'required|unique:items_colors',

                ], [], [
                    'name' => trans('colors.name'),
                ]);
        }

        $data = $this->validate(request(),
            [
                'name' => 'required',
            ], [], [
                'name' => trans('colors.name'),
            ]);
        $data = request()->except(['_token', '_method']);


        ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('itemscolors'));
    }

    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            ItemsColors::findOrFail($id)->delete();
            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('itemscolors'));



        }else {


            ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();
            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('itemscolors'));
        }



    }




}