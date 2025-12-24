@extends('layouts.app')

@section('title', 'Login')

@section('content')

<link rel="stylesheet" href="{{ url('css/login.css') }}">

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Login</h2>

    <form id="login-form">

      <!-- Enrollment No -->
      <div class="form-row">
        <label>Enrollment No</label>
        <input
          type="text"
          name="enrollment_no"
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
          name="email"
          id="email"
          autocomplete="nope"
          class="form-control"
        />
        <span class="error-msg" id="email_error"></span>
      </div>

      <!-- Password -->
      <div class="form-row password-row">
        <label>Password</label>
        <div class="password-wrapper">
          <input
            type="password"
            name="password"
            id="password"
            autocomplete="new-password"
            class="form-control"
          />
          <span
            class="toggle-password"
            onclick="toggleLoginPassword()"
            title="Show / Hide password"
          >
            👁
          </span>
        </div>
        <span class="error-msg" id="password_error"></span>
      </div>

      <!-- Error message (static for now) -->
      <p
        class="error-msg"
        id="login_error_msg"
        style="display:none; color:red; font-size:15px; font-weight:600; margin-top:6px"
      ></p>

      <div class="form-row">
        <button type="button">Login</button>
      </div>
    </form>

    <div class="auth-links">
      <span>New user?</span>
      <a href="{{ url('/register') }}">Register here</a> |
      <a href="{{ url('/forgot-password') }}">Forgot Password?</a>
    </div>
  </div>
</div>

<!-- Shared validation JS -->
<script src="{{ url('js/register.js') }}"></script>

<!-- Password toggle JS -->
<script>
  function toggleLoginPassword() {
    const field = document.getElementById("password");
    field.type = field.type === "password" ? "text" : "password";
  }
</script>

@endsection
