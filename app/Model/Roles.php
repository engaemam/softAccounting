<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    protected $table    = 'roles';
    protected $fillable = ['Seller_id',
                'name',
                'type',
                'allow',
    ];
}
