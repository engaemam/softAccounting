<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Projectcosts extends Model
{
    protected $table = 'projectcosts';
    protected $fillable = ['Seller_id',
        'project_id',
        'expenses_id',
        'value',

    ];
    public function projects()
    {
        return $this->belongsTo(Projects::class, 'project_id');
    }
    public function expensesitems()
    {
        return $this->belongsTo(Expensesitems::class, 'expenses_id');
    }
}
