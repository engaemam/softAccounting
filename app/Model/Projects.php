<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Projects extends Model
{
    protected $table    = 'projects';
    protected $fillable = ['Seller_id',
        'id_client',
        'project_number',
        'project_start_date',
        'project_creation_date',
        'project_value',
        'image_deal',
        'image_bill',
        'project_after_tax',
        'name',
        'type',
        'date_delivery',
        'date_expirat',
        'total_final_mgza',
        'total_final_mogma3',
        'total_project',
        'currency_id',
    ];
    public function clients()
    {
        return $this->belongsTo(Clients::class, 'id_client');
    }
    public function projectitems()
    {
        return $this->hasOne(Projectitems::class,'project_id');
    }

    public function currency()
    {
        return $this->belongsTo(Currencies::class, 'currency_id');
    }
}

