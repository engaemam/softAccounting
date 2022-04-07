<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\CurrenciesDatatable;
use App\Http\Controllers\Controller;
use App\Model\Currencyrates;
use App\Model\Currencies;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class CurrencyratesController extends Controller
{

    public function index($search=null)
    {
        $currencies = Currencyrates::orderBy('created_at','desc')->paginate(15);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.currencyrate.index', compact('currencies','temp'));
    }


    public function create()
    {
        $currencies=Currencies::get();
        return view('admin.currencyrate.create', compact('currencies'));
    }


    public function store()
    {
        $data = request()->validate(
            [
                'currency_id' => 'required',
                'to_currency_id' => 'required',
            ], [], [
            'currency_id' => trans('currencies.currency_id'),
            'to_currency_id' => trans('currencies.to_currency_id'),
        ]);
        $data = request()->except(['_token', '_method']);
        // if(!empty($request->currency_id)){
        //
        //     foreach ($request->currency_id as $key => $item){
        //         $currencyrate = Currencyrates::insert([
        //             'currency_id'                       => $item,
        //             'to_currency_id'                    => $request->input('to_currency_id'),
        //             'rate'                              => $request->input('rate'),
        //
        //         ]);
        //
        //     }
        // }
        Currencyrates::create($data);

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('currencyrate'));
    }


    public function show($currency_id)
    {
      $deviceitemsQuery = Currencyrates::with('currency','currencytorate');

      if(!empty($currency_id)){
          $deviceitemsQuery->where('currency_id',$currency_id);
      }

      $currencies = $deviceitemsQuery->orderBy("id","DESC")->paginate(15);
      //dd($currency_id);
      $devices = Currencies::whereId($currency_id)->get();
      // Start Role Show And Hidden
      $user_role_id = auth()->guard('admin')->User()->roles;
      $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
      $temp = [];
      foreach ($allowRoles as $role)
      {
          $temp[] = $role->allow;
      }
      // End Role Show And Hidden

      return view("admin.currencyrate.index", compact('currencies','devices_id','devices','deviceitemsQuery','temp'));
    }


    public function edit($id)
    {
        $currencyrates = Currencyrates::find($id);
        $currencies    = Currencies::get();
        $currencies2    = Currencies::first();
          $title = trans('currencyrates.edit');

        return view('admin.currencyrate.edit', compact('currencyrates','currencies','title','currencies2'));
    }


    public  function update(Request $request)
    {
        $data = $this->validate(request(),
            [
              'currency_id' => 'required',
              'to_currency_id' => 'required',
          ], [], [
          'currency_id' => trans('currencies.currency_id'),
          'to_currency_id' => trans('currencies.to_currency_id'),


            ]);

        $data = request()->except(['_token', '_method']);

        $currencyrates = Currencyrates::find($request->id);
        $currencyrates->id    = $request->id;
        $currencyrates->currency_id    = $request->currency_id;
        $currencyrates->to_currency_id = $request->to_currency_id;
        $currencyrates->rate           = $request->rate;

        $currencyrates->update($data);

        $currencyrates2 = Currencyrates::where('currency_id',$request->to_currency_id)
                                        ->where('to_currency_id',$request->currency_id)->first();
        $currencyrates2->rate          = round(1/$request->rate, 3);
        $currencyrates2->save();


        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('currencyrate/'.$request->currency_id));
    }

    public function destroy($id)
    {
        //dd($id);
        Currencyrates::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('currencyrate'));
    }




}
