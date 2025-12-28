@php
use Illuminate\Support\Facades\DB;

$user = null;
$profile = null;
$education = null;

if (auth()->check()) {
$user = DB::table('users')->where('id', auth()->id())->first();
$profile = DB::table('student_profile')->where('user_id', auth()->id())->first();
$education = DB::table('education_details')->where('user_id', auth()->id())->first();
}
@endphp

@extends('layouts.app')

@section('title', 'Student Form')

@section('content')
@php
$isUpdate = $isUpdate ?? false;
@endphp


<link rel="stylesheet" href="{{ url('css/studentform.css') }}">

<main class="form-container">
  <img src="{{ url('Asset/GMCAwithName.png') }}" width="650pt" />
  <h1 id="form-title">
    {{ $isUpdate ? 'Update Student Details' : 'Student Application Form' }}
  </h1>

  <!-- ✅ ACTION + METHOD ADDED -->
  <form id="student-form" method="POST" action="{{ url('/studentform') }}">
    @csrf

    <!-- ================= FIELDSET 1 ================= -->
    <fieldset id="step-1">
      <legend>Personal Information</legend>

      <div class="form-row">
        <label>Enrollment No</label>
        <input type="text" class="form-control" readonly
          value="{{ $user->enrollment_no ?? '' }}">
      </div>

      <div class="form-row">
        <label>First Name</label>
        <input type="text" class="form-control" readonly
          value="{{ $profile->fname ?? '' }}">
      </div>

      <div class="form-row">
        <label>Last Name</label>
        <input type="text" class="form-control" readonly
          value="{{ $profile->lname ?? '' }}">
      </div>

      <div class="form-row">
        <label>Email</label>
        <input type="text" class="form-control" readonly
          value="{{ $profile->email ?? '' }}">
      </div>

      <div class="form-row">
        <label>Date of Birth</label>
        <input type="date" name="dob" id="dob" class="form-control"
          value="{{ $profile->dob ?? '' }}">
        <span id="dob_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Gender</label>
        <div class="radio-group">
          <label>
            <input type="radio" name="gender" value="male"
              {{ ($profile->gender ?? '') === 'male' ? 'checked' : '' }}>
            Male
          </label>
          <label>
            <input type="radio" name="gender" value="female"
              {{ ($profile->gender ?? '') === 'female' ? 'checked' : '' }}>
            Female
          </label>
        </div>
        <span id="gender_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Contact No</label>
        <input type="text" name="contact_no" id="contact_no" class="form-control"
          value="{{ $profile->contact ?? '' }}">
        <span id="contact_no_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Address</label>
        <textarea name="address" id="address" class="form-control">{{ $profile->address ?? '' }}</textarea>
        <span id="address_error" class="error-msg"></span>
      </div>

      <div class="submit-container">
        <button type="button" id="next-btn" class="nextbtn">
          Next &raquo;
        </button>
      </div>
    </fieldset>

    <!-- ================= FIELDSET 2 ================= -->
    <fieldset id="step-2">
      <legend>Education Details</legend>

      <h3>10th Standard</h3>

      <div class="form-row">
        <label>School Name</label>
        <input type="text" name="ssc_school" id="ssc_school" class="form-control"
          value="{{ $education->ssc_school ?? '' }}">
        <span id="ssc_school_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Board</label>
        <select name="ssc_board" id="ssc_board" class="form-control">
          <option value="">Select</option>
          <option value="GSEB" {{ ($education->ssc_board ?? '')=='GSEB'?'selected':'' }}>GSEB</option>
          <option value="CBSE" {{ ($education->ssc_board ?? '')=='CBSE'?'selected':'' }}>CBSE</option>
          <option value="ICSE" {{ ($education->ssc_board ?? '')=='ICSE'?'selected':'' }}>ICSE</option>
        </select>
        <span id="ssc_board_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Percentage</label>
        <input type="number" name="ssc_percentage" id="ssc_percentage" class="form-control"
          value="{{ $education->ssc_percentage ?? '' }}">
        <span id="ssc_percentage_error" class="error-msg"></span>
      </div>

      <h3>12th Standard</h3>

      <div class="form-row">
        <label>School Name</label>
        <input type="text" name="hsc_school" id="hsc_school" class="form-control"
          value="{{ $education->hsc_school ?? '' }}">
        <span id="hsc_school_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Board</label>
        <select name="hsc_board" id="hsc_board" class="form-control">
          <option value="">Select</option>
          <option value="GSEB" {{ ($education->hsc_board ?? '')=='GSEB'?'selected':'' }}>GSEB</option>
          <option value="CBSE" {{ ($education->hsc_board ?? '')=='CBSE'?'selected':'' }}>CBSE</option>
          <option value="ICSE" {{ ($education->hsc_board ?? '')=='ICSE'?'selected':'' }}>ICSE</option>
        </select>
        <span id="hsc_board_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Percentage</label>
        <input type="number" name="hsc_percentage" id="hsc_percentage" class="form-control"
          value="{{ $education->hsc_percentage ?? '' }}">
        <span id="hsc_percentage_error" class="error-msg"></span>
      </div>

      <div class="submit-container">
        <button type="button" id="back-btn" class="backbtn">
          &laquo; Back
        </button>

        <button type="submit" id="submit-btn">
          {{ $isUpdate ? 'Update Details' : 'Submit Application' }}
        </button>

      </div>
    </fieldset>

  </form>
</main>

<script src="{{ url('js/studentform.js') }}"></script>

<script>
  document.addEventListener("DOMContentLoaded", function() {
    const step1 = document.getElementById("step-1");
    const step2 = document.getElementById("step-2");

    step1.style.display = "block";
    step2.style.display = "none";

    document.getElementById("next-btn").onclick = () => {
      step1.style.display = "none";
      step2.style.display = "block";
    };

    document.getElementById("back-btn").onclick = () => {
      step2.style.display = "none";
      step1.style.display = "block";
    };
  });
</script>

@endsection