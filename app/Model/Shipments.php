<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shipments extends Model
{
    protected $table    = 'shipments';
    protected $fillable = ['Seller_id',
        'shipping_id',
        'value',
        'bill_id',
        'price_final',
    ];
    public function shipping()
    {
        return $this->belongsTo(Shipping::class,'shipping_id');
    }

    public function bills()
    {
        return $this->belongsTo(Bills::class, 'bill_id');
    }
}
