<?php
namespace App\Http\Controllers\Admin;
use App\Admin;
use App\DataTables\UsersDatatable;
use App\Http\Controllers\Controller;
use App\Model\Shiping_Token;
use App\User;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class Create_Account_Private  extends Controller {

    public function create() {
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            'timeout'           => 500.0,
            // You can set any number of default request options.

        ]);

        $headers = [
            'Accept'        => 'application/json',
        ];
        $response = $client->request('Post', 'api/store/get-clients', [
            'headers' => $headers,
            'form_params' => [
                'token' => 'MohamedFathy23@#'
            ]
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);

    $users =$json->data;
        return view('admin.simple_account.create',compact('users'));
    }

    public function store(Request $request) {

        $data = $this->validate(request(),
            [
                'users'     => 'required',

            ], [], [
                'users'     => trans('admin.name'),

            ]);

            $client = new Client([
                // Base URI is used with relative requests
                'base_uri' => 'http://system.al-nawares.com/',
                'timeout'           => 500.0,
                // You can set any number of default request options.

            ]);

            $headers = [
                'Accept'        => 'application/json',
            ];
            $response = $client->request('Post', 'api/store/get-clients', [
                'headers' => $headers,
                'form_params' => [
                    'token' => 'MohamedFathy23@#'
                ]
            ]);
            $data = (string) $response->getBody();
            $json =  json_decode($data);

            $users =collect($json->data);

           $data= $users->where('id',$request->users)->first();

           if (!Admin::whereemail($data->email)->first()){
       $done =  Admin::create([
            'Seller_id'=>$data->id,
            'role_id'=>1,
            'name'=>$data->name,
            'email'=>$data->email,
            'password'=>$data->password,
            'phone'=>$data->phone,
            'mobile'=>$data->mobile,
            'usertype_id'=>1,
        ]);
           }else{
               session()->flash('error', "البائع مسجل من قبل");
               return back();
           }

if ($done){
        $client = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://alnawaresstore.com/',
            'timeout'           => 500.0,
            // You can set any number of default request options.

        ]);

        $headers = [
            'Accept'        => 'application/json',
        ];
        $response = $client->request('Post', 'api/Create_Seller', [
            'headers' => $headers,
            'form_params' => [
                'token' => 'Api_Create_cdefghijklmnopqrstuSeller_Souq_@_Simple_account',
                'Seller_id' => $done->Seller_id,
                'name' => $done->name
            ]
        ]);


    $client_update = new Client([
        // Base URI is used with relative requests
        'base_uri' => 'http://system.al-nawares.com/',
        'timeout'           => 500.0,
        // You can set any number of default request options.

    ]);

    $headers_update = [
        'Accept'        => 'application/json',
    ];
    $response = $client_update->request('Post', 'api/store/create-store', [
        'headers' => $headers_update,
        'form_params' => [
            'token' => 'MohamedFathy23@#',
            'client_id' => $data->id,
            'is_store' => '1'
        ]
    ]);

    Shiping_Token::create([
        'user_id'=> $data->id,
        'user_name'=>$data->email,

    ]);
}
        session()->flash('success', trans('admin.record_added'));
        return back();
    }
    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id) {
        //
    }
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit() {
       $token  =Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->first();
        return view('admin.shipping_token.edit', compact('token'));
    }
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request) {
        $data = $this->validate(request(),
            [
                'email'    => 'required|email',
            ], [], [
                'email'    => trans('admin.email'),

            ]);



        $client_update = new Client([
            // Base URI is used with relative requests
            'base_uri' => 'http://system.al-nawares.com/',
            'timeout'           => 500.0,
            // You can set any number of default request options.

        ]);

        $headers_update = [
            'Accept'        => 'application/json',
        ];
        $response = $client_update->request('Post', 'api/login', [
            'headers' => $headers_update,
            'form_params' => [
                'email' => $request->email,
                'password' => $request->password,
            ]
        ]);
        $json =  json_decode((string) $response->getBody());

        if ($json->success == true){
            $token =   $json->data->token;
        Shiping_Token::where('user_id',Auth::guard('admin')->user()->Seller_id)->update([
            'user_name'=>$request->email,
            'user_password'=>$request->password,
            'token'=>$token,

        ]);
        session()->flash('success', trans('admin.updated_record'));
        }else{
            session()->flash('error', trans('اسم المستخدم او كلمه المرور غير صحيحه'));

        }
        return redirect(aurl('Shipping_account'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

}