<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class vestidosUsers extends Authenticatable
{

    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'preferred_language',
        'remember_token',
        'first_name',
        'middle_name',
        'last_name', 
        'email', 
        'password',
        'status',
        'user_type',
        'gender',
        'phone_number',
        'date_of_birth',
        'ip',
        'created_at',
        'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
    //
    public function getId(){
        return $this->id;
    }
    public function getLanguage(){
        return $this->hasOne('App\vestidosLanguages','id','preferred_language');
    }
    public function orders(){
        return $this->hasMany('App\vestidosOrders',"user_id");
    }
    public function wishlists(){
        return $this->hasMany('App\vestidosUserWishlists',"user_id");
    }
    public function getStatusName(){
        return $this->belongsTo('App\vestidosStatus',"status");
    }
    public function getFullName(){
        return "{$this->first_name} {$this->middle_name} {$this->last_name}";
    }
    public function rates(){
        return $this->hasMany('App\vestidosProductRates',"user_id");
    }
    public function getAddresses(){
        return $this->hasMany('App\vestidosUserAddresses',"user_id");
    }
    public function getType(){
        return $this->hasOne('App\vestidosUserTypes',"id","user_type");
    }
    public function rollBackApi(){
        do{
            $this->remember_token = str_random(60);
        }while($this->where('remember_token',$this->remember_token)->exists());
        $this->save();
    }
}
