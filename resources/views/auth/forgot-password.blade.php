@extends('layouts.app')

@section('title', 'Forgot Password')

@section('content')

<link rel="stylesheet" href="{{ url('css/login.css') }}">

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Forgot Password</h2>

    {{-- Error --}}
    @if(session('error'))
      <p class="error-msg" style="display:block;">
        {{ session('error') }}
      </p>
    @endif

    {{-- Success --}}
    @if(session('success'))
      <p class="success-msg" style="display:block;">
        {{ session('success') }}
      </p>
    @endif

    <form id="forgot-form"
          method="POST"
          action="{{ url('/forgot-password') }}"
          novalidate>
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
          class="form-control"
        />
        <span class="error-msg" id="email_error"></span>
      </div>

      {{-- Password fields (shown only after verification) --}}
      @if(session('verified'))
        <hr>

        <!-- New Password -->
        <div class="form-row password-row">
          <label>New Password</label>
          <div class="password-wrapper">
            <input
              type="password"
              id="password"
              name="password"
              class="form-control"
            />
            <span
              class="toggle-password"
              onclick="togglePassword('password')"
              title="Show / Hide password"
            >👁</span>
          </div>
          <span class="error-msg" id="password_error"></span>
        </div>

        <!-- Confirm Password -->
        <div class="form-row password-row">
          <label>Confirm Password</label>
          <div class="password-wrapper">
            <input
              type="password"
              id="confirm_password"
              name="password_confirmation"
              class="form-control"
            />
            <span
              class="toggle-password"
              onclick="togglePassword('confirm_password')"
              title="Show / Hide password"
            >👁</span>
          </div>
          <span class="error-msg" id="confirm_password_error"></span>
        </div>
      @endif

      <div class="form-row">
        <button type="submit">
          {{ session('verified') ? 'Reset Password' : 'Verify' }}
        </button>
      </div>
    </form>

    <div class="auth-links">
      <a href="{{ url('/login') }}">Back to Login</a>
    </div>
  </div>
</div>

<!-- KEEP existing validation JS -->
<script src="{{ url('js/register.js') }}"></script>

<script>
  function togglePassword(id) {
    const field = document.getElementById(id);
    if (!field) return;
    field.type = field.type === "password" ? "text" : "password";
  }
</script>

@endsection
