<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Projectdevices extends Model
{
    protected $table    = 'projectdevices';
    protected $fillable = ['Seller_id',
        'project_id',

        'device_id',
        'quantity',
        'total_price',
        'total_final',
        'onedevice',
    ];


    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
    public function projects()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
    public function devices()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
    public function Projectdeviceitems(){
        return $this->hasMany(Projectdeviceitems::class , 'device_id', 'device_id')
            ->with('Deviceitems');
    }
}
