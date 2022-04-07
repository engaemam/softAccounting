<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ItemsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Billdevies;
use App\Model\Bills;
use App\Model\Category;
use App\Model\Items;
use DB;
use App\Model\cats;
//use Maatwebsite\Excel\Excel;
use Excel;

use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class CategoryController extends Controller
{

    public function index(ItemsDatatable $admin,$id=null)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $cats= Category::with('Items')
                ->orwhere('name', 'like', '%'.request()->search.'%')
                ->orwhere('details', 'like', '%'.request()->search.'%')
                ->orwhere('id', 'like', '%'.request()->search.'%')
                ->orderBy("created_at","desc")
                ->paginate(20);



        }else {

                     $cats= Category::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('Items')
                ->paginate(20);

        }

        $title=trans('items.items');
        return $admin->render('admin.cats.index',compact('cats','title'));
    }



    public function create()
    {
        return view('admin.cats.create', ['title' => trans('cats.create')]);
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'name' => 'required|unique:categories',
                'details' => '',

            ], [], [
            'name' => trans('cats.name_ar'),
            'details' => trans('cats.specifications'),

        ]);
        $data = request()->except(['_token', '_method']);

        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;

        Category::create($data);

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('cats'));
    }





    public function edit($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $cats = Category::find($id);




        }else {

            $cats = Category::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);


        }

        $title = trans('cats.edit');
        return view('admin.cats.edit', compact('cats', 'title'));
    }


    public function update(Request $request, $id)
    {
        $cats = Category::find($id);
        if($cats->item_name == $request->item_name){
            $data = $this->validate(request(),
                [
                    'name' => 'required',
                    'details'=>'',
                ], [], [
                    'name' => trans('cats.name'),
                    'details' => trans('cats.specifications'),
                ]);
        }else{
            $data = $this->validate(request(),
                [
                    'name' => 'required|unique:categories',
                    'details'=>'',

                ], [], [
                    'name' => trans('cats.name'),
                    'details' => trans('cats.specifications'),
                ]);
        }

        $data = $this->validate(request(),
            [
                'name' => 'required',
                'details' => '',



            ], [], [
                'name' => trans('cats.name'),
                'details' => trans('cats.specifications'),


            ]);
        $data = request()->except(['_token', '_method']);


        Category::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('cats'));
    }

    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            Category::findOrFail($id)->delete();




        }else {


            Category::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($id)->delete();

        }

            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('cats'));

    }


    public function multi_delete()
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            if (is_array(request('item'))) {
                Category::destroy(request('item'));
            } else {
                Category::find(request('item'))->delete();
            }



        }else {

            if (is_array(request('item'))) {
                Category::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->destroy(request('item'));
            } else {
                Category::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail(request('item'))->delete();
            }

        }

        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('cats'));
    }

    public function search(Request $request){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $cats = Category::where('name', 'like', '%'.request()->search.'%')
                ->orwhere('details', 'like', '%'.request()->search.'%')


                ->orderByRaw("`id`= 0,`id`")


                ->paginate(20);


        }else {

            $cats = Category::where('name', 'like', '%'.request()->search.'%')
                ->orwhere('details', 'like', '%'.request()->search.'%')


                ->orderByRaw("`id`= 0,`id`")->

where('Seller_id', Auth::guard('admin')->user()->Seller_id)
                ->paginate(20);

        }

        $cats->appends(['search' => $request]);

        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        //generalcontroller::checkbill();

        return view('admin.cats.index',compact('cats','temp'));
    }


}