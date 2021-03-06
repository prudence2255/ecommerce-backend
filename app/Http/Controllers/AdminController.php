<?php

namespace App\Http\Controllers;

use Session;
use App\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\NewAdminRequest;
use Illuminate\Support\Facades\Storage;
use App\Http\Requests\AdminLoginRequest;
use App\Http\Requests\AdminUpdateRequest;
use Illuminate\Support\Facades\Validator;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class AdminController extends Controller
{

    public $successStatus = 200;

    public function __construct() {
      $this->middleware('auth:api')->except(['login']);

    }

/**
     * login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(AdminLoginRequest $request){

        $remember_me = $request->has('remember_me') ? true : false;

        if(Auth::attempt(['email' => request('email'),
                         'password' => request('password')],
                         $remember_me)){
            $user = Auth::user();
            $token = $user->createToken('token')->accessToken;

            return response()->json([
                'data' => $user,
                'token' => $token,
            ],
             $this->successStatus);
        }
        else{
            return response()->json([
                            'errors' => (Object) ['error' => ['Email or password invalid']]]
                             , 422);
        }
    }
/**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(NewAdminRequest $request)
    {
         $password = Hash::make($request->password);
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => $password,
            'uid' => IdGenerator::generate(['table' => 'users','field' =>'uid',
                                        'length' => 6, 'prefix' => date('y')])
            //'user_img' => $request->user_img,
        ]);
        $token =  $user->createToken('token')->accessToken;

        if($user){
            return response()->json([
                                'data' => $user, 'token' => $token,
                                'message' => 'User created successfully',
                            ],
             $this->successStatus);
        }
    }
/**
     * details api
     *
     * @return \Illuminate\Http\Response
     */
    public function user_details()
    {
        $user = Auth::user();
        return response()->json(['data' => $user], $this->successStatus);
    }

    //fetch all users api
    public function index() {
        return  response()->json(['data' => User::orderBy('updated_at', 'DESC')->paginate(10)],
                                $this->successStatus);

    }

    //show user api
    public function show(User $user) {
        return response()->json(['data' => $user]);
    }

//update user api

    public function update(AdminUpdateRequest $request) {

        $user = auth()->user();
        $user->slug = null;
        $user->update(['name' => $request->name]);
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $user,
        ],  $this->successStatus);
    }

    /**
     * remove the specified user
     */
    public function destroy(User $user) {
        if($user->id === Auth::user()->id){
            return response()->json(['errors' => (Object) ['error' => ['Login admin cannot be deleted']]], 422);
        }
        $user->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ],  $this->successStatus);
    }

    /**
     * make user an admin
     */

    public function makeAdmin(User $user) {
        $user->role = 'admin';
        $user->save();

        return response([
            'message' => 'User successfully made an admin'
        ], $this->successStatus);
        }

        /**
         * logout the specified user
         */

     public function logout() {
        auth()->user()->token()->revoke();
        Session::flush();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
     }

}

