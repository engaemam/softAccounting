<?php

namespace App\Model;

use App\Model\Devices;
use App\Model\Items;
use App\Model\Subdevices;
use Illuminate\Database\Eloquent\Model;

class Deviceitems extends Model
{
    protected $table    = 'deviceitems';
    protected $fillable = ['Seller_id',
        'item_id',
        'numbers',
        'devices_id',
        'number_items',
    ];


    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function devices()
    {
        return $this->belongsTo(Devices::class, 'devices_id');
    }
    public function subdevices()
    {
        return $this->hasMany(Subdevices::class, 'subdevice_id');
    }

    public function devicesname()
    {
        return $this->belongsTo(Devices::class, 'devices_name');
    }
}
