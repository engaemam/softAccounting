<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoicedeviceitems extends Model
{
    protected $table    = 'invoicedeviceitems';
    protected $fillable = ['Seller_id',
        'invoice_id',
        'device_id',
        'item_id_devices',
        'quantity_devices',
        'price_devices',
        'total_devices',
        'quantity_old',
    ];

    public function items()
    {
        return $this->belongsTo(Items::class, 'item_id_devices');
    }
    public function invoices()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id');
    }


    public function devices()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
    public function Deviceitems(){
        return $this->belongsTo(Deviceitems::class, 'device_id');
    }

}
