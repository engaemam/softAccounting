<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Currencies extends Model
{
    protected $table    = 'currencies';
    protected $fillable = ['Seller_id',
        'currency_name',
        'currency_ammount',

    ];
}
