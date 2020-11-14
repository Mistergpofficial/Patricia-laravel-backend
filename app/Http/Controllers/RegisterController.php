<?php

namespace App\Http\Controllers;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\Request;
use App\Http\Requests\postUser;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Http\Response;

class RegisterController extends Controller
{
	use RegistersUsers;

	protected $redirectTo = RouteServiceProvider::HOME;

	public $successStatus = 200;
    public $loginAfterSignUp = true;


	public function __construct()
    {
        $this->middleware('guest');
	}
	
	
	public function register(postUser $request)
    {

		// $user = new User([
		// 	'email' => $request->email,
		// 	'username' => $request->username,
		// 	'password' => bcrypt($request->input['password'])
		// ]);

		// if($user->save()){
		// 	return response()->json([
		// 		'createdData' => $user,
		// 	], $this->successStatus);
		// }
		// return response()->json(['message' => 'User creation failed'], 400);


        $validator = Validator::make($request->all(), [
			'email' => 'required|string|email|max:255|unique:users',
			'username' => 'required',
			'password' => 'required|min:8|confirmed'
        ]);
   
        if($validator->fails()){
			
			return response()->json($validator->errors());
           // return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->accessToken;
		$success['email'] =  $user->email;
		$success['phone'] =  $user->phone;
   
		return response()->json([
            'createdData' => $user,
            'success' => $success
        ], $this->successStatus);
	}
	

}

