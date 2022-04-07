<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\Http\Controllers\Controller;


use App\Model\Billitems;
use App\Model\BillSource;
use App\Model\City;
use App\Model\Clients;
use App\Model\Colors;
use App\Model\Currencies;
use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\Inovice_status;
use App\Model\Invoicedeviceitems;
use App\Model\Invoicedevices;
use App\Model\Invoiceitems;
use App\Model\Invoices;
use App\Model\InvoiceSources;
use App\Model\Invoicespdf;
use App\Model\Items;
//use App\Model\ItemsColors;
//use App\Model\ItemsSize;
use App\Model\itemsColors;
use App\Model\ItemsSize;
use App\Model\ReturnedInvoices;
use App\Model\ReturnedInvoicesItems;
use App\Model\Sizes;
use App\Model\Specifications;
use App\Model\Subdevices;
use App\Model\Suppliers;
use App\Model\Currencyrates;
use App\Model\Token;
use Carbon\Carbon;
use GuzzleHttp\Client;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use League\Fractal\Resource\Item;
//use Milon\Barcode\DNS1D;
use \Milon\Barcode\DNS1D;
use phpDocumentor\Reflection\Types\Null_;
use Storage;
use Excel;
use Illuminate\Http\Request;
use Yajra\DataTables\Facades\DataTables;

//use Illuminate\Http\Request;
class InvoicesController extends Controller
{
    private function sub_item($q,$id){

        $gettoken = Token::find(2);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'content-type' => 'application/x-www-form-urlencoded',
        ];

        $body= [

            'Simple_account_id'=>$id,
            'qty'=>$q,
        ];
        $response = $client->request('post', 'api/Simple_accounting/products/check_item_sub/sub_q', [
            'headers' => $headers,
            'form_params' => $body
        ]);


    }
    public function index()
    {


        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $invoices = Invoices::with('invoiceSource')->orderBy('date','desc')->paginate(15);




        }else {

            $invoices = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('invoiceSource')->orderBy('date','desc')->paginate(15);


        }

        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        //$invoicesStatus = Inovice_status::get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.invoices.index',compact('invoices','temp'));
    }


    public function createdir(){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $cities = City::get();
            $clients    = Clients::get();
            $items      = Items::get();
            $itemsizes = ItemsSize::get();
            $itemscolors = itemsColors::get();
            $devices    = Devices::get();
            $shipping = City::get();
            $currencies = Currencies::get();
            $invoicesources    = InvoiceSources::get();
            $statement = DB::select("show table status like 'clients'");






        }else {


            $cities = City::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $clients    = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $items      = Items::where('quantity','!=',0)->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemsizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = itemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $devices    = Devices::get();
            $shipping = City::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $currencies = Currencies::get();
            $invoicesources    = InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $statement = DB::select("show table status like 'clients'");



        }

        $modelid =  $statement[0]->Auto_increment;

        return view('admin.invoices.cd',compact('shipping','items','clients','devices','currencies','invoicesources','modelid','itemsizes','itemscolors','cities'));
    }
    function getdata()
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $students = invoices::select('id', 'client_id', 'city');





        }else {

            $students = invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->select('id', 'client_id', 'city');


        }
        return Datatables::of($students)
            ->addColumn('action', function($student){
                return '<a href="#" class="btn btn-xs btn-primary edit" id="'.$student->id.'"><i class="glyphicon glyphicon-edit"></i> Edit</a><a href="#" class="btn btn-xs btn-danger delete" id="'.$student->id.'"><i class="glyphicon glyphicon-remove"></i> Delete</a>';
            })
            ->addColumn('checkbox', '<input type="checkbox" name="student_checkbox[]" class="student_checkbox" value="{{$id}}" />')
            ->rawColumns(['checkbox','action'])
            ->make(true);
    }
    function mainIndex(){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $cities = City::get();
            $clients = Clients::get();
            $users = Admin::get();


        }else {

            $cities = City::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $clients = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $users = Admin::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }

        $user_role_id = auth()->guard('admin')->User()->roles;


        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.invoices.mainIndex',compact('temp','cities','users','clients'));
    }
    public function search(Request $request){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $clients = Clients::pluck('name_client','id');
            $clients_phone = Clients::pluck('phone','id');
            $cities = City::pluck('name','id');
            $users = Admin::pluck('name','id');
            $invoicesStatus = Inovice_status::pluck('name','id');
            $user_id = Auth::guard('admin')->user()->id;
            $invoicesQuery = Invoices::with('Invoicespdf','clients')->where('validate',1)->orwhere('validate',null);
        }else {
            $clients = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->pluck('name_client','id');
            $clients_phone = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->pluck('phone','id');
            $cities = City::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->pluck('name','id');
            $users = Admin::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->pluck('name','id');
            $invoicesStatus = Inovice_status::pluck('name','id');
            $user_id = Auth::guard('admin')->user()->id;
            $invoicesQuery = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('Invoicespdf','clients');

        }



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
            //$this->export($invoicesQuery->get()->get());
            $this->exportInvoices($invoicesQuery->get()->get());
        }
        $invoices = $invoicesQuery->orderBy('date','desc')->paginate(20);
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.invoices.index',compact('invoices','temp','clients','invoicesStatus','cities','users','clients_phone'));
    }
    public function printInvoices(Request $request){


        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $invoicess = Invoices::get();
            $invoiceId = Invoices::pluck('id');
            //dd($invoicess);
            $invoiceitems = Invoiceitems::with('ItemColor','ItemSize')->whereIn('invoice_id',$invoiceId)->get();



        }else {
            $userId = Auth::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->guard('admin')->user()->role_id;
            $invoicess = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('user_id',$userId)->get();
            $invoiceId = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('user_id',$userId)->pluck('id');
            $invoiceitems = Invoiceitems::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('ItemColor','ItemSize')->whereIn('invoice_id',$invoiceId)->get();

        }

        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.invoices.printInvoices.index',compact('temp','invoiceitems','invoicess'));
    }
    function massremove(Request $request)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){




            $student_id_array = $request->input('id');
            $student = Invoices::whereIn('id', $student_id_array);

        }else {

            $student_id_array = $request->input('id');
            $student = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->whereIn('id', $student_id_array);

        }

        if($student->delete())
        {
            return redirect(aurl('mainIndex'));
        }
    }
    // Start GET ITEMS [Quantity , Price]
    public function getInvoices(Request $request){

        $invoice_id = $request->invoice_id ;

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $invoices = Invoices::whereIn('id',$invoice_id)->get();
            $invoiceitems = Invoiceitems::with('ItemColor','ItemSize')->whereIn('invoice_id',$invoice_id)->get();

        }else {
            $invoices = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->whereIn('id',$invoice_id)->get();
            $invoiceitems = Invoiceitems::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('ItemColor','ItemSize')->whereIn('invoice_id',$invoice_id)->get();

        }




        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.invoices.printInvoices.getInvoices',compact('invoices','temp','invoiceitems'));

    }
    public function InvoicesStatus(Request $request){
        $id = $request->id;
        $status_id = $request->status_id;
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $sub = Invoices::where('id',$id)
                ->update(['status_id'=>$status_id]);



        }else {
            $sub = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id',$id)
                ->update(['status_id'=>$status_id]);



        }


        return redirect(aurl('invoices'));

    }
    public function index2($id,Request $request){


        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $clients = Admin::get();
            $invoicesQuery = Invoices::with('Invoicespdf','clients')->where('user_id',$id);

        }else {

            $clients = Admin::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $invoicesQuery = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('Invoicespdf','clients')->where('user_id',$id);


        }

        if($request->name_client != ''){
            $invoicesQuery = $invoicesQuery->whereHas('clients', function ($query){
                {
                    $query->where('name_client', 'LIKE', '%' . request()->name_client . '%');
                }
            });
        }

        if($request->from != ''){
            $from = date("Y-m-d",strtotime($request->from));
            $invoicesQuery->where("date",">=",$from);
        }
        if($request->to != ''){
            $to = date("Y-m-d", strtotime($request->to));
            $invoicesQuery->where("date","<=",$to);
        }



        $invoices = $invoicesQuery->orderBy('date','desc')->paginate(20);



        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
        return view('admin.invoices.index',compact('invoices','temp','clients'));
    }
    public function itemsid( $id , Request $request){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $ItemsId = items::where('id',$id)->get();



        }else {

            $ItemsId = items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id',$id)->get();


        }
        if (!empty($ItemsId)) {

            return view("admin.invoices.mgza.getitem",compact('ItemsId','id'));
        }else{
            return "Undefined";
        }

    }
    public function getItemsQuantity( $item_id,$color_id ,$size_id, Request $request){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $specific = Specifications::where('item_id', $item_id)->where('size', $size_id)->where('color_id', $color_id)->pluck('quantity');



        }else {

            $specific = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id', $item_id)->where('size', $size_id)->where('color_id', $color_id)->pluck('quantity');


        }
        $ItemsId = $specific[0];
        return view("admin.invoices.mgza.getQuantity",compact('ItemsId'));

    }


    public function getItemsPrice( $item_id,$color_id,$size_id , Request $request){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $ItemAll = Specifications::where('item_id',$item_id)->where('color_id',$color_id)->where('size',$size_id)->pluck('selling_price');




        }else {
            $ItemAll = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id',$item_id)->where('color_id',$color_id)->where('size',$size_id)->pluck('selling_price');



        }
        $ItemsId = $ItemAll[0];
        if (!empty($ItemsId)) {
            return view("admin.invoices.mgza.getitem",compact('ItemsId','ItemAll'));
        }else{
            return "Undefined";
        }
    }

    // End GET ITEMS [Quantity , Price]


    public function createtwo(Request $request)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $clients    = Clients::get();
            $items      = Items::get();
            $itemsizes = ItemsSize::get();
            $itemscolors = ItemsColors::get();
            $devices    = Devices::get();
            $currencies = Currencies::get();
            $invoicesources    = InvoiceSources::get();


        }else {


            $clients    = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $items      = Items::where('quantity','!=',0)->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemsizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = ItemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $devices    = Devices::get();
            $currencies = Currencies::get();
            $invoicesources    = InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }

        $statement = DB::select("show table status like 'clients'");
        $modelid =  $statement[0]->Auto_increment;
        return view('admin.invoices.create2',compact('items','clients','devices','currencies','invoicesources','modelid','itemsizes','itemscolors'));
    }
    public function create(Request $request)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){




            $clients    = Clients::get();
            $items      = Items::get();
            $itemsizes = ItemsSize::get();
            $itemscolors = itemsColors::get();
            $devices    = Devices::get();
            $shipping = City::get();
            $currencies = Currencies::get();
            $invoicesources    = InvoiceSources::get();

        }else {


            $clients    = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $items      = Items::where('quantity','!=',0)->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemsizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = itemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $devices    = Devices::get();
            $shipping = City::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $currencies = Currencies::get();
            $invoicesources    = InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
        }
        $gettoken = Token::find(1);
        $client = new Client([
            'base_uri' => $gettoken->website,
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



        $statement = DB::select("show table status like 'clients'");
        $modelid =  $statement[0]->Auto_increment;

        return view('admin.invoices.create',compact('shipping','items','clients','devices','currencies','invoicesources','modelid','itemsizes','itemscolors','data'));
    }


    public function createRetured(Request $request)
    {





        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $clients = Clients::get();
            $cities = City::get();
            if($request->client_id){
                $client    = Clients::where('id',$request->client_id)->get();
            }else{
                $client    = Clients::where('id',$request->client_name)->get();
            }
            $nameofClient = $client[0]['name_client'];
            $IdofClient = $client[0]['id'];
            //dd($IdofClient);
            $items      = Items::get();
            $itemsizes = ItemsSize::get();
            $itemscolors = itemsColors::get();
            $devices    = Devices::get();
            $currencies = Currencies::get();
            $invoicesources    = InvoiceSources::get();




        }else {



            $clients = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $cities = City::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            if($request->client_id){
                $client    = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id',$request->client_id)->get();
            }else{
                $client    = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id',$request->client_name)->get();
            }
            $nameofClient = $client[0]['name_client'];
            $IdofClient = $client[0]['id'];
            //dd($IdofClient);
            $items      = Items::where('quantity','!=',0)->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemsizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = itemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $devices    = Devices::get();
            $currencies = Currencies::get();
            $invoicesources    = InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }
        $statement = DB::select("show table status like 'clients'");
        $modelid =  $statement[0]->Auto_increment;
        return view('admin.invoices.createRetured',compact('items','clients','invoices','devices','currencies','invoicesources','modelid','itemsizes','itemscolors','nameofClient','IdofClient','cities'));
    }
    public function addInvoice(Request $request)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $clients    = Clients::get();
            $items      = Items::get();
            $itemsizes = ItemsSize::get();
            $itemscolors = itemsColors::get();
            $devices    = Devices::get();
            $currencies = Currencies::get();
            $invoicesources    = InvoiceSources::get();



        }else {


            $clients    = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $items      = Items::where('quantity','!=',0)->where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemsizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $itemscolors = itemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $devices    = Devices::get();
            $currencies = Currencies::get();
            $invoicesources    = InvoiceSources::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();

        }

        $statement = DB::select("show table status like 'clients'");
        $modelid =  $statement[0]->Auto_increment;
        return view('admin.invoices.add',compact('items','clients','invoices','devices','currencies','invoicesources','modelid','itemsizes','itemscolors'));
    }



    public function store(Request $request)
    {

        //    $data = request()->validate(
        //        [

        //             'u_size'              => 'required',
        //             'u_quantity'         => 'required',
        //              'u_price'            => 'required',
        //        ], [], [
        //    ]);



        $data = request()->except(['_token', '_method']);



        if($request->hasfile('pdf'))
        {

            foreach($request->file('pdf') as $file)
            {
                $name= rand(1,1000 ).time().'-'.$file->getClientOriginalName() ;
                $file->move(public_path().'/upload/invoices/', $name);
                $dataa[] = $name;
            }
        }
        if(empty($request->file('pdf'))){
            $dataa='';
        }
        $user_id = Auth::guard('admin')->user()->id;

        $mytime = Carbon::now();
        $date = $mytime->toDateTimeString();
        $today = date("Y/m/d",strtotime($date));
        $imageName = str_random(10).'.'.'png';

        $cname = '';
        $cemail = '';
        $cphone = '';
        $cnotes = '';
        $cpass = '';
        $ccountry = '';
        $cpostal = '';
        $ccity ='';
        $shipping = '';
        if($request->invoice_type == '1'){
            $mytime = Carbon::now();
            $date = $mytime->toDateTimeString();
            $today = date("Y/m/d",strtotime($date));
            $imageName = str_random(10).'.'.'png';
            $provider_id = 111;
            $provider_type = 111;
            $cname = 'فاتورة بيع مباشر';
            $ccity ='فاتورة بيع مباشر';
            $cemail = 'فاتورة بيع مباشر';
            $cphone = 'فاتورة بيع مباشر';
            $cnotes = 'فاتورة بيع مباشر';
            $cpass = 'فاتورة بيع مباشر';
            $ccountry = 'فاتورة بيع مباشر';
            $cpostal = 'فاتورة بيع مباشر';
            $invoiceItems = Clients::create([
                'name_client'                => 'فاتورة بيع مباشر',
                'city'                       => 'فاتورة بيع مباشر',
                'notes'                      => 'فاتورة بيع مباشر',
                'phone'                      => 'فاتورة بيع مباشر',
                'provider_id'           =>$provider_id,

                'provider_type'        => $provider_type,
                'email'=>'فاتورة بيع مباشر',
                'password'=>'فاتورة بيع مباشر',
                'postalCode'=>'فاتورة بيع مباشر',
                'country'=>'فاتورة بيع مباشر'
            ]);

            $invoices = Invoices::create([
                // dd($request->get()),
                'invoice_number'        => $request->invoice_number,
                'savedraft'             => $request->savedraft,
                'client_id'             => $request->client_id,
                'date'                  => $today,
                'Seller_id'                  => Auth::guard('admin')->user()->Seller_id,
                'city'                  => 'فاتورة بيع مباشر',
                'discount'              => 0,
                'shipping_costs'        => 0,
                'afterdiscount'         => 0,
                'area_id'  => '0',
                'branch_id'  => '0',

                'invoice_source_id'     =>  $request->invoice_source_id,
                'barcode'               => $imageName,
                'user_id'               => $user_id,
                'Seller_id'               => Auth::guard('admin')->user()->Seller_id,

                'currency_id'           => round($request->currency_id,2),
                'notes'                 => $request->notes,
                'total_final_mgza'      => round(($request->total_final_mgza),2),
                'total_final_mogma3'    => round(($request->total_final_mogma3),2),
                'direct'                => $request->invoice_type,
                'total_invoice'         => round(($request->total_invoice = $request->total_final_mgza + $request->total_final_mogma3),2),]);



        }else{
            $invoiceItems = Clients::create([
                'name_client'                => $request->name_client,
                'city'                       => $request->city,
                'notes'                      => $request->notes_client,
                'mobile'                      => $request->phone,
                'Seller_id'                  => Auth::guard('admin')->user()->Seller_id,

                'email'=>$request->email,
                'password'=>$request->password,
                'postalCode'=>$request->postal,
                'country'=>$request->country
            ]);

            $invoices = Invoices::create([
                // dd($request->get()),
                'invoice_number'        => $request->invoice_number,
                'savedraft'             => $request->savedraft,
                'client_id'             => $request->client_id,
                'date'                  => $today,
                'city'                  => $ccity,
                'address'                  => $request->notes_client,
                'area_id'  => $request->area_id,
                'branch_id'  => $request->city,
                'discount'              => $request->discount,
                'shipping_costs'        => $request->shipping_costs,
                'afterdiscount'         => $request->afterdiscount,
                'invoice_source_id'     => $request->invoice_source_id,
                'barcode'               => $imageName,
                'user_id'               => $user_id,
                'Seller_id'                  => Auth::guard('admin')->user()->Seller_id,

                'currency_id'           => round($request->currency_id,2),
                'notes'                 => $request->notes,
                'total_final_mgza'      => round(($request->total_final_mgza),2),
                'total_final_mogma3'    => round(($request->total_final_mogma3),2),
                'direct'                => $request->invoice_type,
                'total_invoice'         => round(($request->total_invoice = $request->total_final_mgza + $request->total_final_mogma3),2),]);

        }



        //End Save Image Barcode
        if(!empty($request->pdf)) {
            foreach ($dataa as $key => $item) {
                $invoicesPDF = Invoicespdf::create([
                    'id_invoices' => $invoices->id,
                    'pdf' => $item,
                ]);
            }
        }
        if(!empty($request->item_id)) {
            //dd($request->quantity);
            foreach ($request->item_id as $key => $value) {

                if ($request->color[$key] != "20"){
                    foreach ($request->u_size[$value][$request->color[$key]] as $key_size => $size_id){
                        $invoiceItems = Invoiceitems::insert([
                            'invoice_id' => $invoices->id,
                            'item_id' => $value,
                            'color' => $request->color[$key],
                            'size' => $size_id,
                            'quantity_b' => $request->u_quantity[$value][$request->color[$key]][$key_size],
                            'price_b' => round($request->u_price[$value][$request->color[$key]][$key_size], 2),
                            'total_price_b' => round($request->total_price_b[$key_size], 2),
                        ]);
                        if ($request->savedraft == 1) {
                            if ($item = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($value)) {
                                $this->sub_item($request->u_quantity[$value][$request->color[$key]][$key_size],$value);
                                $item->quantity -= $request->u_quantity[$value][$request->color[$key]][$key_size];
                                $item->save();
                            }
                            $color = $request->input('color')[$key];
                            $idSpecific = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id', $item->id)->where('size', $size_id)->where('color_id', $color)->pluck('id');
                            if ($specific = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($idSpecific)->first()) {

                                $specific->quantity -= $request->u_quantity[$value][$request->color[$key]][$key_size];
                                //dd($specific);
                                $specific->save();
                            }
                        }
                    }
                }else{
                    $invoiceItems = Invoiceitems::insert([
                        'invoice_id' => $invoices->id,
                        'item_id' => $value,
                        'color' => $request->color[$key],
                        'size' => 27,
                        'quantity_b' => $request->quantity[$key],
                        'price_b' => round($request->price[$key], 2),
                        'total_price_b' => round($request->quantity[$key]*$request->price[$key], 2),
                    ]);
                    if ($request->savedraft == 1) {
                        if ($item = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($value)) {
                            $this->sub_item($request->quantity[$key],$value);

                            $item->quantity -= $request->quantity[$key];
                            $item->save();
                        }
                        $color = $request->input('color')[$key];
                        $idSpecific = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id', $item->id)->where('size', 27)->where('color_id', $color)->pluck('id');
                        if ($specific = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->find($idSpecific)->first()) {
                            $specific->quantity -= $request->quantity[$key];
                            //dd($specific);
                            $specific->save();
                        }
                    }
                }

            }
        }




        if($request->savedraft == 1){
            $this->subtract($invoices->id);
        }
        session()->flash('success', trans('admin.record_added'));
        return redirect(url('admin/invoices'));

    }
    public function changestatues(Request $request)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $mytime = Carbon::now();
            $date = $mytime->toDateTimeString();
            $today = date("Y-m-d",strtotime($date));
            $invoices = Invoices::findOrFail($request->id);
            $invoices['status_id'] = $request->status_id;
            $invoices['updated_at'] = $today;
            $invoices->save();


        }else {

            $mytime = Carbon::now();
            $date = $mytime->toDateTimeString();
            $today = date("Y-m-d",strtotime($date));
            $invoices = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($request->id);
            $invoices['status_id'] = $request->status_id;
            $invoices['updated_at'] = $today;
            $invoices->save();

        }

        return redirect(aurl('invoices'));
    }



    public function savedraftTosave(Request $request)
    {

        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $mytime = Carbon::now();
            $date = $mytime->toDateTimeString();
            $today = date("Y-m-d",strtotime($date));
            $invoices = Invoices::findOrFail($request->id);
            $invoices['savedraft'] = 1;
            $invoices['updated_at'] = $today;
            $invoices->save();
            $Invoiceitems = Invoiceitems::where('invoice_id',$request->id)->get();

        }else {



        }


        foreach ($Invoiceitems as $key => $invoiceitem)
        {
            $dataitems['invoice_id']            = $request->id;
            $dataitems['item_id']               = $invoiceitem->item_id;
            $dataitems['quantity_b']            = $invoiceitem->quantity_b;
            $dataitems['price_b']               = $invoiceitem->price_b;
            $dataitems['total_price_b']         = $invoiceitem->total_price_b;

            if($item = Items::find($invoiceitem->item_id)){
                $item->quantity -= $invoiceitem->quantity_b;
                $item->save();
            }
        }

        $Invoicedeviceitems = Invoicedeviceitems::where('invoice_id',$request->id)->get();


        foreach ($Invoicedeviceitems as $key => $items) {
            $dataddeviceitems['invoice_id']                = $request->id;
            $dataddeviceitems['device_id']              = $items->device_id;
            $dataddeviceitems['item_id_devices']        = $items->item_id_devices;
            $dataddeviceitems['quantity_devices']       = $items->quantity_devices;
            $dataddeviceitems['price_devices']          = $items->price_devices;
            $dataddeviceitems['total_devices']          = $items->total_devices;

        }
        $this->subtract($request->id);

        return redirect(aurl('invoices'));
    }
    public  function subtract($id){

        $subtracts = Invoicedeviceitems::where('invoice_id',$id)->get();
        foreach ($subtracts as  $key => $subtract){

            $items              = Items::where('id',$subtract->item_id_devices)->value('quantity');
            $subtractitems      = $items - $subtract->quantity_devices    ;
            $sub                = Items::where('id',$subtract->item_id_devices)
                ->update(['quantity'=>$subtractitems]);

        }
    }


    public function Addtaxi(Request $request){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $invoice = Invoices::findOrFail($request->id);
            $invoice->taxes = round($invoice->total_invoice +($invoice->total_invoice * (14/100)),2);
            $invoice->save();



        }else {
            $invoice = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($request->id);
            $invoice->taxes = round($invoice->total_invoice +($invoice->total_invoice * (14/100)),2);
            $invoice->save();


        }

        session()->flash('success', trans('admin.taxs'));
        return back();

    }




    public function edit($id)
    {

        $invoices       = Invoices::find($id);
        $invoicesStatus = Inovice_status::get();
        $cities = City::get();
        $currencies     = Currencies::get();
        $itemsizes = ItemsSize::get();
        //$itemSizes      = Specifications::with('specificsize')->get();
        //dd($itemSizes);
        $invoicess      = Invoiceitems::with('invoices')->where('invoice_id',$id)->get();
        // $afterdis       = $invoicess[0]['afterdiscount'];
        $devices        = Devices::get();
        $items          = Items::get();
        $itemsizes      = ItemsSize::get();
        $itemscolors    = ItemsColors::get();
        $clients        = Clients::get();
        $invoiceitems   = Invoiceitems::where('invoice_id',$invoices->id)->get();

        $invoiceId = $invoices->id;
        $invoicedevices  = Invoicedevices::where('invoice_id', $invoiceId)->with(['Invoicedeviceitems' => function ($query) use ($invoiceId){
            $query->where('invoice_id', $invoiceId);
        }])->get();
        $invoicesources    = InvoiceSources::get();
        $invoicedeviceitems   = Invoicedeviceitems::with('Deviceitems')->where('invoice_id',$invoices->id)->get();

        return view('admin.invoices.edit', compact('invoices', 'title','suppliers','items','devices','currencies','clients','invoiceitems','invoicedevices','invoicedeviceitems','invoicesources','itemsizes','itemscolors','afterdis','itemSizes','itemsizes','invoicesStatus','cities'));
    }

    public function update(Request $request, $id)
    {

        $data = request()->validate(
            [
                //'invoice_number' => 'required',
                'date'             => '',
                'discount'         => '',
                'client_id'        => '',
                'afterdiscount'       => '',
                'city'             => '',
                'color'               => 'required',
                'size'                => '',
                'invoice_source_id'   => 'required',
                'shipping_costs'   => '',

            ], [], [
            //'invoice_number'  => trans('invoices.invoice_number'),
            'date'              => trans('invoices.date'),
            'discount'          => trans('invoices.discount'),
            'client_id'         => trans('invoices.client_id'),
            'afterdiscount'     => trans('invoices.afterdiscount'),
            'city'              => trans('invoices.city'),
            'color'              => trans('invoices.color'),
            'size'              => trans('invoices.size'),
//            'invoice_source_id'    => trans('invoices.bill_source'),
            'shipping_costs'    => trans('invoices.shipping_costs'),
        ]);

        $data = request()->except(['_token', '_method']);
        $imageName = str_random(10).'.'.'png';
        $user_id = Auth::guard('admin')->user()->id;
        $invoices       = Invoices::find($id);
        //$invoices->invoice_number = $request->invoice_number;
        $invoices->savedraft = 0;

//Strart Save Image Barcode




        //End Save Image Barcode
        // $invoices->barcode = $imageName;
        $invoices->client_id = $request->client_id;
        //$invoices->date = $request->date;
        $invoices->discount = $request->discount;
        $invoices->city = $request->city;
        $invoices->afterdiscount = $request->afterdiscount;
        $invoices->shipping_costs = $request->shipping_costs;
        $invoices->invoice_source_id = '8';
        $invoices->currency_id = round(($request->currency_id),2);
        $invoices->notes = $request->notes;
        $invoices->user_id = $user_id;
        $invoices->status_id = $request->status_id;
        $invoices->total_final_mgza = round(($request->total_final_mgza),2);
        $invoices->total_final_mogma3 = round(($request->total_final_mogma3),2);
        $invoices->total_invoice = round(($request->total_invoice = $request->total_final_mgza + $request->total_final_mogma3),2);


        $invoices->save();

        $deletedRows = Invoiceitems::where('invoice_id', $invoices->id)->delete();
        if(!empty($request->item_id)){
            foreach ($request->item_id as $key => $item){
                $invoiceItems = Invoiceitems::create([
                    'invoice_id'                        => $invoices->id,
                    'item_id'                           => $item,
                    'quantity_b'                        => $request->quantity_b[$key],
                    'color'                             => $request->input('color')[$key],
                    'size'                              => $request->input('u_size')[$request->input('color')[$key]][$key],
                    'price_b'                           => round(($request->price_b[$key]),2),
                    'total_price_b'                     => round(($request->total_price_b[$key]),2),
                ]);

            }
        }
        $deletedRows = Invoicedevices::where('invoice_id', $invoices->id)->delete();
        $deletedRows = Invoicedeviceitems::where('invoice_id', $invoices->id)->delete();

        if (!empty($request->devices)){
            foreach ($request->devices as $device_id => $device)
            {
                // single device
                $invoiceDevices = Invoicedevices::create([
                    'invoice_id'                    => $invoices->id,
                    'device_id'                     => $device['device_id'],
                    'quantity'                      => $device['device_quantity'],
                    'onedevice'                     => round($device['device_price'],2),
                    'total_price'                   => round($device['device_total_price'],2),
                ]);
                foreach ($device['device_items'] as $item_id => $item) {
                    $InvoiceDeviceItems = Invoicedeviceitems::create([
                        'invoice_id'        => $invoices->id,
                        'device_id'         => $device['device_id'],
                        'item_id_devices'   => $item['id'],
                        'quantity_devices'  => round((($device['device_quantity'] * $item['qu'])), 2),
                        'quantity_old'      => round((($item['quantity_old'])), 2),
                        'price_devices'     => round(($item['p']), 2),
                        'total_devices'     => round(($device['device_quantity'] * $item['qu'] * $item['p']), 2),
                    ]);
                }
            }
        }




        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('invoices'));
    }


    public function destroy($id)
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $this->DeleteBill($id);
            $this->DeleteSpecific($id);
            Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();


        }else {
            $this->DeleteBill($id);
            $this->DeleteSpecific($id);
            Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id)->delete();


        }

        session()->flash('success', trans('admin.deleted_record'));
        return redirect(aurl('invoices'));
    }
    //Delete Bill
    public  function DeleteBill($id){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $ReturnedInvoices = ReturnedInvoices::where('invice_id',$id)->get()->pluck('id');

            $ReturnedInvoicesItems  = ReturnedInvoicesItems::whereIn('invoice_id',$ReturnedInvoices)->sum('quantity_b');
            //dd($ReturnedInvoicesItems);
            $invoiceitems = Invoiceitems::where('invoice_id',$id)->get();
            foreach ( $invoiceitems as $invoiceitem)
            {
                $getitem = Items::where('id',$invoiceitem->item_id)->value('quantity');
                $sub = $getitem + $invoiceitem->quantity_b  - $ReturnedInvoicesItems ;

                $updatequantiy = Items::where('id',$invoiceitem->item_id)->update(['quantity'=>$sub]);

                //Invoiceitems::find($invoiceitem->id)->delete();

            }

            $Invoicespdf = Invoicespdf::where('id_invoices',$id)->get();
            foreach ($Invoicespdf as $value2)
            {
                Invoicespdf::find($value2->id)->delete();
            }





        }else {



            $ReturnedInvoices = ReturnedInvoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('invice_id',$id)->get()->pluck('id');

            $ReturnedInvoicesItems  = ReturnedInvoicesItems::whereIn('invoice_id',$ReturnedInvoices)->sum('quantity_b');
            //dd($ReturnedInvoicesItems);
            $invoiceitems = Invoiceitems::where('invoice_id',$id)->get();
            foreach ( $invoiceitems as $invoiceitem)
            {
                $getitem = Items::where('id',$invoiceitem->item_id)->value('quantity');
                $sub = $getitem + $invoiceitem->quantity_b  - $ReturnedInvoicesItems ;

                $updatequantiy = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id',$invoiceitem->item_id)->update(['quantity'=>$sub]);

                //Invoiceitems::find($invoiceitem->id)->delete();

            }

            $Invoicespdf = Invoicespdf::where('id_invoices',$id)->get();
            foreach ($Invoicespdf as $value2)
            {
                Invoicespdf::find($value2->id)->delete();
            }


        }


    }
    public  function DeleteSpecific($id){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $invoices = ReturnedInvoices::where('invice_id',$id)->get()->pluck('id');

            $ReturnedInvoicesItems  = ReturnedInvoicesItems::whereIn('invoice_id',$invoices)->sum('quantity_b');
            $invoiceitems = Invoiceitems::where('invoice_id',$id)->get();




        }else {
            $invoices = ReturnedInvoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('invice_id',$id)->get()->pluck('id');

            $ReturnedInvoicesItems  = ReturnedInvoicesItems::whereIn('invoice_id',$invoices)->sum('quantity_b');
            $invoiceitems = Invoiceitems::where('invoice_id',$id)->get();



        }

        foreach ( $invoiceitems as $invoiceitem)
        {
            $getitem = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id',$invoiceitem->item_id)->where('color_id',$invoiceitem->color)
                ->where('size',$invoiceitem->size)->value('quantity');

            $sub = $getitem + $invoiceitem->quantity_b - $ReturnedInvoicesItems  ;
            $updatequantiy = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id',$invoiceitem->item_id)->where('color_id',$invoiceitem->color)
                ->where('size',$invoiceitem->size)->update(['quantity'=>$sub]);

            Invoiceitems::find($invoiceitem->id)->delete();

        }

    }



    public function show($id=null, $from_cur = null, $to_cur = null){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $invoices = Invoices::with('clients','currencies')->find($id);
            $invoiceitems         = Invoiceitems::with('items')->where('invoice_id',$id)->get();
            $invoicedevices       = Invoicedevices::with('devices')->where('invoice_id',$id)->get();
            $invoicedeviceitems   = Invoicedeviceitems::with('items')->where('invoice_id',$id)->get();
            $itemSizes = Specifications::with('specificsize')->get();
            $billsize = ItemsSize::get();
            $cities = City::where('name',$invoices->city)->value('shipping');
            @$currencies           = Currencies::where('id', '!=', $invoices->currency_id)->get();
            $currencyrates        = Currencyrates::get();
            $rate                 = $this->cur($id, $from_cur, $to_cur);
            $items                = Items::get();


        }else {
            $invoices = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('clients','currencies')->find($id);
            $invoiceitems         = Invoiceitems::with('items')->where('invoice_id',$id)->get();
            $invoicedevices       = Invoicedevices::with('devices')->where('invoice_id',$id)->get();
            $invoicedeviceitems   = Invoicedeviceitems::with('items')->where('invoice_id',$id)->get();
            $itemSizes = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->with('specificsize')->get();
            $billsize = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $cities = City::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('name',$invoices->city)->value('shipping');
            @$currencies           = Currencies::where('id', '!=', $invoices->currency_id)->get();
            $currencyrates        = Currencyrates::get();
            $rate                 = $this->cur($id, $from_cur, $to_cur);
            $items                = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();


        }



        return view("admin.invoices.show",compact('cities','billsize','invoices','invoiceitems','rate','currencies','invoicedevices','items','invoicedeviceitems','currencyrates','itemSizes'));
    }

    public function cur($id = null, $from_cur = null, $to_cur = null){
        @$rate = Currencyrates::where('currency_id',$from_cur)->where('to_currency_id',$to_cur)->first();

        // @$invoices = Invoices::with('clients')->find($id);
        // @$final = $curammout->currency_ammount * $invoices->total_invoice;
        //dd($final);
        return $rate;

    }


    public function export($data)
    {
        if(!empty($data)){
            if($data[0]['name_client'] != ''){
                $invoicesData = [];
                foreach($data as $item){
                    $clients = Clients::where('id',$item->client_id)->get();
                    $invoiceItem = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->get();
                    $colorItems = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->pluck('color');
                    $sizeItems = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->pluck('size');
                    $Items = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->pluck('item_id');
                    $itemsContent = Items::where('id',$Items)->get();
                    $count = count($item);
                    $colors = ItemsColors::where('id',1)->get();
                    $size = ItemsSize::where('id',2)->get();
                    foreach ($clients as $client){
                        for($i = 0 ; $i < $count ; $i++){
                            $invoicesData[] = [
                                trans('invoices.invoices_number')      => $item->id,
                                trans('invoices.item_name')            => $itemsContent[$i]['item_name'],
                                trans('invoices.quantity')             => $invoiceItem[$i]['quantity_b'],
                                trans('invoices.price')                => $invoiceItem[$i]['price_b'],
                                trans('invoices.color')                => $colors[$i]['name'],
                                trans('invoices.size')                 => $size[$i]['name'],
                                trans('invoices.date')                 => date("Y/m/d",strtotime($item->created_at)),
                                trans('invoices.client_id')            => $item->clients->name_client,
                                trans('invoices.city')                 => $item->clients->city,
                                trans('invoices.phone')                => $item->clients->phone,
                                trans('invoices.total_invoice')        => $item->total_invoice,
                                trans('invoices.notes')                => $item->notes,
                            ];
                        }

                    }

                }
                if(count($invoicesData) > 0){
                    Excel::create("تصدير فواتير البيع(".date("d-M-Y").")", function($excel) use($invoicesData) {
                        $excel->sheet('sheet1', function($sheet) use($invoicesData) {
                            $sheet->fromArray($invoicesData);

                            $sheet->cell('A1:F1',function($cell){
                                $cell->setBackground('#e8e8e8');
                                $cell->setFontWeight('bold');
                            });
                        });

                    })->export('xls');
                }
            }else{
                //dd($data);
                //$invoicesData = [];
                foreach($data as $item){

                    $invoiceitems         = Invoiceitems::with('items')->where('invoice_id',$item->id)->get();

                    $clients = Clients::where('id',$item->client_id)->get();

                    $invoiceItem = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->get();
                    $colorItems = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->pluck('color');
                    $sizeItems = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->pluck('size');
                    $Items = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->pluck('item_id');

                    $itemsContent = Items::where('id',$Items)->get();
                    $count = count($item);
                    $count2 = count($data);
                    //dd($count);
                    $colors = ItemsColors::where('id',$colorItems)->get();
                    $size = ItemsSize::where('id',$sizeItems)->get();

                    foreach ($clients as $client){
                        for($i = 0 ; $i < $count ; $i++){
                            $invoicesData[] = [
                                trans('invoices.invoices_number')      => $item->id,
                                trans('invoices.item_name')            => $itemsContent[$i]['item_name'],
                                trans('invoices.quantity')             => '',
                                trans('invoices.price')                => '',
                                trans('invoices.color')                => '',
                                trans('invoices.size')                 => '',
                                trans('invoices.date')                 => date("Y/m/d",strtotime($item->created_at)),
                                trans('invoices.client_id')            => $client->name_client,
                                trans('invoices.city')                 => $client->city,
                                trans('invoices.address')                 => $client->notes,
                                trans('invoices.phone')                => $client->phone,
                                trans('invoices.total_invoice')        => $item->total_invoice,
                                trans('invoices.notes')                => $item->notes,
                            ];
                            $invoiceitems         = Invoiceitems::with('items')->where('invoice_id',$item->id)->get();
                            $from = Invoiceitems::where('item_id',$invoiceitems)->get();
                            //dd($invoiceitems[0]['quantity_b']);
                            foreach ($invoiceitems as $invoiceitem){

                                //dd($invoiceitem);
                                $invoicesData[] = [
                                    trans('invoices.invoices_number')      => '',
                                    trans('invoices.item_name')            => $itemsContent[$i]['item_name'],
                                    trans('invoices.quantity')             => $invoiceitem[$i]['quantity_b'],
                                    trans('invoices.price')                => $invoiceitem[$i]['price_b'],
                                    trans('invoices.color')                => $colors[$i]['name'],
                                    trans('invoices.size')                 => $size[$i]['name'],
                                    trans('invoices.date')                 => '',
                                    trans('invoices.client_id')            => '',
                                    trans('invoices.city')                 => '',
                                    trans('invoices.address')              => '',
                                    trans('invoices.phone')                => '',
                                    trans('invoices.total_invoice')        => '',
                                    trans('invoices.notes')                => '',
                                ];
                            }

                        }

                    }
                }

                if(count($invoicesData) > 0){
                    Excel::create("تصدير فواتير البيع(".date("d-M-Y").")", function($excel) use($invoicesData) {
                        $excel->sheet('sheet1', function($sheet) use($invoicesData) {
                            $sheet->fromArray($invoicesData);

                            $sheet->cell('A1:F1',function($cell){
                                $cell->setBackground('#e8e8e8');
                                $cell->setFontWeight('bold');
                            });
                        });

                    })->export('xls');
                }
            }
        }
        else{
            return redirect(aurl('invoices'));
        }

    }

    public function exportInvoices($data)
    {
        //dd('dd');
        //dd($data[0]['user_id']);
        //if(Auth::guard('admin')->user()->id == $invoice->user_id OR Auth::guard('admin')->user()->role_id == 1)

        if(!empty($data)){
            $invoices = Invoices::with('invoiceItem')->orderBy("id","DESC")->get();
            $invoicesData = [];
            foreach($data as $item){
                $invoicesitems = Invoiceitems::with('ItemColor','ItemSize')->where('invoice_id',$item->id)->get();
                $names ='';
                $quantities ='';
                $prices ='';
                $colors ='';
                $sizes ='';
                $billsize = ItemsSize::get();

                //  dd($invoicesitems);
                foreach ($invoicesitems as $invoiceItem){

                    $names.= $invoiceItem->items->item_name . ',';
                    $quantities.= $invoiceItem->quantity_b . ',';
                    $prices.= $invoiceItem->total_price_b . ',';
                    $colors.= $invoiceItem->Colors->name . ',';


                    foreach($billsize as $itemsize){
                        if($itemsize->id == $invoiceItem->size){
                            $sizes.=  $itemsize->name . ',';
                        }
                    }

                }

                $names = substr_replace($names, "", -1);
                $quantities = substr_replace($quantities, "", -1);
                $prices = substr_replace($prices, "", -1);
                $colors = substr_replace($colors, "", -1);
                $sizes = substr_replace($sizes, "", -1);
                $invoicesData[] = [
                    trans('invoices.invoices_number')      => $item->id,
                    trans('invoices.date')                 => date("Y/m/d",strtotime($item->created_at)),
                    trans('clients.name_client')           => $item->clients->name_client,
                    trans('clients.phone')                 => $item->clients->phone,
                    trans('clients.city')                  => $item->clients->city,
                    trans('clients.notes')                 => $item->clients->notes,
                    trans('invoices.total_invoice')        => $item->total_invoice,
                    trans('invoices.notes')                => $item->notes,
                    trans('invoices.item_name')            => $names,
                    trans('invoices.quantity')             => $quantities,
                    trans('invoices.price')                => $prices,
                    trans('invoices.color')                => $colors,
                    trans('invoices.size')                 => $sizes,
                ];

            }

            if(count($invoicesData) > 0){
                Excel::create("تصدير فواتير البيع(".date("d-M-Y").")", function($excel) use($invoicesData) {
                    $excel->sheet('sheet1', function($sheet) use($invoicesData) {
                        $sheet->fromArray($invoicesData);

                        $sheet->cell('A1:F1',function($cell){
                            $cell->setBackground('#e8e8e8');
                            $cell->setFontWeight('bold');
                        });
                    });

                })->export('xls');
            }
        }else{
            //dd('dd');
            return redirect(aurl('invoices'));
        }

    }

# Start GET Device [price,Quantity]#
    public function sumDevices($id,Request $request){

        $DeviceId = Deviceitems::with('items')->where('devices_id',$id)->get();

        $sbudevic = Subdevices::where('device_id',$id)->pluck('subdevice_id');
        $sbudevicz = Subdevices::where('device_id',$id)->get();
        $ItemsId = items::where('id',$id)->get();




        if (!empty($DeviceId)) {
            if(!empty($sbudevicz[0])){
                $subid = Deviceitems::with('items')->wherein('devices_id',$sbudevic)->get();

                return view("admin.invoices.mogma3.sumDevicesIndex",compact('DeviceId','id','subid','sbudevicz','ItemsId'));

            }
            return view("admin.invoices.mogma3.sumDevicesIndex",compact('DeviceId','id','sbudevicz'));

        }else{
            return "Undefined";
        }
    }
    public function sumDevicesQuantity($id,Request $request){


        $devices = Devices::with('Subdevice','deviceitems')->where('id',$id)->get();
        //dd($devices);

        foreach ($devices as $device){
            $itemsMin = $this->getcount($device->id);
            $subDevicesMin = [];
            $devicMin = 0;
            if(count($device->subdevice) > 0){
                foreach ($device->subdevice as $d){
                    $subDevicesMin[] = $this->getcount($d->id);
                }

            }
            if(!empty($subDevicesMin)){
                $devicMin = min($itemsMin, min($subDevicesMin));
            }else{
                $devicMin = $itemsMin;
            }
            $dd = Devices::where('id',$device->id)->update(['quantity'=>$devicMin]);

            //echo $device->id.'  '.$devicMin.'<br>';
        }


        if (!empty($devices)) {
            return view("admin.invoices.mogma3.sumDevicesQuantity",compact('devices'));

        }else{
            return "Undefined";
        }
    }
    public static function getcount($id = null){

        $device = Devices::with('Subdevice','deviceitems')->find($id);

        $devic_items = Deviceitems::where("devices_id", $id)->get();

        $Arrays = [];
        foreach ($devic_items as $item)
        {
            $itemQty = Items::where("id", $item->item_id)->value('quantity');
            //dd($item->number_items);
            $Arrays[] =  floor($itemQty /  $item->number_items);
        }
        //Sub Devices

        # items min
        return empty($Arrays) ? 0 : min($Arrays);

        //$dd = Devices::where('id',$id)->update(['quantity'=>$min]);
//    echo $id.' '.$min."<br>";
//        return false;


    }

#END GET Device [price,Quantity]#

// Start PDF //
    public function getPdf($id){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $Invoicespdfs      = Invoicespdf::where('id_invoices',$id)->orderBy('created_at','desc')->paginate(30);

        }else {


            $Invoicespdfs      = Invoicespdf::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id_invoices',$id)->orderBy('created_at','desc')->paginate(30);

        }
        return view("admin.invoices.pdf.show",compact('Invoicespdfs','id'));
    }
    public function createGetPdf( $id = null ){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $Invoicespdfs      = Invoicespdf::where('id_invoices',$id)->first();
            $invoices       = Invoices::find($id);



        }else {

            $Invoicespdfs      = Invoicespdf::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('id_invoices',$id)->first();
            $invoices       = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);

        }

        return view("admin.invoices.pdf.create",compact('Invoicespdfs','id','invoices'));
    }
    public function createStatus( $id ,Request $request){
        //dd($id);
        if ($status = Invoices::find($id)->first()) {
            //dd($status);
            $status->status_id = $request->status_id;
            //dd($request->status_id);
            $status->save();
        }
        return redirect(aurl('invoices'));
    }
    public function stoneGetPdf($id,request $request){
        $data = $this->validate(request(),
            [
                'pdf' => 'required',
            ], [], [

                'pdf' => trans('clients.name_company'),

            ]);
        $data = request()->except(['_token', '_method']);

        foreach($request->file('pdf') as $file)
        {
            $name= rand(1,1000 ).time().'-'.$file->getClientOriginalName() ;
            $file->move(public_path().'/upload/invoices/', $name);
            $dataa[] = $name;
        }

        if(empty($request->file('pdf'))){
            $dataa='';
        }

        if(!empty($request->pdf)) {
            foreach ($dataa as $key => $item) {
                $invoicesPDF = Invoicespdf::create([
                    'id_invoices' => $request->id_invoices,
                    'pdf' => $item,
                ]);
            }
        }
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('invoices/getpdf/')."/".$invoicesPDF->id_invoices);

    }
    public function editgetPdf($id){
        if (Auth::guard('admin')->user()->Seller_id == 0 ){

            $Invoicespdfs      = Invoicespdf::findOrFail($id);

        }else {

            $Invoicespdfs      = Invoicespdf::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->findOrFail($id);


        }
        return view("admin.invoices.pdf.edit",compact('Invoicespdfs'));
    }
    public function updateGetPdf($id,request $request){
        $data = $this->validate(request(),
            [
                'pdf' => 'required',
            ], [], [

                'pdf' => trans('clients.name_company'),

            ]);
        $data = request()->except(['_token', '_method']);

        foreach($request->file('pdf') as $file)
        {
            $name= rand(1,1000 ).time().'-'.$file->getClientOriginalName() ;
            $file->move(public_path().'/upload/invoices/', $name);
            $dataa[] = $name;
        }

        if(empty($request->file('pdf'))){
            $dataa='';
        }

        foreach ($dataa as $key => $item) {
            $invoicesPDF = Invoicespdf::find($id);
            $invoicesPDF->pdf = $item;
            $invoicesPDF->save();
        }
        session()->flash('success', trans('admin.updated_record'));
        return redirect(aurl('invoices/getpdf/')."/".$invoicesPDF->id_invoices);

    }
    public function destroyPdf($id)
    {

        $invoicesPDF = Invoicespdf::find($id)->delete();
        session()->flash('success', trans('admin.deleted_record'));
        return back();
    }
    // End PDF //
    public function getItemsColor( $id , Request $request){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $ItemsId = Specifications::where('item_id',$id)->pluck('color_id')->toArray();
            $colors = itemsColors::whereIn('id', $ItemsId)->get();



        }else {


            $ItemsId = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id',$id)->pluck('color_id')->toArray();
            $colors = itemsColors::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->whereIn('id', $ItemsId)->get();

        }


        if (!empty($ItemsId)) {
            return view("admin.invoices.mgza.getColor",compact('ItemsId','id','colors'));
        }else{
            return "Undefined";
        }

    }
    public function getItemsSize( $item_id,$color_id ,$zid, Request $request){
        $zxid =$zid;

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $size_id = Specifications::where('item_id',$item_id)->where('color_id',$color_id)->pluck('size')->first();
            $item = Specifications::where('item_id',$item_id)->where('color_id',$color_id)->pluck('size');
            $itemsizes = ItemsSize::whereIn('id',$item)->get();



        }else {
            $size_id = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id',$item_id)->where('color_id',$color_id)->pluck('size')->first();
            $item = Specifications::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('item_id',$item_id)->where('color_id',$color_id)->pluck('size');
            $itemsizes = ItemsSize::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->whereIn('id',$item)->get();


        }

        if (!empty($itemsizes)) {
            return view("admin.invoices.mgza.getSize",compact('itemsizes','size_id','color_id','item_id','zxid'));
        }else{
            return "Undefined";
        }

    }
    public function S(Request $request){
        dd($request);
        $invoice = Invoices::find($request->id);
        $invoice->update($request->status_id);
    }


    public function shipping_update (){

        if (Auth::guard('admin')->user()->Seller_id == 0 ){


            $invoices = Invoices::where('validate',1)->
            where('direct',0)->where('shipping_status',1)->where('shipping_status_id','!=',2)->get();



        }else {

            $invoices = Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->where('validate',1)->
            where('direct',0)->where('shipping_status',1)->where('shipping_status_id','!=',2)->get();

        }

        if ($invoices->count()>0){
            $gettoken = Token::find(1);
            $client = new Client([
                'base_uri' => 'http://al-nawares.com',
            ]);
            $headers = [
                'Authorization' => 'Bearer ' . $gettoken->token,
                'Accept'        => 'application/json',
            ];
            foreach ($invoices as $invoice){


                $response = $client->request('get', 'api/newApi/get-invoices?api_invoice_id='.$invoice->id, [
                    'headers' => $headers,
                ]);
                $result = json_decode($response->getBody(),true);
                if ($result['data']['invoices']['total'] != 0){

                    Invoices::where('id',$invoice->id)->update([
                        'shipping_status_id'=>$result['data']['invoices']['data']['0']['invoicestatus']['id'],
                        'finacialstaus_id'=>$result['data']['invoices']['data']['0']['finacial_status']['id'],
                    ]);
                }
            }
            session()->flash('success', trans('admin.updated_record'));
            return back();
        }else{
            session()->flash('error', trans('admin.updated_not_record'));
            return back();
        }

    }
    public function ajax_data($branch_id){
        $gettoken = Token::find(1);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'api/invoices/priceListAreas/?branch_id_receiver='.$branch_id, [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();
        $json =  json_decode($data);
        $areas =   $json->data->areas;

        return view('admin.invoices.areas',compact('areas') );
    }


    public function Shipping_cost($package,$area_id){


        $gettoken = Token::find(1);
        $client = new Client([
            'base_uri' => $gettoken->website,
        ]);

        $headers = [
            'Authorization' => 'Bearer ' . $gettoken->token,
            'Accept'        => 'application/json',
        ];
        $response = $client->request('GET', 'api/invoices/sumShpping?package='.$package.'&area_id='.$area_id, [
            'headers' => $headers
        ]);
        $data = (string) $response->getBody();

        $json =  json_decode($data);
        $ceheck  =   $json->success;
        if ($ceheck == true){
            return $json->data[0];

        }



    }



}
