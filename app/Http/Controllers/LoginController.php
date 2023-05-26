<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use PDO;

class LoginController extends Controller
{
    public function index()
    {
        return view('login.index',  [
            'title'=>'Login',
            'active'=>'login'
        ]);
    }
    public function authenticate(Request $request){
        $credentials=$request->validate([
            // 'email'=>'required|email:dns',
            'email'=>'required|email',
            'password'=>'required'
         ]);
         
        if (Auth::attempt( $credentials)) {
            $request->session()->regenerate();
            return redirect()->intended('/dashboard');
        }

        return back()->with('loginEroor', 'Login Failed !!');
    }
    
    public function logout(Request $request)
    {
        Auth::logout();
 
        //Supaya engga bisa di pake lagi
        $request->session()->invalidate();
     //Bikin baru Supaya tidak di bajak
        $request->session()->regenerateToken();
     //kembalikan ke redirect '/'
        return redirect('/');
    }
}
