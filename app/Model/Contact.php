<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
class Contact extends Model {
    //
    protected $table    = 'contacts';
    protected $fillable = ['Seller_id',
        'address_ar',
        'address_en',
        'phone',
        'fax',
        'mobile',
        'email',
    ];
}