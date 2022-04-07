<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Addtaxnames extends Model
{
    protected $table    = 'addtaxnames';
    protected $fillable = ['Seller_id',
        'name',


    ];
}
