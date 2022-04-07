<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Allowroles extends Model
{
    protected $table    = 'allowroles';
    protected $fillable = ['Seller_id',
        'role_id',
        'allow',
    ];
    public function shipping()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

}
