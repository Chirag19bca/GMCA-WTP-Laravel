@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

<link rel="stylesheet" href="{{ url('css/profile.css') }}">

<div class="profile-wrapper">
  <div class="profile-card">
    <h2>User Profile</h2>

    {{-- If no profile data --}}
    @if(!$profile)
    <p class="profile-status error">
      Profile not completed yet. Please fill your student details.
    </p>

    <div class="profile-actions">
      <a href="{{ url('/studentform') }}" class="btn-edit">Complete Profile</a>
    </div>

    @else
    {{-- DISPLAY MODE --}}
    <table class="profile-table">
      <tr>
        <th>Enrollment No</th>
        <td>{{ $profile->enrollment_no }}</td>
      </tr>
      <tr>
        <th>First Name</th>
        <td>{{ $profile->fname }}</td>
      </tr>
      <tr>
        <th>Last Name</th>
        <td>{{ $profile->lname }}</td>
      </tr>
      <tr>
        <th>Email</th>
        <td>{{ $profile->email }}</td>
      </tr>
      <tr>
        <th>Date of Birth</th>
        <td>{{ $profile->dob ?? '—' }}</td>
      </tr>
      <tr>
        <th>Gender</th>
        <td>{{ $profile->gender ?? '—' }}</td>
      </tr>
      <tr>
        <th>Contact No</th>
        <td>{{ $profile->contact ?? '—' }}</td>
      </tr>
      <tr>
        <th>Address</th>
        <td>{{ $profile->address ?? '—' }}</td>
      </tr>
    </table>

    <h3>Education Details</h3>

    <table class="profile-table">
      <tr>
        <th colspan="2">10th Standard</th>
      </tr>
      <tr>
        <td>School Name</td>
        <td>{{ $profile->ssc_school ?? '—' }}</td>
      </tr>
      <tr>
        <td>Board</td>
        <td>{{ $profile->ssc_board ?? '—' }}</td>
      </tr>
      <tr>
        <td>Percentage</td>
        <td>
          {{ $profile->ssc_percentage !== null ? $profile->ssc_percentage . '%' : '—' }}
        </td>
      </tr>

      <tr>
        <th colspan="2">12th Standard</th>
      </tr>
      <tr>
        <td>School Name</td>
        <td>{{ $profile->hsc_school ?? '—' }}</td>
      </tr>
      <tr>
        <td>Board</td>
        <td>{{ $profile->hsc_board ?? '—' }}</td>
      </tr>
      <tr>
        <td>Percentage</td>
        <td>
          {{ $profile->hsc_percentage !== null ? $profile->hsc_percentage . '%' : '—' }}
        </td>
      </tr>
    </table>

    <div class="profile-actions">
      <a href="{{ url('/studentform') }}" class="btn-edit">Edit Details</a>
      <a href="{{ url('/change-password') }}" class="btn-edit">
        Change Password
      </a>
    </div>

    @endif

  </div>
</div>

@endsection