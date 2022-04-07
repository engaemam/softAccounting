<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Invoicedevices extends Model
{
    protected $table    = 'invoicedevices';
    protected $fillable = ['Seller_id',
        'invoice_id',
        'onedevice',
        'device_id',
        'quantity',
        'total_price',
        'total_final',
    ];


    public function invoices()
    {
        return $this->belongsTo(Invoices::class, 'invoice_id');
    }
    public function devices()
    {
        return $this->belongsTo(Devices::class, 'device_id');
    }
    public function Invoicedeviceitems(){
        return $this->hasMany(Invoicedeviceitems::class , 'device_id', 'device_id')
            ->with('Deviceitems');
    }
}
