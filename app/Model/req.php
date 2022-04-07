<?php

namespace App\Model;

use App\Model\Invoices;
use App\Model\Items;
use Illuminate\Database\Eloquent\Model;

class req extends Model
{
    protected $table = 'requests';
    protected $fillable = ['Seller_id',
        'clients_id',
        'status',
    
    ];
    protected $guarded=[];

}