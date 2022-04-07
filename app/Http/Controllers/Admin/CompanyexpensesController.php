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

//use Illuminate\Http\Request;
class CompanyexpensesController extends Controller
{

    public function index( )
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $expenses = Companyexpenses::orderBy('created_at','desc')->paginate(15);




        }else {

            $expenses = Companyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy('created_at','desc')->paginate(15);


        }

        return view('admin.companyexpenses.index',compact('expenses'));
    }



    public function create()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $catCompanys = Catcompanyexpenses::get();




        }else {

            $catCompanys = Catcompanyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();


        }
        return view('admin.companyexpenses.create', compact('catCompanys'));
    }

    public function show($id)
    {
        //
    }

    public function store(Request $request)
    {
        $data = request()->validate(
            [

                'price' => 'required',



            ], [], [

            'price' => trans('companyexpenses.price	'),



        ]);
        $data['Seller_id'] = Auth::guard('admin')->user()->Seller_id;

        $data = request()->except(['_token', '_method']);
        Companyexpenses::create($data);
        session()->flash('success', trans('admin.record_added'));
        return redirect(aurl('companyexpenses'));
    }





    public function edit($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $expenses = Companyexpenses::find($id);
            $catCompanys = Catcompanyexpenses::get();



        }else {


            $expenses = Companyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);
            $catCompanys = Catcompanyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }

        $title = trans('companyexpenses.edit');
        return view('admin.companyexpenses.edit', compact('expenses', 'title','catCompanys'));
    }


    public function update(Request $request, $id)
    {
        $data = $this->validate(request(),
            [

                'price' => 'required',



            ], [], [

                'price' => trans('companyexpenses.price	'),
            ]);


        Companyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id', $id)->update($data);
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('companyexpenses'));
    }

    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            Companyexpenses::find($id)->delete();



        }else {

            Companyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();


        }
        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('companyexpenses'));
    }




    public function export()
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $expenses = Companyexpenses::orderBy("id","DESC")->get();



        }else {

            $expenses = Companyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy("id","DESC")->get();


        }
        $itemsData = [];
        foreach($expenses as $item){
            $itemsData[] = [
                'ID' => $item->id,
                'اسم المصاريف	' => $item->title,
                'القيمة'   => $item->price,

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

    public function addnew($deviceId)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $expenses = Companyexpenses::find($deviceId);
            $catCompanys = Catcompanyexpenses::get();
            $expenses = Companyexpenses::where("id_catcompanyexpenses",$deviceId)->orderBy('created_at','desc')->paginate(15);



        }else {

            $expenses = Companyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($deviceId);
            $catCompanys = Catcompanyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $expenses = Companyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where("id_catcompanyexpenses",$deviceId)->orderBy('created_at','desc')->paginate(15);

        }

        return view('admin.companyexpenses.show',compact('expenses','deviceId'));
    }
    public function createaddnew($deviceId)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $expenses = Companyexpenses::findOrFail($deviceId);
            $catCompanys = Catcompanyexpenses::get();
            $catCompanys = Catcompanyexpenses::get();
            $expenses = Companyexpenses::where("id_catcompanyexpenses",$deviceId)->orderBy('created_at','desc')->paginate(15);


        }else {

            $expenses = Companyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($deviceId);
            $catCompanys = Catcompanyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $catCompanys = Catcompanyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $expenses = Companyexpenses::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where("id_catcompanyexpenses",$deviceId)->orderBy('created_at','desc')->paginate(15);

        }

        return view('admin.companyexpenses.create',compact('catCompanys','deviceId'));

    }
}