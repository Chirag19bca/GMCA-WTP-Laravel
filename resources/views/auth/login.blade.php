@extends('layouts.app')

@section('title', 'Login')

@section('content')

<link rel="stylesheet" href="{{ url('css/login.css') }}">

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Login</h2>

    {{-- SUCCESS MESSAGE --}}
    @if (session('success'))
      <p style="color:green; font-size:15px; font-weight:600; margin-bottom:10px">
        {{ session('success') }}
      </p>
    @endif

    {{-- ERROR MESSAGE --}}
    @if ($errors->any())
      <p style="color:red; font-size:15px; font-weight:600; margin-bottom:10px">
        {{ $errors->first() }}
      </p>
    @endif

    <form id="login-form" method="POST" action="{{ url('/login') }}">
      @csrf

      <!-- Enrollment No -->
      <div class="form-row">
        <label>Enrollment No</label>
        <input
          type="text"
          name="enrollment_no"
          value="{{ old('enrollment_no') }}"
          class="form-control"
        />
      </div>

      <!-- Email -->
      <div class="form-row">
        <label>Email</label>
        <input
          type="email"
          name="email"
          value="{{ old('email') }}"
          autocomplete="off"
          class="form-control"
        />
      </div>

      <!-- Password -->
      <div class="form-row password-row">
        <label>Password</label>
        <div class="password-wrapper">
          <input
            type="password"
            name="password"
            class="form-control"
            required
          />
          <span
            class="toggle-password"
            onclick="toggleLoginPassword()"
            title="Show / Hide password"
          >👁</span>
        </div>
      </div>

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

<script>
  function toggleLoginPassword() {
    const field = document.querySelector("input[name='password']");
    field.type = field.type === "password" ? "text" : "password";
  }
</script>

@endsection
