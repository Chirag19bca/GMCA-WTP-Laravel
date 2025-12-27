@extends('layouts.app')

@section('title', 'Services')

@section('content')

<link rel="stylesheet" href="{{ url('css/services.css') }}">

<div class="services-wrapper">
    <h2 class="services-title">Our Services</h2>

    <div class="services-container">

        <!-- Student Form -->
        <div class="service-card" onclick="goToStudentForm()">
            <h3>Student Academic Form</h3>
            <p>
                Fill and submit your academic details securely using our
                student form service.
            </p>
            <span class="service-link">Go to Form →</span>
        </div>

        <!-- Calculator -->
        <div class="service-card" onclick="goToCalculator()">
            <h3>Calculator</h3>
            <p>
                Perform basic arithmetic calculations using our
                built-in calculator tool.
            </p>
            <span class="service-link">Open Calculator →</span>
        </div>

    </div>
</div>

<!-- Page JS -->
<script>
    function goToStudentForm() {
        window.location.href = "{{ url('/studentform') }}";
    }

    function goToCalculator() {
        window.location.href = "{{ url('/calc') }}";
    }
</script>

@endsection
