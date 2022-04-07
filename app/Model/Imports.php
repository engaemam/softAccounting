<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Imports extends Model
{
    protected $table    = 'imports';
    protected $fillable = ['Seller_id',
        'number',
        'date',
        'notes',
        'supplier_id',
        'price_doller',
        'currency_id',
        'total_final_mgza',
        'total_final_mogma3',
        'total_final',
        'total_import',
        'price_doller',
        'transfer',
        'pdf',

        'total_final_mgza_egy',
        'total_final_mogma3_egy',
        'total_final_bill_egy',
        'total_final_egy',
        'total_import_egy',





    ];
    public function suppliers()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currencies::class, 'currency_id');
    }
    public function importitems()
    {
        return $this->belongsTo(Importitems::class, 'bill_id');
    }
}
