<?php

namespace App\Model;

use App\Admin;
use Illuminate\Database\Eloquent\Model;

class Invoices extends Model
{
    protected $table    = 'invoices';
    protected $fillable = ['Seller_id',
        'invoice_number',
        'client_id',
        'date',
        'currency_id',
        'notes',
        'total_final_mgza',
        'total_final_mogma3',
        'total_invoice',
        'total_shipments',
        'alnawares_id',
        'address',
        'pdf',
        'taxes',
        'savedraft',
        'flag',
        'barcode',
        'invoice_source_id',
        'city',
        'status_id',
        'afterdiscount',
        'shipping_costs',
        'user_id',
        'discount',
        'direct',
        'branch_id',
        'area_id',
        'shipping_status_id',
        'finacialstaus_id'

    ];
    public function clients()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
    public function shhiping_status()
    {
        return $this->belongsTo(shipping_status::class, 'shipping_status_id');
    }
    public function currencies()
    {
        return $this->belongsTo(Currencies::class, 'currency_id');
    }
    public function Invoicespdf()
    {
        return $this->belongsTo(Invoicespdf::class, 'id_invoices','id');
    }
    public function returnedinvoice()
    {
        return $this->belongsTo(ReturnedInvoices::class, 'status_id','id');
    }
    public function invoiceSource()
    {
        return $this->belongsTo(InvoiceSources::class, 'invoice_source_id');
    }
    public function Admin(){
        return $this->belongsTo(Admin::class,'user_id');
    }
    public function status(){
        return $this->belongsTo(Inovice_status::class,'status_id');
    }
    public function invoiceItem(){
        return $this->hasMany(Invoiceitems::class,'invoice_id');
    }
}
