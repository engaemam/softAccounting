<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Custodys extends Model
{
    protected $table    = 'custodys';
    protected $fillable = ['Seller_id',
        'number',
        'title',
        'value',
        'dates',
        'notes',
        'project_id',
        'delivery',
        'dates_delivery',


    ];
    public function Projects()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
}
