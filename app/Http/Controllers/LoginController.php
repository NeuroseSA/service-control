<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function login()
    {
        return view('user.login');
    }

    public function authenticate(Request $request)
    {
        $autEmail = User::where('email', $request->input('email'))->first();
        $autPass = User::where('password', $request->input('password'))->first();

        if (isset( $autEmail) && isset($autPass)) {
            Auth::login($autEmail);
            return view('index');            
        }else{
            return view('user.login');
        }

    } 

    public function logout(){
        Auth::logout();
        return redirect(route('user.login'));
    }
}
