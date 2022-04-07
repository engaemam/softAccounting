<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\PagesDatatable;
use App\Http\Controllers\Controller;

use App\Model\Pages;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class PagesController extends Controller
{

    public function index(PagesDatatable $admin)
    {
        return $admin->render('admin.pages.index', ['title' => trans('pages.pages')]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.pages.create', ['title' => trans('pages.create')]);
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
                'title_ar' => 'required',
                'title_en' => 'required',
                

            ], [], [
            'title_ar' => trans('pages.name_ar'),
            'title_ar' => trans('pages.name_en'),
           

        ]);

        $data = request()->except(['_token', '_method']);



//dd($data);
        Pages::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('pages'));
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
        $pages = Pages::find($id);
        $title = trans('admin.edit');
        return view('admin.pages.edit', compact('pages', 'title'));
    }


    public function update(Request $r, $id)
    {
        $data = $this->validate(request(),
            [
                'title_ar' => 'required',
                'title_en'=>'',
                'description_ar'=>'',
                'description_en'=>'',
                'mate_title_ar'=>'',
                'mate_title_en'=>'',
                'mate_description_ar'=>'',
                'mate_description_en'=>'',




            ], [], [
                'title_ar' => trans('pages.name'),


            ]);
        if(request()->hasFile('image'))
        {
            $file =     request()->file('image');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext =     $file->getClientOriginalExtension();
            $size =     $file->getSize();
            $mim =     $file->getMimeType();
            $realpath =     $file->getRealPath();
            $file->move(public_path('upload/pages/'),$name);
            $data['image']= asset('upload/pages/'.$name);
        }

        Pages::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('pages'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Pages::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('pages'));
    }


    public function multi_delete()
    {
        if (is_array(request('item'))) {
            Pages::destroy(request('item'));
        } else {
            Pages::find(request('item'))->delete();
        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('pages'));
    }
}