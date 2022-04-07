<?php

namespace App\Http\Controllers\Admin;

use App\DataTables\citiesDatatable;
use App\DataTables\ItemsDatatable;
use App\Http\Controllers\Controller;
use App\Model\Billdevies;
use App\Model\Bills;
use App\Model\Social;
use DB;

//use Maatwebsite\Excel\Excel;
use Excel;

use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class SocialController extends Controller
{

    public function index(ItemsDatatable $admin,$id=null)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){




            $links= Social::where('link', 'like', '%'.request()->search.'%')
                ->orwhere('id', 'like', '%'.request()->search.'%')
                ->orderBy("id","desc")
                ->paginate(20);


        }else {


            $links= Social::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('name', 'like', '%'.request()->search.'%')
                              ->paginate(20);


        }

        $title='social links';
        return $admin->render('admin.social.index',compact('links','title'));
    }



    public function create()
    {
        return view('admin.social.create', ['title' => 'social links']);
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'name' => 'required',
                'link' => 'required|unique:social_links',
                

            ], [], [
            'name' => 'name',
            'link' => 'social link',

        ]);
        $data = request()->except(['_token', '_method']);
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;


        Social::create($data);

        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('social'));
    }





    public function edit($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $links = Social::find($id);



        }else {

            $links = Social::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);

        }

        $title = 'تعديل الرابط';
        return view('admin.social.edit', compact('links', 'title'));
    }


    public function update(Request $request, $id)
    {
        $links = Social::find($id);
        if($links->item_name == $request->item_name){
            $data = $this->validate(request(),
                [
                    'name' => 'required',
                    'link' => 'required',
                ], [], [
                    'name' => '',
                    'link' => '',
                ]);
        }else{
            $data = $this->validate(request(),
                [
                    'name' => 'required',
                    'link' => 'required',

                ], [], [
                    'name' => 'name',
                    'link' => 'social link',
                ]);
        }

        $data = $this->validate(request(),
            [
                'name' => 'required',
                'link' => 'required',
            ], [], [
                'name' => 'name',
                'link' => 'social link',
            ]);
        $data = request()->except(['_token', '_method']);

        if (Auth::guard('admin')->user()->Seller_id == 0 ){




            Social::where('id', $id)->update($data);


        }else {

            Social::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id', $id)->update($data);


        }
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('social'));
    }

    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            Social::find($id)->delete();





        }else {

            Social::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();


        }

        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('social'));

    }





}