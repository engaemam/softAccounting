<?php

namespace App\Http\Controllers;
use App\Model\Shiping_Token;
use Illuminate\Http\Request;
use App\Model\Clients;
use App\Admin;
use App\Model\Invoicedeviceitems;
use App\Model\Invoicedevices;
use App\Model\Invoiceitems;
use App\Model\Invoices;
use App\Model\Invoicespdf;
use App\Model\Items;
use App\Model\Inovice_status;
use App\Model\Social;
use App\Model\req;
use App\Model\City;
use App\Model\SocialFacebookAccount;
use App\Model\Token;
use App\Model\Specifications;
use App\Offers;
use App\Model\ItemsSize;
use Mail;
use App\User;
use GuzzleHttp\Client;
use App\Model\ItemsColors;
use App\Model\InvoiceSources;
use Redirect;
use http\Env\Response;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Auth;
use Socialite;
use Illuminate\Support\Facades\DB;
class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    public function userchangestatues($id)
    {

        $mytime = Carbon::now();

        $date = $mytime->toDateTimeString();

        $today = date("Y-m-d", strtotime($date));

        $mytime = Carbon::now();
        $date = $mytime->toDateTimeString();
        $today = date("Y-m-d", strtotime($date));
        $invoices = Invoices::findOrFail($id);
        if ($invoices->shipping_status == null OR $invoices->status_id != 3){
            $invoices['status_id'] = 3;
            $invoices['updated_at'] = $today;
            $invoices->save();
        }
        return Redirect::back()->withErrors(['msg', 'The Message']);
    }



    private function orders_status($order_code,$order_status,$seller_id)
    {

     $gettoken = Token::find(2);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
        ];
    
        $body= [
            'seller_id'=>$seller_id,
            'status'=>$order_status,
            'order_id'=>$order_code,

        ];

        $response = $client->request('post', 'api/Simple_accounting/orders/update', [
            'headers' => $headers,
            'form_params' => $body
        ]);

    }




    public function storeall(Request $request){

        $data =  $request->except('_token');
        //dd($data);
        $temp = [];
        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com',

            // You can set any number of default request options.             
        ]);
        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];


        foreach ($request->api_invoice_id as $key => $i) {


            $check = Invoices::find($i);
            if ($check->alnawares_id ==0){

                if ($check->shipping_status == null and $check->direct == 0){
                    $response = $client->request('POST', '/api/invoices/createInvoices', [
                        'headers' => $headers,
                        'form_params' => [
                            'api_invoice_id' => $i,
                            'package_id' => $request->package_id[$key],
                            'area_id' => $request->area_id[$key],
                            'receiver_name' => $request->receiver_name[$key],
                            'receiver_address' => $request->receiver_address[$key],
                            'receiver_mobile1' => $request->receiver_mobile1[$key],
                            'receiver_mobile2' => '0',
                            'number_packages' => $request->number_packages[$key],
                            'weight_package' => $request->weight_package[$key],
                            'length' => '0',
                            'width' => '0',
                            'height' => '0',
                            'shippingstatus_id' => $request->shippingstatus_id[$key],
                            'price' => $request->price[$key],
                            'type_invoices' => '0',
                            'typeShipping' => '0',
                            'notes' => $request->notes[$key],
                        ]
                        //    dd($request->notes[$key]),
                    ]);
                    $result = json_decode($response->getBody());
                    if ($result->success == true){
                        Invoices::where('id',$i)->update([
                            'shipping_status'=>1,
                            'shipping_status_id'=>23,
                            'finacialstaus_id'=>1,
                        ]);
                    }
                }
            }
            else{

                $response = $client->request('POST', '/api/invoices/update-invoice-to-send', [
                    'headers' => $headers,
                    'form_params' => [
                        'invoice_id' => $check->alnawares_id,
                        'status' => $request->Shiping_status[$key],

                    ]
                    //    dd($request->notes[$key]),
                ]);
                $result = json_decode($response->getBody());
                if ($result->success == true){
                    Invoices::where('id',$i)->update([
                        'shipping_status'=>1,
                                                'status_id'=>3,

                                                'shipping_status'=>1,

                                                'Shipping_statuses'=>$request->Shiping_status[$key],

                        'shipping_status_id'=>25,
                        'finacialstaus_id'=>9,
                    ]);
                    
                    
                   $order_info = Invoices::where('id',$i)->first();
                    
                    $this->orders_status($order_info->alnawares_id,$request->Shiping_status[$key],$order_info->Seller_id);
                    
                    
                    
                }
            }

        }
        session()->flash('success', trans('admin.shipping_done'));
        return redirect('/admin/invoices');
    }
    public function nawareslogin(Request $request)
    {

        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->firstOrFail();


        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'api/invoices/priceList', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);
        $data =   $json->data->pricelist;

        $response = $client->request('GET', 'api/invoices/priceList', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);
        $data =   $json->data->pricelist;
        //  dd($json->data->pricelist);
        $response1 = $client->request('GET', 'api/invoices/shippingstatus', [
            'headers' => $headers
        ]);
        $shippingstatus = (string) $response1->getBody();
        $json1 =  json_decode($shippingstatus);
        //  dd($json1->data[0]);
        $data1 = $json1->data[0];
        $invoices = $request->invoice_id;

        $datax = Invoices::find($invoices)->pluck('client_id');

        $invoicesall =  Invoices::find($invoices);

        foreach($invoices as $key=>$inv){
            $qq[$key] = Invoiceitems::where('invoice_id',$inv)->pluck('quantity_b');
            $invoicesall[$key] =  Invoices::find($inv);
        }

        // dd($qq);
        //   dd($invoicesall );
        foreach($datax as $key=>$d){

            $answers[$key] = [
                'clients' => Clients::find($d),
                'invociesall'=>$invoicesall,
                'quantity' =>$qq,
            ];

        }
        //

        // dd($answers);
        return view('admin.nawares.create',compact('data','data1','invoices','answers','invoicesall') );

    }
    public function getPricelist(){


        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $t = $gettoken->pluck('token');
        $token = $t[0];
        //  dd($token);
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'api/invoices/priceList', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);
        $data =   $json->data->pricelist;
        dd($json->data->pricelist);
        return view('admin.nawares.create',compact('data') );

    }

    public function sumShipping(Request $request){
        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $t = $gettoken->pluck('token');
        $token = $t[0];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        // $id = 1;
        $response = $client->request('GET', 'api/invoices/sumShpping?package=14196&price=1000&weight_package=10&insurance=0&area_id=120', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);
        dd($json);
    }
    public function shipping_status(){
        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $t = $gettoken->pluck('token');
        $token = $t[0];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        // $id = 1;
        $response = $client->request('GET', 'api/invoices/shippingstatus', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);
        dd($json->data);
    }
    public function pickups(){
        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $t = $gettoken->pluck('token');
        $token = $t[0];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        // $id = 1;
        $response = $client->request('GET', 'api/pickups', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);
        dd($json->data);
    }
    public function allpickups(){
        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $t = $gettoken->pluck('token');
        $token = $t[0];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        // $id = 1;
        $response = $client->request('GET', 'api/pickups', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);
        dd($json->data);
    }


    public function product(Request $request,Offers $offer){
        $request->session()->put('offer',$offer);
        $items = $offer->items;
        //   dd($offer);
        $o = $items[0];
        // $specification = Specifications::where('item_id',$o->id)->get();
        $specifications = Specifications::with('specificolor')->with('specificsize')->where('item_id',$o->id)->get();
        $sources        = InvoiceSources::all();
        // $invoiceitems = Invoiceitems::where('item_id',$o->id)->value('color');
        // $invoicesizes = Invoiceitems::where('item_id',$o->id)->value('size');
        $links  = Social::all();
        $cities = City::all();
        //  dd($links);
        $itemsizes   = ItemsSize::all();
        $itemscolors = itemsColors::all();
        $name = "hello";
        $email = "";

        return view('facelogin',compact('cities','links','itemscolors','itemsizes','sources','offer','items','specifications','name','email'));
    }

    public function showreq($id=null){
        $invoices             = Invoices::with('clients','currencies')->find($id);
        // dd($invoices);
//        $invoicesize = ItemsSize::all();
        $ss = Invoiceitems::where('invoice_id',$id)->get();
        $count = count($ss);
        //dd($invoices);
        $invoiceitems         = Invoiceitems::with('items')->where('invoice_id',$id)->get();
        //dd($invoiceitems);
        $invoicedevices       = Invoicedevices::with('devices')->where('invoice_id',$id)->get();
        $invoicedeviceitems   = Invoicedeviceitems::with('items')->where('invoice_id',$id)->get();
        $itemSizes = Specifications::with('specificsize')->get();

        $billsize = ItemsSize::all();
        // $rate                 = $this->cur($id, $from_cur, $to_cur);
        $items                = Items::get();
        $req=true;
        $offer = Offers::find($invoices->offer_id);
        return view("admin.invoices.usershow",compact('billsize','offer','req','invoices','invoiceitems','rate','currencies','invoicedevices','items','invoicedeviceitems','currencyrates','itemSizes'));
    }
    public function userrequests(Request $request,$id = 0){
        $clients = Clients::pluck('name_client','id');
        $d = Invoices::find(130);

        $clients_phone = Clients::pluck('phone','id');
        $cities = City::pluck('name','id');
        //dd($cities);
        // $users = Admin::pluck('name','id');
        $reqs = req::all();
        $data = DB::select('select clients_id,COUNT(*) as count from requests where status = 0 GROUP BY clients_id');
        $invoicesStatus = Inovice_status::pluck('name','id');
        $sources = InvoiceSources::all();
        $invoicesQuery = Invoices::with('Invoicespdf','clients')->where('validate',false);
        // $user_id = Auth::guard('admin')->user()->id;
        // if(Auth::guard('admin')->user()->id == 1 OR Auth::guard('admin')->user()->id == 4){
        //     $invoicesQuery = Invoices::with('Invoicespdf','clients')->where('validate',false);
        // }else{
        //     // $invoicesQuery = Invoices::with('Invoicespdf','clients')->where('user_id',$user_id)->where('validate',false);
        // }
        if($request->city != ''){
            $invoicesQuery = $invoicesQuery->whereHas('clients', function ($query){
                {
                    $query->where('city', 'LIKE', '%' . request()->city . '%');
                }
            });
        }
        if($request->name_client != ''){
            $invoicesQuery->where("client_id","=",$request->name_client);
        }
        if($request->client_phone != ''){
            $invoicesQuery->where("client_id","=",$request->client_phone);
        }
        if($request->user_id != ''){
            $invoicesQuery->where("user_id","=",$request->user_id);
        }

        if($request->from != ''){
            $from = date("Y-m-d",strtotime($request->from));
            //dd($from);
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d", strtotime($request->to));
            $invoicesQuery->where("date","<=",$to);
        }
        if($request->exports){
            //$this->export($invoicesQuery->get()->all());
            $this->exportInvoices($invoicesQuery->get()->all());
        }
        // dd($id);
        $invoices = $invoicesQuery->where('client_id',$id)->orderBy('date','desc')->paginate(20);
        //  dd($invoices);
        // dd($invoices);
        // Start Role Show And Hidden
        // $user_role_id = auth()->guard('admin')->User()->roles;
        // $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        // $temp = [];
        // foreach ($allowRoles as $role)
        // {
        //     $temp[] = $role->allow;
        // }
        // End Role Show And Hidden
        // dd($invoices);
        return view('admin.offers.user',compact('data','reqs','sources','invoices', 'clients','invoicesStatus','cities','clients_phone'));
    }

    public function req(Request $request, Offers $offer)
    {
        if (request('submit') == 'new') {
            return view('admin.users.client',compact('offer'));
        }
        else{
            dd('current');
        }
    }

    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function generateRandomString($length = 10) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }
    public function handleFacebookCallback(Request $request)
    {
        $drvid = 'facebook';
        $offer = $request->session()->get('offer');
        $email_address_gt ='missing'.$this->generateRandomString(10).'@'.$this->generateRandomString(10).'.smipleaccount.org';
        try {
            $user = Socialite::driver($drvid)->user();

            $cid = 0;
            if (SocialFacebookAccount::where('email', $user->getEmail())->first()) {
                // user found
                //  dd($user->getEmail());
                $client_id = Clients::where('email', $user->getEmail())->first();

                $cid = $client_id->id;
                $new = false;
            }
            else{




                $data['name_client'] = $user->getName();
                $data['email'] =         ($user->getEmail()) ? $user->getEmail() : $email_address_gt;
                ;

                $data['facebook_id'] = $user->getId();
                $data['provider_id'] = $user->getId();
                $data['provider_type'] = 'facebook';

                Clients::create($data);
                $create['name'] = $user->getName();
                $create['email'] =         ($user->getEmail()) ? $user->getEmail() : $email_address_gt;
                ;
                $create['facebook_id'] = $user->getId();


                if($user->getEmail()){
                    $create['email'] = $user->getEmail();

                }else{
                    $create['email'] = 'missing'.$this->generateRandomString(10).'@'.$this->generateRandomString(10).'.smipleaccount.org';


                }




                $userModel = new SocialFacebookAccount;
                $createdUser = $userModel->addNew($create);
                $new = true;
            }



            // $id= $request->get('id');
            // $data = request()->except(['_token', '_method']);


            //   $invoiceClient = Clients::create([
            //     'name_client'     =>$user->getName(),
            //     'email'           => $user->getEmail(),
            //     'provider_id'     => $user->getId(),
            //     'provider_type' => 'facebook'
            // ]);

            // $invoiceClient->save();
            //
            // Auth::loginUsingId($createdUser->id);

            $items = $offer->items;
            //   dd($offer);
            $o = $items[0];
            // $specification = Specifications::where('item_id',$o->id)->get();
            $specifications = Specifications::with('specificolor')->with('specificsize')->where('item_id',$o->id)->get();
            $sources        = InvoiceSources::all();
            // $invoiceitems = Invoiceitems::where('item_id',$o->id)->value('color');
            // $invoicesizes = Invoiceitems::where('item_id',$o->id)->value('size');
            $links  = Social::all();
            $cities = City::all();

            //  dd($links);
            $itemsizes   = ItemsSize::all();
            $itemscolors = itemsColors::all();
            $name = "hello";
            $email =          ($user->getEmail()) ? $user->getEmail() : $email_address_gt;
            ;
            $password = '123456';
            if($new == true){
                $client   = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'http://system.al-nawares.com/api/login?email=api@client.com&password=123456');
                // echo  $response->getBody();
                $data = (string) $response->getBody();
                $json =  json_decode($data);
                $token =$json->data->token;
                $user_id = $json->data->user->id;
                $update = Token::where('user_id',$user_id)->firstOrFail();

                $update->token = $token;
                $update->save();
                $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

                $t = $gettoken->pluck('token');
                $token = $t[0];
                $client = new Client([
                    // Base URI is used with relative requests
                    'base_uri' => 'http://system.al-nawares.com/',
                    // You can set any number of default request options.

                ]);



                $headers = [
                    'Authorization' => 'Bearer ' . $gettoken->token,
                    'Accept'        => 'application/json',
                ];
                $response = $client->request('GET', 'api/invoices/priceList', [
                    'headers' => $headers
                ]);
                $data = (string) $response->getBody();
                $json =  json_decode($data);
                $data =   $json->data->pricelist;
                return view('admin.users.newuser',compact('cities','links','itemscolors','itemsizes','sources','offer','items','specifications','name','email','data','cid'));
            }
            else{
                $client   = new \GuzzleHttp\Client();
                $response = $client->request('POST', 'http://system.al-nawares.com/api/login?email=api@client.com&password=123456');
                // echo  $response->getBody();
                $data = (string) $response->getBody();
                $json =  json_decode($data);
                $token =$json->data->token;
                $user_id = $json->data->user->id;
                $update = Token::where('user_id',$user_id)->firstOrFail();

                $update->token = $token;
                $update->save();
                $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

                $t = $gettoken->pluck('token');
                $token = $t[0];
                $client = new Client([
                    // Base URI is used with relative requests
                    'base_uri' => 'http://system.al-nawares.com/',
                    // You can set any number of default request options.

                ]);

                $headers = [
                    'Authorization' => 'Bearer ' . $gettoken->token,
                    'Accept'        => 'application/json',
                ];
                $response = $client->request('GET', 'api/invoices/priceList', [
                    'headers' => $headers
                ]);
                $data = (string) $response->getBody();
                $json =  json_decode($data);
                $data =   $json->data->pricelist;
                return view('admin.users.olduser',compact('cities','links','itemscolors','itemsizes','sources','offer','items','specifications','name','email','cid','data'));
            }


        } catch (Exception $e) {


            return redirect('auth/facebook');


        }
    }

    public function sign(Request $request){

        if(! $auth = Clients::where('email',request('email'))->where('password',request('password'))->first()){
            return response()->json(['error'=>'wrong'], 500);
        }
        return response()->json($auth);
    }
    public function sign2(Request $request){
        $links = Social::all();
        if(! $auth = Clients::where('email',request('email'))->first()){
            session()->flash('error', trans('admin.not_match_user'));
            return back();
        }
        $mytime    = Carbon::now();
        $date      = $mytime->toDateTimeString();
        $today     = date("Y/m/d", strtotime($date));
        $imageName = str_random(10) . '.' . 'png';
        $user_id   = 1;
        $Req       = req::create([
            'clients_id' => $auth->id,
            'status'     => 1,
        ]);
        $Req->save();
        $invoices = Invoices::create([
            //'invoice_number'        => $request->invoice_number,
            'savedraft'          => $request->savedraft,
            'client_id'          => $auth->id,
            'date'               => $today,
            'city'               => $auth->city,
            'discount'           => $request->discount,
            'shipping_costs'     => $request->shipping_costs,
            'afterdiscount'      => $request->afterdiscount,
            'invoice_source_id'  => $request->invoice_source_id,
            'barcode'            => '9NQj64nZE8.png',
            'user_id'            => $user_id,
            'direct'             => 0,
            'currency_id'        => round($request->currency_id, 2),
            'notes'              => $request->notes,
            'branch_id'          => $request->branch_id,
            'area_id'            => $request->area_id,
            'total_final_mgza'   => round(($request->afterdiscount), 2),
            'total_final_mogma3' => round(($request->afterdiscount), 2),
            'total_invoice'      => round(($request->afterdiscount), 2), ]);

        //Strart Save Image Barcode
//
        $invoices->offer_id    = $request->offer;
        $invoices->validate    = 0;
        $invoices->offersCount = $request->offerQuan;
        $invoices->save();
        if(!empty($request->item_id)){
            //dd($request->quantity);
            foreach ($request->item_id as $key => $i){
                $invoiceItems = Invoiceitems::create([
                    'invoice_id'    => $invoices->id,
                    'item_id'       => $i,
                    'color'         => $request->color[$key],
                    'size'          => $request->size[$key],
                    'quantity_b'    => $request->offerQuan,
                    'price_b'       => $request->offerPrice,
                    'total_price_b' => $request->offerQuan*$request->offerPrice
                ]);
            }

        }
        $Req = req::create([
            'clients_id' => $auth->id,
            'status'     => 1,
        ]);
        $client_email = Clients::where('id',$auth->id)->value('email');
        $rqid         = req::where('clients_id',$auth->id)->value('id');
        $data         = array('name'=> $request->name_client,'offer'=>$request->offer,'requestid'=>$rqid,'clientid'=>$auth->id,'email' => $client_email);
        // dd($client_email);
        //  Mail::send('mail', $data, function($message) use($client_email) {
        //  $message->to($client_email,'Request')->subject
        //     ('تأكيد الطلب');
        //  $message->from('perfectdemo2020@gmail.com','Perfect');
        //  });
        $Req->save();
        return view('done',compact('links'));
    }

    public function register(Request $request){
        $mytime    = Carbon::now();
        $links     = Social::all();
        $date      = $mytime->toDateTimeString();
        $today     = date("Y/m/d", strtotime($date));
        $imageName = str_random(10) . '.' . 'png';
        $user_id = 1;
        // $user_id       = Auth::guard('admin')->user()->id;
        $clients = Clients::where('email',$request->email)->first()->toArray();

        $client_id = $clients['id'];
        $client_city = $request->notes_client;


        $clientt = request()->except(['_token','branch_id','area_id', '_method','id','item_id','color','size','source','offerQuan','price_b','offerPrice','shipping_costs','finalbill','offer','client_id','notes_client','phone1','savedraft']);



        if($clients =! null){
            // $client['city']=$request->notes_client;
            $clientt['phone']=$request->phone;
            $clientt['city'] = $client_city;


            Clients::where('email', $request->email)->update($clientt);


            $Req = req::create([
                'clients_id' => $client_id,
                'status'     => 1,
            ]);
            $Req->save();
        }
        else{
            $invoiceClient = Clients::create([
                'name_client'     => $request->name_client,
                'city'            => $client_city,
                // 'client_position' => $request->notes_client,
                'notes'           => $request->notes,
                'phone'           => $request->phone,
                'mobile'          => $request->mobile,
                'email'           => $request->email,
                'password'        => $request->password,
                'postalCode'      => $request->postal,
            ]);
            $invoiceClient->country = $client_city;
            $invoiceClient->save();
            $Req = req::create([
                'clients_id' => $invoiceClient->id,
                'status'     => 1,
            ]);
            $Req->save();
        }

        //  dd($request->all());
        // dd($invoiceClient->id);

        //dd($request->all());
        $invoices = Invoices::create([
            //'invoice_number'        => $request->invoice_number,
            'savedraft'          => $request->savedraft,
            'client_id'          => $client_id,
            'date'               => $today,
            'city'               => $client_city,
            'discount'           => 0,
            'shipping_costs'     => $request->shipping_costs,
            'afterdiscount'      => $request->finalbill,
            'total_invoice'      => $request->finalbill,
            'invoice_source_id'  => $request->source,
            'barcode'            => '9NQj64nZE8.png',
            'user_id'            => $user_id,
            'currency_id'        => round($request->currency_id, 2),
            'notes'              => $request->notes,
            'direct'             => 0,
            'total_final_mgza'   => $request->finalbill,
            'total_final_mogma3' => round(($request->total_final_mogma3), 2),
            'branch_id'          => $request->branch_id,
            'area_id'            => $request->area_id,
            'total_invoice'      => round(($request->total_invoice = $request->total_final_mgza + $request->total_final_mogma3), 2), ]);

        $invoices->offer_id    = $request->offer;
        $invoices->validate    = 0;
        $invoices->offersCount = $request->offerQuan;
        $invoices->save();




        //dd($request->all());
        if(!empty($request->item_id)){
            //dd($request->quantity);
            foreach ($request->item_id as $key => $i){
                $invoiceItems = Invoiceitems::create([
                    'invoice_id'    => $invoices->id,
                    'item_id'       => $i,
                    'color'         => $request->color[$key],
                    'size'          => $request->size[$key],
                    'quantity_b'    => $request->offerQuan,
                    'price_b'       => $request->offerPrice,
                    'total_price_b' => $request->offerQuan*$request->offerPrice
                ]);
            }

        }
        //email
        // $client_email = Clients::where('id',$clients['id'])->value('email');
        // $rqid         = req::where('clients_id',$clients['id'])->value('id');
        // $data         = array('name'=> $request->name_client,'offer'=>$request->offer,'requestid'=>$rqid,'clientid'=>$clients['id'],'email' => $client_email);

        // Mail::send('mail', $data, function($message) use($client_email) {
        //  $message->to($client_email,'Request')->subject
        //     ('تأكيد الطلب');
        //  $message->from('perfectdemo2020@gmail.com','Perfect');
        //  });
        return view('done',compact('links'));

    }
    public function storeReq(Request $request)
    {
//
//        $data = request()->validate(
//            [
//                //'invoice_number'  => 'required',
//                'date'              => '',
//                'discount'          => '',
//                'name_client'       => '',
//                'client_id'         => '',
//                'afterdiscount'     => '',
//                'city'              => '',
//                'color'             => 'required',
//                'size'              => 'required',
//                'invoice_source_id' => 'required',
//                'shipping_costs' => '',
//
//            ], [], [
//            //'invoice_number'   => trans('invoices.invoice_number'),
//            'date'              => trans('invoices.date'),
//            'discount'           => trans('invoices.discount'),
//            'client_id'         => trans('invoices.client_id'),
//            'afterdiscount' => trans('invoices.afterdiscount'),
//            'city'         => trans('invoices.city'),
//            'color'         => trans('invoices.color'),
//            'size'         => trans('invoices.size'),
//            'invoice_source_id'         => trans('invoices.bill_source'),
//            'shipping_costs'         => trans('invoices.shipping_costs'),
//
//
//        ]);
        $data = request()->except(['_token', '_method']);

        if ($request->hasfile('pdf')) {

            foreach ($request->file('pdf') as $file) {
                $name = rand(1, 1000) . time() . '-' . $file->getClientOriginalName();
                $file->move(public_path() . '/upload/invoices/', $name);
                $dataa[] = $name;
            }
        }
        if (empty($request->file('pdf'))) {
            $dataa = '';
        }
        $user_id = 1;
        //dd($user_id);
        //dd($request->client_id);
        $mytime    = Carbon::now();
        $date      = $mytime->toDateTimeString();
        $today     = date("Y/m/d", strtotime($date));
        $imageName = str_random(10) . '.' . 'png';
        if (empty($request->name_client)) {
            $cityy = Clients::where('id', $request->client_id)->get();
            $city  = $cityy[0]['city'];
        } else {
            $city = $request->city;
        }
        if (!empty($request->name_client)) {
            //dd($request->phone);
            if($request->id){
                $invoiceItems = Clients::find($request->id);
            }
            else{
                $invoiceItems = Clients::create([
                    'name_client'     => $request->name_client,
                    'city'            => $request->city,
                    'client_position' => $request->notes_client,
                    'notes'           => $request->notes,
                    'phone'           => $request->phone,
                    'email'           => $request->email,
                    'password'        => $request->password,
                    'postalCode'      => $request->postal,
                ]);
                $invoiceItems->country = $request->country;
                $invoiceItems->save();
            }
        }
        $invoices = Invoices::create([
            //'invoice_number'        => $request->invoice_number,

            'savedraft'          => $request->savedraft,
            'client_id'          => $invoiceItems->id,
            'date'               => $today,
            'city'               => $city,
            'discount'           => $request->discount,
            'shipping_costs'     => $request->shipping_costs,
            'afterdiscount'      => $request->afterdiscount,
            'invoice_source_id'  => $request->invoice_source_id,
            'barcode'            => $imageName,
            'user_id'            => $user_id,
            'currency_id'        => round($request->currency_id, 2),
            'notes'              => $request->notes,
            'total_final_mgza'   => round(($request->total_final_mgza), 2),
            'total_final_mogma3' => round(($request->total_final_mogma3), 2),
            'total_invoice'      => round(($request->total_invoice = $request->total_final_mgza + $request->total_final_mogma3), 2),
        ]);
        //Strart Save Image Barcode
        $Req = req::create([
            'clients_id' => $invoiceItems->id,
            'status'     => 1,
        ]);
        $Req->save();
        $invoices->offer_id    = $request->offer;
        $invoices->validate    = 0;
        $invoices->offersCount = $request->offerQuan;
        $invoices->save();

        $barcode = \DNS1D::getBarcodePNG($invoices->id, 'C39');
        $image   = $barcode;                                           // your base64 encoded
        $image   = str_replace('data:image/png;base64,', '', $image);
        $image   = str_replace(' ', '+', $image);
        \File:: put(public_path('upload/barcode') . '/' . $imageName, base64_decode($image));

        //End Save Image Barcode
        if (!empty($request->pdf)) {
            foreach ($dataa as $key => $item) {
                $invoicesPDF = Invoicespdf::create([
                    'id_invoices' => $invoices->id,
                    'pdf'         => $item,
                ]);
            }
        }
        if (!empty($request->item_id)) {
            //dd($request->quantity);
            foreach ($request->item_id as $key => $i) {
                $invoiceItems = Invoiceitems::insert([
                    'invoice_id'    => $invoices->id,
                    'item_id'       => $i,
                    'color'         => $request->color[$key],
                    'size'          => $request->size[$key],
                    'quantity_b'    => $request->quantity_b[$key],
                    'price_b'       => round($request->price_b[$key], 2),
                    'total_price_b' => round($request->total_price_b[$key], 2),
                ]);
                if ($request->savedraft == 1) {
                    if ($item = Items::find($i)) {
                        $item->quantity -= $request->quantity_b[$key];
                        $item->save();
                    }
                    $color = '1';
                    $size  = $request->input('size')[$key];
//                    $idSpecific = Specifications::where('item_id', $item->id)->where('size', $size)->where('color_id', $color)->pluck('id');
//                    if ($specific = Specifications::find($idSpecific)->first()) {
//                        $specific->quantity -= $request->quantity_b[$key];
//                        dd($specific);
//                        $specific->save();
                }
            }

        }


        if (!empty($request->devices)) {
            foreach ($request->devices as $device_id => $device) {
                // single device
                $invoiceDevices = Invoicedevices::create([
                    'invoice_id'  => $invoices->id,
                    'device_id'   => $device_id,
                    'quantity'    => $device['device_quantity'],
                    'onedevice'   => round($device['device_price'], 2),
                    'total_price' => round($device['device_total_price'], 2),
                ]);
                foreach ($device['device_items'] as $item_id => $item) {
                    $InvoiceDeviceItems = Invoicedeviceitems::create([
                        'invoice_id'       => $invoices->id,
                        'device_id'        => $device_id,
                        'item_id_devices'  => $item['id'],
                        'quantity_devices' => round((($device['device_quantity'] * $item['qu'])), 2),
                        'quantity_old'     => round((($item['quantity_old'])), 2),
                        'price_devices'    => round(($item['p']), 2),
                        'total_devices'    => round(($device['device_quantity'] * $item['qu'] * $item['p']), 2),
                    ]);
                }
            }
        }

        if ($request->savedraft == 1) {
            $this->subtract($invoices->id);
        }
        session()->flash('success', trans('admin.record_added'));
        return redirect('/offers');
    }
    public  function subtract($id){

        $subtracts = Invoicedeviceitems::where('invoice_id',$id)->get();
        foreach ($subtracts as  $key => $subtract){

            $items         = Items::where('id',$subtract->item_id_devices)->value('quantity');
            $subtractitems = $items - $subtract->quantity_devices    ;
            $sub           = Items::where('id',$subtract->item_id_devices)
                ->update(['quantity'=>$subtractitems]);

        }
    }

    public function offer(){
        return view('done');
    }

    public function changestatus($id,$offerid)
    {
        // dd($offerid);
        $mytime       = Carbon::now();
        $date         = $mytime->toDateTimeString();
        $today        = date("Y-m-d",strtotime($date));
        $reqs         = req::findOrFail($id);
        $reqs['status']     = 0;
        $reqs['updated_at'] = $today;
        $reqs->save();
        return redirect()->to('offers/'.$offerid);
    }

    public function ajaxAreas($branch_id){
        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $t = $gettoken->pluck('token');
        $token = $t[0];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        // $id = 1;
        $response = $client->request('GET', 'api/invoices/priceListAreas/?branch_id_receiver='.$branch_id, [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);
        $areas =   $json->data->areas;
        //dd($areas);

        return view('admin.nawares.areas',compact('areas') );
    }
    public function apiinvoices($inv_id = 0){
        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $t = $gettoken->pluck('token');
        $token = $t[0];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        // $id = 1;
        $response = $client->request('GET', 'api/newApi/get-invoices?api_invoice_id='.$inv_id, [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);
        $invoices =   $json->data->invoices;
        $invoices = $invoices->data;
        // dd($invoices);
        //    dd($invoices->data[0]->invoicestatus->name);

        return view('admin.nawares.invoices',compact('invoices') );

    }

    public function allinvoices()
    {
        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $t = $gettoken->pluck('token');
        $token = $t[0];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        // $id = 1;
        $response = $client->request('GET', 'api/newApi/get-invoices', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();

        $json =  json_decode($data);
//    dd($json);
        $invoices =   $json->data->invoices;
        $invoices = $invoices->data;

        // dd($invoices);

        return view('admin.nawares.invoices',compact('invoices') );
    }
    public function allbills()
    {
        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $t = $gettoken->pluck('token');
        $token = $t[0];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
// $id = 1;
        $response = $client->request('GET', 'api/newApi/get-bills', [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();

        $json =  json_decode($data);
//    dd($json);
        $bills =   $json->data->bills;
        $bills = $bills->data;

// dd($bills);

        return view('admin.nawares.bills',compact('bills') );
    }

    public function confirmbill($id)
    {
        $gettoken = Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();

        $t = $gettoken->pluck('token');
        $token = $t[0];
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            // You can set any number of default request options.

        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
// $id = 1;
        $response = $client->request('POST', 'http://system.al-nawares.com/api/newApi/confirm-receipt-of-bill?id='.$id);


        return redirect('/api/allbills/');
    }

}