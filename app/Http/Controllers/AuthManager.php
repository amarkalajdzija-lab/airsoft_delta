<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;     // ✅ za logout
use Illuminate\Support\Facades\Session;  // ✅ za flush sesije
use Illuminate\Support\Facades\RateLimiter;
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


public function loginPost(Request $request)
{
    $key = 'login:' . $request->ip();

    if (RateLimiter::tooManyAttempts($key, 5)) {
        $seconds = RateLimiter::availableIn($key);
        return back()->withErrors([
            'email' => "Previše pokušaja. Pokušajte ponovo za {$seconds}s."
        ]);
    }

    $request->validate([
        'email'    => 'required|email',
        'password' => 'required',
    ]);

    if (Auth::attempt($request->only('email', 'password'))) {
        RateLimiter::clear($key);
        return redirect()->route('home');
    }

    RateLimiter::hit($key, 60); // count this failed attempt, decay 60s
    return back()->with('error', 'Uneseni podaci su netačni!');
}

    public function registrationPost(Request $request)
    {
        $request->validate(
            [
                'name'=>'required',
                'email'=>'required|email|unique:users',
                'password|min:8'=>'required',
                'password_confirmation'=>'required'
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

