<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Http\Controllers\Controller;
use App\Model\Allowroles;
use App\Model\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

//use Illuminate\Http\Request;
class RolesController extends Controller
{

    public function index()
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $roles = Roles::orderBy('created_at','desc')->paginate(15);




        }else {

            $roles = Roles::orderBy('created_at','desc')->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->paginate(15);


        }


        return view('admin.roles.index',compact('roles'));
    }



    public function create()
    {
        return view('admin.roles.create');
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [

            ], [], [

        ]);
        $data = request()->except(['_token', '_method']);


                $roles = Roles::create([
                    'name'      => $request->name,
                    'Seller_id'      => Auth::guard('admin')->user()->Seller_id,
                ]);

        if (!empty($request->allow)) {
                foreach ($request->allow as $key => $allow) {
                    $Allowroles = Allowroles::insert([
                        'role_id'       => $roles->id,
                        'allow'         => $allow,
                    ]);
                }
        }


        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('roles'));
    }





    public function edit($id)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $roles = Roles::find($id);
            $allowRoles = Allowroles::where('role_id',$roles->id)->get();



        }else {


            $roles = Roles::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);
            $allowRoles = Allowroles::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('role_id',$roles->id)->get();

        }

        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        //dd($allowRoles->allow);





        return view('admin.roles.edit', compact('roles','allowRoles','temp'));
    }


    public function update(Request $request, $id)
    {
        $roles = Roles::find($id);
        $data = $this->validate(request(),
            [

            ], [], [

            ]);



        $data = request()->except(['_token', '_method']);
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $roles = Roles::find($id);




        }else {

            $roles = Roles::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);


        }
        $roles->name = $request->name;
        $roles->save();

            $deletedRows = Allowroles::where('role_id', $roles->id)->delete();
        if (!empty($request->allow)) {
            foreach ($request->allow as $key => $allow) {
                $Allowroles = Allowroles::insert([
                    'role_id'       => $roles->id,
                    'allow'         => $allow,
                ]);
            }
        }



        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('roles'));
    }

//    test function destroy($id) {
//        $Allowroles = Allowroles::where('role_id',$id)->get();
//        foreach ($Allowroles as $allowrole)
//        {
//            Allowroles::find($allowrole->id)->delete();
//        }
//        Roles::find($id)->delete();
//
//        session()->flash('success', trans('admin.deleted_record'));
//        return redirect(aurl('roles'));
//    }

    public function destroy($id)
    {
        if ($this->alreadycheck($id)== '1') {
            session()->flash('error', trans('admin.deleted_record_cant'));
            return redirect(aurl('roles'));

        } else {

            if (Auth::guard('admin')->user()->Seller_id == 0 ){



                $Allowroles = Allowroles::where('role_id',$id)->get();



            }else {

                $Allowroles = Allowroles::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('role_id',$id)->get();


            }


            foreach ($Allowroles as $allowrole)
            {
                Allowroles::find($allowrole->id)->delete();
            }
            Roles::find($id)->delete();

            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('roles'));
        }
    }
    public function alreadycheck($id){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $users       = Admin::where('role_id',$id)->value('role_id');




        }else {

            $users       = Admin::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('role_id',$id)->value('role_id');


        }
        if($users){
            return '1';

        }
    }



    public function search(Request $request){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){




            $roles = Roles::where('id', 'like', '%'.request()->search.'%')->orderBy("id","desc")->paginate(20);


        }else {


            $roles = Roles::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id', 'like', '%'.request()->search.'%')->orderBy("id","desc")->paginate(20);

        }
        return view('admin.roles.index',compact('roles'));
    }


}