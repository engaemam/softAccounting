<?php
namespace App\Http\Controllers\Admin;
use App\Admin;
use App\DataTables\AdminDatatable;
use App\Http\Controllers\Controller;
use App\Model\Roles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller {
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(AdminDatatable $admin) {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $admins = Admin::with('roles')->orderBy('created_at','desc')->paginate(15);
        }else{
            $admins = Admin::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->with('roles')->orderBy('created_at','desc')->paginate(15);

        }

//dd($admins);
        return $admin->render('admin.admins.index',compact('admins'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create() {
        
           if (Auth::guard('admin')->user()->Seller_id == 0 ){

              $roles = Roles::get();
        }else{
         
   $roles = Roles::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->get();
        }
     
        //dd($roles);
        return view('admin.admins.create', compact('roles'));
    }
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store() {
        $data = $this->validate(request(),
            [
                'name'                  => 'required',
                'email'                 => 'required|email|unique:admins',
                'password'              => 'required|min:6',
                'password_confirmation' => 'required|same:password',
                'role_id'=>''
            ], [], [
                'name'                  => trans('admin.name'),
                'email'                 => trans('admin.email'),
                'password'              => trans('admin.password'),
                'password_confirmation' => trans('admin.password_confirmation'),
            ]);
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;
        $data['password'] = bcrypt(request('password'));

        Admin::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('admin'));
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id) {
        $admin = Admin::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->where('id',$id)->first();
        $roles = Roles::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->get();
        $title = trans('admin.edit');
        return view('admin.admins.edit', compact('admin', 'title','roles'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id) {

        $data = $this->validate(request(),
            [
                'name'     => 'required',
                'email'    => 'required|email|unique:admins,email,'.$id,
                'password' => 'sometimes|nullable|min:6',
                'role_id'=>''
            ], [], [
                'name'     => trans('admin.name'),
                'email'    => trans('admin.email'),
                'password' => trans('admin.password'),
            ]);



        if (request('password') != '') {
            $data['password'] = bcrypt(request('password'));
        }else{
            unset($data['password']);//Delete Of Array.
        }




        Admin::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('admin'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id) {
        Admin::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->where('id',$id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('admin'));
    }
    public function multi_delete() {
        if (is_array(request('item'))) {
            Admin::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->where('id',request('item'))->destroy(request('item'));
        } else {
            Admin::where('Seller_id',Auth::guard('admin')->user()->Seller_id)->where('id',request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('admin'));
    }



}