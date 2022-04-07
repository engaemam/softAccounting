<?php

namespace App\Http\Controllers\Admin;

use App\Admin;
use App\DataTables\ClientsDatatable;
use App\Http\Controllers\Controller;

use App\Model\City;
use App\Model\req;
use App\Model\Clients;
use App\Model\Invoices;
use App\Model\Moneyorders;
use App\Model\Projects;
use Illuminate\Support\Facades\Auth;
use SebastianBergmann\CodeCoverage\Report\Xml\Project;
use Storage;
use DB;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ClientsController extends Controller
{
    public $client = 3;

    public function search(Request $request){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $clients = Clients::where('name_company', 'like', '%'.request()->search.'%')
                ->orwhere('name_client', 'like', '%'.request()->search.'%')
                ->orwhere('city', 'like', '%'.request()->search.'%')
                ->orwhere('phone', 'like', '%'.request()->search.'%')
                ->orwhere('mobile', 'like', '%'.request()->search.'%')
                ->orwhere('client_position', 'like', '%'.request()->search.'%')
                ->orwhere('notes', 'like', '%'.request()->search.'%')
                ->orwhere('id', 'like', '%'.request()->search.'%')
                ->orderBy("id","desc")
                ->paginate(20);


            $data = DB::select('select clients_id,COUNT(*) as count from requests where status = 0 GROUP BY clients_id');


        }else {

            $clients = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('name_client', 'like', '%'.request()->search.'%')
             
                ->orderBy("id","desc")
                ->paginate(20);
            $seller_id = Auth::guard('admin')->user()->Seller_id;
  

        }


            
            // dd($clientsid);
      //  $data = DB::table('requests')->select('clients_id')->count('clients_id')->where('status',0)->groupBy('clients_id')->get();
    //  dd($data);
        $user_role_id = auth()->guard('admin')->User()->roles;
    
       // dd($countrefuse);
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view('admin.clients.index',compact('clients','temp'));
    }

    public function create()
    {

        return view('admin.clients.create', ['title' => trans('clients.create')],compact('cities'));
    }
    public function createbills()
    {

        return view('admin.clients.createinvoices', ['title' => trans('clients.create')]);
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'name_client' => 'required',

            ], [], [
            'name_company' => trans('clients.name_company'),
            'name_client' => trans('clients.name_client'),



        ]);
        $id= $request->get('id');
        $data = request()->except(['_token', '_method']);
        $data['usertype_id'] = $this->client;
         $data['provider_id'] = 11;
         $data['provider_type'] = 12;
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;

        Clients::create($data);
        session()->flash('success', trans('admin.record_added'));
        $terms = Clients::where('id','=',$id)->get();
        if($terms->isEmpty()) {
            return redirect()->to(aurl('clients'));
        }
        return redirect(aurl('invoices/createtwo/'.$id));
    }
    public function storeBills()
    {
        $data = request()->validate(
            [
                'name_company' => 'required',
            ], [], [
            'name_company' => trans('clients.name_company'),
            'name_client' => trans('clients.name_client'),



        ]);
        $data = request()->except(['_token', '_method']);
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;

        Clients::create($data);
        session()->flash('success', trans('admin.record_added'));

        return view('admin.clients.createinvoices', ['title' => trans('clients.create')]);
    }



    public function show($id)
    {
        //
    }


    public function edit($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $clients = Clients::findOrFail($id);



        }else {

            $clients = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);


        }
        $title = trans('clients.edit');

        return view('admin.clients.edit', compact('clients', 'title','cities'));
    }


    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'name_company' => '',
                'name_client' => 'required',
                'phone' => '',
                'mobile' => '',
                'client_position' => '',
                'notes' => '',





            ], [], [

                'name_company' => trans('clients.name_company'),
                'name_client' => trans('clients.name_client'),


            ]);
        $data = request()->except(['_token', '_method']);


        Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('clients'));
    }

    public function destroy($id)
    {
            if (Auth::guard('admin')->user()->Seller_id == 0 ){




                if ($this->alreadycheck($id)== '1') {
                    session()->flash('error', trans('admin.deleted_record_cant'));
                    return redirect(aurl('clients'));

                } else {

                    Clients::find($id)->delete();
                    session()->flash('success', trans('admin.deleted_record'));
                    return redirect(aurl('clients'));
                }


        }else {


                if ($this->alreadycheck($id)== '1') {
                    session()->flash('error', trans('admin.deleted_record_cant'));
                    return redirect(aurl('clients'));

                } else {

                    Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();
                    session()->flash('success', trans('admin.deleted_record'));
                    return redirect(aurl('clients'));
                }

}


    }
    public function alreadycheck($id){
        $Invoices  = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('client_id',$id)->value('client_id');
        $Project   = Projects::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id_client',$id)->value('id_client');
        $Money     = Moneyorders::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('client_id',$id)->value('client_id');


        if($Invoices || $Project ||$Money){
            return '1';

        }
    }


    public function multi_delete()
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            if (is_array(request('clients'))) {
                Clients::destroy(request('clients'));
            } else {
                Clients::find(request('clients'))->delete();
            }


        }else {

            if (is_array(request('clients'))) {
                Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->destroy(request('clients'));
            } else {
                Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail(request('clients'))->delete();
            }

        }




        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('clients'));
    }


}