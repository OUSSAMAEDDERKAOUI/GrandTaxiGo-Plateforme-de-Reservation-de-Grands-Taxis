<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Passenger;
use App\Models\Driver;
use Illuminate\Http\Request;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;


class RegisteredUserController extends Controller
{

    public function showRegister()
    {
        if (Auth::check()) {
            return redirect('/auth/register');
        }
        return view('auth.register');
    }

    public function storeRegister(Request $request)
    {
        $validatedData = $request->validate([
            'f_name' => ['required', 'string', 'max:255'],
            'l_name' => ['required', 'string', 'max:255'],
            'location'=>['required','string', 'max:255'],
            'role' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
        // dd($validatedData);

        if ($request->hasFile('profile_picture')) {
            $profilePicturePath = $request->file('profile_picture')->store('profile_pictures', 'public');
        } else {
            $profilePicturePath = null;
        }


        $user = User::create([
            'f_name' => $validatedData['f_name'],
            'l_name' => $validatedData['l_name'],
            'location' => $validatedData['location'],
            'email' => $validatedData['email'],
            'password' => Hash::make($validatedData['password']),
            'profile_picture' => $profilePicturePath,
            'is_available' =>'true',
        ]);

        if ($request->role == 'passenger') {
            $user->assignRole('passenger');
            event(new Registered($user));
            return to_route('passenger.announcements');
        } elseif ($request->role == 'driver') {
            $user->assignRole('driver');
            event(new Registered($user));
            return to_route('driver.announcements');
        }
    }
    public function login()
    {
        if (Auth::check()) {
            return redirect('/');
        }
        return view('auth.login');
    }


    public function home()
    {

        $user = Auth::user();



        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasRole('passenger')) {
                return to_route('passenger.announcements');
            } elseif ($user->hasRole('driver')) {
                return to_route('driver.announcements');
            }

            return redirect('/auth/login');
        }
    }

    public function loginPoste(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::user();

            if ($user->hasRole('passenger')) {
                return to_route('passenger.announcements');
            } elseif ($user->hasRole('driver')) {
                return to_route('driver.announcements');
            }

            return redirect('/auth/login');
        }

        $validated = $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'string'],
        ]);

        if (Auth::attempt([
            'email' => $validated['email'],
            'password' => $validated['password']
        ], $request->remember)) {

            $user = Auth::user();

            if ($user->roles->contains('name', 'passenger')) {
                return to_route('passenger.announcements');
            } elseif ($user->roles->contains('name', 'driver')) {
                return to_route('driver.announcements');
            }
        }

        return back()->withErrors([
            'email' => 'The provided credentials are incorrect.',
        ])->withInput();
    }



    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/auth/login');
    }
}
