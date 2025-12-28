@extends('layouts.app')

@section('title','About Us')

@section('content')

<!-- Page-specific CSS -->
<link rel="stylesheet" href="{{ url('css/about.css') }}">

<div class="about-wrapper">
  <div class="about-card">
    <h1>About Us</h1>

    <p class="intro-text">
      Welcome to our <strong>Student Portal</strong> — a secure and user-friendly 
      web application built using the <strong>Laravel Framework</strong>. This portal 
      allows students to register, log in, manage their profiles, and submit academic 
      details efficiently.
    </p>

    <h2>🎯 Our Mission</h2>
    <p>
      Our mission is to provide a modern and reliable digital platform that simplifies 
      student data management. By leveraging Laravel’s MVC architecture, we ensure 
      better security, maintainability, and performance.
    </p>

    <h2>📚 What This Mini Project Includes</h2>
    <ul>
      <li>Student Registration with Validation</li>
      <li>Secure Login & Session Management</li>
      <li>Password Change & Security Flow</li>
      <li>Profile Management System</li>
      <li>Student Academic Details Form</li>
      <li>Client-side & Server-side Validation</li>
    </ul>

    <h2>🛠 Technologies Used</h2>
    <p>
      <strong>Frontend:</strong> HTML, CSS, JavaScript<br>
      <strong>Framework:</strong> Laravel (MVC Architecture)<br>
      <strong>Backend:</strong> PHP<br>
      <strong>Database:</strong> MySQL<br>
      <strong>Security:</strong> CSRF Protection, Password Hashing
    </p>

    <h2>🏗 Project Architecture</h2>
    <p>
      The application follows Laravel’s <strong>MVC (Model-View-Controller)</strong> 
      pattern. Controllers handle business logic, Blade templates manage the UI, and 
      MySQL stores persistent data. Client-side validation enhances user experience, 
      while server-side validation ensures data integrity.
    </p>

    <h2>👨‍💻 Project Team</h2>
    <p>
      This mini project was developed by students of <strong>Government MCA College</strong> 
      as part of the academic curriculum, demonstrating practical implementation of 
      Laravel and database-driven web applications.
    </p>

  </div>
</div>

@endsection
