<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Http\Controllers\UserController;

class UserController extends Controller
{
    // Registering User
    public function create(){
        return view('users.register');
    }
    // Login User
    public function login(){
        return view('users.login');
    }
    public function store(Request $request){
        $formFields = $request->validate([
                'name'=>['required','min:3'],
                'email'=>['required','email',Rule::unique('users','email')],
                'password'=>['required','confirmed','min:6']
            ]);
            // Hashing Password
        $formFields['password'] = bcrypt($formFields['password']);
        // Create User
        $user = User::create($formFields);
        // Login User
        auth()->login($user);
        // Redirect after login 
        return redirect('/')->with('message',"User Created and Logged in Successfully");
    }
    // Logout User
    public function logout(Request $request){
        auth()->logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/')->with('message','You are Logged Out');
    }
    // Login User
    public function authenticate(Request $request){
        $formFields = $request->validate([
            'email'=>['required','email'],
            'password'=>['required']
        ]);
        if(auth()->attempt($formFields)){
            $request->session()->regenerate();
            return redirect('/')->with('message','You are now Logged In');
        }
        return back()->withErrors(['email'=>'Invalid Credentials'])->onlyInput('email');
        
    }
}
