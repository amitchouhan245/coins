<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use Exception;

class CheckToken
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {

        try {
            
            $user = JWTAuth::parseToken()->authenticate();
            
            if ($user != "") {

                $request->attributes->add(['user' => $user]);
                
            }else{
                
                return response()->json(['success' => false,'message'=>'Oops! Looks like your account has been deleted.', 'code' => 259]);
            }

        }catch (Exception $e) {
           
            if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                
                return response()->json(['success' => false, 
                                         'message'=>'Oops! Session expired', 
                                         'msg-dev'=>'Token is Invalid', 
                                         'code' => 259]);
            
            }else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
            
                return response()->json(['success' => false,
                                        'message'=>'Token is Expired', 
                                        'msg-dev'=>'Oops! Session expired',
                                        'code' => 259]);
            
            }else{
            
                return response()->json(['success' => false,'message'=>'Oops! Something is wrong', 'code' => 259]);
            }
        
        }
        return $next($request);
    }
}
