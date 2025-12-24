@extends('layouts.app')

@section('title', 'Student Registration')

@section('content')

<link rel="stylesheet" href="{{ url('css/register.css') }}">

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Student Registration</h2>

    <form id="register-form" novalidate>

      <div class="form-row">
        <label>Enrollment No</label>
        <input
          type="text"
          id="enrollment_no"
          name="enrollment_no"
          class="form-control"
        />
        <span class="error-msg" id="enrollment_no_error"></span>
      </div>

      <div class="form-row">
        <label>First Name</label>
        <input
          type="text"
          id="fname"
          name="fname"
          class="form-control"
        />
        <span class="error-msg" id="fname_error"></span>
      </div>

      <div class="form-row">
        <label>Last Name</label>
        <input
          type="text"
          id="lname"
          name="lname"
          class="form-control"
        />
        <span class="error-msg" id="lname_error"></span>
      </div>

      <div class="form-row">
        <label>Email</label>
        <input
          type="email"
          id="email"
          name="email"
          autocomplete="nope"
          class="form-control"
        />
        <span class="error-msg" id="email_error"></span>
      </div>

      <!-- PASSWORD -->
      <div class="form-row password-row">
        <label>Password</label>
        <div class="password-wrapper">
          <input
            type="password"
            id="password"
            name="password"
            autocomplete="new-password"
            class="form-control"
          />
          <span
            class="toggle-password"
            onclick="toggleRegisterPassword()"
            title="Show / Hide password"
          >
            👁
          </span>
        </div>
        <span class="error-msg" id="password_error"></span>
      </div>

      <div class="form-row">
        <button type="button">Register</button>
      </div>
    </form>

    <!-- messages (static for now) -->
    <p class="success-msg" style="display:none;"></p>
    <p class="error-msg" style="display:none;"></p>

    <div class="auth-links">
      <span>Already registered? </span>
      <a href="{{ url('/login') }}">Login here</a>
    </div>
  </div>
</div>

<!-- Password toggle JS -->
<script>
  function toggleRegisterPassword() {
    const field = document.getElementById("password");
    field.type = field.type === "password" ? "text" : "password";
  }
</script>
<script src="{{ url('js/register.js') }}"></script>
@endsection
