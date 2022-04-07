<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Taxesdeviceitems extends Model
{
    protected $table    = 'taxesdeviceitems';
    protected $fillable = ['Seller_id',
        'taxes_id',
        'device_id',
        'item_id_devices',
        'quantity_devices',
        'price_devices',
        'total_devices',
    ];

    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id_devices');
    }


    public function devices()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
}
