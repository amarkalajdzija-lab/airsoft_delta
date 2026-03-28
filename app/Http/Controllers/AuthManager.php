<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;     // ✅ za logout
use Illuminate\Support\Facades\Session;  // ✅ za flush sesije
use App\Models\User;

class AuthManager extends Controller
{
    public function login()
    {
        return view('login');
    }

    public function registration()
    {
        return view('registration');
    }

    public function LoginPost(Request $request)
    {
        $request->validate(
            [
                'email'=>'required',
                'password'=>'required'
                ]
        );
        $credentials = $request->only('email', 'password');
        if(Auth::attempt($credentials)){
            return redirect()->intended(route('home'));
        }
        return redirect(route('login'))->with("error", "Uneseni podaci su netačni!");
    }

    public function registrationPost(Request $request)
    {
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password'=>'required'
                ]
        );
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['password'] = Hash::make($request->password);
        $user = User::create($data);
        if(!$user){
            return redirect(route('registration'))->with("error", "Registracija neuspjela. Pokušajte ponovo.");
        }
        return redirect(route('login'))->with("success", "Registracija uspješna!");
    }

    public function logout(){
        Session::flush();
        Auth::logout();
        return redirect(route('login'));
    }
    
    
}

