<?php

namespace App\Http\Controllers;
use App\models\user;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\View\View;

class AuthController extends Controller
{
   //
   public function showLogin()
   {
      if (Auth::check()) {
         return redirect('/');
     }
      return view('auth.login');
   }

   public function showRegister()
   {
      if (Auth::check()) {
         return redirect('/');
     }
      return view('auth.register');
   }

   public function login(Request $request)
   {
      if (Auth::check()) {
         return redirect('/');
     }
      $validated = $request->validate([
         'email' => ['required', 'email', 'exists:users,email'],
         'password' => ['required', 'string'],
      ]);

      if (Auth::attempt([
         'email' => $validated['email'],
         'password' => $validated['password']
      ], $request->remember)) {
         return redirect()->intended('/books')->with('success', 'login successful.');
      }

      return back()->withErrors([
         'email' => 'The provided credentials are incorrect.',
      ])->withInput(); 
   }



   
   public function register(Request $request)
   {
      if (Auth::check()) {
         return redirect('/');
     }
      $validated = $request->validate([
         'name' => ['required', 'string', 'max:255'],
         'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
         'password' => ['required', 'string', 'min:8', 'confirmed'],
      ]);

      $user = User::create([
         'name' => $validated['name'],
         'email' => $validated['email'],
         'role'=>'user',
         'password' => Hash::make($validated['password']),
      ]);

      return redirect('/login')->with('success', 'register successful.');
   }

   public function logout(Request $request){
      Auth::logout();
      return redirect('/login')->with('success', 'logout successful.');
   }
}
