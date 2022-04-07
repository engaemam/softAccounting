<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Specifications extends Model
{
    protected $table    = 'item_specifications';
    //protected $guarded = [];
    protected $fillable = ['Seller_id',
        'item_id',
        'count',
        'color_id',
        'size',
        'selling_price',
        'quantity',
        ];
    public function specific()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }
    public function specificolor()
    {
        return $this->belongsTo(itemsColors::class, 'color_id');
    }
    public function specificsize()
    {
        return $this->belongsTo(ItemsSize::class, 'size');
    }
    public function specificsize2()
    {
        return $this->belongsTo(Sizes::class, 'size');
    }


}
