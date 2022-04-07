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
use App\Model\Items;
use App\Model\Items_Color;
use App\Model\itemsColors;
use App\Model\Specific;
use App\Model\Specifications;
use App\Model\Token;
use DB;
//use Maatwebsite\Excel\Excel;
use Excel;

use GuzzleHttp\Client;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class product_apiController extends Controller
{



    public function create()
    {
        $gettoken = Token::find(2);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'api/Simple_accounting/products/create/'.Auth::guard('admin')->user()->Seller_id.'', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);

        $categories =   $json->data->categories;
        $size =   $json->data->size;
        $color =   $json->data->color;
        $user =   $json->data->user;

        return view('admin.items.products_api.create',compact('categories','size','color','user'));
    }



    public function store(Request $request)
    {

        $gettoken = Token::find(2);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'content-type' => 'application/x-www-form-urlencoded',
           ];
        if($request->hasFile('images')) {

                        $image = request()->file('images');

                $image_path = $image->getPathname();
                $image_mime = $image->getmimeType();
                $image_org  = $image->getClientOriginalName();
            

        }
        if(request()->hasFile('images')) {
            $file = request()->file('images');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/items/'), $name);
            $data['image'] =  $name;

        }

        $item_ids = new Items();
        $item_ids->category_id= 0;
        $item_ids->item_name= $request->ar_title;
        $item_ids->Seller_id= Auth::guard('admin')->user()->Seller_id;
        $item_ids->specifications= $request->ar_body;
        if(request()->hasFile('images')){
            $item_ids->image= $name;
        }
        //$item_ids->city= $request->city;

        $item_ids->barcode= "";
        $item_ids->quantity= 0;
        $item_ids->price= 0;
        $item_ids->newprice= 0;
        $item_ids->save();
        if($request->color_id){
            foreach ($request->color_id as $key=>$color){
             
                    $Specifications = new Specifications();
                    $Specifications->Seller_id = Auth::guard('admin')->user()->Seller_id;
                    $Specifications->item_id = $item_ids->id;
                    $Specifications->size = (isset($request->size_id[$key])) ? $request->size_id[$key] :27;
                    $Specifications->color_id = (isset($color)) ? $color :20;;
                    $Specifications->selling_price = $request->selling_price[$key];
                    $Specifications->save();
                
            }
        }


        if(request()->hasFile('image')) {
            $file = request()->file('image');
            $name = str_random(21) . time() . '.' . $file->getClientOriginalExtension();
            $ext = $file->getClientOriginalExtension();
            $size = $file->getSize();
            $mim = $file->getMimeType();
            $realpath = $file->getRealPath();
            $file->move(public_path('upload/items/'), $name);
            $data['image'] =  $name;

        }




 

        $body= [
            'images'=>base64_encode(file_get_contents(url('upload/items/'.$name))),
            'ar_title'=>$request->ar_title,
            'en_title'=>$request->en_title,
            'category_id'=>$request->category_id,
            'Seller_id'=>Auth::guard('admin')->user()->Seller_id,
            'Simple_account_id'=>$item_ids->id,
            'code'=>$request->code,
            'brand'=>$request->brand,
            'stock'=>$request->stock,
            'price'=>$request->price,
            'active'=>$request->active,
            'fet'=>$request->fet,
            'discount'=>$request->discount,
            'price_after_discount'=>$request->price_after_discount,
            'ar_body'=>$request->ar_body,
            'en_body'=>$request->en_body,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
        ];
        $response = $client->request('post', 'api/Simple_accounting/products/store', [
            'headers' => $headers,
            'form_params' => $body
        ]);

// dd((string)$response->getBody(),json_decode((string)$response->getBody()));


        session()->flash('success', trans('admin.record_added'));
        return redirect(url('admin/products_api'));
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
        $response = $client->request('GET', 'api/Simple_accounting/products/'.$id.'/edit', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);

        $product =   $json->data->product;
        $portCat =   $json->data->portCat;
        $allcategories =   $json->data->allcategories;
        $size =   $json->data->size;
        $color =   $json->data->color;
        $user =   $json->data->user;
        $title = trans('colors.edit');
        return view('admin.items.products_api.edit',  compact('product', 'portCat', 'allcategories','color','size','user'));
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
        if($request->hasFile('images')) {

            foreach($request->images as $image){
                $image_path = $image->getPathname();
                $image_mime = $image->getmimeType();
                $image_org  = $image->getClientOriginalName();
            }

        }

        $body= [
            'images'=>(isset($image_path)) ? base64_encode(file_get_contents($image_path)) : "",
            'ar_title'=>$request->ar_title,
            'en_title'=>$request->en_title,
            'category_id'=>$request->category_id,
            'en_title'=>$request->en_title,
            'ar_title'=>$request->ar_title,
            'user_id'=>$request->user_id,
            'qty'=>$request->qty,
            'user_id'=>41,
            'code'=>$request->code,
            'brand'=>$request->brand,
            'stock'=>$request->stock,
            'price'=>$request->price,
            'active'=>$request->active,
            'fet'=>$request->fet,
            'discount'=>$request->discount,
            'price_after_discount'=>$request->price_after_discount,
            'ar_body'=>$request->ar_body,
            'en_body'=>$request->en_body,
            'color_id'=>$request->color_id,
            'size_id'=>$request->size_id,
        ];
        $response = $client->request('post', 'api/Simple_accounting/products/'.$id, [
            'headers' => $headers,
            'form_params' => $body
        ]);

        session()->flash('success', trans('admin.updated_record'));
        return redirect(url('admin/products_api'));
    }

    public function destroy($id)
    {

    }

    public  function paginate($items, $perPage = 15, $page = null, $options = [])
    {
        $page = $page ?: (Paginator::resolveCurrentPage() ?: 1);

        $items = $items instanceof Collection ? $items : Collection::make($items);

        return new LengthAwarePaginator($items->forPage($page, $perPage), $items->count(), $perPage, $page, $options);
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
        $response = $client->request('GET', 'api/Simple_accounting/products/show_data/'.Auth::guard('admin')->user()->Seller_id.'', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);

        $product =  $json->data;
$products = $this->paginate($product);

$url = $gettoken->website;
        return view('admin.items.products_api.index', compact('products','url'));
    }


}