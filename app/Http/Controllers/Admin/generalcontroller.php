<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Model\Billdevicesitems;
use App\Model\Billdevies;
use App\Model\Billitems;
use App\Model\Bills;
use App\Model\Billspdf;
use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\Importdeviceitems;
use App\Model\Importitems;
use App\Model\Invoicedeviceitems;
use App\Model\Invoiceitems;
use App\Model\Invoices;
use App\Model\Items;
use App\Model\Projectdeviceitems;
use App\Model\Projectitems;
use App\Model\Shipments;
use App\Model\Specifications;
use App\Model\Subdevices;
use App\Model\Token;
use GuzzleHttp\Client;
use Illuminate\Http\Request;

class generalcontroller extends Controller
{

///////////////////////part///////////////////////////
    public  static function quantitysub($id){
        $iteamids=billitems::where('bill_id',$id)->pluck('item_id')->toArray();
        $quantity =billitems::where('bill_id',$id)->pluck('quantity_b')->toArray();
        $aa= array_combine($iteamids, $quantity);
        foreach($aa as $key => $value)
        {
            $getquantity = Items::where('id',$key)->pluck('quantity');
            $collect =$getquantity[0] - $value;
            $items = Items::where('id',$key)->update(['quantity'=>$collect]);
        }
    }
    public  static function quantityadd($iteamids,$quantity){
        $combine= array_combine($iteamids, $quantity);
        foreach($combine as $key => $value)
        {
            $getquantity = Items::where('id',$key)->pluck('quantity');
            $getprice    = Items::where('id',$key)->pluck('price');
            $collect     = $getquantity[0] + $value;
            $getprice[0] = $value;
            $items       = Items::where('id',$key)->update(['quantity'=>$collect,'price'=> $getprice[0]]);
        }
    }
/////////////////////////////part///////////////////
    public function deviceid($id,Request $request){
        $DeviceId = Deviceitems::with('items')->where('devices_id',$id)->get();
        $sbudevic = Subdevices::where('device_id',$id)->pluck('subdevice_id');
        //dd($sbudevic);
        $sbudevicz = Subdevices::where('device_id',$id)->get();
        $ItemsId = items::where('id',$id)->get();






        if (!empty($DeviceId)) {
            if(!empty($sbudevicz[0])){
                $subid = Deviceitems::with('items')->wherein('devices_id',$sbudevic)->get();


                return view("admin.bills.ajax",compact('DeviceId','id','subid','sbudevicz','ItemsId'));

            }
            return view("admin.bills.ajax",compact('DeviceId','id','sbudevicz'));

        }else{
            return "Undefined";
        }

    }
///////////////////////////////////mogm3/////////////////////////
    public static function countdiv($id){

        $getdiveitem = Billdevicesitems::where('bill_id',$id)->get();

        foreach ($getdiveitem as  $key => $value){
            if($value->price_devices == 0){
                $ddd = Items::where('id',$value->item_id_devices)->value('quantity');
                $value3w = $value->quantity_devices + $ddd  ;
                $dd = Items::where('id',$value->item_id_devices)->update(['quantity'=>$value3w]);
            }else{
                $ddd = Items::where('id',$value->item_id_devices)->value('quantity');
                $value3w = $value->quantity_devices + $ddd  ;
                $dd = Items::where('id',$value->item_id_devices)->update(['quantity'=>$value3w,'price'=>$value->price_devices_egy]);
            }


        }
    }

    public static function subdiv($id){

        $getdiveitem = Billdevicesitems::where('bill_id',$id)->get();
        foreach ($getdiveitem as  $key => $value){
            $ddd = Items::where('id',$value->item_id_devices)->value('quantity');
            $value3w = $ddd - $value->quantity_devices   ;
            $dd = Items::where('id',$value->item_id_devices)->update(['quantity'=>$value3w,'price'=>$value->price_devices]);

        }


    }
    ///////////
    public static function showadd($id){

        $bills =      Bills::with('suppliers')->find($id);
        //$bills['percentage'] = ceil(($bills['total_shipments_egy'] / ($bills['total_final_bill_egy'] + $bills['total_shipments_egy'])) * 100);
        @$bills['percentage']    = round(($bills['total_shipments_egy'] * 100 ) / $bills['total_final_bill_egy'] ,2);//new

        $billitems = Billitems::with('items')->where('bill_id',$id)->orderBy('created_at', 'desc')->get();

        foreach ($billitems as $key => $value){
            if($value->price_b_egy == 0){

            }else{
                $zz = round( $value->price_b_egy * $bills->percentage/100 + $value->price_b_egy,2);
                $items = Items::where('id',$value->item_id)->update(['newprice'=>$zz]);
            }
        }
        $billdevicesitems = Billdevicesitems::with('items')->where('bill_id',$id)->orderBy('created_at', 'desc')->get();

        foreach ($billdevicesitems as $billdevicesitem){
            if($billdevicesitem->price_devices_egy== 0){

            }else{
                $zz = round($billdevicesitem->price_devices_egy * $bills->percentage/100 + $billdevicesitem->price_devices_egy,2);
                $items = Items::where('id',$billdevicesitem->item_id_devices)->update(['newprice'=>$zz]);
            }


        }

    }
///////////////////////////////////mogm3//////////////////////////////////////////

    public static function notnull($array){

        if(!isset($array)){
            $arrayz[] = "null";
            return $arrayz ;
        }else{
            $fiterr = array_filter($array);
            return $fiterr;
        }
    }
    //alreadycheck ITEMS DELETE
    public static function alreadycheck($id){
        $Deviceitems    = Deviceitems::where('item_id',$id)->value('item_id');

        $billitem          = Billitems::where('item_id',$id)->value('item_id');
        $invitem           = Invoiceitems::where('item_id',$id)->value('item_id');
        $projectitems      = Projectitems::where('item_id',$id)->value('item_id');
        $Importitems       = Importitems::where('item_id',$id)->value('item_id');

        $itemiddeiv        = Billdevicesitems::where('item_id_devices',$id)->value('item_id_devices');
        $Invoice_Items     = Invoicedeviceitems::where('item_id_devices',$id)->value('item_id_devices');
        $Project_Items     = Projectdeviceitems::where('item_id_devices',$id)->value('item_id_devices');
        $Import_Items      = Importdeviceitems::where('item_id_devices',$id)->value('item_id_devices');

        if($billitem ||
            $Deviceitems ||
            $invitem ||
            $projectitems ||
            $itemiddeiv !=null ||
            $Importitems ||
            $Invoice_Items !=null ||
            $Project_Items !=null||
            $Import_Items !=null

        ){
            return '1';

        }
    }
    //Delete Bill
    public static function DeleteBill($id){
        $bill = Bills::find($id);
        if($bill->savedraft == 0){
            $shipments = Shipments::where('bill_id',$id)->get();
            foreach ($shipments as $shipment)
            {
                Shipments::find($shipment->id)->delete();
            }
            $Billspdf = Billspdf::where('id_bills',$id)->get();
            foreach ($Billspdf as $value4)
            {
                Billspdf::find($value4->id)->delete();
            }

            $billitems = Billitems::where('bill_id',$id)->get();

            $tempOldItems = [];
            foreach ($billitems as $billitem)
            {



                Billitems::find($billitem->id)->delete();

            }


            $billdevies = Billdevies::where('bill_id',$id)->get();
            foreach ($billdevies as $billdevy)
            {
                Billdevies::find($billdevy->id)->delete();
            }

            $getdiveitem = Billdevicesitems::where('bill_id',$id)->get();

            $tempOldItems = [];
            foreach ($getdiveitem as  $key => $value){
                Billdevicesitems::find($value->id)->delete();
            }

        }else{
            $shipments = Shipments::where('bill_id',$id)->get();
            foreach ($shipments as $shipment)
            {
                Shipments::find($shipment->id)->delete();
            }
            $Billspdf = Billspdf::where('id_bills',$id)->get();
            foreach ($Billspdf as $value4)
            {
                Billspdf::find($value4->id)->delete();
            }

            $billitems = Billitems::where('bill_id',$id)->get();

            $tempOldItems = [];
            foreach ($billitems as $billitem)
            {
                $tempOldItems[] = $billitem->item_id;
                $getitem = Items::where('id',$billitem->item_id)->value('quantity');
                $sub = $getitem - $billitem->quantity_b ;
                $updatequantiy = Items::where('id',$billitem->item_id)->update(['quantity'=>$sub]);
//dd($getitem);
                Billitems::find($billitem->id)->delete();
            }
            $billitems2 = Billitems::where('bill_id',$id)->get();

            $tempOldItems2 = [];
            foreach ($billitems2 as $billitem)
            {
                $tempOldItems2[] = $billitem->item_id;
                //$getitem = Items::where('id',$billitem->item_id)->value('quantity');
                $getitem = Specifications::where('item_id',$billitem->item_id)->where('color_id',$billitem->color)->where('size',$billitem->size)->pluck('quantity')->first();
                //dd($getitem);
                $getitemId = Specifications::where('item_id',$billitem->item_id)->where('color_id',$billitem->color)->where('size',$billitem->size)->pluck('id')->first();
                //$getitem = Specifications::where('item_id',$billitem->item_id)->where('color',)->value('quantity');
                $sub = $getitem - $billitem->quantity_b ;
                $updatequantiy = Specifications::where('id',$getitemId)->update(['quantity'=>$sub]);


                Billitems::find($billitem->id)->delete();

            }

            foreach ($tempOldItems as $oldItem){
                $lastItem = Billitems::where('item_id', $oldItem)->orderBy('created_at', 'desc')->first();
                $updatequantiy = Items::where('id', $oldItem)->update([
                    'price' => $lastItem != null ? $lastItem->price_b : 0
                ]);
            }



            $billdevies = Billdevies::where('bill_id',$id)->get();
            foreach ($billdevies as $billdevy)
            {
                Billdevies::find($billdevy->id)->delete();
            }

            $getdiveitem = Billdevicesitems::where('bill_id',$id)->get();

            $tempOldItems = [];
            foreach ($getdiveitem as  $key => $value){
                $tempOldItems[] = $value->item_id_devices;

                $ddd = Items::where('id',$value->item_id_devices)->value('quantity');
                $value3w = $ddd - $value->quantity_devices   ;
                $updatequantiy = Items::where('id',$value->item_id_devices)->update(['quantity'=>$value3w]);
                Billdevicesitems::find($value->id)->delete();
            }

            foreach ($tempOldItems as $oldItem){
                $lastItem = Billdevicesitems::where('item_id_devices', $oldItem)->orderBy('created_at', 'desc')->first();
                $updatequantiy = Items::where('id', $oldItem)->update([
                    'price' => $lastItem != null ? $lastItem->price_devices : 0
                ]);
            }

        }





    }
    public static function checkbill(){

        $bills = Bills::get();


        if($bills[0]['id'] == null){

            $item = Items::get();
            foreach ($item as $it3m)
            {
                $Zeroone = 0;

                $updateprice = Items::where('id',$it3m->id)->update(['price'=>$Zeroone,'newprice'=>$Zeroone]);

            }

        }
    }
    public static function roles($user_role_id=null){
        // Start Role Show And Hidden
        $user_role_id = auth()->guard('admin')->User()->roles;
        $allowRoles = \App\Model\Allowroles::where('role_id', $user_role_id->id)->get();
        $temp = [];
        foreach ($allowRoles as $role)
        {
            $temp[] = $role->allow;
        }
        // End Role Show And Hidden
    }
    public function RoutrnuCount($id){
        dd($id);
    }









}
