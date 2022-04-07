<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\CurrenciesDatatable;
use App\Http\Controllers\Controller;
use App\Model\Currencies;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class CurrenciesController extends Controller
{

    public function index(CurrenciesDatatable $admin,$search=null)
    {
        $currencies = Currencies::orderBy('created_at','desc')->paginate(15);
        $currency = Currencies::find(1);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return $admin->render('admin.currencies.index', compact('currency','temp'));
    }


    public function create()
    {
        return view('admin.currencies.create', ['title' => trans('currencies.create')]);
    }


    public function store()
    {
        $data = request()->validate(
            [
                'currency_name' => 'required',
                'currency_ammount' => 'required',
            ], [], [
            'currency_name' => trans('currencies.name_ar'),
            'currency_ammount' => trans('currencies.name_en'),
        ]);
        $data = request()->except(['_token', '_method']);

        Currencies::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('currencies'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $currencies = Currencies::find($id);
        $title = trans('currencies.edit');
        return view('admin.currencies.edit', compact('currencies', 'title'));
    }


    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'currency_name' => 'required',
                'currency_ammount' => 'required',
            ], [], [
                'currency_name' => trans('currencies.name_ar'),
                'currency_ammount' => trans('currencies.name_en'),


            ]);
        $data = request()->except(['_token', '_method']);


        Currencies::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('currencies'));
    }

    public function destroy($id)
    {
        //dd($id);
        Currencies::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('currencies'));
    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Currencies::destroy(request('item'));
        } else {
            Currencies::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('currencies'));
    }

}