<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class User extends Model {

    use SoftDeletes, Notifiable;

    protected $fillable = [

        'name', 'email', 'password', 'country_code','status','mobile_number','user_type', 'created_at','verification_code', 'profile_image','updated_at','deleted_at','is_mobile_verified','address','user_name'
    ];

    protected $appends = ['mobile'];

    public function scopeOfType($query, $type) {
        
        return $query->where('user_type', $type);
    }

    public function getMobileAttribute($value) {
        
        return ucwords($this->country_code.' '.$this->mobile_number);

    }

    public function scopeActive($query) {

        return $query->where('status', '1');
    }

}
