<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class RegisterController extends Controller
{
    public function show()
    {
        if (Auth::check()) {
            return redirect('/profile');
        }

        return view('auth.register');
    }

    public function register(Request $request)
    {
        /* ---------- 1. Validate ---------- */
        if (
            !$request->enrollment_no ||
            !$request->fname ||
            !$request->lname ||
            !$request->email ||
            !$request->password
        ) {
            return back()
                ->withErrors('All fields are required.')
                ->withInput();
        }

        if (!filter_var($request->email, FILTER_VALIDATE_EMAIL)) {
            return back()
                ->withErrors('Invalid email format.')
                ->withInput();
        }

        /* ---------- 2. Check duplicate ---------- */
        $exists = DB::table('users')
            ->where('enrollment_no', $request->enrollment_no)
            ->orWhere('email', $request->email)
            ->exists();

        if ($exists) {
            return back()
                ->withErrors('User with this enrollment number or email already exists.')
                ->withInput();
        }

        /* ---------- 3. Insert into users (NO timestamps) ---------- */
        $userId = DB::table('users')->insertGetId([
            'enrollment_no' => $request->enrollment_no,
            'email'         => $request->email,
            'password'      => Hash::make($request->password),
        ]);

        /* ---------- 4. Insert into student_profile ---------- */
        DB::table('student_profile')->insert([
            'user_id' => $userId,
            'fname'   => $request->fname,
            'lname'   => $request->lname,
            'dob'     => null,
            'gender'  => null,
            'contact' => null,
            'address' => null,
            'email'   => $request->email,
        ]);

        /* ---------- 5. DO NOT auto login ---------- */
        Auth::logout();

        /* ---------- 6. Redirect to login ---------- */
        return redirect('/login')
            ->with('success', 'Registration successful. Please login.');
    }
}
