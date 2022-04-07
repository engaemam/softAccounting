<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Expensesitems extends Model
{
    protected $table    = 'expensesitems';
    protected $fillable = ['Seller_id',
        'items',
    ];
}
