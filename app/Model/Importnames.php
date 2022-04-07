<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Importnames extends Model
{
    protected $table    = 'importnames';
    protected $fillable = ['Seller_id',
        'name',

    ];
}
