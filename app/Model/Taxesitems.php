<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Taxesitems extends Model
{
    protected $table    = 'taxesitems';
    protected $fillable = ['Seller_id',
        'taxes_id',

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

    public function invoices()
    {
        return $this->belongsTo(Taxes::class, 'taxes_id');
    }
}
