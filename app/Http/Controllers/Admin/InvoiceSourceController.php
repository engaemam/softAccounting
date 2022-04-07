<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\BillpartsDatatable;
use App\Model\Billdevies;
use App\Model\Bills;
use App\Model\BillSource;
use App\Model\Category;
use App\Model\InvoiceSources;
use App\Model\sources;
use DB;
//use Maatwebsite\Excel\Excel;
use Excel;

use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class InvoiceSourceController extends Controller
{

    public function index(BillpartsDatatable $admin, $id=null)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $sources = InvoiceSources::with('invoiceSource')->where('status', 1)

                ->orderBy("id","desc")
                ->paginate(20);




        }else {

            $sources = InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('invoiceSource')->where('status', 1)

                ->orderBy("id","desc")
                ->paginate(20);

        }

        $title=trans('sources.sources');
        return $admin->render('admin.invoicesource.index',compact('sources','title'));
    }



    public function create()
    {
        return view('admin.invoicesource.create', ['title' => trans('sources.create')]);
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'name' => 'required|unique:invoice_sources',

            ], [], [
            'name' => trans('sources.name_ar'),

        ]);
        $data = request()->except(['_token', '_method']);

        $data['status'] = 1;
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;
        InvoiceSources::create($data);

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('sources'));
    }





    public function edit($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){




            $sources = InvoiceSources::findOrFail($id);


        }else {
            $sources = InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);



        }
        $title = trans('sources.edit');
        return view('admin.invoicesource.edit', compact('sources', 'title'));
    }


    public function update(Request $request, $id)
    {
        $invoicesource = InvoiceSources::find($id);
        if($invoicesource->item_name == $request->item_name){
            $data = $this->validate(request(),
                [
                    'name' => 'required',
                ], [], [
                    'name' => trans('sources.name'),
                ]);
        }else{
            $data = $this->validate(request(),
                [
                    'name' => 'required|unique:invoice_sources',

                ], [], [
                    'name' => trans('sources.name'),
                ]);
        }

        $data = $this->validate(request(),
            [
                'name' => 'required',
            ], [], [
                'name' => trans('sources.name'),
            ]);
        $data = request()->except(['_token', '_method']);


        InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id', $id) ->where('status', 1)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('sources'));
    }

    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            InvoiceSources::findOrFail($id)->where('status', 1)->delete();



        }else {

            InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->where('status', 1)->delete();


        }

        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('sources'));

    }


    public function multi_delete()
    {


        if (is_array(request('item'))) {
            InvoiceSources::where('status', 1)->destroy(request('item'));
        } else {
            InvoiceSources::find(request('item'))->where('status', 1)->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('sources'));
    }




}