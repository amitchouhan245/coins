<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class MobileOtp extends Model {
    

    protected $table = 'mobile_otp';


    protected $fillable = [

        'mobile_number','code','created_at','updated_at','deleted_at'
    ];
}
