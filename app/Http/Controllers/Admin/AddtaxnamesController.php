<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Addtaxnames;
use App\Model\Addtaxs;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class AddtaxnamesController extends Controller
{

    public function index()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){
        $addtaxnames = Addtaxnames::where('name','LIKE','%'.request()->search.'%')->orderBy('created_at','desc')->paginate(15);
        }else{
            $addtaxnames = Addtaxnames::where('Seller_id',Auth::user()->Seller_id)->where('name','LIKE','%'.request()->search.'%')->orderBy('created_at','desc')->paginate(15);

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
        return view('admin.addtaxnames.index',compact('addtaxnames','temp'));
    }

    public function create()
    {
        return view('admin.addtaxnames.create', ['title' => trans('addtaxnames.create')]);
    }


    public function store()
    {
        $data = request()->validate(
            [
                'name' => 'required',



            ], [], [
            'name' => trans('addtaxnames.name'),



        ]);
        $data = request()->except(['_token', '_method']);


        Addtaxnames::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('addtaxnames'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $addtaxnames = Addtaxnames::find($id);
        $title = trans('addtaxnames.edit');
        return view('admin.addtaxnames.edit', compact('addtaxnames', 'title'));
    }


    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'name' => 'required',

            ], [], [
                'name' => trans('addtaxnames.name'),


            ]);
        $data = request()->except(['_token', '_method']);


        Addtaxnames::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('addtaxnames'));
    }

    public function destroy($id)
    {
        if (self::alreadycheck($id)== '1') {
            session()->flash('error', trans('admin.deleted_record_cant'));
            return redirect(aurl('addtaxnames'));

        } else {
            Addtaxnames::find($id)->delete();
            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('addtaxnames'));
        }

    }
    public function alreadycheck($id){
        $Addtaxs       = Addtaxs::where('addtaxnames_id',$id)->value('addtaxnames_id');
        if($Addtaxs){
            return '1';

        }
    }




    public function search(){

        $addtaxnames = Addtaxnames::where('name','LIKE','%'.request()->search.'%')->orderBy('created_at','desc')->paginate(15);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.addtaxnames.index',compact('addtaxnames','temp'));
    }
}