<?php

namespace App\Http\Controllers;
use App\User;
use Illuminate\Http\Facades\Validator;
use Illuminate\Http\Request;
use TymonJWTAuthExceptionsJWTException;

class JwtAuthController extends Controller
{
	public $token = true;
  
    public function register(Request $request)
    {
 
         $validator = Validator::make($request->all(), 
                      [ 
                      'email' => 'required|string|email|max:255|unique:users',
					  'username' => 'required',
					  'password' => 'required|string|min:6|confirmed',
                     // 'password' => 'required',  
                     // 'c_password' => 'required|same:password', 
                     ]);  
 
         if ($validator->fails()) {  
 
               return response()->json(['error'=>$validator->errors()], 401); 
 
            }   
 
 
        $user = new User();
        $user->email = $request->email;
        $user->username = $request->username;
        $user->password = bcrypt($request->password);
        $user->save();
  
        if ($this->token) {
            return $this->login($request);
        }
  
        return response()->json([
            'success' => true,
            'data' => $user
        ], Response::HTTP_OK);
	}
	
}
