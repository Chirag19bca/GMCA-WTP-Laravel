@extends('layouts.app')

@section('title', 'Contact')

@section('content')

<link rel="stylesheet" href="{{ url('css/contact.css') }}">

<div class="contact-wrapper">
    <legend>Contact Us</legend>

    <p class="contact-intro">
        If you have any questions or need assistance, feel free to contact us
        using the form below.
    </p>

    <form class="contact-form">
        <div class="form-row">
            <label>Name</label>
            <input type="text" placeholder="Enter your name">
        </div>

        <div class="form-row">
            <label>Email</label>
            <input type="email" placeholder="Enter your email">
        </div>

        <div class="form-row">
            <label>Message</label>
            <textarea rows="4" placeholder="Enter your message"></textarea>
        </div>

        <div class="form-row">
            <button type="button" class="contact-btn">Send Message</button>
        </div>
    </form>

    <div class="contact-info">
        <p><strong>College:</strong> Government MCA College, Maninagar</p>
        <p><strong>Email:</strong> gmca@college.edu</p>
        <p><strong>Phone:</strong> +91 95374 12455,+91 79904 95457</p>
    </div>
</div>

@endsection
