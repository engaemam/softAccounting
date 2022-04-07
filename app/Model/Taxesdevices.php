<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Taxesdevices extends Model
{
    protected $table    = 'taxesdevices';
    protected $fillable = ['Seller_id',
        'taxes_id',
        'onedevice',
        'device_id',
        'quantity',
        'total_price',
        'total_final',
    ];


    public function Taxes()
    {
        return $this->belongsTo(Taxes::class, 'taxes_id');
    }
    public function devices()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
}
