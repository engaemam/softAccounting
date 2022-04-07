<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class shipping_status extends Model
{
    protected $table    = 'shipping_statuses';
    protected $fillable = ['Seller_id',
        'name',
    ];
    public function invoicestatus()
    {
        return $this->hasMany(ReturnedInvoices::class, 'status_id');
    }
    public function status()
    {
        return $this->hasMany(Invoices::class, 'status_id');
    }
}
