<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\DevicesDatatable;
use App\Http\Controllers\Controller;
use App\Model\Billdevies;
use App\Model\Billitems;
use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\Importdevices;
use App\Model\Invoicedevices;
use App\Model\Invoiceitems;
use App\Model\Items;
use App\Model\Projectdevices;
use App\Model\Projectitems;
use App\Model\Subdevices;
use Storage;
use Excel;

use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class DevicesController extends Controller
{

    public function index(DevicesDatatable $admin)
    {
        $devices = Devices::orderBy('created_at','DESC')->paginate(15);


        foreach ($devices as $device){
        $device->qty = $this->getcount($device->id);
       }


        $subdevicesQuery = Subdevices::with('devices','devices2');

        if(!empty($devices_id))
        {
            $subdevicesQuery->whereDeviceId($devices_id);
        }

        $subdevices = $subdevicesQuery->orderBy("id","DESC")->first();

        return $admin->render('admin.devices.index', ['title' => trans('devices.devices')],compact('devices','subdevices'));
    }

    public function search(Request $request)
    {

        $devices = Devices::with('Subdevice','deviceitems')
            ->where( 'devices_name','LIKE','%' . request()->search . '%')
            ->orwhere('specifications', 'like', '%'.request()->search.'%')
            ->orderByRaw("`quantity`= 0,`quantity`, `id` DESC")
            ->orderBy('created_at','DESC')->paginate(15);


        foreach ($devices as $device){
            $itemsMin = $this->getcount($device->id);
            $subDevicesMin = [];
            $devicMin = 0;
            if(count($device->subdevice) > 0){
                foreach ($device->subdevice as $d){
                    $subDevicesMin[] = $this->getcount($d->id);
                }

            }
            if(!empty($subDevicesMin)){
                $devicMin = min($itemsMin, min($subDevicesMin));
            }else{
                $devicMin = $itemsMin;
            }
            $dd = Devices::where('id',$device->id)->update(['quantity'=>$devicMin]);

            //echo $device->id.'  '.$devicMin.'<br>';
        }

        //dd('r');







        //$devices = Devices::where( 'devices_name' , request()->search )->get();
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.devices.index',compact('devices','temp'));

    }

    public function create()
    {
        return view('admin.devices.create', ['title' => trans('devices.create')]);
    }
    private function seen(){
        $device2 = Devices::with('Subdevice','deviceitems')->paginate(15);
        $children = [];
        //array_push($children, $device);
        $children[$device2->id] = $device2; // if($device->id == Loop)
        //dd($children);
        foreach ($children as &$c){
            if(count($c->subdevice) > 0){
                foreach ($c->subdevice as $cc){
                    if(isset($children[$cc->id])){
                        break 2; //2 = 34an atl3 min Loop
                    }
                    //array_push($children, $cc);
                    $children[$cc->id] = $cc;
                    $device2->qty = $this->getcount($cc->id);
                }
                //dd($children);
            }
        }
    }


    public function store()
    {
        $data = request()->validate(
            [
                'devices_name' => 'required|unique:devices',
                'specifications' => '',
            ], [], [
            'devices_name' => trans('devices.devices_name'),
            'specifications' => trans('devices.specifications'),
        ]);
        $data = request()->except(['_token', '_method']);
        $data['quantity'] = 0;

        Devices::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('devices'));
    }


    public function show($id)
    {
        //
    }


    public function edit($id)
    {
        $devices = Devices::find($id);
        $title = trans('devices.edit');
        return view('admin.devices.edit', compact('devices', 'title'));
    }


    public function update(Request $request, $id)
    {
        $devices = Devices::find($id);
        if($devices->devices_name == $request->devices_name) {
            $data = $this->validate(request(),
                [
                    'devices_name' => 'required',
                    'specifications' => '',
                ], [], [
                    'devices_name' => trans('devices.devices_name'),


                ]);
        }else{
            $data = $this->validate(request(),
                [
                    'devices_name' => 'required|unique:devices',
                    'specifications' => '',
                ], [], [
                    'devices_name' => trans('devices.devices_name'),


                ]);
        }
        $data = request()->except(['_token', '_method']);


        Devices::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('devices'));
    }

    public function destroy($id)
    {
        if (self::alreadycheck($id)== '1') {
            session()->flash('error', trans('admin.deleted_record_cant'));
            return redirect(aurl('devices'));

        } else {

            Devices::findOrFail($id)->delete();
            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('devices'));
        }

    }
    public function alreadycheck($id){
        $billitem       = Billdevies::where('device_id',$id)->value('device_id');
        //$deviceitems    = Deviceitems::where('devices_id',$id)->value('devices_id');
        $invitem        = Invoicedevices::where('device_id',$id)->value('device_id');
        $projectitems   = Projectdevices::where('device_id',$id)->value('device_id');
        $Importdevices = Importdevices::where('device_id',$id)->value('device_id');
        $Subdevices     = Subdevices::where('subdevice_id',$id)->value('device_id');

        if($billitem  || $invitem || $projectitems ||$Importdevices ||$Subdevices){
            return '1';

        }
    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Devices::destroy(request('item'));
        } else {
            Devices::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('devices'));
    }

    public static function getcount($id = null){

        $device = Devices::with('Subdevice','deviceitems')->find($id);

        $devic_items = Deviceitems::where("devices_id", $id)->get();

        $Arrays = [];
        foreach ($devic_items as $item)
        {
            $itemQty = Items::where("id", $item->item_id)->value('quantity');
            //dd($item->number_items);
            $Arrays[] =  floor($itemQty /  $item->number_items);
        }
        //Sub Devices

        # items min
        return empty($Arrays) ? 0 : min($Arrays);

        //$dd = Devices::where('id',$id)->update(['quantity'=>$min]);
//    echo $id.' '.$min."<br>";
//        return false;


    }


    public function export()
    {
        $devices = Devices::orderBy("id","DESC")->get();
        $devicesData = [];
        foreach($devices as $device){
            $devicesData[] = [
                'اسم الجهاز	' => $device->devices_name,
                'المواصفات' => $device->specifications,
                'كمية في المخزن' => $device->quantity,

            ];
        }

        if(count($devicesData) > 0){
            Excel::create("تصديرالاجهزة(".date("d-M-Y").")", function($excel) use($devicesData) {
                $excel->sheet('sheet1', function($sheet) use($devicesData) {
                    $sheet->fromArray($devicesData);

                    $sheet->cell( function($cell){
                        $cell->setBackground('#e8e8e8');
                        $cell->setFontWeight('bold');
                    });
                });

            })->export('xls');
        }
    }

}