<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Devices extends Model
{
    protected $table    = 'devices';
    protected $fillable = ['Seller_id',
        'devices_name',
        'specifications',
    ];
    public function deviceitems()
    {
        return $this->hasMany(Deviceitems::class, 'devices_id');
    }

    public function subdevice()
    {
        //return $this->belongsToMany(self::class);
        return $this->belongsToMany(self::class, 'subdevices', 'device_id', 'subdevice_id');
    }


}
