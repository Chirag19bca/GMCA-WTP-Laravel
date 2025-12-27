<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class ChangePasswordController extends Controller
{
    public function show()
    {
        return view('auth.change-password');
    }

    public function update(Request $request)
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // STEP 1: verify current password
        if (!$request->session()->has('verified')) {

            if (!$request->current_password) {
                return back()->withErrors('Current password is required.');
            }

            if (!Hash::check($request->current_password, $user->password)) {
                return back()->withErrors('Current password is incorrect.');
            }

            // mark verified
            $request->session()->put('verified', true);

            return back()->with('success', 'Password verified. Please set a new password.');
        }

        // STEP 2: update password
        if (!$request->password || !$request->password_confirmation) {
            return back()->withErrors('All fields are required.');
        }

        if ($request->password !== $request->password_confirmation) {
            return back()->withErrors('Passwords do not match.');
        }

        $user->password = Hash::make($request->password);
        $user->save();

        // cleanup
        $request->session()->forget('verified');
        Auth::logout();

        return redirect('/login')
            ->with('success', 'Password changed successfully. Please login again.');
    }
}
