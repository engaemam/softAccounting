<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\SupplierproductsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Items;
use App\Model\Supplierproducts;
use App\Model\Suppliers;
use Illuminate\Support\Facades\Auth;
use Storage;
use Excel;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class SupplierproductsController extends Controller
{

    public function index(SupplierproductsDatatable $admin)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $supplierproducts = Supplierproducts::orderBy('created_at','desc')->paginate(15);




        }else {

            $supplierproducts = Supplierproducts::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy('created_at','desc')->paginate(15);


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
        return $admin->render('admin.supplierproducts.index',compact('supplierproducts','items','suppliers','temp'));
    }
    public function show($supplier_id=null)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $supplierproductsQuery = Supplierproducts::with('suppliers','items');





        }else {

            $supplierproductsQuery = Supplierproducts::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers','items');


        }
        
        

        if(!empty($supplier_id)){
            $supplierproductsQuery->whereSupplierId($supplier_id);
        }

        $supplierproducts = $supplierproductsQuery->orderBy("id","DESC")->paginate(20);


        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view("admin.supplierproducts.show", compact('supplierproducts','supplier_id','temp'));
    }
    public function addnew($supplier_id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $items = Items::get();
            $suppliers = Suppliers::get();


        }else {
            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();


        }

        return view('admin.supplierproducts.create',compact('supplier_id','items','suppliers'));
    }

    public function create()
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $items = Items::get();
            $suppliers = Suppliers::get();


        }else {

            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }


        return view('admin.supplierproducts.create', ['title' => trans('supplierproducts.create')],compact('items','suppliers'));
    }


    public function store(Request $request,$supplier_id=null)
    {
        $data = request()->validate(
            [
                'item_id' => 'required',

                'supplier_id' => 'required',


            ], [], [
            'item_id' => trans('supplierproducts.item_id'),
            'last_price' => trans('supplierproducts.last_price'),
            'supplier_id' =>trans('supplierproducts.supplier_id'),

        ]);
        $data = request()->except(['_token', '_method']);

        foreach ($request->item_id as $key => $item){
            $supplierproducts = Supplierproducts::create([
                'supplier_id'   => $request->supplier_id,
                'item_id'       => $item,
                'Seller_id'       => Auth::guard('admin')->user()->Seller_id,
                'last_price'    => $request->last_price[$key],
            ]);
        }



        //Supplierproducts::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('supplierproducts/'.$request->supplier_id));
    }





    public function edit($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $supplierproducts = Supplierproducts::find($id);
            $items = Items::get();
            $suppliers = Suppliers::get();




        }else {

            $supplierproducts = Supplierproducts::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($id);
            $items = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();


        }

        $title = trans('supplierproducts.edit');
        return view('admin.supplierproducts.edit', compact('supplierproducts', 'title','items','suppliers'));
    }


    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'item_id' => 'required',
                'last_price'=>'',
                'supplier_id'=>'required',


            ], [], [
                'item_id' => trans('supplierproducts.item_id'),
                'last_price' => trans('supplierproducts.last_price'),
                'supplier_id' =>trans('supplierproducts.supplier_id'),


            ]);
        $data = request()->except(['_token', '_method']);


        foreach ($request->item_id as $key => $item) {
            $supplierproducts = Supplierproducts::find($id);
            $supplierproducts->supplier_id = $request->supplier_id;
            $supplierproducts->item_id = $item;
            $supplierproducts->last_price =  $request->last_price[$key];
            $supplierproducts->save();
        }
        //Supplierproducts::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('supplierproducts/'.$request->supplier_id));
    }

    public function destroy(Request $request,$id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            Supplierproducts::find($id)->delete();




        }else {
            Supplierproducts::   where('Seller_id', Auth::guard('admin')->user()->Seller_id)->
            find($id)->delete();


        }

        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('suppliers/'));
    }


    public function multi_delete()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            if (is_array(request('item'))) {
                Supplierproducts::destroy(request('item'));
            } else {
                Supplierproducts::find(request('item'))->delete();
            }


        }else {
            if (is_array(request('item'))) {
                Supplierproducts::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->destroy(request('item'));
            } else {
                Supplierproducts::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find(request('item'))->delete();
            }


        }


        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('supplierproducts'));
    }
    public function search(Request $request){

        $search      = $request['search'];

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $supplierproducts = Supplierproducts::with('suppliers','items')->whereHas('suppliers', function ($query) use ($search){
                $query->where('suppliers_name', 'like', '%'.$search.'%');
            })->orderBy("id","desc")
                ->paginate(20);



        }else {

            $supplierproducts = Supplierproducts::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('suppliers','items')->whereHas('suppliers', function ($query) use ($search){
                $query->where('suppliers_name', 'like', '%'.$search.'%');
            })->orderBy("id","desc")
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

        return view('admin.supplierproducts.index',compact('supplierproducts','temp'));
    }
    public function export()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $suppliers = Supplierproducts::orderBy("id","DESC")->get();




        }else {

            $suppliers = Supplierproducts::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy("id","DESC")->get();


        }
        $suppliersData = [];
        foreach($suppliers as $supplier){
            $suppliersData[] = [
                'ID' => $supplier->id,
                'اسم المورد	'   => $supplier->suppliers->suppliers_name,
                'اسم المادة	'   => $supplier->items->item_name,
                'آخر سعر شراء	'  => $supplier->last_price,
            ];
        }

        if(count($suppliersData) > 0){
            Excel::create("تصدير منتجات موردين(".date("d-M-Y").")", function($excel) use($suppliersData) {
                $excel->sheet('sheet1', function($sheet) use($suppliersData) {
                    $sheet->fromArray($suppliersData);

                    $sheet->cell('A1:D1',function($cell){
                        $cell->setBackground('#e8e8e8');
                        $cell->setFontWeight('bold');
                    });
                });

            })->export('xls');
        }
    }


}