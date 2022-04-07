<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ExpensesitemsDatatable;
use App\Http\Controllers\Controller;

use App\Model\Expensesitems;
use App\Model\Projectcosts;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ExpensesitemsController extends Controller
{

    public function index(ExpensesitemsDatatable $admin)
    {
        $expensesitems = Expensesitems::orderBy('created_at','desc')->paginate(15);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return $admin->render('admin.expensesitems.index',compact('expensesitems','temp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.expensesitems.create', ['title' => trans('expensesitems.create')]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $data = request()->validate(
            [
                'items' => 'required',

                

            ], [], [
            'items' => trans('expensesitems.items'),

           

        ]);

        $data = request()->except(['_token', '_method']);



//dd($data);
        Expensesitems::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('expensesitems'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $expensesitems = Expensesitems::find($id);
        $title = trans('admin.edit');
        return view('admin.expensesitems.edit', compact('expensesitems', 'title'));
    }


    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'items' => 'required',




            ], [], [
                'items' => trans('expensesitems.items'),


            ]);


        Expensesitems::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('expensesitems'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if (self::alreadycheck($id)== '1') {
            session()->flash('error', trans('admin.deleted_record_cant'));
            return redirect(aurl('expensesitems'));

        } else {
            Expensesitems::find($id)->delete();
            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('expensesitems'));
        }


    }
    public function alreadycheck($id){
        $Shipments       = Projectcosts::where('expenses_id',$id)->value('expenses_id');

        if($Shipments){
            return '1';

        }
    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Expensesitems::destroy(request('item'));
        } else {
            Expensesitems::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('expensesitems'));
    }
}