@extends('layouts.app')

@section('title', 'Student Registration')

@section('content')

<link rel="stylesheet" href="{{ url('css/register.css') }}">

<div class="auth-wrapper">
  <div class="auth-card">
    <h2>Student Registration</h2>

    {{-- SERVER ERROR --}}
    @if ($errors->any())
      <p class="error-msg">{{ $errors->first() }}</p>
    @endif

    <form id="register-form"
          method="POST"
          action="{{ route('register.post') }}"
          novalidate>
      @csrf

      <div class="form-row">
        <label>Enrollment No</label>
        <input type="text" id="enrollment_no" name="enrollment_no"
               value="{{ old('enrollment_no') }}" class="form-control">
        <span class="error-msg" id="enrollment_no_error"></span>
      </div>

      <div class="form-row">
        <label>First Name</label>
        <input type="text" id="fname" name="fname"
               value="{{ old('fname') }}" class="form-control">
        <span class="error-msg" id="fname_error"></span>
      </div>

      <div class="form-row">
        <label>Last Name</label>
        <input type="text" id="lname" name="lname"
               value="{{ old('lname') }}" class="form-control">
        <span class="error-msg" id="lname_error"></span>
      </div>

      <div class="form-row">
        <label>Email</label>
        <input type="email" id="email" name="email"
               value="{{ old('email') }}" class="form-control">
        <span class="error-msg" id="email_error"></span>
      </div>

      <div class="form-row password-row">
        <label>Password</label>
        <div class="password-wrapper">
          <input type="password" id="password" name="password"
                 class="form-control">
          <span class="toggle-password"
                onclick="toggleRegisterPassword()">👁</span>
        </div>
        <span class="error-msg" id="password_error"></span>
      </div>

      <div class="form-row">
        <label>Confirm Password</label>
        <input type="password" id="confirm_password"
               name="password_confirmation"
               class="form-control">
        <span class="error-msg" id="confirm_password_error"></span>
      </div>

      <div class="form-row">
        <button type="button" onclick="submitRegisterForm()">
          Register
        </button>
      </div>
    </form>

    <div class="auth-links">
      <span>Already registered?</span>
      <a href="{{ url('/login') }}">Login here</a>
    </div>
  </div>
</div>

<!-- PASSWORD TOGGLE -->
<script>
function toggleRegisterPassword() {
  const field = document.getElementById("password");
  field.type = field.type === "password" ? "text" : "password";
}
</script>

<!-- YOUR EXISTING VALIDATION JS -->
<script src="{{ url('js/register.js') }}"></script>

<!-- BRIDGE JS: JS VALIDATION → LARAVEL SUBMIT -->
<script>
function submitRegisterForm() {

  // 👇 THIS FUNCTION MUST ALREADY EXIST IN register.js
  // It should return true if all validations pass
  if (typeof validateRegisterFormOnSubmit === "function") {

    const valid = validateRegisterFormOnSubmit();

    if (!valid) {
      return; // STOP if validation fails
    }
  }

  // ✅ Validation passed → submit to Laravel
  document.getElementById("register-form").submit();
}
</script>

@endsection