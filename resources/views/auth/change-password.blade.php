@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

<link rel="stylesheet" href="{{ url('css/login.css') }}">

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Change Password</h2>

    {{-- Errors --}}
    @if($errors->any())
      <p class="error-msg">{{ $errors->first() }}</p>
    @endif

    {{-- Success --}}
    @if(session('success'))
      <p class="success-msg">{{ session('success') }}</p>
    @endif

    <form method="POST" action="{{ url('/change-password') }}">
      @csrf

      {{-- STEP 1 --}}
      @if(!session('verified'))
        <div class="form-row password-row">
          <label>Current Password</label>
          <div class="password-wrapper">
            <input type="password" name="current_password" class="form-control">
            <span class="toggle-password" onclick="toggle(this)">👁</span>
          </div>
        </div>
      @endif

      {{-- STEP 2 --}}
      @if(session('verified'))
        <div class="form-row password-row">
          <label>New Password</label>
          <div class="password-wrapper">
            <input type="password" name="password" id="password" class="form-control">
            <span class="toggle-password" onclick="toggle(this)">👁</span>
          </div>
        </div>

        <div class="form-row password-row">
          <label>Confirm Password</label>
          <div class="password-wrapper">
            <input type="password" name="password_confirmation" class="form-control">
            <span class="toggle-password" onclick="toggle(this)">👁</span>
          </div>
        </div>
      @endif

      <div class="form-row">
        <button type="submit">
          {{ session('verified') ? 'Update Password' : 'Verify Password' }}
        </button>
      </div>
    </form>
  </div>
</div>

<script>
function toggle(el) {
  const input = el.previousElementSibling;
  input.type = input.type === 'password' ? 'text' : 'password';
}
</script>

@endsection
