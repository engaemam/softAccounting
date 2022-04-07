<?php

namespace App\Model;
use App\Model\Offers;
use Illuminate\Database\Eloquent\Model;

class Offeritems extends Model
{
    protected $table    = 'items_offers';
    protected $fillable = ['Seller_id',
        'name',
        'price',
        'quantity',
        'total_price' ,      
        'specifications',
        'image',
           ];
           public function offers()
           {
               return $this->belongsTo(Offers::class);
           }
           public function Colors()
           {
               return $this->belongsTo(itemsColors::class, 'color');
           }
}
