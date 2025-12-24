@extends('layouts.app')

@section('title', 'Reset Password')

@section('content')

<link rel="stylesheet" href="{{ url('css/login.css') }}">

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Reset Password</h2>

    <form id="reset-form" novalidate>

      <!-- NEW PASSWORD -->
      <div class="form-row password-row">
        <label>New Password</label>
        <div class="password-wrapper">
          <input
            type="password"
            id="password"
            autocomplete="new-password"
            class="form-control"
          />
          <span
            class="toggle-password"
            onclick="togglePassword()"
            title="Show / Hide password"
          >
            👁
          </span>
        </div>
        <span class="error-msg" id="password_error"></span>
      </div>

      <!-- CONFIRM PASSWORD -->
      <div class="form-row password-row">
        <label>Confirm Password</label>
        <div class="password-wrapper">
          <input
            type="password"
            id="confirm_password"
            class="form-control"
          />
          <span
            class="toggle-password"
            onclick="togglePassword()"
            title="Show / Hide password"
          >
            👁
          </span>
        </div>
        <span class="error-msg" id="confirm_password_error"></span>
      </div>

      <div class="form-row">
        <button type="button">Update Password</button>
      </div>
    </form>

    <!-- Messages (static for now) -->
    <p class="success-msg" style="display:none;"></p>
    <p class="error-msg" style="display:none;"></p>

    <div class="auth-links">
      <a href="{{ url('/login') }}">Back to Login</a>
    </div>
  </div>
</div>

<!-- Password toggle JS -->
<script>
  function togglePassword() {
    const pwd = document.getElementById('password');
    const cpwd = document.getElementById('confirm_password');

    const type = pwd.type === 'password' ? 'text' : 'password';
    pwd.type = type;
    cpwd.type = type;
  }
</script>
<script src="{{ url('js/register.js') }}"></script>

@endsection
