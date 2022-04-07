<?php

namespace App\Http\Controllers\Admin;
use App\DataTables\SubdevicesDatatable;
use App\Http\Controllers\Controller;


use App\Model\Devices;
use App\Model\Subdevices;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class SubdevicesController extends Controller
{

    public function index(SubdevicesDatatable $admin)
    {

        $subdevices=Subdevices::with('devices','devices2')->orderBy('created_at','desc')->paginate(15);
        return $admin->render('admin.subdevices.index', ['title' => trans('subdevices.show')],compact('subdevices'));
    }
    public function addnew($deviceId)
    {
        $subdevices = new Subdevices(\Request::old());
        $devices= Devices::get();
        return view('admin.subdevices.create',compact('devices','subdevices','deviceId'));
    }

    public function create()
    {
        $subdevices = new Subdevices(\Request::old());
            $devices= Devices::get();
        return view('admin.subdevices.create',compact('devices','subdevices'));
    }
    public function show($devices_id=null)
    {
        $subdevicesQuery = Subdevices::with('devices','devices2');

    if(!empty($devices_id )){
        $subdevicesQuery->whereDeviceId($devices_id);
    }

        $subdevicess = $subdevicesQuery->orderBy("id","DESC")->get();
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view("admin.subdevices.show", compact('subdevicess','devices_id','temp'));

    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [


                'device_id' => 'required',
                'subdevice_id' => 'required',
            ], [], [
            'device_id' => trans('subdevices.device_id'),
            'subdevice_id' => 'الجهاز الفرعي',



        ]);
        $data = request()->except(['_token', '_method']);
        $subdevices = Subdevices::create([
            'device_id'             => $request->device_id,
            'subdevice_id'           => $request->subdevice_id,

        ]);


        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('subdevices/'.$request->device_id));
    }





    public function edit($id)
    {
        $subdevices = Subdevices::find($id);
        $title = trans('subdevices.edit');
        $devices = Devices::get();


        return view('admin.subdevices.edit', compact('subdevices', 'title','devices'));
    }


    public function update(Request $request, $id)
    {
        $subdevices = Subdevices::find($id);
        $data = $this->validate(request(),
            [
                'device_id' => 'required',
                'subdevice_id' => 'required',
            ], [], [
                'device_id' => trans('subdevices.device_id'),
                'subdevice_id' => 'الجهاز الفرعي',

            ]);

        $data = request()->except(['_token', '_method']);

        Subdevices::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('subdevices/'.$request->device_id));
    }

    public function destroy(Request $request,$id)
    {
        //dd($id);
        Subdevices::findOrFail($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('subdevices/'.$request->device_id));
    }


    public function multi_delete()
    {
        if (is_array(request('subdevices'))) {
            Subdevices::destroy(request('subdevices'));
        } else {
            Subdevices::findOrFail(request('subdevices'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('subdevices'));
    }

    public function search(Request $request)
    {

        $search      = $request['search'];
        $subdevices = Subdevices::with('devices','devices2')->whereHas('devices', function ($query) use ($search){
            $query->where('devices_name', 'like', '%'.$search.'%');})
            ->orderBy("id","desc")
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

        return view('admin.subdevices.index',compact('subdevices','temp'));
    }

}