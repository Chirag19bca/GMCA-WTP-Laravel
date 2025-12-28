<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class StudentFormController extends Controller
{
    /* ================= SHOW FORM ================= */
    public function show()
    {
        $userId = Auth::id();

        // Fetch user + profile
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

        // Fetch education details
        $education = DB::table('education_details')
            ->where('user_id', $userId)
            ->first();

        /**
         * Decide mode
         * If DOB exists → already submitted before
         */
        $isUpdate = false;
        if ($profile && $profile->dob) {
            $isUpdate = true;
        }

        return view('studentform', compact('profile', 'education', 'isUpdate'));
    }

    /* ================= SUBMIT / UPDATE FORM ================= */
    public function store(Request $request)
    {
        $userId = Auth::id();

        // Check if this is first submission or update
        $existingProfile = DB::table('student_profile')
            ->where('user_id', $userId)
            ->first();

        $isUpdate = false;
        if ($existingProfile && $existingProfile->dob) {
            $isUpdate = true;
        }

        /* ---------- OPTIONAL VALIDATION ---------- */
        $request->validate([
            'dob'            => 'nullable|date',
            'gender'         => 'nullable|in:male,female',
            'contact_no'     => 'nullable|string|max:15',
            'address'        => 'nullable|string',
            'ssc_school'     => 'nullable|string',
            'ssc_board'      => 'nullable|string',
            'ssc_percentage' => 'nullable|numeric',
            'hsc_school'     => 'nullable|string',
            'hsc_board'      => 'nullable|string',
            'hsc_percentage' => 'nullable|numeric',
        ]);

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
        $educationData = [
            'ssc_school'     => $request->ssc_school,
            'ssc_board'      => $request->ssc_board,
            'ssc_percentage' => $request->ssc_percentage,
            'hsc_school'     => $request->hsc_school,
            'hsc_board'      => $request->hsc_board,
            'hsc_percentage' => $request->hsc_percentage,
        ];

        $exists = DB::table('education_details')
            ->where('user_id', $userId)
            ->exists();

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

        /* ---------- REDIRECT WITH DIFFERENT MESSAGE ---------- */
        if ($isUpdate) {
            return redirect('/profile')
                ->with('success', 'Details updated successfully.');
        }

        return redirect('/profile')
            ->with('success', 'Student form submitted successfully.');
    }
}
