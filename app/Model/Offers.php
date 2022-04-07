<?php

namespace App;

use App\Model\Items;
use App\Model\Colors;
use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Item;

class Offers extends Model
{
    protected $table    = 'offers';
    protected $fillable = ['Seller_id',
        'name',
        'price',
        'specifications',
        'notes',
        'image',
        'selling_price',
        'total_price_b',
        'quantity_b',
    ];
    public function items()
    {
        return $this->belongsToMany(Items::class);
    }

    public function Colors()
    {
        return $this->belongsTo(itemsColors::class, 'color');
    }

}
