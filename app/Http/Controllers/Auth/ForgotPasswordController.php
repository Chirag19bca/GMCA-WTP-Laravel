<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class ForgotPasswordController extends Controller
{
    public function handle(Request $request)
    {
        // STEP 1: Verify enrollment + email
        if (!$request->password) {

            if (!$request->enrollment_no || !$request->email) {
                return back()->with('error', 'All fields are required.');
            }

            $user = DB::table('users')
                ->where('enrollment_no', $request->enrollment_no)
                ->where('email', $request->email)
                ->first();

            if (!$user) {
                return back()->with('error', 'Invalid enrollment number or email.');
            }

            return back()
                ->with('verified', true)
                ->withInput();
        }

        // STEP 2: Reset password
        if ($request->password !== $request->password_confirmation) {
            return back()
                ->with('error', 'Passwords do not match.')
                ->with('verified', true)
                ->withInput();
        }

        DB::table('users')
            ->where('enrollment_no', $request->enrollment_no)
            ->where('email', $request->email)
            ->update([
                'password' => Hash::make($request->password),
            ]);

        return redirect('/login')
            ->with('success', 'Password reset successful. Please login.');
    }
}
