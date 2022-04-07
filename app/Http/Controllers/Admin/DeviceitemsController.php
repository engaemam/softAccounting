<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\DeviceitemsDatatable;
use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\Itemserials;
use App\Model\Items;
use App\Model\Subdevices;
use App\Model\Suppliers;
use Storage;
use Excel;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class DeviceitemsController extends Controller
{

    public function index(DeviceitemsDatatable $admin)
    {
        $deviceitems = Deviceitems::with('devices','items')->orderBy("id","DESC")->paginate(15);

        return $admin->render('admin.deviceitems.index', ['title' => trans('deviceitems.deviceitems')],compact('itemserials','items','suppliers','deviceitemsQuery','deviceitems'));
    }
    public function show($devices_id=null)
    {
        $deviceitemsQuery = Deviceitems::with('devices','items');

        if(!empty($devices_id)){
            $deviceitemsQuery->whereDevicesId($devices_id);
        }

        $deviceitems = $deviceitemsQuery->orderBy("id","DESC")->get();
        $devices = Devices::whereId($devices_id)->get();
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view("admin.deviceitems.show", compact('deviceitems','devices_id','devices','deviceitemsQuery','temp'));
    }
    public function addnew($deviceId)
    {
        $deviceitems = new Deviceitems(\Request::old());
        $items = Items::get();
        $devices = Devices::get();
        $subdevices=Subdevices::get();
        return view('admin.deviceitems.create',compact('deviceitems','items','devices','subdevices','deviceId'));
    }



    public function create()
    {

        $deviceitems = new Deviceitems(\Request::old());
        $items = Items::get();
        $devices = Devices::get();
        //$items = DB::table('items')->get();
        $subdevices=Subdevices::get();
        return view('admin.deviceitems.create', ['title' => trans('deviceitems.create')],compact('deviceitems','items','devices','subdevices'));
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'item_id' => '',
                'numbers' => '',
                'devices_id' => '',

            ], [], [
            'item_id' => trans('deviceitems.item_name'),
            'numbers' => trans('deviceitems.numbers'),
            'devices_id' =>trans('deviceitems.devices_id'),

        ]);
        $data = request()->except(['_token', '_method']);
        $itemid = array_filter($request->input('item_id'));
        $number_items = array_filter($request->number_items);


        foreach ($itemid as $key => $item){
            $deviceitems = Deviceitems::create([
                'devices_id'        => $request->devices_id,
                'item_id'           => $item,
                'number_items'      => $number_items[$key],
                'numbers'           => $request->numbers,
            ]);
        }




        //dd($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('deviceitems/'.$request->devices_id));
    }





    public function edit($id)
    {
        $deviceitems = Deviceitems::find($id);
        $items = Items::get();
        $devices = Devices::get();
        $subdevices=Subdevices::get();
        $deviceitemsqs=Deviceitems::find($id);

        $title = trans('deviceitems.edit');
        return view('admin.deviceitems.edit', compact('deviceitems', 'title','items','devices','subdevices','deviceitemsqs'));
    }


    public function update(Request $request, $id)
    {

        $data = $this->validate(request(),
            [
                'item_id' => '',
                'numbers'=>'',
                'device_id'=>'',


            ], [], [
                'item_id' => trans('deviceitems.item_id'),
                'numbers' => trans('deviceitems.numbers'),
                'device_id' =>trans('deviceitems.device_id'),


            ]);

        $data = request()->except(['_token', '_method']);


        foreach ($request->item_id as $key => $item) {
            $deviceitems = Deviceitems::find($id);
            $deviceitems->item_id = $item;
            $deviceitems->number_items = $request->number_items[$key];
            $deviceitems->devices_id = $request->devices_id;
            $deviceitems->numbers = $request->numbers;
            $deviceitems->save();
        }



        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('deviceitems/'.$request->devices_id));
    }

    public function destroy($id)
    {
        //dd($id);
        Deviceitems::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('devices'));
    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Deviceitems::destroy(request('item'));
        } else {
            Deviceitems::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('deviceitems'));
    }
    public function search(Request $request){
        $search      = $request['search'];
        $deviceitems = Deviceitems::with('devices','items')
            ->whereHas('devices', function ($query) use ($search){
                $query->where('devices_name', 'like', '%'.$search.'%');
            })->orderBy("id","desc")
            ->paginate(20);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view('admin.deviceitems.index',compact('deviceitems','temp'));
    }
    public function export()
    {
        $deviceitems = Deviceitems::with('devices','items')->orderBy("id","DESC")->get();
        $deviceitemsData = [];
        foreach($deviceitems as $deviceitem){
            $deviceitemsData[] = [
                'ID'            => $deviceitem->id,
                'اسم الجهاز'    => $deviceitem->devices->devices_name,
                'العدد'         => $deviceitem->numbers,
                'اسم المادة'    => $deviceitem->items->item_name,
                'الكمية	'       => $deviceitem->number_items,

            ];
        }

        if(count($deviceitemsData) > 0){
            Excel::create("تصدير موادالجهاز(".date("d-M-Y").")", function($excel) use($deviceitemsData) {
                $excel->sheet('sheet1', function($sheet) use($deviceitemsData) {
                    $sheet->fromArray($deviceitemsData);

                    $sheet->cell('A1:F1',function($cell){
                        $cell->setBackground('#e8e8e8');
                        $cell->setFontWeight('bold');
                    });
                });

            })->export('xls');
        }
    }

}