<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Clients extends Model
{
    protected $table    = 'clients';
    protected $fillable = ['Seller_id',
        'name_company',
        'name_client',
        'city',
        'phone',
        'mobile',
        'client_position',
        'notes',
        'postalCode',
        'email',
        'password',
        'provider_id',
        'provider_type'
        
    ];
}
