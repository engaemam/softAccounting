<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ItemsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Bills;
use App\Model\Category;
use App\Model\Devices;
use App\Model\Specifications;
use DB;
use App\Model\Items;
//use Maatwebsite\Excel\Excel;
use Excel;

use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class SpecificationsController extends Controller
{

    public function index(ItemsDatatable $admin,$id=null)
    {


        $items= Items::with('Items')->orderBy('created_at','desc')->paginate(15);
        $title=trans('items.items');
        $bills =      Bills::with('suppliers')->find($id);

        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }


        return $admin->render('admin.items.index',compact('items','title','bills','temp'));
    }



    public function create()
    {
        $items_cates = Category::get();
        //$bills = new Bills(\Request::old());
        //$suppliers = Suppliers::get();
        $items = Items::get();
        $devices = Devices::orderBy('created_at','desc')->get();
        //$currencies=Currencies::get();
        return view('admin.items.create', ['title' => trans('items.create')],compact('items_cates','items','devices'));
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'item_id' => 'required',
                'count' => '',
                'color' => '',
                'size' => '',
            ], [], [
            'item_name' => trans('items.name_ar'),
            'category_id' => trans('items.item_cates'),
            'specifications' => trans('items.specifications'),
        ]);
        $data = request()->except(['_token', '_method']);


        $data['count']   = 0;
        $data['color']      = 0;
        $data['size']   = 0;
        Specifications::create($data);
        $item_id=DB::getPdo()->lastInsertId();
        //dd($item_id);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('itemserials/create'))->with('item_id',$item_id);
    }





    public function edit($id)
    {
        $items = Items::with('Items')->find($id);
        $items_cates = Category::get();
        $title = trans('items.edit');
        return view('admin.items.edit', compact('items', 'title','items_cates'));
    }


    public function update(Request $request, $id)
    {
        $items = Items::find($id);
        if($items->item_name == $request->item_name){
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
        }else{
            $data = $this->validate(request(),
                [
                    'item_name' => 'required|unique:items',
                    'category_id' => 'required',
                    'specifications'=>'',
                    'image'=>'',
                    'quantity'=>'',

                ], [], [
                    'item_name' => trans('items.name'),
                    'category_id' => trans('items.item_cates'),
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

        Items::where('id', $id)->update($data);
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


            ->orderByRaw("`quantity`= 0,`quantity`")


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

        return view('admin.items.index',compact('items','temp'));
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