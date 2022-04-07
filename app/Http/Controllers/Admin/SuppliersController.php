<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\DataTables\SuppliersDatatable;
use App\Http\Controllers\Controller;

use App\Model\Bills;
use App\Model\Imports;
use App\Model\Supplierproducts;
use App\Model\Suppliers;
use Illuminate\Support\Facades\Auth;
use Storage;
use Excel;

use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class SuppliersController extends Controller
{
    public function search(Request $request){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $suppliers = Suppliers::
            orderBy("id","desc")
                ->paginate(20);


        }else {
            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->
            orderBy("id","desc")
                ->paginate(20);


        }


        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view('admin.suppliers.index',compact('suppliers','temp'));
    }

    public function create()
    {
        return view('admin.suppliers.create', ['title' => trans('suppliers.create')]);
    }
    public function createbills()
    {

        return view('admin.suppliers.createBills', ['title' => trans('suppliers.create')]);
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'suppliers_name' => '',

            ], [], [
            'suppliers_name' => trans('suppliers.suppliers_name'),

        ]);
        $data = request()->except(['_token', '_method']);

        $id= $request->get('id');
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;
        Suppliers::create($data);
        session()->flash('success', trans('admin.record_added'));
        $terms = Suppliers::where('id','=',$id)->get();
        if($terms->isEmpty()) {
            return redirect()->to(aurl('suppliers'));
        }
        return redirect(aurl('bills/createtwo/'.$id));
    }
    public function storeBills()
    {
        $data = request()->validate(
            [
                'suppliers_name' => '',

            ], [], [
            'suppliers_name' => trans('suppliers.suppliers_name'),

        ]);
        $data = request()->except(['_token', '_method']);

        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;
        Suppliers::create($data);
        session()->flash('success', trans('admin.record_added'));
        return view('admin.suppliers.createBills', ['title' => trans('suppliers.create')]);
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $suppliers = Suppliers::findOrFail($id);




        }else {


            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);

        }
        $title = trans('suppliers.edit');
        return view('admin.suppliers.edit', compact('suppliers', 'title'));
    }


    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'suppliers_name' => 'required',
                'manager_name'=>'',
                'position_manger'=>'',
                'suppliers_number'=>'',
                'mobile'=>'',
                'country'=>'',

            ], [], [
                'suppliers_name' => trans('suppliers.suppliers_name'),


            ]);
        $data = request()->except(['_token', '_method']);


        Suppliers::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('suppliers'));
    }

    public function destroy($id)
    {
        if ($this->alreadycheck($id)== '1') {
            session()->flash('error', trans('admin.deleted_record_cant'));
            return redirect(aurl('suppliers'));

        } else {
            if (Auth::guard('admin')->user()->Seller_id == 0 ){


                Suppliers::find($id)->delete();




            }else {
                Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($id)->delete();



            }
            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('suppliers'));
        }

    }
    public function alreadycheck($id){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $Supplierproducts   = Supplierproducts::where('supplier_id',$id)->value('supplier_id');
            $Bills              = Bills::where('supplier_id',$id)->value('supplier_id');
            $Imports            = Imports::where('supplier_id',$id)->value('supplier_id');



        }else {

            $Supplierproducts   = Supplierproducts::where('supplier_id',$id)->value('supplier_id');
            $Bills              = Bills::where('supplier_id',$id)->value('supplier_id');
            $Imports            = Imports::where('supplier_id',$id)->value('supplier_id');


        }
        if($Supplierproducts  || $Bills ||$Imports ){
            return '1';

        }
    }




    public function export()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $suppliers = Suppliers::orderBy("id","DESC")->get();



        }else {


            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy("id","DESC")->get();

        }
        $suppliersData = [];
        foreach($suppliers as $supplier){
            $suppliersData[] = [
                'ID' => $supplier->id,
                'اسم الشركة	'   => $supplier->suppliers_name,
                'اسم المسؤول'   => $supplier->manager_name,
                'منصب المسؤول'  => $supplier->position_manger,
                'رقم المورد	'   => $supplier->suppliers_number,
                'الموبايل'      => $supplier->mobile,
                'بلد المورد'    => $supplier->country,
            ];
        }

        if(count($suppliersData) > 0){
            Excel::create("تصديرالموردين(".date("d-M-Y").")", function($excel) use($suppliersData) {
                $excel->sheet('sheet1', function($sheet) use($suppliersData) {
                    $sheet->fromArray($suppliersData);

                    $sheet->cell('A1:F1',function($cell){
                        $cell->setBackground('#e8e8e8');
                        $cell->setFontWeight('bold');
                    });
                });

            })->export('xls');
        }
    }
}