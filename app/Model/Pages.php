<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class pages extends Model
{
    protected $table    = 'pages';
    protected $fillable = ['Seller_id',
        'title_ar',
        'title_en',
        'image',
        'description_ar',
        'description_en',
        'mate_title_ar',
        'mate_title_en',
        'mate_description_ar',
        'mate_description_en',
        'status',
    ];
}
