<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Importexpenses extends Model
{
    protected $table    = 'importexpenses';
    protected $fillable = ['Seller_id',
        'importname_id',
        'value',
        'import_id',
        'price_final',
    ];
    public function importnames()
    {
        return $this->belongsTo(Importnames::class, 'importname_id');
    }

    public function imports()
    {
        return $this->belongsTo(Imports::class, 'import_id');
    }
}
