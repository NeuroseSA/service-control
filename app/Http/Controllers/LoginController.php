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
        $user = User::where('email', $request->input('email'))->first();
    
        if (isset( $user) && $user->password == $request->input('password') ) {
                Auth::login($user);
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
