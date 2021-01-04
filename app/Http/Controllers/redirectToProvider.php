<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class redirectToProvider extends Controller
{
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }
}
