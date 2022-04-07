<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\ProjectcostsDatatable;
use App\Http\Controllers\Controller;

use App\Model\Expensesitems;
use App\Model\Projectcosts;
use App\Model\Projectitems;
use App\Model\Projects;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class ProjectcostsController extends Controller
{

    public function index(ProjectcostsDatatable $admin)
    {
        $projectcosts = Projectcosts::orderBy('created_at','DESC')->paginate(15);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return $admin->render('admin.projectcosts.index',compact('projectcosts','temp'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $projects=Projects::get();
        $projectcosts = new Projectcosts(\Request::old());
        $expensesitems = Expensesitems::get();
        return view('admin.projectcosts.create',compact('expensesitems','projectcosts','projects'));
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'expenses_id' => 'required',
                'value' => 'required',
            ], [], [
            'expenses_id' => trans('projectcosts.expenses_id'),
        ]);

        $data = request()->except(['_token', '_method']);
            $projectcosts = Projectcosts::create([
                'project_id'            => $request->project_id,
                'expenses_id'           => $request->expenses_id,
                'value'                 => $request->value,
            ]);
            $this->projectCostCalculate($request->project_id);


        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('projectcosts/'.$request->project_id));
    }

    function projectCostCalculate($project_id){
        $project = Projects::find($project_id);
        $project->project_after_tax = 0;
        $Projectcosts = Projectcosts::where('project_id', $project_id)->get();
        foreach ($Projectcosts as $item){
            $project->project_after_tax += $item->value;
        }

        $project->save();
    }



    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */

    public function show($project_id=null)
    {

        $ProjectCostQuery = Projectcosts::with('projects');

        if(!empty($project_id)){
            $ProjectCostQuery->whereProjectId($project_id);
        }

        $projectcosts = $ProjectCostQuery->orderBy("id","DESC")->get();
        //$projectcosts  = Projects::whereId($project_id)->get();
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden

        return view("admin.projectcosts.show", compact('projectcosts','project_id','deviceitemsQuery','temp'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $projectcosts = Projectcosts::find($id);
        $projects     = Projects::get();
        $expensesitems = Expensesitems::get();
        $project        = Projects::with('currency')->where('id',$projectcosts->project_id)->first();

        $title = trans('projectcosts.edit');
        return view('admin.projectcosts.edit', compact('projectcosts', 'title','expensesitems','projects','project'));
    }


    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'expenses_id' => 'required',
                'value' => '',
               // 'project_id' => 'required',





            ], [], [
                'expenses_id' => trans('projectcosts.items'),


            ]);

            $projectcosts = Projectcosts::find($id);
            $projectcosts->project_id   = $projectcosts->project_id ;
            $projectcosts->expenses_id  = $request->expenses_id ;
            $projectcosts->value        = $request->value;
            $z=$this->projectCostCalculate($projectcosts->project_id);
            $projectcosts->save();

        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('projectcosts/'.$projectcosts->project_id));
    }
    function projectCostUpdate($project_id){
        $project = Projects::find($project_id);
        $project->project_after_tax = 0;
        $Projectcosts = Projectcosts::where('project_id', $project_id)->get();
        foreach ($Projectcosts as $item){
            $project->project_after_tax -= $item->value;
        }

        $project->save();
    }


    function projectCostSub($project_id){
        $projectcostss = Projectcosts::where('id', $project_id)->value('project_id');
        $project = Projects::find($projectcostss);
        $projectcosts = Projectcosts::where('id', $project_id)->value('value');
        $valuee = $project->project_after_tax - $projectcosts;
        $update = Projects::where('id',$projectcostss)->update(['project_after_tax'=>$valuee]);
    }
    public function destroy($id=null)
    {
        $this->projectCostSub($id);
        Projectcosts::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return back();
    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Projectcosts::destroy(request('item'));
        } else {
            Projectcosts::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('projectcosts'));
    }
    public function addnew($projectId)
    {

        $projectitems   = new Projectitems(\Request::old());
        $expensesitems  = Expensesitems::get();
        $projectcosts   = Projectcosts::get();
        $projects       = Projects::get();
        $project        = Projects::with('currency')->where('id',$projectId)->first();
        //dd($project);

        return view('admin.projectcosts.create', compact('projectcosts', 'projectitems', 'projects', 'devices','projectId','expensesitems','project'));
    }
}