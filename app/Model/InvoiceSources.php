<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class InvoiceSources extends Model
{
    protected $table    = 'invoice_sources';
    protected $fillable = ['Seller_id',
        'name',
    ];
    public function invoiceSource()
    {
        return $this->hasMany(Invoices::class, 'invoice_source_id');
    }
}
