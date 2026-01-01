@extends('layouts.app')

@section('content')
<div class="container">
    <h3>Student List</h3>

    <table class="table table-bordered">
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
                    <a href="{{ route('students.show', $s->id) }}"
                       class="btn btn-sm btn-primary">View</a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>

    {{ $students->links() }}
</div>
@endsection
