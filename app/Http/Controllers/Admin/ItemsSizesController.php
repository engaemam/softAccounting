<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\BillpartsDatatable;
use App\Model\Billdevies;
use App\Model\Bills;
use App\Model\BillSource;
use App\Model\Category;
use App\Model\Invoicesizes;
use App\Model\ItemsSize;
use App\Model\Itemssizes;
use App\Model\Sizes;
use DB;
//use Maatwebsite\Excel\Excel;
use Excel;

use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ItemsSizesController extends Controller
{

    public function index(BillpartsDatatable $admin, $id=null)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $sizes = ItemsSize::where('status',1)->where('name', 'like', '%'.request()->search.'%')
                ->paginate(20);


        }else {

            $sizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->
            where('status',1)->where('name', 'like', '%'.request()->search.'%')
                ->paginate(20);

        }

        $title=trans('sizes.sizes');
        return $admin->render('admin.itemssizes.index',compact('sizes','title'));
    }



    public function create()
    {
        return view('admin.itemssizes.create', ['title' => trans('sizes.create')]);
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'name' => 'required|unique:items_sizes',

            ], [], [
            'name' => trans('sizes.name_ar'),

        ]);
        $data = request()->except(['_token', '_method']);
        $data['status']= 1;
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;
        ItemsSize::create($data);

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('itemssizes'));
    }





    public function edit($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $sizes = ItemsSize::where('status',1)->findOrFail($id);




        }else {


            $sizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('status',1)->findOrFail($id);

        }
        $title = trans('sizes.edit');
        return view('admin.itemssizes.edit', compact('sizes', 'title'));
    }


    public function update(Request $request, $id)
    {
        $invoicesource = ItemsSize::find($id);
        if($invoicesource->item_name == $request->item_name){
            $data = $this->validate(request(),
                [
                    'name' => 'required',
                ], [], [
                    'name' => trans('sizes.name'),
                ]);
        }else{
            $data = $this->validate(request(),
                [
                    'name' => 'required|unique:items_sizes',

                ], [], [
                    'name' => trans('sizes.name'),
                ]);
        }

        $data = $this->validate(request(),
            [
                'name' => 'required',
            ], [], [
                'name' => trans('sizes.name'),
            ]);
        $data = request()->except(['_token', '_method']);

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            ItemsSize::where('status',1)->where('id', $id)->update($data);



        }else {

            ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('status',1)->where('id', $id)->update($data);


        }
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('itemssizes'));
    }

    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){




            ItemsSize::find($id)->delete();

        }else {

            ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();

        }


        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('itemssizes'));

    }





}