@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')

<link rel="stylesheet" href="{{ url('css/login.css') }}">

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Forgot Password</h2>

    <form id="forgot-form" novalidate>

      <!-- Enrollment No -->
      <div class="form-row">
        <label>Enrollment No</label>
        <input
          type="text"
          id="enrollment_no"
          class="form-control"
        />
        <span class="error-msg" id="enrollment_no_error"></span>
      </div>

      <!-- Email -->
      <div class="form-row">
        <label>Email</label>
        <input
          type="email"
          id="email"
          class="form-control"
        />
        <span class="error-msg" id="email_error"></span>
      </div>

      <div class="form-row">
        <button type="button">Verify</button>
      </div>
    </form>

    <!-- Messages (static placeholders for now) -->
    <p class="error-msg" style="display:none;"></p>
    <p class="success-msg" style="display:none;"></p>

    <div class="auth-links">
      <a href="{{ url('/login') }}">Back to Login</a>
    </div>
  </div>
</div>

<!-- 🔁 Reuse SAME validation JS -->
<script src="{{ url('js/register.js') }}"></script>

@endsection
