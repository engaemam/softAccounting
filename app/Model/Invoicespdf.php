<?php

namespace App\Model;

use App\Model\Invoices;
use App\Model\Items;
use Illuminate\Database\Eloquent\Model;

class Invoicespdf extends Model
{
    protected $table    = 'invoicespdf';
    protected $fillable = ['Seller_id',
        'id_invoices',
        'pdf',


    ];
    public function invoices()
    {
        return $this->belongsTo(Invoices::class, 'id_invoices');
    }
    protected static function boot() {
        parent::boot();

        static::deleting(function($pdf) {

            if(file_exists (public_path('/upload/invoices/'.$pdf->pdf)))
                unlink(public_path('/upload/invoices/'.$pdf->pdf));
        });
    }


}
