<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use App\Models\Country;
 	

class State extends Model
{
 	protected $dates = ['deleted_at'];

	public function getStateNameAttribute($value)
    {
        return ucfirst($value);
	}
	
    public function country(){
			
		return $this->belongsTo(Country::class, 'country_id', 'id');  

	}

    public function cities(){
       
		return $this->hasMany(City::class, 'state_id', 'id');  
    }
}
