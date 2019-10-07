<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\User;

class LoginController extends Controller
{
    public function login()
    {
        return Socialite::with('steam')->redirect();
    }

    public function redirect()
    {
        $steamUser = Socialite::driver('steam')->user();
        $localUser = User::getFromSteam($steamUser);
        if (!$localUser) {
            return response()->redirectToRoute('home')->with('errorMessage', 'Unable to login');
        }
        Auth::login($localUser);
        return response()->redirectToIntended(route('home'))->with('successMessage', 'You have been logged in');
    }

    public function logout()
    {
        Auth::logout();
        return response()->redirectToIntended(route('home'))->with('successMessage', 'You have been logged out');
    }
}
