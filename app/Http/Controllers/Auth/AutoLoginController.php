<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class AutoLoginController extends Controller
{
    public function login(Request $request, $user)
    {
        // Allow only in local environment
        if (!app()->isLocal()) {
            abort(403);
        }

        // Preset users (must exist in DB)
        $users = [
            'dhruvil' => 'dhruvil@gmail.com',
            'dhrumil' => 'dhrumil@gmail.com',
            'chirag'  => 'chirag@gmail.com',
        ];

        if (!isset($users[$user])) {
            abort(404);
        }

        $foundUser = User::where('email', $users[$user])->first();

        if (!$foundUser) {
            return redirect('/login')
                ->withErrors(['email' => 'Auto-login user not found in database']);
        }

        Auth::login($foundUser);
        $request->session()->regenerate();

        return redirect('/profile')->with('success', 'Auto login successful');
    }
}
