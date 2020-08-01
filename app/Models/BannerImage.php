<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class BannerImage extends Model {

	use SoftDeletes;

    protected $fillable = [
    	
        'title','description', 'image','status', 'created_at','updated_at','deleted_at'
    ];
	
	protected $table = "banner_images";
	protected $dates = ['deleted_at'];
    
}
