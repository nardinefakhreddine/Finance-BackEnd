<?php

namespace App\Http\Controllers;
use App\Models\Admins;
use Illuminate\Http\Request;
use App\Http\Requests\RegisterRequest;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;
use Illuminate\Support\Facades\Hash;

class AdminsController extends Controller

{

    public function index(){
         $admins=Admins::paginate(3);
        return response()->json($admins);
    }
    
       public function CreateAdmin(Request $request){
           //Like insert into Query
           //Insert Values in DB
           $admin =Admins::create(
               [
                   'name'=>$request->name,
                   'email'=>$request->email,
                   'password'=>$request->password,
                   //OR bcrypt() to hash
               ]);
              // Log a user in and return a jwt for them.
             // $token =auth()->login($admin);
              return response()->json($admin);
               //return the first row of the table
              // $user = Admins::first();
               
       }

       //$token = auth('api')->attempt($credentials);define a specific guard

    public function login (Request $request){
       
        // $credentials=$request->input();all()
        $credentials=$request->only(['email','password']);
         //here if email and pass exist in db return a  specific token
         //// Generate a token for the user if the credentials are valid
        //$token = JWTAuth::attempt($credentials);
        $token=auth()->attempt($credentials);
      
      try{ 
          if( ! $token){
            return response()->json(['Invalid Credentails']);
          }

      }catch(JWTException $e){
        return response()->json(['can t create token']);
    }
   $token =response()->json(compact('token'));
    return $token;


}


   /*try{
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
       // $user_id=auth()->admins();//we get all info of user
      //  $user_id=auth()->admins()->id;//we get ids of admins
        return $this->respondWithToken($token);
        
  
    
        try{
            if(! $token = JWTAuth::attempt($credentials)){
                return response()->json(['invalid credentails']);
            }
        }catch(JWTException $e){
            return response()->json(['cant create token']);
        }
         
        */
    
    


    public function logout(){
        //Log the user out - which will invalidate
        // the current token and unset the authenticated user.
        auth()->logout();
        // Pass true to force the token to be blacklisted "forever"
       //auth()->logout(true);
        return response()->json(['success logout']);
    }


    public function updateAdmin(Request $request,$id){
    
        $admins=admins::find($id);
        $admins->name     = $request->name;
        $admins->email    = $request->email;
        $admins->password=$request->password;
        $admins->save();
      
        return response()->json(compact('admins'));
    }


    public function getAdmin(){
        $admins=Admins::orderBy('id','desc')->paginate(3);
        $response=response()->json(compact('admins'));
        return $response;
    }
    public function edit($id){
          $admin=Admins::find($id);
          return response()->json($admin);
    }

    public function getCount(){
		$admins=Admins::all();
		$adminsCount=$admins->count();
		return response()->json(compact('adminsCount'));
	}
    public function deleteAdmin($id){
        $admins=Admins::find($id);
        $admins->delete();
        return response()->json(compact('admins'));
    }
    


protected  function respondWithToken($token){
   
    return response()->json([
        'access-token'=>$token,
        'token-type'=>'bearer',
        /*lenght of time in minutes (config/jwt.php) to edit it
        in .env EDIT JWT_TTL=??
        WE CAN ALSO SET THIS TO NULL TO NEVER EXPIRED*/
        'expires-in'=>auth()->factory()->getTTl()*60,
        //// Get the currently authenticated user
        'admin'=>auth()->user()
    ]);
}



}