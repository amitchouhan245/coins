<?php

namespace App;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id','first_name','last_name', 'email', 'password', 'country_code','mobile_number',
        'user_type', 'created_at', 'social_id','is_verified','profile_image','updated_at','is_mobile_verified','status','deleted_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *  
     * @var array
     */
    protected $hidden = [

        'password', 'remember_token',
    ];    

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }
    protected $appends = ['name'];
    
    public function getNameAttribute($value){
      
    return ucfirst($this->first_name).' '.ucfirst($this->last_name);
    }

}
