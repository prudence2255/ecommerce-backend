<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Notifications\PasswordReset as PasswordResetNotification;
use App\User;
use App\Customer;
use App\PasswordReset;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;

class PasswordResetController extends Controller
{
    /**
     * Create token password reset
     *
     * @param  [string] email
     * @return [string] message
     */
    public function create(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
        ]);
        $user = Customer::where('email', $request->email)->first();

        if (!$user)
            return response()->json([
                'errors' => (Object) ['error' => ['We cant find a user with that e-mail address.']]
            ], 422);

        $passwordReset = PasswordReset::updateOrCreate(
            ['email' => $user->email],
            [
                'email' => $user->email,
                'token' => uniqid()
             ]
        );
        if($user && $passwordReset)
            $user->notify(
                new PasswordResetNotification($passwordReset->token, $user)
            );
        return response()->json('We have e-mailed your password reset link!');
    }
    
     /**
     * Reset password
     *
     * @param  [string] email
     * @param  [string] password
     * @param  [string] password_confirmation
     * @param  [string] token
     * @return [string] message
     * @return [json] user object
     */

    public function reset(Request $request)
    {
        $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string',
            'confirm_password' => 'required|same:password',
        ]);

        $passwordReset = PasswordReset::where([
            ['token', $request->token],
            ['email', $request->email]
        ])->first();

        if (!$passwordReset)
        return response()->json([
            'errors' => (Object) ['error' => ['This password reset token is invalid.']]
        ], 422);

        $user = Customer::where('email', $passwordReset->email)->first();

        if (!$user)
        return response()->json([
            'errors' => (Object) ['error' => ['We cant find a user with that e-mail address.']]
        ], 422);

        $user->password = Hash::make($request->password);
        $user->save();
        $passwordReset->delete();
        return response()->json('Password reset successfully');

    }


    public function update_password(Request $request)
                                 {
                    $request->validate([
                         'current_password' => 'required|string',
                         'new_password' => 'required|string|min:6',
                        'confirm_password' => 'required|string|same:new_password',
                            ]);       
                                          
                        $current_password = $request->current_password;
                        $new_password  = $request->new_password;
        
        if(!Hash::check($current_password, $request->user()->password)){
            return response()->json([
                'errors' => (Object) ['error' => ['The old password did not match.']]
            ], 422);
         }
             else{
            $request->user()->fill(['password' => Hash::make($new_password)])->save();
             return response('Password reset successfully');

     }
    }
}
