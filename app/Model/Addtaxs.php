<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Addtaxs extends Model
{
    protected $table    = 'addtaxs';
    protected $fillable = ['Seller_id',
        'bill_id',
        'addtaxnames_id',
        'price',
    ];

    public function addtaxnames()
    {
        return $this->belongsTo(Addtaxnames::class, 'addtaxnames_id');
    }

    public function bills()
    {
        return $this->belongsTo(Bills::class, 'bill_id');
    }
}
