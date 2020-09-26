<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Customer; 
use Illuminate\Support\Facades\Auth; 
use Illuminate\Support\Facades\Hash;
use Session;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Support\Str;

class CustomerController extends Controller
{
   
    public $successStatus = 200;
/** 
     * login api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function login(Request $request){ 
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $remember_me = $request->has('remember_me') ? true : false; 

       $customer = Customer::where('email', $request->email)->first(); 
       if($customer){
           if(Hash::check($request->password, $customer->password)){
            $token = $customer->createToken('token')->accessToken;  
            return response()->json([
                'data' => $customer, 
                'token' => $token,
            ],
             $this->successStatus); 
           }else{ 
            return response()->json([
                            'errors' => (Object) ['error' => ['Email or password invalid']]],
                             422); 
        } 
       }else{ 
        return response()->json([
                        'errors' => (Object) ['error' => ['Email or password invalid']]],
                         422); 
    } 
        
    }
/** 
     * Register api 
     * 
     * @return \Illuminate\Http\Response 
     */ 
    public function register(Request $request) 
    { 
        $request->validate([
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password' => 'required|min:6',
            'c_password' => 'required|same:password',
        ]);
         $password = Hash::make($request->password); 
        $customer = Customer::create([
            'name' => $request->name,
            'email' => $request->email,
            'provider' => null,
            'password' => $password,
            'uid' => IdGenerator::generate(['table' => 'users','field' =>'uid', 
                                        'length' => 6, 'prefix' => date('y')])
            ]);    
        if($customer){
            $token =  $customer->createToken('token')->accessToken; 
            return response()->json([
                                'data' => $customer, 'token' => $token,
                                'message' => 'User created successfully',
                            ],
             $this->successStatus);
        }else{
            return response()->json([
                'errors' => (Object) ['error' => ['Something went wrong']]]
                 , 422); 
        }
    }
/** 
     * details api 
     * 
     * @return \Illuminate\Http\Response 
     */ 

    //fetch all users api
    public function index() {
        return response()->json(['data' => Customer::orderBy('updated_at', 'DESC')->paginate(10)], 
                                $this->successStatus);
         
    }
    
    //show user api
    public function show(Customer $customer) {
        return response()->json(['data' => $customer]);
    }

    public function login_customer() {
        $customer = Auth::guard('customer')->user();

        return response()->json(['data' => $customer]);
    }
//update user api

    public function update(Request $request) {
        $customer = auth::guard('customer')->user();
        $customer->slug = null;
        $customer->update(['name' => $request->name]);
        return response()->json([
            'message' => 'User updated successfully',
            'data' => $customer,
        ],  $this->successStatus);
    }

    public function destroy(Customer $customer) {
        $customer->delete();
        return response()->json([
            'message' => 'User deleted successfully'
        ],  $this->successStatus);
    }

     public function logout(Request $request) {
       $token = $request->user()->token();
        $token->revoke();
        return response()->json([
            'message' => 'Successfully logged out'
        ], 200);
     }      
}

