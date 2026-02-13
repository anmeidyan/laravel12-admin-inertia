<?php

namespace App\Http\Controllers\Admin;

use App\Services\Interfaces\AuthServiceInterface;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{   
    public function __construct(protected AuthServiceInterface $authService)
    {
        $this->authService = $authService;
    }

    public function registerForm(){
        return view('admin.auth.register');
    }

    public function registerPost(Request $request){
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'password_confirm' => 'required|string|min:6|same:password',
        ]);

        $this->authService->register($validated);

        return redirect()->route('admin.login')->with('success','Registration successful! Please login.');
    }

    public function loginForm(){
        if(auth()->check()){
            return redirect()->route('admin.dashboard');
        }
        
        return view('admin.auth.login');
    }

    public function loginPost(Request $request){
        $validated = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string|min:6',
        ]);

        $remember = $request->boolean('remember');

        $auth = $this->authService->login($validated, $remember);

        if($auth){
            return redirect()->route('admin.dashboard');
        }else{
            return redirect()->route('admin.login')->with('danger','Access denied!');
        }
    }

    public function logout(Request $request){
        $this->authService->logout($request);

        return redirect()->route('admin.login');
    }
}
