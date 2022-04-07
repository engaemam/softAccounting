<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\DeviceitemsDatatable;
use App\Model\Bills;
use App\Model\Clients;
use App\Model\Suppliers;
use App\Model\Currencies;
use App\Model\Moneyorders;
use App\Model\Invoices;
use Illuminate\Support\Facades\Auth;
use Storage;
use Excel;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class MoneyordersController extends Controller
{

        public function index()
        {
            if (Auth::guard('admin')->user()->Seller_id == 0 ){

                $moneyorders = Moneyorders::orderBy("id","DESC")->paginate(15);

            }else {

                $moneyorders = Moneyorders::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy("id","DESC")->paginate(15);


            }

            return view('admin.moneyorders.index',compact('moneyorders'));
        }
    public function search(Request $request){


        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $moneyorders = Moneyorders::where('number', 'like', '%'.request()->search.'%')
                ->paginate(15);



        }else {

            $moneyorders = Moneyorders::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('number', 'like', '%'.request()->search.'%')
                ->paginate(15);
        }


          //  dd($moneyorders);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view('admin.moneyorders.index',compact('moneyorders','temp'));
    }

    public function create()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $clients     = Clients::get();
            $bills       = Bills::get();
            $suppliers   = Suppliers::get();
            $invoices    = Invoices::get();
            $currencies  = Currencies::get();



        }else {


            $clients     = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $bills       = Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $suppliers   = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $invoices    = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $currencies  = Currencies::get();
        }

        return view('admin.moneyorders.create',compact('invoices','suppliers','clients','bills','currencies'));
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'number'    => 'required',
                // 'client_id' => 'required',
                // 'supplier_id' =>  'required',
                'value'     => 'required',
                'dates'     => '',
                'notes'     => '',
                'bill_id'   => '',
                'type'      => '',
                'currency_id'      => '',
                'currency'      => '',

            ], [], [
            'number'        => trans('moneyorders.number'),
            'client_id'     => trans('moneyorders.client_id'),
            'value'         =>trans('moneyorders.value'),

        ]);
     //   dd($request->get());
        $data = request()->except(['_token', '_method']);
                $billno ='';
            if(!empty($request->invoice_id)){
            $billno =$request->invoice_id;
            }else{
                $billno =$request->bill_id;
            }
                if(!empty($request->client_id)){
                $client_id =$request->client_id;
                }else{
                $client_id =NULL;
                }
                if(!empty($request->supplier_id)){
                $supplier_id =$request->supplier_id;
               // 
                }else{
                $supplier_id =NULL;
                }    
               // dd( $supplier_id);
                $moneyorders = Moneyorders::create([
                'number'           => $request->number,
                'client_id'        => $client_id,
                'supplier_id'      => $supplier_id,
                'Seller_id'      => Auth::guard('admin')->user()->Seller_id,
                'bill_id'          => $billno,
                'value'            => $request->value,
                'dates'            => $request->dates,
                'notes'            => $request->notes,
                'type'             => $request->type,
                'currency_id'      => $request->currency_id,

            ]);

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('moneyorders'));
    }





    public function edit($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $moneyorders = Moneyorders::find($id);
            $clients     = Clients::get();
            $bills       = Bills::get();


        }else {

            $moneyorders = Moneyorders::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->
            findOrFail($id);
            $clients     = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $bills       = Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }

        $currencies  = Currencies::get();
        $title = trans('moneyorders.edit');
        return view('admin.moneyorders.edit', compact('moneyorders', 'title','clients','bills','currencies'));
    }


    public function update(Request $request, $id)
    {
        $data = request()->validate(
            [
                'number'    => 'required',
                'client_id' => 'required',
                'value'     => 'required',
                'dates'     => '',
                'notes'     => '',
                'bill_id'   => '',
                'type'      => '',
                'currency_id'      => '',

            ], [], [
            'number'        => trans('moneyorders.number'),
            'client_id'     => trans('moneyorders.client_id'),
            'value'         =>trans('moneyorders.value'),

        ]);

        $data = request()->except(['_token', '_method']);

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $moneyorders = Moneyorders::find($id);
            $moneyorders->number    = $request->number;
            $moneyorders->client_id = $request->client_id;
            $moneyorders->bill_id   = $request->bill_id;
            $moneyorders->value     = $request->value;
            $moneyorders->dates     = $request->dates;
            $moneyorders->notes     = $request->notes;
            $moneyorders->type      = $request->type;
            $moneyorders->currency_id      = $request->currency_id;
            $moneyorders->save();


        }else {

            $moneyorders = Moneyorders::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);
            $moneyorders->number    = $request->number;
            $moneyorders->client_id = $request->client_id;
            $moneyorders->bill_id   = $request->bill_id;
            $moneyorders->value     = $request->value;
            $moneyorders->dates     = $request->dates;
            $moneyorders->notes     = $request->notes;
            $moneyorders->type      = $request->type;
            $moneyorders->currency_id      = $request->currency_id;
            $moneyorders->save();

        }

        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('moneyorders'));
    }

    public function destroy($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            Moneyorders::find($id)->delete();




        }else {

            Moneyorders::find($id)->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->delete();

        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('moneyorders'));
    }





}