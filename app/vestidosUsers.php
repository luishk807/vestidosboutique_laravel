<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon as carbon;

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
    public function isAdmin(){
        return $this->user_type==2;
    }
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
    public function getGender(){
        return $this->belongsTo('App\vestidosGenders',"gender");
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
    public function getLatestTen(){
        $users = DB::table("vestidos_users as users")
        ->select("users.*","status.name as status_name","gender.name as gender_name")
        ->orderBy("users.created_at","desc")
        ->join("vestidos_statuses as status","status.id","users.status")
        ->join("vestidos_genders as gender","gender.id","users.gender")
        ->where("users.user_type","=",1)
        ->limit(10)
        ->get();
        return $users;
    }
    public function getUnapprovedUsers(){
        $users = DB::table("vestidos_users as users")
        ->select("users.*","status.name as status_name","gender.name as gender_name")
        ->where("users.status","!=","1")
        ->whereAnd("users.user_type","1")
        ->orderBy("users.created_at","desc")
        ->join("vestidos_genders as gender","users.gender","gender.id")
        ->join("vestidos_statuses as status","status.id","users.status")
        ->where("users.user_type","=",1)
        ->limit(10)
        ->get();
        return $users;
    }
    public function getTotalGender(){
        $users = DB::table("vestidos_users")
        ->select(DB::raw("COUNT(*) as male"),DB::raw("COUNT(*) as female"))
        ->get();
        return $users;
    }
    public function getUsersByIds($ids){
        $id_list =[];
         foreach($ids as $id){
             $id_list[]=$id;
         }
         $products = DB::table("vestidos_users as users")
         ->select("users.id as id","users.first_name as col_1","users.email as col_2","types.name as col_3","gender.name as col_4")
         ->whereIn('users.id',$id_list)
         ->join("vestidos_genders as gender","gender.id","users.gender")
         ->join("vestidos_user_types as types","types.id","users.user_type")
         ->join("vestidos_statuses as status","status.id","users.status")
         ->groupBy("users.id")
         ->get();
         return $products;
     }
    public function getRangeAges(){
        $user=[];
        $range = 18;
        $range_limit = 90;
        $increase = 20;
        $range_counts = [];
        $range_titles = [];
        while($range < $range_limit){
            $range_b = $range + $increase;
            
            $user = DB::table("vestidos_users")
            ->select(DB::raw("COUNT(*) as count"))
            ->whereRaw("DATEDIFF('".carbon::now()."', date_of_birth)/365 > ".$range)
            ->whereRaw("DATEDIFF('".carbon::now()."', date_of_birth)/365 < ".$range_b)
            ->get()->toArray();
            $range_info[] = [
                "name"=>$range."-".$range_b,
                "y"=>$user[0]->count
            ];

            $range = $range_b;
        }
        $range_info = json_encode($range_info,JSON_NUMERIC_CHECK);
        return $range_info;

    }
}
