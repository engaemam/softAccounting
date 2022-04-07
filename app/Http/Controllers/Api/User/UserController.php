<?php

namespace App\Http\Controllers\Api\User;

use App\Admin;
use App\Http\Controllers\Api\ApiBaseController;
use App\Model\Clients;
use App\Model\Invoiceitems;
use App\Model\Invoices;
use App\Model\Items;
use App\Model\ItemsSize;
use App\Model\Token;
use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Model\Cart;
use App\Model\Product;
use App\Model\Review;
use App\Http\Resources\User\UserCollection;
use Validator;
use Illuminate\Support\Str;
use Auth;
use App\Model\Shipping;

class UserController extends ApiBaseController
{
    
  public function __construct()
    {
        $this->middleware('guest', ['except' => 'logout']);
    }


    public function registerSeller(Request $request) {
        $token = Token::find(3);

        if ($request->token == $token->token){

            $check = Admin::where('Seller_id',$request->Seller_id)->first();

            if($check){
                return $this->sendResponse(
                    "",
                    __("admin.faild", [], "ar"),
                    $this->obj,
                    false,
                    200
                );
            }

            $CreateSeller =Admin::create([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
                'Seller_id'=>$request->Seller_id,
                'phone'=>$request->phone,
                'role_id'=>2,
            ]);
            return $this->sendResponse(
                $CreateSeller->id,
                __("admin.record_added", [], "ar"),
                $this->obj,
                true,
                200
            );

        }

        return $this->sendResponse(
            "",
            __("admin.record_added", [], "ar"),
            $this->obj,
            false,
            200
        );
        
    }


    public function seller_edit(Request $request) {
        $token = Token::find(3);

        if ($request->token == $token->token){

            $check = Admin::where('Seller_id',$request->Seller_id)->first();

            if(!$check){
                return $this->sendResponse(
                    "",
                    __("admin.faild", [], "ar"),
                    $this->obj,
                    false,
                    200
                );
            }

            $CreateSeller =Admin::where('Seller_id',$request->Seller_id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
                'Seller_id'=>$request->Seller_id,
                'phone'=>$request->phone,
                'role_id'=>2,
            ]);
            return $this->sendResponse(
                $CreateSeller->id,
                __("admin.record_added", [], "ar"),
                $this->obj,
                true,
                200
            );

        }

        return $this->sendResponse(
            "",
            __("admin.record_added", [], "ar"),
            $this->obj,
            false,
            200
        );

    }
    public function selleupdate(Request $request) {
        $token = Token::find(3);

        if ($request->token == $token->token){

            $check = Admin::where('Seller_id',$request->Seller_id)->first();

            if(!$check){
                return $this->sendResponse(
                    "",
                    __("admin.faild", [], "ar"),
                    $this->obj,
                    false,
                    200
                );
            }

            $CreateSeller =Admin::where('Seller_id',$request->Seller_id)->update([
                'name'=>$request->name,
                'email'=>$request->email,
                'password'=>$request->password,
                'Seller_id'=>$request->Seller_id,
                'phone'=>$request->phone,
                'role_id'=>2,
            ]);
            return $this->sendResponse(
                $CreateSeller->id,
                __("admin.record_added", [], "ar"),
                $this->obj,
                true,
                200
            );

        }

        return $this->sendResponse(
            "",
            __("admin.record_added", [], "ar"),
            $this->obj,
            false,
            200
        );

    }




    public function storeShipping(Request $request, $id) {
       $user = User::find($id);
       if(!$user) {
            return response()->json(['error' => 'User Not Found' ],404);
       }
       $validator = Validator::make($request->all(), [
            'en_name' => 'required',
            'ar_name' => 'required',
            'mobile' => 'required',
            'state' => 'required',
            'email' => 'required',
            'city' => 'required',
            'region' => 'required',
            'address' => 'required',
            'payment_methods' => 'required',
            'currency'  => 'required',
            'total_price' => 'required',
            'points' => 'required',
        ]);
        

         if ($validator->fails()) {
              return response()->json(['error'=>$validator->errors()], 400);               
        }
        
        
        $ship = new Shipping;
        $ship->en_name = $request->en_name;
        $ship->ar_name = $request->ar_name;
        $ship->user_id = $user->id;
        $ship->mobile = $request->mobile;
        $ship->state = $request->state;
        $ship->email = $request->email;
        $ship->city = $request->city;
        $ship->region = $request->region;
        $ship->address = $request->address;
        $ship->shipping_methods = ' شركة النوارس الذهبية ';
        $ship->payment_methods = $request->payment_methods;
        $ship->total_price = $request->total_price;
        $ship->points = $request->points;
        $ship->code = rand();
        $ship->currency = $request->currency;
        $ship->save();
        
        
          $cart = Cart::where('user_id', $user->id)->first();
          
          foreach($cart->products as $product){
            $ship->products()->attach($product->id);
          }
           $cart->products()->detach();
    
           
         if(!$ship){
             return response()->json(['error' => 'Shipping Method Cound not be Created ' ],500);
         }
         return response()->json(['Success' => 'Shipping Method Created Successfully' ],201);

    }


    public function CreateInvoice(Request $request) {
        $token = Token::find(3);

        if ($request->token == $token->token){
            $today     = date("Y/m/d", strtotime(Carbon::now()->toDateTimeString()));
            $imageName = str_random(10).'.'.'png';
            $vendor_ids   = json_decode($request->vendor_ids, TRUE);
            $vendor_item   = json_decode($request->vendor_item, TRUE);
            $vendor_price   = json_decode($request->vendor_price, TRUE);

            if ($request->count_vendor == 1){
                $client = Clients::firstOrCreate([
                    'name_client'=> $request->name_client,
                    'mobile'=> $request->receiver_mobile1,
                    'email'=> $request->client_email,
                    'Seller_id'=> $vendor_ids[0],
                ],[
                    'name_client'=> $request->name_client,
                    'mobile'=> $request->receiver_mobile1,
                    'email'=> $request->client_email,
                    'notes_client'=> $request->receiver_address,

                ]);
                }else{
                   foreach ($vendor_ids as $item){
                       $client []= Clients::firstOrCreate([
                           'name_client'=> $request->name_client,
                           'mobile'=> $request->receiver_mobile1,
                           'email'=> $request->client_email,
                           'Seller_id'=> $item,
                       ],[
                           'name_client'=> $request->name_client,
                           'mobile'=> $request->receiver_mobile1,
                           'email'=> $request->client_email,
                           'Seller_id'=> $item,
                           'notes_client'=> $request->receiver_address,
                       ]);
                   }
                }



        if ($request->count_vendor == 1){
            $invoices = Invoices::create([
                //'invoice_number'        => $request->invoice_number,
                'savedraft'          => 1,
                'client_id'          => $client->id,
                'date'               => $today,
                'city'               => $request->package_id,
                'area_id'               => $request->area_id,
                'discount'           => 0,
                'shipping_costs'     => $request->Shipping_cost,
                'afterdiscount'      => $request->price,
                'address'      => $request->receiver_address,
                'alnawares_id'      => $request->alnawares_id,
                'invoice_source_id'  => 18,
                'barcode'            => $imageName,
                'user_id'            => $vendor_ids[0],
                'Seller_id'            => $vendor_ids[0],
                'direct'             => 0,
                'currency_id'        => 0,
                'notes'              => $request->notes,
                'branch_id'          => $request->package_id,
                'total_final_mgza'   => round(($request->price), 2),
                'total_final_mogma3' => round(($request->price), 2),
                'total_invoice'      => round(($request->price), 2), ]);
            foreach ($vendor_item as  $key=>$item_id){
                foreach ($item_id as $item2){

                @Items::where('id',$item_id[0]['product_item']['Simple_account_id'])->decrement('quantity',$item2['quality']);
                $invoiceItems []= Invoiceitems::insert([
                    'invoice_id' => $invoices->id,
                    'item_id' => $item2['product_item']['Simple_account_id'],
                    'color' => (isset($item2['specifics1']['item_color']['simple_accounting_id'])) ? @$item2['specifics1']['item_color']['simple_accounting_id'] : 0,
                    'size' => (isset($item2['specifics2']['item_size']['simple_accounting_id'])) ? @$item2['specifics2']['item_size']['simple_accounting_id'] : 0,
                    'quantity_b' => $item2['quality'],
                    'price_b' => round($item2['price'], 2),
                    'total_price_b' => round($item2['quality']*$item2['price'], 2),
                ]);
                }

            }
        }else{
            foreach ($vendor_ids as $key_item=>$items_id){

            $invoices = Invoices::create([
                //'invoice_number'        => $request->invoice_number,
                'savedraft'          => 1,
                'client_id'          => $client[$key_item]->id,
                'date'               => $today,
                'city'               => $request->package_id,
                'area_id'               => $request->area_id,
                'discount'           => 0,
                'shipping_costs'     => $request->Shipping_cost,
                'afterdiscount'      => $vendor_price[$key_item],
                'invoice_source_id'  => 18,
                'barcode'            => $imageName,
                'user_id'            => $items_id,
                'Seller_id'            => $items_id,
                'direct'             => 0,
                'currency_id'        => 0,
                'notes'              => $request->notes,
                'branch_id'          => $request->package_id,
                'total_final_mgza'   => round(($vendor_price[$key_item]), 2),
                'total_final_mogma3' => round(($vendor_price[$key_item]), 2),
                'total_invoice'      => round(($vendor_price[$key_item]), 2), ]);


            foreach ($vendor_item[$items_id] as  $key=>$item_id){
                    @Items::where('id',$item_id['product_item']['Simple_account_id'])->decrement('quantity',$item_id['quality']);
                $invoiceItems []= Invoiceitems::insert([
                    'invoice_id' => $invoices->id,
                    'item_id' => $item_id['product_item']['Simple_account_id'],
                    'color' => (isset($item_id['specifics1'])) ? $item_id['specifics1']['item_color']['simple_accounting_id']: 0,
                    'size' => (isset($item_id['specifics2'])) ? $item_id['specifics2']['item_size']['simple_accounting_id']: 0,
                    'quantity_b' => $item_id['quality'],
                    'price_b' => round($item_id['price'], 2),
                    'total_price_b' => round($item_id['quality']*$item_id['price'], 2),
                ]);
            }
            }
        }


        }

        return $this->sendResponse(
            "",
            __("admin.record_added", [], "ar"),
            $this->obj,
            false,
            200
        );

    }


}
