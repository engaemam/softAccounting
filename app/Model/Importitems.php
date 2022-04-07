<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Importitems extends Model
{
    protected $table    = 'importitems';
    protected $fillable = ['Seller_id',
        'import_id',

        'item_id',
        'quantity_b',
        'price_b',
        'total_price_b',
        'total_final_b',
        'price_b_egy',
        'total_price_b_egy',

    ];
    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function imports()
    {
        return $this->belongsTo(Imports::class, 'import_id');
    }

}
