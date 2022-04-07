<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Shipping extends Model
{
    protected $table    = 'shippings';
    protected $fillable = ['Seller_id',
        'type_expense',

    ];
}
