<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Item;

class ReturnedBillItem extends Model
{
    protected $table    = 'returned_billitems';
    protected $fillable = ['Seller_id',
        'bill_id',
        'item_id',
        'quantity_b',
        'price_b',
        'price_b_egy',
        'total_price_b',
        'total_price_b_egy',
        'color',
        'size',
        'afterdiscount',
        'shipping_costs',

    ];
    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function retunedbills()
    {
        return $this->belongsTo(ReturnedBill::class, 'bill_id');
    }
    public function devics()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
    public function billitems()
    {
        return $this->hasMany(Items::class, 'bill_id');
    }

}
