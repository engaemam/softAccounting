<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Moneyorders extends Model
{
    protected $table    = 'moneyorders';
    protected $fillable = ['Seller_id',
        'number',
        'client_id',
        'value',
        'dates',
        'notes',
        'bill_id',
        'type',
        'currency_id',
        'currency',
        'supplier_id',

    ];
    public function Bills()
    {
        return $this->belongsTo(Bills::class, 'bill_id');
    }
    public function Clients()
    {
        return $this->belongsTo(Clients::class, 'client_id');
    }
    public function Suppliers()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
    public function currency(){
        return $this->belongsTo(Currencies::class, 'currency_id');

    }
}
