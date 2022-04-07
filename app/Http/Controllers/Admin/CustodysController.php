<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\DeviceitemsDatatable;
use App\Model\Custodys;

use App\Model\Projects;
use Storage;
use Excel;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class CustodysController extends Controller
{

    public function index()
    {
        $custodys = Custodys::orderBy("id","DESC")->paginate(15);

        return view('admin.custodys.index',compact('custodys'));
    }
    public function search(Request $request){
        $custodys = Custodys::where('number', 'like', '%'.request()->search.'%')
            ->paginate(15);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view('admin.custodys.index',compact('custodys','temp'));
    }

    public function create()
    {

        $custodys    = new Custodys(\Request::old());
        $projects    = Projects::get();

        return view('admin.custodys.create',compact('custodys','projects'));
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'number'    => 'required',
                'title'     => 'required',
                'value'     => 'required',
                'dates'     => '',
                'notes'     => '',
                'project_id' => '',


            ], [], [
            'number'        => trans('custodys.number'),
            'title'         => trans('custodys.title'),
            'value'         =>trans('custodys.value'),

        ]);
        $data = request()->except(['_token', '_method']);

        $custodys = Custodys::create([
            'number'           => $request->number,
            'title'            => $request->title,
            'project_id'       => $request->project_id,
            'value'            => $request->value,
            'dates'            => $request->dates,
            'notes'            => $request->notes,


        ]);

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('custodys'));
    }





    public function edit($id)
    {
        $custodys = Custodys::find($id);
        $projects    = Projects::get();
        $title = trans('custodys.edit');
        return view('admin.custodys.edit', compact('custodys', 'title','projects'));
    }


    public function update(Request $request, $id)
    {
        $data = request()->validate(
            [
                'number'    => 'required',
                'title'     => 'required',
                'value'     => 'required',
                'dates'     => '',
                'notes'     => '',
                'project_id' => '',


            ], [], [
            'number'        => trans('custodys.number'),
            'title'         => trans('custodys.title'),
            'value'         =>trans('custodys.value'),

        ]);

        $data = request()->except(['_token', '_method']);
        $custodys = Custodys::find($id);
        $custodys->number       = $request->number;
        $custodys->title        = $request->title;
        $custodys->project_id   = $request->project_id;
        $custodys->value        = $request->value;
        $custodys->dates        = $request->dates;
        $custodys->notes        = $request->notes;
        $custodys->save();
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('custodys'));
    }

    public function destroy($id)
    {
        Custodys::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('custodys'));
    }

    public function delivery($id){
        //dd($id);
        $custodys = Custodys::find($id);
        $custodys->delivery        = 1;
        $custodys->dates_delivery  = date("Y/m/d");
        $custodys->save();
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('custodys'));

    }





}