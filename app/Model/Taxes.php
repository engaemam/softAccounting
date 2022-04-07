<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Taxes extends Model
{
    protected $table    = 'taxes';
    protected $fillable = ['Seller_id',
        'bills',
        'invoices',
        'total',
        'datefrom',
        'dateto',

    ];

}
