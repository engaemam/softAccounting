<?php

namespace App\Http\Controllers\Admin;
use App\Admin;
use App\DataTables\CurrenciesDatatable;
use App\Http\Controllers\Controller;
use App\Model\Bills;
use App\Model\Clients;
use App\Model\Currencies;
use App\Model\Devices;
use App\Model\Invoices;
use App\Model\Items;
use App\Model\Projects;
use App\Model\Suppliers;
use Illuminate\Support\Facades\Auth;
use Storage;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class DashboardController extends Controller
{

    public function index()
    {
        if (Auth::guard('admin')->user()->Seller_id == 0 ){



            $users   = Admin::get();
            $items   = Items::get();
            $devices=Devices::get();
            $clients = Clients::get();
            $suppliers = Suppliers::get();
            $bill     = Bills::get();
            $bills   = Bills::orderBy('created_at','DESC')->limit(5)->get();
            $invoices=Invoices::get();
            $invoice=Invoices::orderBy('created_at','DESC')->limit(5)->get();
            $projects=Projects::count();



        }else {


            $users   = Admin::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $items   = Items::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $devices=Devices::get();
            $clients = Clients::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $suppliers = Suppliers::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $bill     = Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $bills   = Bills::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy('created_at','DESC')->limit(5)->get();
            $invoices=Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->get();
            $invoice=Invoices::where('Seller_id', Auth::guard('admin')->user()->Seller_id)->orderBy('created_at','DESC')->limit(5)->get();
            $projects=Projects::count();

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
        return view('admin.home',['users'=>$users,
            'temp'=>$temp,
            'items'=>$items,
            'clients'=>$clients,
            'suppliers'=>$suppliers,
            'devices'=>$devices,
            'bills'=>$bills,
            'projects'=>$projects,
            'invoices'=>$invoices,
            'bill'=>$bill,
            'invoice'=>$invoice]);
    }


}