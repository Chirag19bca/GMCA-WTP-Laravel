@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

@php
  $profile = $profile ?? null;
  $isCompleted = $profile && $profile->dob;
@endphp

<link rel="stylesheet" href="{{ url('css/profile.css') }}">

<div class="profile-wrapper">
  <div class="profile-card">

    <h2>User Profile</h2>

    {{-- PROFILE STATUS --}}
    @if($isCompleted)
      <p class="profile-status complete">
        Profile Status: Completed
      </p>
    @else
      <p class="profile-status incomplete">
        Profile Status: Incomplete
      </p>
    @endif

    {{-- BASIC DETAILS (ALWAYS SHOWN) --}}
    <table class="profile-table">
      <tr>
        <th>Enrollment No</th>
        <td>{{ $profile->enrollment_no ?? '—' }}</td>
      </tr>
      <tr>
        <th>First Name</th>
        <td>{{ $profile->fname ?? '—' }}</td>
      </tr>
      <tr>
        <th>Last Name</th>
        <td>{{ $profile->lname ?? '—' }}</td>
      </tr>
      <tr>
        <th>Email</th>
        <td>{{ $profile->email ?? '—' }}</td>
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

    {{-- EDUCATION DETAILS --}}
    <div class="education-section">
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
          <td>{{ $profile->ssc_percentage !== null ? $profile->ssc_percentage.'%' : '—' }}</td>
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
          <td>{{ $profile->hsc_percentage !== null ? $profile->hsc_percentage.'%' : '—' }}</td>
        </tr>
      </table>
    </div>

    {{-- ACTION BUTTONS --}}
    <div class="profile-actions">
      <a href="{{ url('/studentform') }}" class="btn-primary">
        {{ $isCompleted ? 'Update Details' : 'Complete Profile' }}
      </a>

      <a href="{{ url('/change-password') }}" class="btn-secondary">
        Change Password
      </a>
    </div>

  </div>
</div>

@endsection
