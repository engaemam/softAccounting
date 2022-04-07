<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturnedInvoices extends Model
{
    protected $table    = 'returned_invoice';
    protected $fillable = ['Seller_id',
        'invoice_number',
        'invice_id',
        'client_id',
        'date',
        'currency_id',
        'notes',
        'total_final_mgza',
        'total_final_mogma3',
        'total_invoice',
        'total_shipments',
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
        'discount',
        'user_id',

    ];
    public function clients()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
    public function suppliers()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
    public function currencies()
    {
        return $this->belongsTo(Currencies::class, 'currency_id');
    }
    public function Invoicespdf()
    {
        return $this->belongsTo(Invoicespdf::class, 'id_invoices','id');
    }
    public function invoicestatus()
    {
        return $this->belongsTo(Inovice_status::class, 'status_id','id');
    }

    public function invoiceSource()
    {
        return $this->belongsTo(InvoiceSources::class, 'invoice_source_id');
    }
    public function returnedInvoicesItems()
    {
        return $this->belongsTo(ReturnedInvoicesItems::class, 'invoice_id');
    }

}
