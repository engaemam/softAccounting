<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProjectsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Currencies;
use App\Model\Currencyrates;
use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\Items;
use App\Model\Projectcosts;
use App\Model\Projectdeviceitems;
use App\Model\Projectdevices;
use App\Model\Subdevices;
use Excel;

use App\Model\Clients;
use App\Model\Projectitems;
use App\Model\Projects;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ProjectsController extends Controller
{

    public function index(ProjectsDatatable $admin)
    {
        $projectdevices = Projectdevices::orderBy('created_at', 'desc')->paginate(15);
        $projectitems = Projectitems::orderBy('created_at', 'desc')->paginate(15);
        $project = Projects::with('clients','projectitems')->orderBy('created_at','desc')->paginate(15);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return $admin->render('admin.projects.index',compact('project','projectdevices','projectitems','temp'));

    }


    public function create()
    {
        $clients    = Clients::with('projects');
        $clients2   = Clients::get();
        $items      = Items::get();
        $devices    = Devices::get();
        $currencies = Currencies::get();
        return view('admin.projects.create',compact('clients','clients2','items','devices','currencies'));
    }


    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'project_number' => 'required',
                'image_deal' => v_image(),
                'image_bill' => v_image(),


            ], [], [
            'project_number' => trans('projects.project_number'),
            'image_deal' => trans('projects.image'),
            'image_bill' => trans('projects.image'),


        ]);

        $data = request()->except(['_token', '_method']);

        if(request()->hasFile('image_deal')) {
            $file = request()->file('image_deal');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/projects/'), $name);
            $data['image_deal'] =  $name;

        }

        if(request()->hasFile('image_bill')) {
            $file = request()->file('image_bill');
            $names = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/projects/'), $names);
            $data['image_bill'] =  $names;

        }

            $project = new Projects();
            $project->name                      = $request->name;
            $project->id_client                 = $request->id_client;
            $project->project_number            = $request->project_number;
            $project->project_start_date        = $request->project_start_date;
            $project->project_creation_date     = $request->project_creation_date;
            $project->date_delivery             = $request->date_delivery;
            $project->date_expirat              = $request->date_expirat;
            $project->project_value             = $request->project_value;
            if($request->image_deal == '') {
                $name = $project->image_bill = null;
            }
            $project->image_deal               = $name;
            if($request->image_bill == '') {
                $names = $project->image_bill = null;
            }
            $project->image_bill               = $names;
            $project->project_after_tax        = $request->project_after_tax;
            $project->type                     = $request->type;
            $project->total_final_mgza         = round($request->total_final_mgza,2);
            $project->total_final_mogma3       = round($request->total_final_mogma3,2);
            $project->currency_id              = $request->currency_id;
            $project->total_project            = $request->total_project = $request->total_final_mgza + $request->total_final_mogma3;
            $project->save();

                        if (!empty($request->item_id)) {

                                foreach ($request->item_id as $key => $item) {
                                    $projectitems = Projectitems::insert([
                                        'project_id'     => $project->id,
                                        'item_id'        => $item,
                                        'quantity_b'     => $request->quantity_b[$key],
                                        'price_b'        => round($request->price_b[$key],2),
                                        'total_price_b'  => round($request->total_price_b[$key],2),
                                    ]);
                                    if($request->type == 'قيد التنفيذ'){
                                        if ($item = Items::find($item)) {
                                            $item->quantity -= $request->quantity_b[$key];
                                            $item->save();
                                        }
                                    }

                                }
                            }



                        if (!empty($request->devices)){
                            foreach ($request->devices as $device_id => $device)
                            {
                                // single device
                                $Projectdevices = Projectdevices::create([
                                    'project_id'                    => $project->id,
                                    'device_id'                     => $device_id,
                                    'quantity'                      => $device['device_quantity'],
                                    'onedevice'                     => round($device['device_price'],2),
                                    'total_price'                   => round($device['device_total_price'],2),
                                ]);
                                foreach ($device['device_items'] as $item_id => $item) {
                                    $Projectdeviceitems = Projectdeviceitems::create([
                                        'project_id' => $project->id,
                                        'device_id' => $device_id,
                                        'item_id_devices' => $item['id'],
                                        'quantity_devices' => round((($device['device_quantity'] * $item['qu'])), 2),
                                        'quantity_old'      => round((($item['quantity_old'])), 2),
                                        'price_devices' => round(($item['p']), 2),
                                        'total_devices' => round(($device['device_quantity'] * $item['qu'] * $item['p']), 2),
                                    ]);
                                }
                            }
                        }
                            if($request->type == 'قيد التنفيذ'){
                                $this->subtract($project->id);
                            }



        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('projects'));
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
    public function deviceid($id,Request $request){

        $DeviceId = Deviceitems::with('items')->where('devices_id',$id)->get();

        $sbudevic = Subdevices::where('device_id',$id)->pluck('subdevice_id');
        $sbudevicz = Subdevices::where('device_id',$id)->get();
        $ItemsId = items::where('id',$id)->get();
        //dd($DeviceId);



        if (!empty($DeviceId)) {
            if(!empty($sbudevicz[0])){
                $subid = Deviceitems::with('items')->wherein('devices_id',$sbudevic)->get();


                return view("admin.projects.ajax",compact('DeviceId','id','subid','sbudevicz','ItemsId'));

            }
            return view("admin.projects.ajax",compact('DeviceId','id','sbudevicz'));

        }else{
            return "Undefined";
        }

    }



    public function show($id)
    {
        //
    }


    public function edit($id)
    {
            $projects           = Projects::with('clients','projectitems')->find($id);
            $projectitems       = Projectitems::with('projects','items')->where('project_id',$id)->orderBy('created_at', 'desc')->get();
            //$projectdeviceitems = Projectdeviceitems::with('Deviceitems','projects','devices')->where('project_id',$id)->orderBy('created_at', 'desc')->get();

        $projectId = $projects->id;
        $projectdevices  = Projectdevices::where('project_id', $projectId)->with(['Projectdeviceitems' => function ($query) use ($projectId){
            $query->where('project_id', $projectId);
        }])->get();
        //dd($projectdevices);

            $clients            = Clients::get();
            $devices            = Devices::get();
            $items              = Items::get();
            $title              = trans('projects.edit');
            return view("admin.projects.edit",compact('projects','clients','projectitems','projectdevices','projectdeviceitems','title','items','devices'));
    }


    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'project_number' => 'required',
                'image_deal'=>'',
                'image_bill'=>'',
                'id_client' => '',
                'project_start_date' => '',
                'project_creation_date' => '',
                'project_value' => '',
                'project_after_tax' => '',
                'name'=>'',
                "type"=>'',

            ], [], [
                'projecct_number' => trans('projects.name_ar'),
                'image_deal'=>trans('projects.image'),
                'image_bill'=>trans('projects.image'),


            ]);
        $data = request()->except(['_token', '_method']);
        if(request()->hasFile('image_deal')) {
            $file = request()->file('image_deal');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/projects/'), $name);
            $data['image_deal'] = asset('upload/projects/' . $name);
        }
        if(request()->hasFile('image_bill')) {
            $file = request()->file('image_bill');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/projects/'), $name);
            $data['image_bill'] = asset('upload/projects/' . $name);
        }

        $project                            = Projects::find($id);
        $project->name                      = $request->name;
        $project->id_client                 = $request->id_client;
        $project->project_number            = $request->project_number;
        $project->project_start_date        = $request->project_start_date;
        $project->project_creation_date     = $request->project_creation_date;
        $project->date_delivery             = $request->date_delivery;
        $project->date_expirat              = $request->date_expirat;
        $project->project_value             = $request->project_value;
        if($request->image_deal == '') {
            $name = $project->image_bill = null;
        }
        $project->image_deal               = $name;
        if($request->image_bill == '') {
            $names = $project->image_bill = null;
        }
        $project->image_bill               = $names;
        $project->project_after_tax        = $request->project_after_tax;
        $project->type                     = $request->type;
        $project->total_final_mgza         = round($request->total_final_mgza,2);
        $project->total_final_mogma3       = round($request->total_final_mogma3,2);
        $project->currency_id              = $request->currency_id;
        $project->total_project            = $request->total_project = $request->total_final_mgza + $request->total_final_mogma3;
        $project->save();

        $deletedRows = Projectitems::where('project_id', $project->id)->delete();
        if (!empty($request->item_id)) {

            foreach ($request->item_id as $key => $item) {
                $projectitems = Projectitems::create([
                    'project_id'     => $project->id,
                    'item_id'        => $item,
                    'quantity_b'     => $request->quantity_b[$key],
                    'price_b'        => round($request->price_b[$key],2),
                    'total_price_b'  => round($request->total_price_b[$key],2),
                ]);
            }
        }

        $deletedRows = Projectdevices::where('project_id', $project->id)->delete();
        $deletedRows = Projectdeviceitems::where('project_id', $project->id)->delete();
        if (!empty($request->devices)){
            foreach ($request->devices as $device_id => $device)
            {
                // single device
                $Projectdevices = Projectdevices::create([
                    'project_id'                    => $project->id,
                    'device_id'                     => $device_id,
                    'quantity'                      => $device['device_quantity'],
                    'onedevice'                     => round($device['device_price'],2),
                    'total_price'                   => round($device['device_total_price'],2),
                ]);
                foreach ($device['device_items'] as $item_id => $item) {
                    $Projectdeviceitems = Projectdeviceitems::create([
                        'project_id' => $project->id,
                        'device_id' => $device_id,
                        'item_id_devices' => $item['id'],
                        'quantity_devices' => round((($device['device_quantity'] * $item['qu'])), 2),
                        'quantity_old'      => round((($item['quantity_old'])), 2),
                        'price_devices' => round(($item['p']), 2),
                        'total_devices' => round(($device['device_quantity'] * $item['qu'] * $item['p']), 2),
                    ]);
                }
            }
        }
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('projects'));
    }

    public function TransferToUnderway(Request $request){
        $project = Projects::findOrFail($request->id);
        $project['type'] = 'قيد التنفيذ';
        $project->save();


        $projectitems = Projectitems::where('project_id',$request->id)->get();

        foreach ($projectitems as $key => $projectitem)
        {
                $dataitems['project_id']            = $request->id;
                $dataitems['item_id']               = $projectitem->item_id;
                $dataitems['quantity_b']            = $projectitem->quantity_b;
                $dataitems['price_b']               = $projectitem->price_b;
                $dataitems['total_price_b']         = $projectitem->total_price_b;

                if($item = Items::find($projectitem->item_id)){
                    $item->quantity -= $projectitem->quantity_b;
                    $item->save();
                }
            }
//
//            $Projectdeviceitems = Projectdeviceitems::where('invoice_id',$request->id)->get();
//
//
//            foreach ($Projectdeviceitems as $key => $items) {
//                $dataddeviceitems['project_id']             = $request->id;
//                $dataddeviceitems['device_id']              = $items->device_id;
//                $dataddeviceitems['item_id_devices']        = $items->item_id_devices;
//                $dataddeviceitems['quantity_devices']       = $items->quantity_devices;
//                $dataddeviceitems['price_devices']          = $items->price_devices;
//                $dataddeviceitems['total_devices']          = $items->total_devices;
//
//            }
            $this->subtract($request->id);

            return back();


    }

    public function destroy(Request $request,$id)
    {
        $project = Projects::findOrFail($id);

        if ($project->type == 'قيد التنفيذ') {
            $this->DeleteProject($id);
        }else{
            $this->DeleteShow($id);

        }
         Projects::findOrFail($id)->delete();

        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('projects'));
    }
    public  function DeleteProject($id){
        $projectcosts = Projectcosts::where('project_id',$id)->get();
        foreach ($projectcosts as $projectcost)
        {
            Projectcosts::find($projectcost->id)->delete();
        }
        $projectitems = Projectitems::where('project_id',$id)->get();
        foreach ( $projectitems as $projectitem)
        {
            $getitem = Items::where('id',$projectitem->item_id)->value('quantity');
            $sub = $getitem + $projectitem->quantity_b   ;
            $updatequantiy = Items::where('id',$projectitem->item_id)->update(['quantity'=>$sub]);

            Projectitems::find($projectitem->id)->delete();

        }
        $projectdevices = Projectdevices::where('project_id',$id)->get();
        foreach ($projectdevices as $projectdevice)
        {
            Projectdevices::find($projectdevice->id)->delete();
        }

        $projectdeviceitems = Projectdeviceitems::where('project_id',$id)->get();
        foreach ($projectdeviceitems as  $key => $value){
            $ddd = Items::where('id',$value->item_id_devices)->value('quantity');
            $value3w = $ddd + $value->quantity_devices   ;
            $updateQuantiy = Items::where('id',$value->item_id_devices)->update(['quantity'=>$value3w]);
            Projectdeviceitems::find($value->id)->delete();
        }

    }
    public  function DeleteShow($id){
        $projectcosts = Projectcosts::where('project_id',$id)->get();
        foreach ($projectcosts as $projectcost)
        {
            Projectcosts::find($projectcost->id)->delete();
        }
        $projectitems = Projectitems::where('project_id',$id)->get();
        foreach ( $projectitems as $projectitem)
        {
            Projectitems::find($projectitem->id)->delete();
        }
        $projectdevices = Projectdevices::where('project_id',$id)->get();
        foreach ($projectdevices as $projectdevice)
        {
            Projectdevices::find($projectdevice->id)->delete();
        }

        $projectdeviceitems = Projectdeviceitems::where('project_id',$id)->get();
        foreach ($projectdeviceitems as  $key => $value){
            Projectdeviceitems::find($value->id)->delete();
        }

    }


    public function multi_delete()
    {
        if (is_array(request('projects'))) {
            Projects::destroy(request('projects'));
        } else {
            Projects::findOrFail(request('projects'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('projects'));
    }
    public function project_print($id,$from_cur = null, $to_cur = null){
        $projects           = Projects::with('clients','projectitems')->find($id);
        $projectitems       = Projectitems::with('projects','items')->where('project_id',$id)->orderBy('created_at', 'desc')->get();
        $projectdevices     = Projectdevices::with('projects','devices')->where('project_id',$id)->orderBy('created_at', 'desc')->get();
        $projectdeviceitems = Projectdeviceitems::with('projects','devices')->where('project_id',$id)->orderBy('created_at', 'desc')->get();
        $clients        = Clients::get();
        //dd($projects->currency_id);
        @$currencies           = Currencies::where('id', '!=', $projects->currency_id)->get();
        $currencyrates        = Currencyrates::get();
        $rate                 = $this->cur($id, $from_cur, $to_cur);

//dd($from_cur);

        return view("admin.projects.show",compact('projects','clients','projectitems','projectdevices','projectdeviceitems','rate','currencyrates','currencies'));
    }
    public function cur($id = null, $from_cur = null, $to_cur = null){
        $rate = Currencyrates::where('currency_id',$from_cur)->where('to_currency_id',$to_cur)->first();
        return $rate;
    }

public function search(Request $request){
    $project = projects::where('name', 'like', '%'.request()->search.'%')
    ->orWhere('project_number', 'like', '%'.request()->search.'%')
    ->orWhere('id', 'like', '%'.request()->search.'%')
        ->orderBy("id","desc")->paginate(20);
    // Start Role Show And Hidden
    $user_role_id = auth()->guard('admin')->User()->roles;
    $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
    $temp = [];
    foreach ($allowRoles as $role)
    {
        $temp[] = $role->allow;
    }
    // End Role Show And Hidden

    return view('admin.projects.index',compact('project','temp'));
}

public function export()
{
    $items = projects::with('clients','projectitems')->orderBy("id","DESC")->get();
    $devicesData = [];
    foreach($items as $item){
        $devicesData[] = [
            'ID' => $item->id,
            'اسم المشروع' => $item->name,
            'حالة المشروع' => $item->type,
            'اسم الزبون' => $item->clients->name_client,
            'رقم المشروع' => $item->project_number,
            'تاريخ التوريد' => $item->project_start_date,
            'تاريخ تشغيل المشروع' => $item->project_creation_date,
            'قيمة المشروع' => $item->project_value,
            'قيمة المشروع بعد الضريبة' => $item->project_after_tax,
        ];
    }

    if(count($devicesData) > 0){
        Excel::create("تصديرالمواد(".date("d-M-Y").")", function($excel) use($devicesData) {
            $excel->sheet('sheet1', function($sheet) use($devicesData) {
                $sheet->fromArray($devicesData);

                $sheet->cell('A1:F1',function($cell){
                    $cell->setBackground('#e8e8e8');
                    $cell->setFontWeight('bold');
                });
            });

        })->export('xls');
    }
    }


    }


