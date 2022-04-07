<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Itemserials extends Model
{
    protected $table    = 'itemserials';
    protected $fillable = ['Seller_id',
        'item_id',
        'serial_number',
        'supplier_id',
    ];


    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
    public function suppliers()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }

}
