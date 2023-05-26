<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class RegisterController extends Controller
{
    public function index()
    {
        return view('register.index',  [
            'title'=>'Register',
            'active'=>'register'
        ]);
    }
    public function store(Request $request)
    {
        // Rule untuk validasi
        $validatedData = $request->validate([
            'name'=>'required|max:255',
             'user_name'=> ['required','min:3','max:255','unique:users'],
             'email' => 'required|email:dns|unique:users',
             'password'=>'required|min:5|max:255'
        ]);

        // 2 cara membuat backrypt password jika menggunakan has harus ada use Illuminate\Support\Facades\Hash; di atas
       // $validatedData['password']=bcrypt($validatedData['password']);
       $validatedData['password'] = Hash::make($validatedData['password']);

        User::create($validatedData);
        //  untuk menambah alert di atas atau pesan
        // $request->session()->flash('success', 'Registration Succesfull!! please login');
        // with('success', 'Registration Succesfull!! please login') jg di gunakan untuk menampilkan pesan
        return redirect('/login')->with('success', 'Registration Succesfull!! please login');
    }
}
