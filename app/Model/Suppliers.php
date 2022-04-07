<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Suppliers extends Model
{
    protected $table    = 'suppliers';
    protected $fillable = ['Seller_id',
        'suppliers_name',
        'manager_name',
        'position_manger',
        'suppliers_number',
        'mobile',
        'country',
    ];


    public function itemserials()
    {
        return $this->hasMany(Itemserials::class, 'supplier_id', 'supplier_id');
    }
    public function bills()
    {
        return $this->hasMany(Bills::class, 'supplier_id', 'supplier_id');
    }
}
