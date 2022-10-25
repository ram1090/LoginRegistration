<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use Illuminate\Support\Facades\Auth;
use App\Providers\RouteServiceProvider;
use Illuminate\Validation\Rules\Password;


class UserController extends Controller
{
    private $response = [];
    public function registerForm()
    {
        return view("auth.register");
    }

    public function registerStore(UserRequest $request)
    {
        User::create($request->all());
        $request->session()->flash('message', '<span class="badge text-bg-success">Well Done</span> User successfully registered !');
        return redirect()->back();
    }


    public function loginForm()
    {
        return view("auth.login");
    }


    public function loginCheck(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate();
            return redirect()->intended(RouteServiceProvider::USER_DASHBOARD);
        }
        else{

            $request->session()->flash('message', '<span class="badge text-bg-danger">Opps </span> Invalid credentials !');
            return redirect()->back()->withInput();
        }
    }

    public function userProfile()
    {
        return view("user.profile");
    }

    public function logout(Request $request)
    {
        Auth::logout();
    
        $request->session()->invalidate();
    
        $request->session()->regenerateToken();
    
        return redirect('/');
    }


}
