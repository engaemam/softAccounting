<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Supplierproducts extends Model
{
    protected $table    = 'supplierproducts';
    protected $fillable = ['Seller_id',
        'item_id',
        'last_price',
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
