<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use App\Models\State;

class City extends Model {

	use SoftDeletes;
	
	protected $table = "cities";
	protected $dates = ['deleted_at'];

	public function getCityNameAttribute($value){
        
        return ucfirst($value);
	}

    public function state(){

		return $this->belongsTo(State::class, 'state_id','id');  
	}
   
}
