<?php

namespace App\Http\Middleware;

use Closure;
use JWTAuth;
use Exception;
use Tymon\JWTAuth\Http\Middleware\BaseMiddleware;



class JwtMiddleware extends BaseMiddleWare
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

     /*   try {

            if (! $admin = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['user_not_found'], 404);
            }
    
        } catch (Tymon\JWTAuth\Exceptions\TokenExpiredException $e) {
    
            return response()->json(['token_expired'], $e->getStatusCode());
    
        } catch (Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
    
            return response()->json(['token_invalid'], $e->getStatusCode());
    
        } catch (Tymon\JWTAuth\Exceptions\JWTException $e) {
    
            return response()->json(['token_absent'], $e->getStatusCode());
    
        }*/
  

        try{
            //if the token from front end work? validate in back end?
            $admin=JWTAuth::parseToken()->authenticate();
            $request->merge(['Admin' => $admin]);
            //The instanceof keyword is used to check if an object belongs to a class
        }catch(Exception $e){
            if($e instanceof \Tymon\JWTAuth\Exceptions\TokenInvalidException){
                return response()->json(['status'=>'Token is Invalid']);
            }
            else if ($e instanceof \Tymon\JWTAuth\Exceptions\TokenExpiredException){
                return response()->json(['status'=>'Token is Expired']);
            }
          // else if ( $e instanceof \Tymon\JWTAuth\Exceptions\JWTException) {
            //return response()->json(['status'=>'token_absent']);
      //  }

            else{
                return response()->json(['status'=>'Authorization Token not Found']);
            }

       // return response()->json($request);
       // the token is valid and we have found the user via the sub claim
	//return response()->json(compact('admin'));
        }
       return $next($request); 
        


}
}