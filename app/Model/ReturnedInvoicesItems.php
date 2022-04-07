<?php

namespace App\Model;

use App\Model\Invoices;
use App\Model\Items;
use Illuminate\Database\Eloquent\Model;

class ReturnedInvoicesItems extends Model
{
    protected $table    = 'returned_invoice_items';
    protected $fillable = ['Seller_id',
        'invoice_id',

        'item_id',
        'quantity_b',
        'price_b',
        'total_price_b',
        'total_final_b',
        'color',
        'size',
        'afterdiscount',

    ];
    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id');
    }

    public function invoices()
    {
        return $this->belongsTo(ReturnedInvoices::class, 'invoice_id');
    }

}
