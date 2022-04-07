<?php

namespace App\Model;

use App\Model\Invoices;
use App\Model\Items;
use Illuminate\Database\Eloquent\Model;

class Billspdf extends Model
{
    protected $table    = 'billspdf';
    protected $fillable = ['Seller_id',
        'id_bills',
        'pdf',


    ];
    public function bills()
    {
        return $this->belongsTo(Bills::class, 'id_bills');
    }


    protected static function boot() {
        parent::boot();

        static::deleting(function($pdf) {

            if(file_exists (public_path('/upload/bills/'.$pdf->pdf)))
            unlink(public_path('/upload/bills/'.$pdf->pdf));
        });
    }



}
