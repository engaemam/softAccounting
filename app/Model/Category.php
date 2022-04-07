<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use App\Model\Items;
class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['Seller_id',
        'name',
        'details',
    ];


    public function Items()
    {
        return $this->hasMany(Items::class, 'category_id', 'id');

    }
}
