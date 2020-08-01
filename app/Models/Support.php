<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Support extends Model {

    protected $table = "supports";
    
    protected $fillable = [

       'id','from_id','to_id','message','status','created_at','updated_at','deleted_at'
    ];

    protected $appends = ['date'];

    public function fromUser(){

		return $this->belongsTo(User::class, 'from_id','id');  
	}

	public function getDateAttribute(){

    	return date_format($this->created_at,"Y-m-d g:i A");
    }
}
