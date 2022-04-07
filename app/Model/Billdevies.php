<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Billdevies extends Model
{
    protected $table    = 'billdevies';
    protected $fillable = ['Seller_id',
        'bill_id',

        'device_id',
        'quantity',
        'price',
        'total_price',
        'total_final',
        'onedevices',
        'onedevices_egy',


        'item_id_devices',
        'quantity_devices',
        'price_devices',
        'total_devices',
        'total_price_egy',
    ];

    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id_devices');
    }

    public function bills()
    {
        return $this->belongsTo(Bills::class, 'bill_id');
    }
    public function devices()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
    public function Billdevicesitems(){
        return $this->hasMany(Billdevicesitems::class , 'device_id', 'device_id')
                    ->with('Deviceitems');
    }
    public function bb(){
        
    }

}
