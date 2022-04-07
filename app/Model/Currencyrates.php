<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Currencyrates extends Model
{
  protected $table    = 'currencyrates';
  protected $fillable = ['Seller_id',
      'currency_id',
      'to_currency_id',
      'rate',
  ];
  public function currency()
  {
      return $this->belongsTo(Currencies::class, 'currency_id');
  }
  public function currencytorate()
  {
      return $this->belongsTo(Currencies::class, 'to_currency_id');
  }

}
