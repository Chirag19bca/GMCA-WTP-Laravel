<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class LoginController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect('/profile');
        }

        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'password' => 'required',
        ]);

        $email        = trim($request->email ?? '');
        $enrollmentNo = trim($request->enrollment_no ?? '');
        $password     = $request->password;

        if ($email === '' && $enrollmentNo === '') {
            return back()->withErrors([
                'email' => 'Provide enrollment number or email.'
            ]);
        }

        /* ----------------------------
           CASE 1: Email + Enrollment
        -----------------------------*/
        if ($email && $enrollmentNo) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                return back()->withErrors([
                    'email' => 'Email not registered.'
                ]);
            }

            if (!Hash::check($password, $user->password)) {
                return back()->withErrors([
                    'password' => 'Incorrect password.'
                ]);
            }

            if ($user->enrollment_no !== $enrollmentNo) {
                return back()->withErrors([
                    'enrollment_no' => 'Enrollment number does not match email.'
                ]);
            }

            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/profile')->with('success', 'Login successful.');
        }

        /* ----------------------------
           CASE 2: Only Email
        -----------------------------*/
        if ($email) {
            $user = User::where('email', $email)->first();

            if (!$user) {
                return back()->withErrors([
                    'email' => 'User not found.'
                ]);
            }

            // if (!Hash::check($password, $user->password)) {
            //     return back()->withErrors([
            //         'password' => 'Incorrect password.'
            //     ]);
            // }

            Auth::login($user);
            $request->session()->regenerate();

            return redirect('/profile')->with('success', 'Login successful.');
        }

        /* ----------------------------
           CASE 3: Only Enrollment No
        -----------------------------*/
        $user = User::where('enrollment_no', $enrollmentNo)->first();

        if (!$user) {
            return back()->withErrors([
                'enrollment_no' => 'User not found.'
            ]);
        }

        if (!Hash::check($password, $user->password)) {
            return back()->withErrors([
                'password' => 'Incorrect password.'
            ]);
        }

        Auth::login($user);
        $request->session()->regenerate();

        return redirect('/profile')->with('success', 'Login successful.');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return redirect('/')->with('success', 'Logged out successfully.');
    }
}
