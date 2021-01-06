<?php

namespace App\Http\Controllers\admins;
use App\Models\Admins;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller
{
       public function register(Request $request){
           $admin =Admins::create(
               [
                   'name'=>$request->name,
                   'email'=>$request->email,
                   'password'=>$request->password,
               ]);
               $token =auth()->login($admin);
               return $this->respondWithToken($token);
       }



    public function login (){
        
        return['test'];
       /* $credentials=$request->only('email','password');

        try{
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json(['invalid credentails']);
            }
        }catch(JWTException $e){
            return response()->json(['cant create token']);
        }
            
        return response()->json(compact('token'));
        
     /*   $credentials=request(['email','password']);
        if(! $token =auth()->attempt($credentials)){
            return response()->json(['error'=>'Unauthorized']);
        }
       // $user_id=auth()->admins();//we get all info og user
      //  $user_id=auth()->admins()->id;//we get ids of admins
        return $this->respondWithToken($token);
        
  
    
        try{
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json(['invalid credentails']);
            }
        }catch(JWTException $e){
            return response()->json(['cant create token']);
        }
            
        return response()->json(compact('token'));
        */
    }
    


    public function logout(){
        auth()->logout();
        return response()->json(['success logout']);
    }


protected  function respondWithToken($token){
   
    return response()->json([
        'access-token'=>$token,
        'token-type'=>'bearer',
        'expires-in'=>auth()->factory()->getTTl()*60,
        'admin'=>auth()->admins()
    ]);
}
}