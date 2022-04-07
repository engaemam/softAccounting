<?php

namespace App\Model;

use App\Model\Invoices;
use App\Model\Items;
use Illuminate\Database\Eloquent\Model;

class Invoiceitems extends Model
{
    protected $table    = 'invoiceitems';
    protected $fillable = ['Seller_id',
        'invoice_id',

        'item_id',
        'quantity_b',
        'price_b',
        'total_price_b',
        'total_final_b',
        'color',
        'size',
        'afterdiscount',

    ];
    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function invoices()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id');
    }
    public function ItemColor(){
        return $this->belongsTo(Colors::class,'color');
    }
    public function ItemSize(){
        return $this->belongsTo(Sizes::class,'size');
    }
    public function Colors()
    {
        return $this->belongsTo(itemsColors::class, 'color');
    }
}
