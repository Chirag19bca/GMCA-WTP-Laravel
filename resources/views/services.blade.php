@extends('layouts.app')

@section('title', 'Services')

@section('content')

<link rel="stylesheet" href="{{ url('css/services.css') }}">

<div class="services-wrapper">
    <h2 class="services-title">Our Services</h2>
    <p class="services-subtitle">
        Access useful tools and features provided for students.
    </p>

    <div class="services-container">

        <!-- Student Form -->
        <div class="service-card" onclick="goToStudentForm()">
            <img src="{{ url('Asset/form.png') }}"
                alt="Student Academic Form"
                class="service-icon">
            <h3>Student Academic Form</h3>
            <p>
                Fill and manage your academic details securely through
                the student application form.
            </p>
            <span class="service-link">Open Form →</span>
        </div>

        <!-- Calculator -->
        <div class="service-card" onclick="goToCalculator()">
            <img src="{{ url('Asset/calculator.png') }}"
                alt="Calculator"
                class="service-icon">

            <h3>Calculator</h3>
            <p>
                Perform basic arithmetic calculations using our
                built-in calculator tool.
            </p>
            <span class="service-link">Open Calculator →</span>
        </div>


    </div>
</div>

<script>
    function goToStudentForm() {
        window.location.href = "{{ url('/studentform') }}";
    }

    function goToCalculator() {
        window.location.href = "{{ url('/calc') }}";
    }
</script>

@endsection