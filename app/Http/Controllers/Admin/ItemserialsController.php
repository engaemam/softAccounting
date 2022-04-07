<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\DataTables\itemserialsDatatable;
use App\Model\Itemserials;
use App\Model\Items;
use App\Model\Suppliers;
use Illuminate\Support\Facades\Auth;
use Storage;
use DB;
use Excel;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ItemserialsController extends Controller
{

    public function index( )
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $itemserials = Itemserials::with('items','suppliers')->orderBy('created_at','desc')->paginate(15);




        }else {

            $itemserials = Itemserials::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('items','suppliers')->orderBy('created_at','desc')->paginate(15);


        }
        return view('admin.itemserials.index', ['title' => trans('itemserials.itemserials')],compact('itemserials','items','suppliers'));
    }
    public function show( $items_id=null)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $itemserialsQuery = Itemserials::with('items','suppliers');




        }else {

            $itemserialsQuery = Itemserials::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('items','suppliers');


        }
        if(!empty($items_id)){
            $itemserialsQuery->whereItemId($items_id);
        }


        $itemserials = $itemserialsQuery->orderBy("id","DESC")->first();


        // Start Role Show And Hidden



        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view("admin.itemserials.show", compact('itemserials','temp'));
    }
    public function addnew($item_id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $items = Items::get();
            $suppliers = Suppliers::get();



        }else {

            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }

        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden


        return view('admin.itemserials.create',compact('item_id','items','suppliers','temp'));
    }
    public function create()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $items = Items::get();
            $suppliers = Suppliers::get();
            //$items = DB::table('items')->get();
            $item_id = session()->get('item_id');


        }else {

            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $item_id = session()->get('item_id');

        }

       // dd($item_id);
        return view('admin.itemserials.create',compact('item_id','items','suppliers'));
    }


    public function store()
    {
        $data = request()->validate(
            [
                'item_id' => 'required',
                'serial_number' => 'required',
                'supplier_id' => '',

            ], [], [
            'item_id' => trans('itemserials.item_id'),
            'serial_number' => trans('itemserials.serial_number'),
            'supplier_id' =>trans('itemserials.supplier_id'),

        ]);
        $data = request()->except(['_token', '_method']);

        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;

        Itemserials::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('items'));
    }





    public function edit($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $itemserials = Itemserials::find($id);
            $items = Items::get();
            $suppliers = Suppliers::get();



        }else {

            $itemserials = Itemserials::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);
            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }



        $title = trans('itemserials.edit');
        return view('admin.itemserials.edit', compact('itemserials', 'title','items','suppliers'));
    }


    public function update(Request $r, $id,$item_id=null)
    {
        $data = $this->validate(request(),
            [
                'item_id' => 'required',
                'serial_number'=>'required',
                'supplier_id'=>'required',


            ], [], [
                'item_id' => trans('itemserials.item_id'),
                'serial_number' => trans('itemserials.serial_number'),
                'supplier_id' =>trans('itemserials.supplier_id'),


            ]);
        $data = request()->except(['_token', '_method']);

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            Itemserials::where('id', $id)->update($data);





        }else {

            Itemserials::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id', $id)->update($data);


        }

        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('items'));
    }

    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            Itemserials::find($id)->delete();



        }else {

            Itemserials::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->
            findOrFail($id)->delete();


        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('items'));
    }



    public function search(Request $request){

        $search      = $request['search'];

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $itemserials = Itemserials::with('suppliers','items')
                ->whereHas('items', function ($query) use ($search){$query->where('item_name', 'like', '%'.$search.'%');})
                ->orwhereHas('suppliers', function ($query) use ($search){$query->where('suppliers_name', 'like', '%'.$search.'%');})
                ->orderBy("id","desc")
                ->paginate(20);


        }else {

            $itemserials = Itemserials::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers','items')
                ->whereHas('items', function ($query) use ($search){$query->where('item_name', 'like', '%'.$search.'%');})
                ->orwhereHas('suppliers', function ($query) use ($search){$query->where('suppliers_name', 'like', '%'.$search.'%');})
                ->orderBy("id","desc")
                ->paginate(20);

        }

        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view('admin.itemserials.index',compact('itemserials','temp'));
    }

    public function export()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $items = Itemserials::with('suppliers','items')->orderBy("id","DESC")->get();



        }else {

            $items = Itemserials::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers','items')->orderBy("id","DESC")->get();


        }
        $itemsData = [];
        foreach($items as $item){
            $devicesData[] = [
                'ID' => $item->id,
                'اسم المادة	' => $item->items->item_name,
                'اسم المورد' => $item->suppliers->suppliers_name,
                'رقم التسلسل' => $item->serial_number,
            ];
        }

        if(count($devicesData) > 0){
            Excel::create("تصدير رقم تسلسل المادة(".date("d-M-Y").")", function($excel) use($devicesData) {
                $excel->sheet('sheet1', function($sheet) use($devicesData) {
                    $sheet->fromArray($devicesData);

                    $sheet->cell('A1:D1',function($cell){
                        $cell->setBackground('#e8e8e8');
                        $cell->setFontWeight('bold');
                    });
                });

            })->export('xls');
        }
    }

}