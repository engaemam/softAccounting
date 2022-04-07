<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class SocialFacebookAccount extends Model
{
    protected $fillable = ['Seller_id',
        'name', 'email', 'password', 'facebook_id','updated_at','created_at'
    ];
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function addNew($input)
    {
        $check = static::where('facebook_id',$input['facebook_id'])->first();


        if(is_null($check)){
            return static::create($input);
        }


        return $check;
    }
}
