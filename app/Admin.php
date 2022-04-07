<?php

namespace App;
use App\Model\Invoices;
use App\Model\Roles;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Admin extends Authenticatable
{ use Notifiable;
    private $admin =1;
    private $suppliers =2;
    private $clients =3;
    protected $table = 'admins';
    protected $fillable = [
        'name', 'email', 'password','role_id',
        'phone',
        'mobile',
        'city',
        'country_id',
        'suppliers_name',
        'manager_name',
        'position_manger',
        'suppliers_number',
        'name_company',
        'name_client',
        'client_position',
        'notes',
        'usertype_id',
        'Seller_id',
        'active',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];


    public function roles()
    {
        return $this->belongsTo(Roles::class, 'role_id');
    }

    public function scopeActive($query)
    {
        return $query->where('active', 1);
    }
    public function scopeAdmins($query)
    {
        return $query->where('usertype_id', $this->admin);
    }
    public function scopeSuppliers($query)
    {
        return $query->where('usertype_id', $this->suppliers);
    }
    public function scopeClients($query)
    {
        return $query->where('usertype_id' ,$this->clients);
    }
    public function Invoices(){
        return $this->hasMany(Invoices::class,'user_id');
    }
}
