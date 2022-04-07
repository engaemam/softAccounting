<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Subdevices extends Model
{
    protected $table    = 'subdevices';
    protected $fillable = ['Seller_id',
        'device_id',
        'devices_name',
        'specifications',
        'subdevice_id',
    ];

    public function deviceitems()
    {
        return $this->hasMany(Deviceitems::class, 'devices_id');
    }

    public function devices()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
   
    public function devices2()
    {
        return $this->belongsTo(Devices::class, 'subdevice_id');
    }


}
