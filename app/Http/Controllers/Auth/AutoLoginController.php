<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class AutoLoginController extends Controller
{
    public function login($user)
    {
        // Prevent switching while logged in
        if (Auth::check()) {
            return redirect('/profile');
        }

        // Map photo name → email
        $map = [
            'Dhruvil' => 'dhruvil@gmail.com',
            'Dhrumil' => 'dhrumil@gmail.com',
            'Chirag'  => 'chirag@gmail.com',
        ];

        if (!isset($map[$user])) {
            return redirect('/');
        }

        $dbUser = DB::table('users')
            ->where('email', $map[$user])
            ->first();

        if (!$dbUser) {
            return redirect('/login')
                ->withErrors('Auto login user not found.');
        }

        Auth::loginUsingId($dbUser->id);

        return redirect('/profile');
    }
}
