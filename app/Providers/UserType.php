<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Request, View;

class UserType extends ServiceProvider {
    
    public function boot() {

        $type = Request::segment(1);

        $appUrl = url('/')."/".$type."/";
        View::share('app_url', $appUrl);
    }

    public function register() {

       /* $type = Request::segment(1);
    
        $appUrl = url('/')."/".$type."/";
        View::share('app_url', $appUrl);*/
        
    }
}
