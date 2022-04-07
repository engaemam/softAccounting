<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ItemsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Billitems;
use App\Model\Bills;
use App\Model\Category;
use App\Model\Devices;
use App\Model\Colors;
use App\Model\itemsColors;
use App\Model\ItemsSize;
use App\Model\Sizes;
use App\Model\Specifications;
use App\Model\Items;
//use Maatwebsite\Excel\Excel;
use Excel;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ItemsController extends Controller
{


    public function create()
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $items_cates = Category::get();
            $itemsizes = ItemsSize::get();
            $itemscolors = ItemsColors::get();
            $items = Items::get();
            $devices = Devices::orderBy('created_at','desc')->get();



        }else {

            $items_cates = Category::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemsizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $devices = Devices::orderBy('created_at','desc')->get();

        }


        $statement = DB::select("show table status like 'items'");
        $modelid =  $statement[0]->Auto_increment;
        //$currencies=Currencies::get();
        return view('admin.items.create', ['title' => trans('items.create')],compact('items_cates','items','devices','modelid','itemscolors','itemsizes'));
    }

    public function show($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $items = Items::with('Items')->find($id);
            $itemsizes = ItemsSize::get();
            $itemscolors = ItemsColors::get();
            $items_cates = Category::get();
            $specifications = Specifications::with('specificolor')->with('specificsize')->where('item_id',$id)->get();
            $specific = Specifications::with('specificolor','specificsize')->where('item_id',$id)->pluck('color_id')->toArray();
            $ItemsId = Specifications::where('item_id',$id)->pluck('color_id')->toArray();
            $colors = ItemsColors::whereIn('id', $specific)->get();
            $specification = Specifications::with('specificolor')->with('specificsize')->where('item_id',$id)->pluck('id');
            $ss = $specifications[0]['id'];
            $items_colors = ItemsColors::with('specificolor')->where('id',$ss)->get();


        }else {


            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('Items')->find($id);
            $itemsizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $items_cates = Category::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $specifications = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificolor')->with('specificsize')->where('item_id',$id)->get();
            $specific = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificolor','specificsize')->where('item_id',$id)->pluck('color_id')->toArray();
            $ItemsId = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id',$id)->pluck('color_id')->toArray();
            $colors = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->whereIn('id', $specific)->get();
            $specification = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificolor')->with('specificsize')->where('item_id',$id)->pluck('id');
            $ss = $specifications[0]['id'];
            $items_colors = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificolor')->where('id',$ss)->get();



        }




        $title = trans('items.edit');
        return view('admin.items.show', compact('items', 'title','items_cates','specifications','items_colors','itemsizes','itemscolors','colors'));

    }

    public function store(Request $request)
    {
       //dd($request->get());

        $data = request()->validate(
            [
//                unique:items
                'item_name' => 'required',
                'category_id' => 'required',
                'specifications' => 'required',
                'selling_price' => 'required',
                'color_id' => 'required',
                'image'=>v_image()


            ], [], [
            'item_name' => trans('items.name_ar'),
            'category_id' => trans('items.item_cates'),
            'specifications' => trans('items.specifications'),
            'color_id' => trans('specific.color'),
            'selling_price' => trans('specific.selling_price'),
            'size' => trans('specific.size'),
            'image'=>trans('items.image'),


        ]);
        $data = request()->except(['_token', '_method']);
        //        dd($data);

        if(request()->hasFile('image')) {
            $file = request()->file('image');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/items/'), $name);
            $data['image'] =  $name;

        }

        $item_ids = new Items();
        $item_ids->category_id= $request->category_id;
        $item_ids->item_name= $request->item_name;
        $item_ids->Seller_id= Auth::guard('admin')->user()->Seller_id;
        $item_ids->specifications= $request->specifications;

        if(request()->hasFile('image')){
        $item_ids->image= $name;
        }
        //$item_ids->city= $request->city;  
        
       $item_ids->barcode= "";
        $item_ids->quantity= 0;
        $item_ids->price= 0;
        $item_ids->newprice= 0;
        $item_ids->save();

        if($request->color_id){
            foreach ($request->color_id as $key=>$color){
                foreach ($request->size_id[$key] as $size_key=>$size){
                    $Specifications = new Specifications();
                    $Specifications->Seller_id = Auth::guard('admin')->user()->Seller_id;
                    $Specifications->item_id = $item_ids->id;
                    $Specifications->size = ($size) ? $size :27;
                    $Specifications->color_id = $color;
                    $Specifications->selling_price = $request->selling_price[$key];
                    $Specifications->save();
                }
                }
        }

//        $statement = DB::select("show table status like 'items'");
//        $item =  $statement[0]->Auto_increment;
//        $item_id = $item - 1 ;
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('items'));

    }





    public function edit($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $items = Items::with('Items')->find($id);
            $itemsizes = ItemsSize::get();
            $itemscolors = ItemsColors::get();
            $items_cates = Category::get();
            $specifications_get = Specifications::with('specificolor')->with('specificsize')->where('item_id',$id)->get();
            $specifications = $specifications_get->groupBy('color_id');



        }else {

            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('Items')->find($id);
            $itemsizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $items_cates = Category::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $specifications_get = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificolor')->with('specificsize')->where('item_id',$id)->get();
            $specifications = $specifications_get->groupBy('color_id');


        }



        $title = trans('items.edit');
        return view('admin.items.edit', compact('items', 'title','items_cates','specifications','itemsizes','itemscolors'));
    }


    public function update(Request $request, $id)
    {


        $data = request()->validate(
            [
//                unique:items
                'item_name' => 'required',
                'category_id' => 'required',
                'specifications' => 'required',
                'selling_price' => 'required',
                'color_id' => 'required',
                'image'=>v_image()


            ], [], [
            'item_name' => trans('items.name_ar'),
            'category_id' => trans('items.item_cates'),
            'specifications' => trans('items.specifications'),
            'color_id' => trans('specific.color'),
            'selling_price' => trans('specific.selling_price'),
            'size' => trans('specific.size'),
            'image'=>trans('items.image'),


        ]);
        $data = request()->except(['_token', '_method']);
        if(request()->hasFile('image')) {
            $file = request()->file('image');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/items/'), $name);
            $data['image'] =  $name;

        }
        if (Auth::guard('admin')->user()->Seller_id == 0 ){




            $idSpecific = Specifications::where('item_id', $id)->sum('quantity');
            $all = Items::find($id);
            $all->id = $id;
            $all->category_id = $request->category_id;
            $all->item_name= $request->item_name;
            $all->specifications= $request->specifications;
            if(request()->hasFile('image')){
                $all->image= $name;
            }
            //$all->city= $request->city;
            $all->quantity= $idSpecific;
            $all->price= 0;
            $all->newprice= 0;
            $all->save();
            $deletedRows = Specifications::where('item_id', $all->id)->delete();

        }else {

            $idSpecific = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id', $id)->sum('quantity');
            $all = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($id);
            $all->id = $id;
            $all->category_id = $request->category_id;
            $all->item_name= $request->item_name;
            $all->specifications= $request->specifications;
            if(request()->hasFile('image')){
                $all->image= $name;
            }
            //$all->city= $request->city;
            $all->quantity= $idSpecific;
            $all->price= 0;
            $all->newprice= 0;
            $all->save();
            $deletedRows = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id', $all->id)->delete();

        }

        if($request->color_id){
            foreach ($request->color_id as $key=>$color){
                foreach ($request->size_id[$key] as $size_key=>$size){
                    $Specifications = new Specifications();
                    $Specifications->item_id = $all->id;
                    $Specifications->size = ($size) ? $size :27;
                    $Specifications->color_id = $color;
                    $Specifications->selling_price = $request->selling_price[$key];
                    $Specifications->save();
                }
            }
        }
        
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('items'));
    }

    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            if (generalcontroller::alreadycheck($id)== '1') {
                session()->flash('error', trans('admin.deleted_record_cant'));
                return redirect(aurl('items'));

            } else {

                Items::find($id)->delete();
                session()->flash('success', trans('admin.deleted_record'));
                return redirect(aurl('items'));
            }




        }else {

            if (generalcontroller::alreadycheck($id)== '1') {
                session()->flash('error', trans('admin.deleted_record_cant'));
                return redirect(aurl('items'));

            } else {

                Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();
                session()->flash('success', trans('admin.deleted_record'));
                return redirect(aurl('items'));
            }


        }

    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Items::destroy(request('item'));
        } else {
            Items::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('items'));
    }

    public function search(Request $request){
        //$query = SELECT * FROM your_table ORDER BY your_field = 0, your_field;
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $items = Items::where('item_name', 'like', '%'.request()->search.'%')
                ->orwhere('specifications', 'like', '%'.request()->search.'%')


                //->orderBy("`quantity`= 0,`quantity`")
                ->orderBy('id','DESC')


                ->paginate(20);


        }else {

            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_name', 'like', '%'.request()->search.'%')
             
                //->orderBy("`quantity`= 0,`quantity`")
                ->orderBy('id','DESC')


                ->paginate(20);

        }

        $items->appends(['search' => $request]);

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

        return view('admin.items.index',compact('items','temp'));
    }


}

