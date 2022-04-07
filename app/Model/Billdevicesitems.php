<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Billdevicesitems extends Model
{
    protected $table    = 'billdevicesitems';
    protected $fillable = ['Seller_id',
        'bill_id',
        'device_id',
        'item_id_devices',
        'quantity_devices',
        'price_devices',
        'price_devices_egy',
        'total_devices',
        'total_devices_egy',
        'quantity_old',
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

       public function Deviceitems(){
            return $this->hasMany(Deviceitems::class,'devices_id','device_id');
       }
}
