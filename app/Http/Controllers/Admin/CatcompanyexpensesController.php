<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Model\Catcompanyexpenses;
use App\Model\Companyexpenses;
use DB;
use Excel;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;


class CatcompanyexpensesController extends Controller
{

    public function index( )
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $expenses = Catcompanyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy('created_at','desc')->paginate(15);

        }else {
            $expenses = Catcompanyexpenses::orderBy('created_at','desc')->paginate(15);

        }
        return view('admin.catcompanyexpenses.index',compact('expenses'));
    }



    public function create()
    {
        return view('admin.catcompanyexpenses.create', ['title' => trans('catcompanyexpenses.create')]);
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [
                'title' => 'required',




            ], [], [
            'title' => trans('catcompanyexpenses.title'),




        ]);
        $data = request()->except(['_token', '_method']);
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;
        Catcompanyexpenses::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('catcompanyexpenses'));
    }





    public function edit($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $expenses = Catcompanyexpenses::findOrFail($id);





        }else {

            $expenses = Catcompanyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);


        }



        $title = trans('catcompanyexpenses.edit');
        return view('admin.catcompanyexpenses.edit', compact('expenses', 'title'));
    }


    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [
                'title' => 'required',




            ], [], [
                'title' => trans('catcompanyexpenses.title'),

            ]);


        Catcompanyexpenses::where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('catcompanyexpenses'));
    }

    public function destroy($id)
    {
        if (self::alreadycheck($id)== '1') {
            session()->flash('error', trans('admin.deleted_record_cant'));
            return redirect(aurl('catcompanyexpenses'));
        } else {

            if (Auth::guard('admin')->user()->Seller_id == 0 ){



                Catcompanyexpenses::find($id)->delete();


            }else {

                Catcompanyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();

            }

            session()->flash('success', trans('admin.deleted_record'));
            return redirect(aurl('catcompanyexpenses'));
        }

    }
    public function alreadycheck($id){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $comapny = Companyexpenses::where('id_catcompanyexpenses',$id)->value('id_catcompanyexpenses');





        }else {

            $comapny = Companyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id_catcompanyexpenses',$id)->value('id_catcompanyexpenses');


        }

        if($comapny  ){
            return '1';

        }
    }




    public function export()
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $expenses = Catcompanyexpenses::orderBy("id","DESC")->get();



        }else {
            $expenses = Catcompanyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy("id","DESC")->get();



        }
        $itemsData = [];
        foreach($expenses as $item){
            $itemsData[] = [
                'ID' => $item->id,
                'اسم المصاريف	' => $item->title,


            ];
        }

        if(count($itemsData) > 0){
            Excel::create("مصاريف الشركة(".date("d-M-Y").")", function($excel) use($itemsData) {
                $excel->sheet('sheet1', function($sheet) use($itemsData) {
                    $sheet->fromArray($itemsData);

                    $sheet->cell('A1:C1',function($cell){
                        $cell->setBackground('#e8e8e8');
                        $cell->setFontWeight('bold');
                    });
                });

            })->export('xls');
        }
    }

}