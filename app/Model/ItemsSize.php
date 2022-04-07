<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ItemsSize extends Model
{
    //
    protected $table    = 'items_sizes';
    //protected $guarded = [];
    protected $fillable = ['Seller_id',
        'name','status'
    ];
    public function specificsize()
    {
        return $this->hasMany(Specifications::class, 'size');
    }
    public function Iteminvoice(){
        return $this->hasMany(Invoiceitems::class,'size');
    }
}
