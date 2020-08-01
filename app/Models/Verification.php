<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Verification extends Model
{
	    protected $fillable = ['id','user_id','code','for','created_at','deleted_at','updated_at'];

}
