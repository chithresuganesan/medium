<?php

namespace App\Http\Controllers\Auth;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;

class ResetPasswordController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Password Reset Controller
    |--------------------------------------------------------------------------
    |
    | This controller is responsible for handling password reset requests
    | and uses a simple trait to include this behavior. You're free to
    | explore this trait and override any methods you wish to tweak.
    |
    */

    use ResetsPasswords;

    /**
     * Where to redirect users after resetting their password.
     *
     * @var string
     */
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function changePassword()
    {
        return view('auth.changepassword');
    }


    public function updatePassword(Request $request)
    {

       $user = \Auth::user();
       $validation = Validator::make($request->all(), [
        'current_password' => 'required|current_password:' . $user->password,
        'password' => 'required|min:6|different:current_password|confirmed'
          ]);

          if ($validation->fails()) {
            return redirect()->back()->withErrors($validation->errors());
          }

            $user->password = Hash::make($request->password);
            $user->save();

            return redirect()->back()
                  ->with('success', 'Your new password is now set!');

    }
}
