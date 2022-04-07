<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ItemsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Billitems;
use App\Model\Bills;
use App\Model\Category;
use App\Model\Devices;
use App\Model\Colors;
use App\Model\Specifications;
use DB;
use App\Model\Items;
//use Maatwebsite\Excel\Excel;
use Excel;

use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ItemsColorsController2 extends Controller
{




    public function create($id,Request $request)
    {
        $items_cates = Category::get();
        dd($id);
        $items = Items::get($id);
        $devices = Devices::orderBy('created_at','desc')->get();
        $last = Suppliers::latest()->first();
        $modelid = $last->id + 1;
        return view('admin.itemscolors.create', ['title' => trans('items.create')],compact('items_cates','items','devices'));
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
       //dd($request->get());
        $data = request()->validate(
            [

                'color' => 'required',
                'size' => 'required',



            ], [], [

            //'color' => trans('specific.color'),
            'size' => trans('specific.size'),



        ]);
        $data = request()->except(['_token', '_method']);


        $item_ids = new Colors();
        $item_ids->save();
        foreach ($request->size as $k=>$item){

            $Specifications = new Colors();
            $Specifications->item_id= $item_ids->id;
            //$Specifications->count=$request->count[$k];
            //$Specifications->color	= $item;
            $Specifications->color=$request->size[$k];
            $Specifications->save();
        }
        $item_id=DB::getPdo()->lastInsertId();
        //dd($item_id);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('itemserials/create'))->with('item_id',$item_id);
        //return redirect(aurl('itemscolors/create'))->with('item_id',$item_id);
    }





    public function edit($id)
    {
        $items = Items::with('Items')->find($id);
        $items_cates = Category::get();
        $specifications = Specifications::where('item_id',$id)->get();
        $title = trans('items.edit');
        return view('admin.itemscolors.edit', compact('items', 'title','items_cates','specifications'));
    }


    public function update(Request $request, $id)
    {
        $items = Items::find($id);
        if($items->item_name == $request->item_name){
            $data = $this->validate(request(),
                [
                    'item_name' => 'required',
                    'category_id' => 'required',
                    //'color' => 'required',
                    'size' => 'required',
                    //'count' => 'required',
                    'specifications'=>'',
                    'image'=>'',
                    'quantity'=>'',

                ], [], [
                    'item_name' => trans('items.name'),
                    //'color' => trans('specific.color'),
                    'size' => trans('specific.size'),
                    //'count' => trans('specific.count'),
                    'category_id' => trans('items.item_cates'),
                ]);
        }else{
            $data = $this->validate(request(),
                [
                    'item_name' => 'required|unique:items',
                    'category_id' => 'required',
                    //'color' => 'required',
                    'size' => 'required',
                    //'count' => 'required',
                    'specifications'=>'',
                    'image'=>'',
                    'quantity'=>'',

                ], [], [
                    'item_name' => trans('items.name'),
                    'category_id' => trans('items.item_cates'),
                    //'color' => trans('specific.color'),
                    'size' => trans('specific.size'),
                    //'count' => trans('specific.count'),
                ]);
        }

            $data = $this->validate(request(),
            [
                'item_name' => 'required',
                'category_id' => 'required',
                'specifications'=>'',
                'image'=>'',
                'quantity'=>'',




            ], [], [
                'item_name' => trans('items.name'),
                'category_id' => trans('items.item_cates'),


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
       // Items::where('id', $id)->update($data);
        $all = Items::find($id);
        $all->id = $id;
        $all->category_id = $request->category_id;
        $all->item_name= $request->item_name;
        $all->specifications= $request->specifications;
        $all->city= $request->city;
        $all->quantity= 0;
        $all->price= 0;
        $all->newprice= 0;
        $all->save();
        $deletedRows = Specifications::where('item_id', $all->id)->delete();
        if(!empty($request->size)){

            foreach ($request->size as $key => $item){
                //dd($item);
                $specifications = Specifications::create([
                    'item_id'                => $all->id,
                    //'color'             => $item,
                    'size'                   => $item ,//$request->input('size')[$key],
                    //'count'                  => $request->input('count')[$key],
                ]);

            }
        }
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('items'));
    }

    public function destroy($id)
    {
        if (generalcontroller::alreadycheck($id)== '1') {
            session()->flash('error', trans('admin.deleted_record_cant'));
            return redirect(aurl('items'));

        } else {

            Items::find($id)->delete();
            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('items'));
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

        $items = Items::where('item_name', 'like', '%'.request()->search.'%')
            ->orwhere('specifications', 'like', '%'.request()->search.'%')


                        //->orderBy("`quantity`= 0,`quantity`")
                        ->orderBy('id','DESC')

          
                        ->paginate(20);
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

        return view('admin.itemscolors.index',compact('items','temp'));
    }

    public function export()
    {
        $items = Items::orderBy("id","DESC")->get();
        $itemsData = [];
        foreach($items as $item){
            $itemsData[] = [
                'ID' => $item->id,
                'اسم المادة	' => $item->item_name,
                'المواصفات' => $item->specifications,
                'بلد المنشأ	' => $item->city,
                'الكمية	' => $item->quantity,
                'اخر سعر شراء للمادة' => $item->price,
            ];
        }

        if(count($itemsData) > 0){
            Excel::create("تصديرالمواد(".date("d-M-Y").")", function($excel) use($itemsData) {
                $excel->sheet('sheet1', function($sheet) use($itemsData) {
                    $sheet->fromArray($itemsData);

                    $sheet->cell('A1:F1',function($cell){
                        $cell->setBackground('#e8e8e8');
                        $cell->setFontWeight('bold');
                    });
                });

            })->export('xls');
        }
    }
}