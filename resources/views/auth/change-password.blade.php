@extends('layouts.app')

@section('title', 'Change Password')

@section('content')

<link rel="stylesheet" href="{{ url('css/login.css') }}">

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Change Password</h2>

    {{-- SERVER ERROR --}}
    @if($errors->any())
      <p class="error-msg" style="display:block; margin-bottom:10px;">
        {{ $errors->first() }}
      </p>
    @endif

    {{-- SERVER SUCCESS --}}
    @if(session('success'))
      <p class="success-msg" style="display:block; margin-bottom:10px;">
        {{ session('success') }}
      </p>
    @endif

    <form
      method="POST"
      action="{{ url('/change-password') }}"
      novalidate
      onsubmit="return validateChangePasswordForm();"
      autocomplete="off"
    >
      @csrf

      {{-- STEP 1: VERIFY CURRENT PASSWORD --}}
      @if(!session('verified'))
        <div class="form-row password-row">
          <label>Current Password</label>
          <div class="password-wrapper">
            <input
              type="password"
              name="current_password"
              id="current_password"
              class="form-control"
              autocomplete="current-password"
            >
            <span class="toggle-password" onclick="toggle(this)">👁</span>
          </div>
          <span class="error-msg" id="current_password_error"></span>
        </div>
      @endif

      {{-- STEP 2: SET NEW PASSWORD --}}
      @if(session('verified'))
        <div class="form-row password-row">
          <label>New Password</label>
          <div class="password-wrapper">
            <input
              type="password"
              name="password"
              id="password"
              class="form-control"
              autocomplete="new-password"
            >
            <span class="toggle-password" onclick="toggle(this)">👁</span>
          </div>
          <span class="error-msg" id="password_error"></span>
        </div>

        <div class="form-row password-row">
          <label>Confirm Password</label>
          <div class="password-wrapper">
            <input
              type="password"
              name="password_confirmation"
              id="confirm_password"
              class="form-control"
              autocomplete="new-password"
            >
            <span class="toggle-password" onclick="toggle(this)">👁</span>
          </div>
          <span class="error-msg" id="confirm_password_error"></span>
        </div>
      @endif

      {{-- GLOBAL ERROR --}}
      <p
        class="error-msg"
        id="change_password_error"
        style="display:none; font-weight:600; margin-top:6px;"
      ></p>

      <div class="form-row">
        <button type="submit">
          {{ session('verified') ? 'Update Password' : 'Verify Password' }}
        </button>
      </div>
    </form>
  </div>
</div>

<!-- 🔁 SHARED VALIDATION LOGIC -->
<script src="{{ url('js/register.js') }}"></script>

<script>
function toggle(el) {
  const input = el.previousElementSibling;
  input.type = input.type === 'password' ? 'text' : 'password';
}

function validateChangePasswordForm() {
  let valid = true;

  const current = document.getElementById('current_password');
  const password = document.getElementById('password');
  const confirm  = document.getElementById('confirm_password');

  if (current && !validateRegisterField(current)) valid = false;
  if (password && !validateRegisterField(password)) valid = false;
  if (confirm  && !validateRegisterField(confirm))  valid = false;

  const msg = document.getElementById('change_password_error');
  if (!valid && msg) {
    msg.innerText = 'Please fix the highlighted fields.';
    msg.style.display = 'block';
  } else if (msg) {
    msg.style.display = 'none';
  }

  return valid;
}
</script>

@endsection
