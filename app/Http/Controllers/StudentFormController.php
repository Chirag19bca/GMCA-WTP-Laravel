<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class StudentFormController extends Controller
{
    /* ================= STUDENT LIST ================= */
    public function index()
    {
        $students = DB::table('users')
            ->join('student_profile', 'users.id', '=', 'student_profile.user_id')
            ->select(
                'users.id',
                'users.enrollment_no',
                'users.email',
                'student_profile.fname',
                'student_profile.lname'
            )
            ->orderBy('users.enrollment_no', 'asc')
            ->paginate(10);

        return view('students.index', compact('students'));
    }

    /* ================= VIEW STUDENT ================= */
    public function viewStudent($id)
    {
        $student = DB::table('users')
            ->join('student_profile', 'users.id', '=', 'student_profile.user_id')
            ->leftJoin('education_details', 'users.id', '=', 'education_details.user_id')
            ->where('users.id', $id)
            ->select(
                'users.enrollment_no',
                'users.email',
                'student_profile.fname',
                'student_profile.lname',
                'student_profile.dob',
                'student_profile.gender',
                'student_profile.contact',
                'student_profile.address',
                'education_details.ssc_school',
                'education_details.ssc_board',
                'education_details.ssc_percentage',
                'education_details.hsc_school',
                'education_details.hsc_board',
                'education_details.hsc_percentage'
            )
            ->first();

        return view('students.show', compact('student'));
    }

    /* ================= EDIT STUDENT ================= */
    public function edit($id)
    {
        $profile = DB::table('users')
            ->join('student_profile', 'users.id', '=', 'student_profile.user_id')
            ->where('users.id', $id)
            ->select(
                'users.id',
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
            ->where('user_id', $id)
            ->first();

        return view('studentform', [
            'profile'    => $profile,
            'education'  => $education,
            'editUserId' => $id,
            'isEdit'     => true
        ]);
    }

    /* ================= LOGGED USER FORM ================= */
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

        $isUpdate = ($profile && $profile->dob);

        return view('studentform', compact('profile', 'education', 'isUpdate'));
    }

    /* ================= SUBMIT / UPDATE ================= */
    public function store(Request $request)
    {
        // Decide which user to update
        $userId = $request->edit_user_id ?? Auth::id();

        /* ---------- VALIDATION ---------- */
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

        /* ---------- UPDATE PROFILE ---------- */
        DB::table('student_profile')
            ->where('user_id', $userId)
            ->update([
                'dob'     => $request->dob,
                'gender'  => $request->gender,
                'contact' => $request->contact_no,
                'address' => $request->address,
            ]);

        /* ---------- UPDATE / INSERT EDUCATION ---------- */
        DB::table('education_details')
            ->updateOrInsert(
                ['user_id' => $userId],
                [
                    'ssc_school'     => $request->ssc_school,
                    'ssc_board'      => $request->ssc_board,
                    'ssc_percentage' => $request->ssc_percentage,
                    'hsc_school'     => $request->hsc_school,
                    'hsc_board'      => $request->hsc_board,
                    'hsc_percentage' => $request->hsc_percentage,
                ]
            );

        /* ---------- REDIRECT ---------- */
        if ($request->has('edit_user_id')) {
            return redirect()
                ->route('students.show', $userId)
                ->with('success', 'Details updated successfully.');
        }

        return redirect()
            ->back()
            ->with('success', 'Details updated successfully.');
    }
}
