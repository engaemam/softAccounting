<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItemsColors extends Model
{
    //
    protected $table    = 'items_colors';
    //protected $guarded = [];
    protected $fillable = ['Seller_id',
        'name',
        'status',
    ];
    public function specificolor()
    {
        return $this->hasMany(Specifications::class, 'color_id');
    }
    public function Iteminvoice(){
        return $this->hasMany(Invoiceitems::class,'color');
    }
}
