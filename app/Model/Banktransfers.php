<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Banktransfers extends Model
{
    protected $table    = 'banktransfers';
    protected $fillable = ['Seller_id',
        'image',
        'title',
        'body',
        'import_id',

    ];
    public function imports()
    {
        return $this->belongsTo(Imports::class, 'import_id');
    }
}
