@extends('layouts.app')

@section('title', 'Services')

@section('content')

<link rel="stylesheet" href="{{ url('css/services.css') }}">

<div class="services-wrapper">
    <h2 class="services-title">Our Services</h2>

    <div class="services-container">

        <!-- Service Card -->
        <div class="service-card" onclick="goToStudentForm()">
            <h3>Student Academic Form</h3>
            <p>
                Fill and submit your academic details securely using our
                student form service.
            </p>
            <span class="service-link">Go to Form →</span>
        </div>

    </div>
</div>

<!-- Page JS -->
<script>
    function goToStudentForm() {
        window.location.href = "{{ url('/studentform') }}";
    }
</script>

@endsection
