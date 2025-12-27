<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentFormController extends Controller
{
    public function show()
    {
        $userId = Auth::id();

        $profile = DB::table('users')
            ->join('student_profile', 'users.id', '=', 'student_profile.user_id')
            ->where('users.id', $userId)
            ->select(
                'users.enrollment_no',
                'users.email',
                'student_profile.fname',
                'student_profile.lname',
                'student_profile.dob',
                'student_profile.gender',
                'student_profile.contact',
                'student_profile.address'
            )
            ->first();

        $education = DB::table('education_details')
            ->where('user_id', $userId)
            ->first();

        return view('studentform', compact('profile', 'education'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id();

        /* ---------- UPDATE student_profile ---------- */
        DB::table('student_profile')
            ->where('user_id', $userId)
            ->update([
                'dob'     => $request->dob,
                'gender'  => $request->gender,
                'contact' => $request->contact_no,
                'address' => $request->address,
            ]);

        /* ---------- INSERT or UPDATE education_details ---------- */
        $exists = DB::table('education_details')
            ->where('user_id', $userId)
            ->exists();

        $educationData = [
            'ssc_school'     => $request->ssc_school,
            'ssc_board'      => $request->ssc_board,
            'ssc_percentage' => $request->ssc_percentage,
            'hsc_school'     => $request->hsc_school,
            'hsc_board'      => $request->hsc_board,
            'hsc_percentage' => $request->hsc_percentage,
        ];

        if ($exists) {
            DB::table('education_details')
                ->where('user_id', $userId)
                ->update($educationData);
        } else {
            DB::table('education_details')
                ->insert(array_merge(
                    ['user_id' => $userId],
                    $educationData
                ));
        }

        return redirect('/profile')
            ->with('success', 'Student details updated successfully.');
    }
}
