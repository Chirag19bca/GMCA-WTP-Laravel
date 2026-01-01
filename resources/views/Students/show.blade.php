@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/students.css') }}">

<div class="students-container">
    <h3 class="students-title">Student Details</h3>

    <table class="students-table details-table">
        <tr><th>Name</th><td>{{ $student->fname }} {{ $student->lname }}</td></tr>
        <tr><th>Enrollment No</th><td>{{ $student->enrollment_no }}</td></tr>
        <tr><th>Email</th><td>{{ $student->email }}</td></tr>
        <tr><th>DOB</th><td>{{ $student->dob }}</td></tr>
        <tr><th>Gender</th><td>{{ $student->gender }}</td></tr>
        <tr><th>Contact</th><td>{{ $student->contact }}</td></tr>
        <tr><th>Address</th><td>{{ $student->address }}</td></tr>

        <tr><th>SSC School</th><td>{{ $student->ssc_school }}</td></tr>
        <tr><th>SSC Board</th><td>{{ $student->ssc_board }}</td></tr>
        <tr><th>SSC %</th><td>{{ $student->ssc_percentage }}</td></tr>

        <tr><th>HSC School</th><td>{{ $student->hsc_school }}</td></tr>
        <tr><th>HSC Board</th><td>{{ $student->hsc_board }}</td></tr>
        <tr><th>HSC %</th><td>{{ $student->hsc_percentage }}</td></tr>
    </table>

    <a href="{{ route('students.index') }}" class="back-btn">⬅ Back</a>
</div>
@endsection
