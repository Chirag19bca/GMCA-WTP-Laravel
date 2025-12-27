<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class ProfileController extends Controller
{
    public function show()
    {
        // replaces: if (!isset($_SESSION['user_id']))
        if (!Auth::check()) {
            return redirect('/login');
        }

        $userId = Auth::id();

        // 1-to-1 conversion of your SQL
        $profile = DB::table('users as u')
            ->join('student_profile as sp', 'u.id', '=', 'sp.user_id')
            ->leftJoin('education_details as ed', 'sp.user_id', '=', 'ed.user_id')
            ->where('u.id', $userId)
            ->select(
                'u.enrollment_no',

                'sp.fname',
                'sp.lname',
                'sp.email',
                'sp.dob',
                'sp.gender',
                'sp.contact',
                'sp.address',

                'ed.ssc_school',
                'ed.ssc_board',
                'ed.ssc_percentage',

                'ed.hsc_school',
                'ed.hsc_board',
                'ed.hsc_percentage'
            )
            ->first();

        // If profile not created yet
        if (!$profile) {
            return view('profile', ['profile' => null]);
        }

        return view('profile', compact('profile'));
    }
}
