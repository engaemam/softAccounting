<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Banktransfers;
use App\Model\Imports;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class BanktransfersController extends Controller
{

    public function index()
    {

        $banktransfers = Banktransfers::orderBy('id','desc')->paginate(15);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.banktransfers.index', compact('banktransfers','temp'));
    }

    public function create()
    {
        $imports = Imports::get();
        return view('admin.banktransfers.create',compact('imports'));
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'title' => 'required',



            ], [], [
            'title' => trans('عنوان'),



        ]);
        if(request()->hasFile('image')) {
            $file = request()->file('image');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/bank/'), $name);
            $data['image'] =  $name;

        }
        $data = request()->except(['_token', '_method']);

        $banktransfer = new Banktransfers();
        $banktransfer->title                = $request->title;
        $banktransfer->body                 = $request->body;
        $banktransfer->import_id            = $request->import_id;

        if($request->image == '') {
            $name = $banktransfer->image = null;
        }
        $banktransfer->image               = $name;
        $banktransfer->save();


        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('banktransfers'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $banktransfer = Banktransfers::find($id);
        $imports = Imports::get();
        return view('admin.banktransfers.edit', compact('banktransfer','imports'));
    }


    public function update(Request $request)
    {
        $inputs = $this->validate(request(),
            [
                'title' => 'required',



            ], [], [
                'title' => trans('عنوان'),



            ]);
        if(request()->hasFile('image')) {
            $file = request()->file('image');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/bank/'), $name);
            $data['image'] =  $name;

        }

        $inputs = $request->except(['_token']);

        $banktransfer = Banktransfers::findOrFail($inputs['id']);
        $banktransfer->title                = $request->title;
        $banktransfer->body                 = $request->body;
        $banktransfer->import_id            = $request->import_id;

        if($request->image == '') {
            $name = $banktransfer->image = null;
        }
        $banktransfer->image               = $name;
        $banktransfer->update();


        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('banktransfers'));
    }

    public function destroy($id)
    {

        Banktransfers::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('banktransfers'));
    }


    public function search(){
        $banktransfers = Banktransfers::where('title','LIKE','%'.request()->search.'%')
            ->orderBy('created_at','desc')
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
        return view('admin.banktransfers.index',compact('banktransfers','temp'));
    }
}