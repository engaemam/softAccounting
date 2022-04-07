<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Importexpenses;
use App\Model\Importnames;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ImportnamesController extends Controller
{

    public function index()
    {
        $importnames = Importnames::orderBy('created_at','desc')->paginate(15);
        return view('admin.importnames.index', compact('importnames'));
    }

    public function create()
    {
        return view('admin.importnames.create');
    }


    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required',



            ], [], [
            'name' => trans('عنوان'),



        ]);
        $data = request()->except(['_token', '_method']);


        Importnames::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('importnames'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $importname = Importnames::find($id);
        return view('admin.importnames.edit', compact('importname', 'title'));
    }


    public function update(Request $request)
    {
        $inputs = $this->validate(request(),
            [
                'name' => 'required',

            ], [], [
                'name' => trans('Name'),


            ]);


        $inputs = $request->except(['_token']);

        $importnames = Importnames::findOrFail($inputs['id']);
        $importnames->update($inputs);

        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('importnames'));
    }

    public function destroy($id)
    {
        if (self::alreadycheck($id)== '1') {
            session()->flash('error', trans('admin.deleted_record_cant'));
            return redirect(aurl('importnames'));

        } else {
            Importnames::find($id)->delete();
            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('importnames'));
        }



    }
    public function alreadycheck($id){
        $Shipments       = Importexpenses::where('importname_id',$id)->value('importname_id');

        if($Shipments){
            return '1';

        }
    }


    public function search(){
        $importnames = Importnames::where('name','LIKE','%'.request()->search.'%')->orderBy('created_at','desc')->paginate(15);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.importnames.index',compact('importnames','temp'));
    }
}