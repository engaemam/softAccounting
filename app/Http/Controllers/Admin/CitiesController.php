<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\citiesDatatable;
use App\DataTables\ItemsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Billdevies;
use App\Model\Bills;
use App\Model\City;
use App\Model\Token;
use DB;
use App\Model\cities;
//use Maatwebsite\Excel\Excel;
use Excel;

use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class CitiesController extends Controller
{

    public function index(ItemsDatatable $admin,$id=null)
    {


        $cities= City::where('name', 'like', '%'.request()->search.'%')
            ->orwhere('id', 'like', '%'.request()->search.'%')
            ->orderBy("id","desc")
            ->paginate(20);
        $title=trans('cities.cities');
        return $admin->render('admin.cities.index',compact('cities','title'));
    }



    public function create()
    {
        $client = new \GuzzleHttp\Client();
        $gettoken = Token::find(1);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        $res = $client->request('GET', 'http://system.al-nawares.com/api/newApi/getBranchs',['headers'=>$headers]);
        $jsonArray = json_decode($res->getBody()->getContents(), true);

        foreach($jsonArray['data'] as $item ){
            City::firstOrCreate([

                'id'=>$item['id'],
                'name'=>$item['title'],
            ],[

                'id'=>$item['id'],
                'name'=>$item['title'],
                'shipping'=>0,

            ]);

        }
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('cities'));
        }

    public function show($id)
    {
        //
    }





    public function edit($id)
    {
        $cities = City::find($id);
        $title = trans('cities.edit');
        return view('admin.cities.edit', compact('cities', 'title'));
    }


    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'shipping' => 'required',
            ], [], [
                'shipping' => trans('cities.price_shipping'),
            ]);
        $data = request()->except(['_token', '_method']);


        City::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('cities'));
    }

    public function destroy($id)
    {


        City::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('cities'));

    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            City::destroy(request('item'));
        } else {
            City::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('cities'));
    }

    public function search(Request $request){

        //$query = SELECT * FROM your_table ORDER BY your_field = 0, your_field;

        $cities = City::where('name', 'like', '%'.request()->search.'%')
            ->orderByRaw("`id`= 0,`id`")
            ->paginate(20);
        $cities->appends(['search' => $request]);

        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        //generalcontroller::checkbill();

        return view('admin.cities.index',compact('cities','temp'));
    }


}