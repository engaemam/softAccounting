<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Sizes extends Model
{
    //
    protected $table    = 'sizes';
    //protected $guarded = [];
    protected $fillable = ['Seller_id',
        'name',
    ];
    public function specificsize()
    {
        return $this->hasMany(Specifications::class, 'size');
    }
    public function Iteminvoice(){
        return $this->hasMany(Invoiceitems::class,'size');
    }
}
