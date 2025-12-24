@extends('layouts.app')

@section('title', 'User Profile')

@section('content')

<link rel="stylesheet" href="{{ url('css/profile.css') }}">

<div class="profile-wrapper">
  <div class="profile-card">
    <h2>User Profile</h2>

    <!-- Status messages (static for now) -->
    <p class="profile-status">Loading…</p>
    <p class="profile-status error" style="display:none;"></p>

    <!-- DISPLAY MODE -->
    <div>

      <table class="profile-table">
        <tr>
          <th>Enrollment No</th>
          <td>—</td>
        </tr>
        <tr>
          <th>First Name</th>
          <td>—</td>
        </tr>
        <tr>
          <th>Last Name</th>
          <td>—</td>
        </tr>
        <tr>
          <th>Email</th>
          <td>—</td>
        </tr>
        <tr>
          <th>Date of Birth</th>
          <td>—</td>
        </tr>
        <tr>
          <th>Gender</th>
          <td>—</td>
        </tr>
        <tr>
          <th>Contact No</th>
          <td>—</td>
        </tr>
        <tr>
          <th>Address</th>
          <td>—</td>
        </tr>
      </table>

      <h3>Education Details</h3>

      <table class="profile-table">
        <tr>
          <th colspan="2">10th Standard</th>
        </tr>
        <tr>
          <td>School Name</td>
          <td>—</td>
        </tr>
        <tr>
          <td>Board</td>
          <td>—</td>
        </tr>
        <tr>
          <td>Percentage</td>
          <td>—</td>
        </tr>

        <tr>
          <th colspan="2">12th Standard</th>
        </tr>
        <tr>
          <td>School Name</td>
          <td>—</td>
        </tr>
        <tr>
          <td>Board</td>
          <td>—</td>
        </tr>
        <tr>
          <td>Percentage</td>
          <td>—</td>
        </tr>
      </table>

      <div class="profile-actions">
        <a href="{{ url('/studentform') }}" class="btn-edit">Edit Details</a>
      </div>

    </div>
  </div>
</div>

<!-- reuse studentform validation for these fields -->
<script src="{{ url('js/studentform.js') }}"></script>

@endsection
