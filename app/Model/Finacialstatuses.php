<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Finacialstatuses extends Model


{
    protected $table = 'finacialstatuses';
    protected $fillable =
        [
            'Seller_id',
            'name',
            'status',
        ];
    public function Invoices(){
        return $this->hasMany(Invoices::class, 'finacialstaus_id');
    }
}
