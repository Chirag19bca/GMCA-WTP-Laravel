@extends('layouts.app')

@section('title', 'Student Form')

@section('content')

<!-- Student Form CSS -->
<link rel="stylesheet" href="{{ url('css/studentform.css') }}">

<main class="form-container">
  <img src="{{ url('Asset/GMCAwithName.png') }}" width="650pt" />
  <h1 id="form-title">Student Application Form</h1>

  <form id="student-form">

    <!-- STEP 1: Personal Information -->
    <fieldset>
      <legend>Personal Information</legend>

      <div class="form-row">
        <label>Enrollment No</label>
        <input type="text" class="form-control" readonly />
      </div>

      <div class="form-row">
        <label>First Name</label>
        <input type="text" class="form-control" readonly />
      </div>

      <div class="form-row">
        <label>Last Name</label>
        <input type="text" class="form-control" readonly />
      </div>

      <div class="form-row">
        <label>Email</label>
        <input type="text" class="form-control" readonly />
      </div>

      <div class="form-row">
        <label>Date of Birth</label>
        <input type="date" id="dob" class="form-control" />
        <span id="dob_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Gender</label>
        <div class="radio-group">
          <label><input type="radio" name="gender" value="male" /> Male</label>
          <label><input type="radio" name="gender" value="female" /> Female</label>
        </div>
        <span id="gender_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Contact No</label>
        <input type="text" id="contact_no" class="form-control" />
        <span id="contact_no_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Address</label>
        <textarea id="address" class="form-control"></textarea>
        <span id="address_error" class="error-msg"></span>
      </div>

      <div class="submit-container">
        <button type="button" id="next-btn" class="nextbtn">
          Next &raquo;
        </button>
      </div>
    </fieldset>

    <!-- STEP 2: Education Details -->
    <fieldset>
      <legend>Education Details</legend>

      <h3>10th Standard</h3>

      <div class="form-row">
        <label>School Name</label>
        <input type="text" id="ssc_school" class="form-control" />
        <span id="ssc_school_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Board</label>
        <select id="ssc_board" class="form-control">
          <option value="" disabled selected>Select</option>
          <option value="GSEB">GSEB</option>
          <option value="CBSE">CBSE</option>
          <option value="ICSE">ICSE</option>
        </select>
        <span id="ssc_board_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Percentage</label>
        <input type="number" id="ssc_percentage" class="form-control" />
        <span id="ssc_percentage_error" class="error-msg"></span>
      </div>

      <h3>12th Standard</h3>

      <div class="form-row">
        <label>School Name</label>
        <input type="text" id="hsc_school" class="form-control" />
        <span id="hsc_school_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Board</label>
        <select id="hsc_board" class="form-control">
          <option value="" disabled selected>Select</option>
          <option value="GSEB">GSEB</option>
          <option value="CBSE">CBSE</option>
          <option value="ICSE">ICSE</option>
        </select>
        <span id="hsc_board_error" class="error-msg"></span>
      </div>

      <div class="form-row">
        <label>Percentage</label>
        <input type="number" id="hsc_percentage" class="form-control" />
        <span id="hsc_percentage_error" class="error-msg"></span>
      </div>

      <div class="submit-container">
        <button type="button" id="back-btn" class="backbtn">
          &laquo; Back
        </button>
        <button type="button" id="submit-btn">
          Submit Application
        </button>
      </div>
    </fieldset>

  </form>
</main>

<!-- Student Form JS -->
<script src="{{ url('js/studentform.js') }}"></script>

@endsection
