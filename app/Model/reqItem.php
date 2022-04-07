<?php

namespace App\Model;

use App\Model\Invoices;
use App\Model\Items;
use Illuminate\Database\Eloquent\Model;

class reqItem extends Model
{
    protected $table = 'Requests_items';
    protected $guarded = ['id'];

}