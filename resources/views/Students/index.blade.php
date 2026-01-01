@extends('layouts.app')

@section('content')
<link rel="stylesheet" href="{{ asset('css/students.css') }}">
<div class="students-container">
    <h3 class="students-title">Student Records</h3>

    <table class="students-table">
        <thead>
            <tr>
                <th>Name</th>
                <th>Enrollment No</th>
                <th>Email</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            @foreach($students as $s)
            <tr>
                <td>{{ $s->fname }} {{ $s->lname }}</td>
                <td>{{ $s->enrollment_no }}</td>
                <td>{{ $s->email }}</td>
                <td>
                    <a href="{{ route('students.show', $s->id) }}" class="btn-view">
                        View
                    </a>

                    <a href="{{ route('students.edit', $s->id) }}" class="btn-edit">
                        Edit
                    </a>
                </td>

            </tr>
            @endforeach
        </tbody>
    </table>

    <!-- SIMPLE PAGINATION -->
    <div class="simple-pagination">
        @if ($students->previousPageUrl())
        <a href="{{ $students->previousPageUrl() }}" class="page-btn">Previous</a>
        @endif

        @if ($students->nextPageUrl())
        <a href="{{ $students->nextPageUrl() }}" class="page-btn">Next</a>
        @endif
    </div>
</div>
@endsection