<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\DataTables\BillpartsDatatable;
use App\Model\Billdevies;
use App\Model\Bills;
use App\Model\BillSource;
use App\Model\Category;
use App\Model\Invoicecolors;
use App\Model\Colors;
use App\Model\Items_Color;
use App\Model\itemsColors;
use App\Model\ItemsSize;
use App\Model\Specific;
use App\Model\Token;
use DB;
//use Maatwebsite\Excel\Excel;
use Excel;

use GuzzleHttp\Client;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class Item_Size_apiController extends Controller
{



    public function create()
    {
        return view('admin.itemssizes.itemssize_Api.create');
    }



    public function store(Request $request)
    {
        $gettoken = Token::find(2);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
        ];
        $create = ItemsSize::create([

            'name'=>$request->name_ar,
            'Seller_id'=>Auth::guard('admin')->user()->Seller_id,

        ]);
        $body= [
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
            'Simple_account_id'=>$create->id,
            'Seller_id'=>Auth::guard('admin')->user()->Seller_id,

        ];

        $response = $client->request('post', 'api/Simple_accounting/Item_Size/store', [
            'headers' => $headers,
            'form_params' => $body
        ]);



        session()->flash('success', trans('admin.record_added'));
        return redirect(url('admin/Item_size_api'));
    }





    public function edit($id)
    {
        $gettoken = Token::find(2);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'api/Simple_accounting/Item_Size/'.$id.'/edit', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);

        $colors =   $json->data;

        $title = trans('colors.edit');
        return view('admin.itemssizes.itemssize_Api.edit', compact('colors', 'title'));
    }


    public function update(Request $request, $id)
    {
        $gettoken = Token::find(2);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
        ];
        $body= [
            'name_ar'=>$request->name_ar,
            'name_en'=>$request->name_en,
        ];
        $response = $client->request('put', 'api/Simple_accounting/Item_Size/'.$id, [
            'headers' => $headers,
            'form_params' => $body
        ]);


        session()->flash('success', trans('admin.updated_record'));
        return redirect(url('admin/Item_size_api'));
    }

    public function destroy($id)
    {

    }



    public function search(){


        $gettoken = Token::find(2);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'api/Simple_accounting/Item_Size/show_data/'.Auth::guard('admin')->user()->Seller_id.'', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);

        $colors =   collect($json->data);

        return view('admin.itemssizes.itemssize_Api.index',compact('colors'));
    }


}