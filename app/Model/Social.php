<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;
use League\Fractal\Resource\Item;

class Social extends Model
{
    protected $table    = 'social_links';
    protected $fillable = ['Seller_id',
        'name',   
        'link',   
    ];
   

}
