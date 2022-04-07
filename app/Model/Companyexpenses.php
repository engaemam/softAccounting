<?php

namespace App\Model;


use Illuminate\Database\Eloquent\Model;

class Companyexpenses extends Model
{
    protected $table    = 'companyexpenses';
    protected $fillable = ['Seller_id',
        'id_catcompanyexpenses',
        'date',
        'price',
        'title',


    ];
    public function Catcompanyexpenses()
    {
        return $this->belongsTo(Catcompanyexpenses::class, 'id_catcompanyexpenses');
    }

}
