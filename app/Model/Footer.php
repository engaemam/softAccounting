<?php
namespace App\Model;
use Illuminate\Database\Eloquent\Model;
class Footer extends Model {
    //
    protected $table    = 'footers';
    protected $fillable = ['Seller_id',
        'footer_facebook',
        'footer_instagram',
        'footer_youtube',
        'footer_link',
    ];
}