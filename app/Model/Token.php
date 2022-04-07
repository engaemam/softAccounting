<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;


class Token extends Model
{
    protected $table    = 'tokens';
 
    protected $fillable = ['Seller_id',
        'user_id',
        'token',
        'email',
        'password',

    ];
    protected $hidden = ['created_at', 'updated_at'];

  


}
