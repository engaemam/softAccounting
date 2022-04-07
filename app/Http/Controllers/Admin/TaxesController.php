<?php

namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;


use App\Model\Bills;
use App\Model\Clients;
use App\Model\Currencies;
use App\Model\Deviceitems;
use App\Model\Devices;
use App\Model\Invoicedeviceitems;
use App\Model\Invoicedevices;
use App\Model\Invoiceitems;
use App\Model\Invoices;
use App\Model\Invoicespdf;
use App\Model\Items;
use App\Model\Subdevices;
use App\Model\Suppliers;
use App\Model\Currencyrates;
use App\Model\Taxes;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Item;
use Storage;
use Excel;
use Illuminate\Http\Request;

//use Illuminate\Http\Request;
class TaxesController extends Controller
{

    public function index(){

        $currence   = Currencies::get();

        $invoices      = Invoices::where('taxes','!=','')->get();

        $tempTotalInvoices = 0;
        $fixedCurency = 4;//Currency Id EGYPT = 4
        foreach ($invoices as $invoice){
            @$rate = (double)1;
            if((int)$invoice->currency_id != $fixedCurency) {
                @$rate = (double)$this->cur((int)$invoice->currency_id, $fixedCurency);
            }
            //echo $invoice->currency_id.'-' . $rate .'-'. $invoice->taxes. '<br>';
            $tempTotalInvoices += round(@$rate * $invoice->taxes,2);
        }

        $bills      = Bills::where('total_addtaxs','!=','')->get();

        $tempTotalBills = 0;
        $fixedCurency = 4;//Currency Id EGYPT = 4
        foreach ($bills as $bill){
            @$rate = (double)1;
            if((int)$bill->currency_id != $fixedCurency) {
                @$rate = (double)$this->cur((int)$bill->currency_id, $fixedCurency);
            }
            //echo $bill->currency_id.'-' . $rate .'-'. $bill->total_addtaxs. '<br>';
            $tempTotalBills += round(@$rate * ($bill->total_addtaxs),2);
        }

        $total      = round($tempTotalInvoices - $tempTotalBills,2) ;
        return view('admin.taxes.index', compact('total','tempTotalInvoices','tempTotalBills'));

    }
    public function search(Request $request){

        if ($request->action == 'search') {
            //conver to time stamp
            $to = date("Y-m-d");
            if ($request->to != null) {
                $to = strtotime($request->to);
                $to = date("Y-m-d", $to);
            }
            $from = date("Y-m-d");
            if ($request->from != null) {
                $from = strtotime($request->from);
                $from = date("Y-m-d", $from);
            }

            $invoices      = Invoices::where('taxes','!=','')->where('flag','=','0')
                ->whereDate("date", ">=", $from)
                ->whereDate("date", "<=", $to)->get();

            $tempTotalInvoices = 0;
            $fixedCurency = 4;//Currency Id EGYPT = 4
            foreach ($invoices as $invoice){
                $rate = (double)1;
                if((int)$invoice->currency_id != $fixedCurency) {
                    @$rate = (double)$this->cur((int)$invoice->currency_id, $fixedCurency);
                }
                //echo $invoice->currency_id.'-' . $rate .'-'. $invoice->taxes. '<br>';
                $tempTotalInvoices += round(@$rate * $invoice->taxes,2);
            }



            $bills      = Bills::where('total_addtaxs','!=','')->where('flag','=','0')
                ->whereDate("date", ">=", $from)
                ->whereDate("date", "<=", $to)->get();
            //dd($bills);

            $tempTotalBills = 0;
            $fixedCurency = 4;//Currency Id EGYPT = 4
            foreach ($bills as $bill){
                $rate = (double)1;
                if((int)$bill->currency_id != $fixedCurency) {
                    $rate = (double)$this->cur((int)$bill->currency_id, $fixedCurency);
                }
                //echo $bill->currency_id.'-' . $rate .'-'. $bill->total_addtaxs. '<br>';
                $tempTotalBills += round($rate * $bill->total_addtaxs,2);
            }


            $total    = round($tempTotalInvoices - $tempTotalBills,2);

        }else{
            //conver to time stamp
            $to = date("Y-m-d");
            if ($request->to != null) {
                $to = strtotime($request->to);
                $to = date("Y-m-d", $to);
            }
            $from = date("Y-m-d");
            if ($request->from != null) {
                $from = strtotime($request->from);
                $from = date("Y-m-d", $from);
            }

            $invoices      = Invoices::where('taxes','!=','')->where('flag','=','0')
                ->whereDate("date", ">=", $from)
                ->whereDate("date", "<=", $to)->get();

            $tempTotalInvoices = 0;
            $fixedCurency = 4;//Currency Id EGYPT = 4
            foreach ($invoices as $invoice){
                $invoicesave = Invoices::find($invoice->id);
                $invoicesave->flag = 1;
                $invoicesave->save();
                @$rate = (double)1;

                if((int)$invoice->currency_id != $fixedCurency) {
                    @$rate = (double)$this->cur((int)$invoice->currency_id, $fixedCurency);
                }
                //echo $invoice->currency_id.'-' . $rate .'-'. $invoice->taxes. '<br>';
                $tempTotalInvoices += round(@$rate * $invoice->taxes,2);
            }



            $bills      = Bills::where('total_addtaxs','!=','')->where('flag','=','0')
                ->whereDate("date", ">=", $from)
                ->whereDate("date", "<=", $to)->get();


            $tempTotalBills = 0;
            $fixedCurency = 4;//Currency Id EGYPT = 4
            foreach ($bills as $bill){
                $billsave = Bills::find($bill->id);
                $billsave->flag = 1;
                $billsave->save();
                $rate = (double)1;


                if((int)$bill->currency_id != $fixedCurency) {
                    $rate = (double)$this->cur((int)$bill->currency_id, $fixedCurency);
                }
                //echo $bill->currency_id.'-' . $rate .'-'. $bill->total_addtaxs. '<br>';
                $tempTotalBills += round($rate * $bill->total_addtaxs,2);
            }


            $total    = round($tempTotalInvoices - $tempTotalBills,2);

            $Taxes = Taxes::create([
                'bills'           => round($tempTotalBills,2),
                'invoices'        => round($tempTotalInvoices,2),
                'total'           => $total,
                'datefrom'        => $request->from,
                'dateto'          => $request->to,
            ]);
            session()->flash('success', trans('taxes.tax'));

        }
        return view('admin.taxes.index', compact('total','tempTotalInvoices','tempTotalBills'));


    }



    public function cur($from_cur = null, $to_cur = null){
        return Currencyrates::where('currency_id',$from_cur)->where('to_currency_id',$to_cur)->first()->rate;
    }
    public function TaxClearance()
    {
        $taxes = Taxes::orderBy('created_at', 'desc')->paginate(15);
        return view('admin.taxes.indextax', compact('taxes'));
    }




}
