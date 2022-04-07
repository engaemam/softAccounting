<?php

namespace App\Http\Controllers\Admin;


use App\DataTables\ProjectitemsDatatable;
use App\Http\Controllers\Controller;


use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\Items;
use App\Model\Projectdeviceitems;
use App\Model\Projectdevices;
use App\Model\Projectitems;
use App\Model\Projects;
use App\Model\Subdevices;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ProjectitemsController extends Controller
{

    public function index(ProjectitemsDatatable $admin)
    {
        $projectdevices = Projectdevices::orderBy('created_at', 'desc')->paginate(15);
        $projectitems = Projectitems::orderBy('created_at', 'desc')->paginate(15);
        return $admin->render('admin.projectitems.index', compact('projectitems', 'projectdevices'));
    }

    public function create()
    {
        $projectitems = new Projectitems(\Request::old());

        $items = Items::get();
        $projects = Projects::get();
        $devices = Devices::get();
        return view('admin.projectitems.create', compact('items', 'projectitems', 'projects', 'devices'));
    }
    public function show($project_id)
    {
        //dd($project_id);
        $projectitemsQuery = Projectitems::with('devices', 'items', 'projects');

        $projectdevicesQuery = Projectdevices::with('devices', 'items', 'projects');

        if (!empty($project_id)) {
            $projectitemsQuery->whereProjectId($project_id);

            $projectdevicesQuery->whereProjectId($project_id);
        }

        $projectitems = $projectitemsQuery->orderBy("id", "DESC")->paginate(15);
        $projectdevices = $projectdevicesQuery->orderBy("id", "DESC")->paginate(15);

        $projectitemse = Projectitems::whereProjectId($project_id)->get();


        return view("admin.projectitems.show", compact('projectitems', 'projectdevices','projectitemse','project_id'));
    }
    public function addnew($projectId)
    {
        $projectitems = new Projectitems(\Request::old());

        $items = Items::get();
        $projects = Projects::get();
        $devices = Devices::get();
        return view('admin.projectitems.create', compact('items', 'projectitems', 'projects', 'devices','projectId'));
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'item_id' => '',
                'project_id' => 'required',


            ], [], [
            'item_id' => trans('projectitems.item_id'),
            'project_id' => trans('projectitems.project_id'),


        ]);
        $data = request()->except(['_token', '_method']);

        if(!empty($request->item_id)){

            foreach ($request->item_id as $key => $item){
                $projectitems = Projectitems::insert([
                    'project_id'                        => $request->project_id,
                    'item_id'                           => $item,
                    'quantity_b'                        => $request->quantity_b[$key],
                    'price_b'                           => $request->price_b[$key],
                    'total_price_b'                     => $request->total_price_b[$key],
                ]);
                if($item = Items::find($item)){
                    $item->quantity -= $request->quantity_b[$key];
                    $item->save();
                }
            }
        }
        if(!empty($request->device_id[0]))
        {
            foreach ($request->device_id as $key => $device){
                $projectdevices = Projectdevices::insert([
                    'project_id'                    => $request->project_id,
                    'device_id'                     => $device,
                    'quantity'                      => $request->quantity[$key],
                    'total_price'                   => $request->total_price[$key],
                ]);
            }
        }
        if(!empty($request->item_id_devices) ){

            foreach ($request->item_id_devices as $key => $items){
                if(!empty(is_array($items) || is_object($items) )) {
                    foreach ($items as $k => $value) {
                        //dd($items);

                        $ProjectDeviceItems = Projectdeviceitems::insert([
                            'project_id'        => $request->project_id,
                            'device_id'         => $key,
                            'item_id_devices'   => $value,
                            'quantity_devices'  => $request->quantity_devices[$key][$k],
                            'price_devices'     => $request->price_devices[$key][$k],
                            'total_devices'     => $request->total_devices[$key][$k],
                        ]);

                    }
                }

            }
            $this->subtract($request->project_id);
        }





        //Projectitems::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('projectitems/'.$request->project_id));
    }
    public  function subtract($id){

        $subtracts = Projectdeviceitems::where('project_id',$id)->get();
        foreach ($subtracts as  $key => $subtract){

            $items              = Items::where('id',$subtract->item_id_devices)->value('quantity');
            $subtractitems      = $items - $subtract->quantity_devices    ;
            $sub                = Items::where('id',$subtract->item_id_devices)
                ->update(['quantity'=>$subtractitems]);

        }
    }





    public function edit($id)
    {
        $projectitems = Projectitems::find($id);
        $projectdevices = Projectdevices::find($id);
        $items = Items::get();
        $projects = Projects::get();
        $devices = Devices::get();
        $title = trans('projectitems.edit');
        return view('admin.projectitems.edit', compact('projectitems', 'title', 'items', 'projects', 'devices', 'projectdevices'));
    }



    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'item_id' => '',
                'project_id' => '',
                'price_item' => '',
                'quantity_b' => '',
                'total_price' => '',

            ], [], [
                'item_id' => trans('projectitems.item_id'),
                'project_id' => trans('projectitems.project_id'),


            ]);
        $data = request()->except(['_token', '_method']);

        $projectitems = Projectitems::find($id);
        if (!empty($projectitems)){
            $projectitems = Projectitems::find($id);
            //$projectitems->project_id   = $request->project_id;
            $projectitems->item_id = $request->item_id;
            $projectitems->quantity_b = $request->quantity_b;
            $projectitems->save();
        }else{
            $projectdevices = Projectdevices::find($id);
            // $projectdevices->project_id   = $request->project_id;
            $projectdevices->device_id = $request->device_id;
            $projectdevices->quantity = $request->quantity;
            $projectdevices->save();
        }

        $d = Deviceitems::where('devices_id', $request->device_id)->get();
        foreach ($d as $i){
            $item = Items::find($i->item_id);
            $item->quantity -= ($request->quantity * $i->number_items);
            $item->save();
        }

        //Projectitems::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        //return redirect(aurl('projectitems'));
        return back();
    }
    //START GET AJAX
    public function itemsid( $id , Request $request){
        $ItemsId = items::where('id',$id)->get();

        if (!empty($ItemsId)) {

            return view("admin.projectitems.getitem",compact('ItemsId','id'));
        }else{
            return "Undefined";
        }

    }
    public function deviceid($id,Request $request){
        $DeviceId = Deviceitems::with('items')->where('devices_id',$id)->get();
        $sbudevic = Subdevices::where('device_id',$id)->pluck('subdevice_id');
        $sbudevicz = Subdevices::where('device_id',$id)->get();
        $ItemsId = items::where('id',$id)->get();
        //dd($DeviceId);



        if (!empty($DeviceId)) {
            if(!empty($sbudevicz[0])){
                $subid = Deviceitems::with('items')->wherein('devices_id',$sbudevic)->get();


                return view("admin.projectitems.ajax",compact('DeviceId','id','subid','sbudevicz','ItemsId'));

            }
            return view("admin.projectitems.ajax",compact('DeviceId','id','sbudevicz'));

        }else{
            return "Undefined";
        }

    }
    //End GET AJEX

    public function destroy($id)
    {
        //dd($id);
        Projectitems::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('projectitems'));
    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Projectitems::destroy(request('item'));
        } else {
            Projectitems::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('projectitems'));
    }
}