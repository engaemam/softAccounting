<?php

namespace App\Model;

use App\Deviceitems;
use App\Itemserials;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    protected $table    = 'items';
    protected $fillable = ['Seller_id',
        'id_items',
        'item_name',
        'category_id',
        'specifications',
        'image',
        'quantity',
        'city',
        'price',
    
        'price_final',
        'newprice',
        'link',
        'barcode'

    ];


    public function itemserials()
    {
        return $this->hasMany(Itemserials::class, 'item_id', 'item_id');
    }
    public function deviceitems()
    {
        return $this->hasMany(Deviceitems::class, 'item_id', 'item_id');
    }

    public function bills()
    {
        return $this->hasMany(Bills::class, 'item_id', 'item_id');
    }

    public function billitems()
    {
        return $this->hasMany(Billitems::class, 'item_id', 'id');

    }
    public function specific()
    {
        return $this->hasMany(Specifications::class, 'item_id', 'id');

    }
    public function Items()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }

    public function Billdevicesitems()
    {
        return $this->hasMany(Billdevicesitems::class, 'item_id_devices', 'id');

    }
    public function Invoiceitems()
    {
        return $this->hasMany(Invoiceitems::class, 'item_id', 'id');
    }
    public function Invoicedeviceitems()
    {
        return $this->hasMany(Invoicedeviceitems::class, 'item_id_devices', 'id');
    }

    public function sizes(){
        return $this->belongsToMany(ItemsSize::class);
    }
    public function colors(){
        return $this->belongsToMany(ItemsColors::class);
    }
}
