@extends('layouts.app')

@section('title', 'Login')

@section('content')

<link rel="stylesheet" href="{{ url('css/login.css') }}">

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Login</h2>

    {{-- SERVER SUCCESS MESSAGE --}}
    @if (session('success'))
      <p class="success-msg" style="display:block; margin-bottom:10px;">
        {{ session('success') }}
      </p>
    @endif

    {{-- SERVER ERROR MESSAGE --}}
    @if ($errors->any())
      <p class="error-msg" style="display:block; margin-bottom:10px;">
        {{ $errors->first() }}
      </p>
    @endif

    <form
      id="login-form"
      method="POST"
      action="{{ url('/login') }}"
      novalidate
      onsubmit="return validateLoginForm();"
      autocomplete="off"
    >
      @csrf

      <!-- Enrollment No -->
      <div class="form-row">
        <label>Enrollment No</label>
        <input
          type="text"
          id="enrollment_no"
          name="enrollment_no"
          value="{{ old('enrollment_no') }}"
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
          name="email"
          value="{{ old('email') }}"
          autocomplete="off"
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
            id="password"
            name="password"
            autocomplete="new-password"
            class="form-control"
          />
          <span
            class="toggle-password"
            onclick="toggleLoginPassword()"
            title="Show / Hide password"
          >👁</span>
        </div>
        <span class="error-msg" id="password_error"></span>
      </div>

      <!-- GLOBAL CLIENT VALIDATION ERROR -->
      <p
        class="error-msg"
        id="login_error_msg"
        style="display:none; font-weight:600; margin-top:6px;"
      ></p>

      <div class="form-row">
        <button type="submit">Login</button>
      </div>
    </form>

    <div class="auth-links">
      <span>New user?</span>
      <a href="{{ url('/register') }}">Register here</a> |
      <a href="{{ url('/forgot-password') }}">Forgot Password?</a>
    </div>
  </div>
</div>

<!-- Shared validation logic -->
<script src="{{ url('js/register.js') }}"></script>

<script>
  function toggleLoginPassword() {
    const field = document.getElementById("password");
    field.type = field.type === "password" ? "text" : "password";
  }

  // Client-side submit validation
  function validateLoginForm() {
    let valid = true;

    if (!validateRegisterField(document.getElementById("enrollment_no")))
      valid = false;

    if (!validateRegisterField(document.getElementById("email")))
      valid = false;

    if (!validateRegisterField(document.getElementById("password")))
      valid = false;

    const msg = document.getElementById("login_error_msg");
    if (!valid && msg) {
      msg.innerText = "Please fix the highlighted fields.";
      msg.style.display = "block";
    }

    return valid;
  }
</script>

@endsection
