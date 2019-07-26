<?php

namespace App\Http\Controllers\Auth;

use Illuminate\Http\Request;
use App\User;
use Auth;
use Hash;
use Validator;
use Illuminate\Support\Facades\Session;
use App\Util\Utils;
use App\Http\Controllers\Controller;

class PasswordController extends Controller
{
    //
    /**
     * @return mixed
     */
    public function change()
    {
        Session::put('title', 'Change Password');
        return view('auth.passwords.change');
    }

    /**
     * @return mixed Redirect
     */
    public function update()
    {
        // custom validator
        Validator::extend('password', function ($attribute, $value, $parameters, $validator) {
            return Hash::check($value, \Auth::user()->password);
        });

        // message for custom validation
        $messages = [
            'password' => 'Invalid current password.',
        ];

        // validate form
        $validator = Validator::make(request()->all(), [
            'current_password'      => 'required|password',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',

        ], $messages);

        // if validation fails
        if ($validator->fails()) {
            return redirect()
                ->back()
                ->withErrors($validator->errors());
        }

        // update password
        $user = User::find(Auth::id());

        $user->password = bcrypt(request('password'));
        $user->save();

        return redirect()
            ->route('password.change')
            ->withSuccess('Password has been updated.');
    }

}
