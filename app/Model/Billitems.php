<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Item;

class Billitems extends Model
{
    protected $table    = 'billitems';
    protected $fillable = ['Seller_id',
        'bill_id',
        'item_id',
        'quantity_b',
        'price_b',
        'price_b_egy',
        'total_price_b',
        'total_price_b_egy',
        //New Add Ahmed E2arch
        'color',
        'size',
        'afterdiscount',
        'shipping_costs',
        //New Add Ahmed E2arch


    ];
    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function bills()
    {
        return $this->belongsTo(Bills::class, 'bill_id');
    }
    public function devics()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
    public function billitems()
    {
        return $this->hasMany(Items::class, 'bill_id');
    }
    public function Colors()
    {
        return $this->belongsTo(itemsColors::class, 'color');
    }
    public function Size()
    {
        return $this->belongsTo(ItemsSize::class, 'size');
    }
    public function item_color()
    {
        return $this->hasMany(Specifications::class, 'item_id','item_id');
    }




}
