<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Colors extends Model
{
    //
    protected $table    = 'colors';
    //protected $guarded = [];
    protected $fillable = ['Seller_id',
        'name',
    ];

}
