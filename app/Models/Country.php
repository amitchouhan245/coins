<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Country extends Model{

    protected $table = 'countries';
	protected $dates = ['deleted_at'];
    
    use SoftDeletes;

    // RELATIONS
    public function getCountryNameAttribute($value){
       
        return ucfirst($value);
    }
    
    public function states(){
       
		return $this->hasMany(State::class, 'country_id', 'id');  
    }
}