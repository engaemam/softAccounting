<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Importdeviceitems extends Model
{
    protected $table = 'importdeviceitems';
    protected $fillable = ['Seller_id',
        'import_id',
        'device_id',
        'item_id_devices',
        'quantity_devices',
        'price_devices',
        'total_devices',

        'price_devices_egy',
        'total_devices_egy',
        'quantity_old',
    ];

    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id_devices');
    }

    public function imports()
    {
        return $this->belongsTo(Imports::class, 'import_id');
    }

    public function devices()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
    public function Deviceitems(){
        return $this->hasMany(Deviceitems::class,'devices_id','device_id');
    }
}
