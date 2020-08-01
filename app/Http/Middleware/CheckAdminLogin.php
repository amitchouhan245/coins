<?php

namespace App\Http\Middleware;

use Closure, Session, Redirect;

class CheckAdminLogin {
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next) {

        $sessionArray = Session::get($request->segment('1'));

        $segment = $request->segment('1');

        if (empty($sessionArray['id'])) {
     
            return redirect($segment."/login");
        }
       
        return $next($request);
    }
}
