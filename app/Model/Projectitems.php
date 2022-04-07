<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Projectitems extends Model
{
    protected $table    = 'projectitems';
    protected $fillable = ['Seller_id',
        'project_id',
        'item_id',
        'quantity_b',
        'price_b',
        'total_price_b',
        'total_final_b',

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
        return $this->belongsTo(Devices::class, 'devices_id');
    }
}
