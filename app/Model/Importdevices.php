<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Importdevices extends Model
{
    protected $table    = 'importdevices';
    protected $fillable = ['Seller_id',
        'import_id',

        'device_id',
        'quantity',
        'price',
        'total_price',

        'onedevices',
        'onedevices_egy',
        'total_price_egy',
    ];



    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
    public function imports()
    {
        return $this->belongsTo(Imports::class, 'import_id');
    }
    public function devices()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
    public function Importdeviceitems(){
        return $this->hasMany(Importdeviceitems::class , 'device_id', 'device_id')
            ->with('Deviceitems');
    }
}
