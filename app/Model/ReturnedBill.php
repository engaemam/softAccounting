<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class ReturnedBill extends Model
{
    protected $table    = 'returned_bills';
    protected $fillable = ['Seller_id',
        //'bill_number',
        'date',
        'notes',
        'supplier_id',
        'price_before_doller',
        'currency_id',
        'total_price',
        'total_price_ex',
        'total_final_mgza',
        'total_final_mogma3',
        'total_final_bill',
        'total_final_bill_egy',
        'total_shipments',
        'pdf',
        'savedraft',
        'total_addtaxs',
        'flag',
        'total_final_mgza_egy',
        'total_final_mogma3_egy',
        'total_shipments_egy',
        'total_addtaxs_egy',
        'barcode',
        'bill_source_id',

    ];


    public function suppliers()
    {
        return $this->belongsTo(Suppliers::class, 'supplier_id');
    }
    public function currency()
    {
        return $this->belongsTo(Currencies::class, 'currency_id');
    }
    public function returned_billitems()
    {
        return $this->belongsTo(ReturnedBillItem::class, 'bill_id');
    }
}
