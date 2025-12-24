<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title', 'WTP Project')</title>

    <!-- OLD CSS FILES (UNCHANGED) -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
    <link rel="stylesheet" href="{{ url('css/register.css') }}">
    <link rel="stylesheet" href="{{ url('css/studentform.css') }}">


</head>

<body>
    <table class="main-table">

        <!-- Header Section -->
        <tr class="header">
            <td colspan="3">
                <div class="header-container">

                    <div class="header-left">
                        <img src="{{ url('Asset/Dhruvil.jpg') }}" class="student-img" />
                        <img src="{{ url('Asset/Dhrumil.jpg') }}" class="student-img" />
                        <img src="{{ url('Asset/Chirag.jpg') }}" class="student-img" />
                    </div>

                    <div class="header-content">
                        <h1>Welcome to Group 8 Webpage</h1>
                        <h3>Student ID: 25GMCA36, 25GMCA34, 25GMCA50</h3>

                        @if(session('user_id'))
                        <p class="header-status">
                            Logged in as <span>{{ session('user_name', 'Student') }}</span>
                        </p>
                        @else
                        <p class="header-status">Not logged in</p>
                        @endif
                    </div>

                    <div class="header-right">
                        <img src="{{ url('Asset/GMCA.png') }}" class="logo" />
                    </div>

                </div>
            </td>
        </tr>

        <!-- Navigation Bar -->
        <tr class="navbar">
            <td colspan="3">
                <a href="{{ url('/') }}">Home</a> |
                <a href="{{ url('/about') }}">About Us</a> |
                <a href="{{ url('/services') }}">Services</a> |
                <a href="{{ url('/contact') }}">Contact</a> |

                @if(!session('user_id'))
                <a href="{{ url('/register') }}">Register</a> |
                <a href="{{ url('/login') }}">Login</a>
                @else
                <a href="{{ url('/profile') }}">Profile</a> |
                <a href="{{ url('/calc') }}">Calculator</a> |
                <a href="{{ url('/studentform') }}">Student Form</a> |
                <a href="{{ url('/logout') }}">Logout</a>
                @endif
            </td>
        </tr>

        <!-- PAGE CONTENT -->
        <tr class="content-row">
            <td colspan="3">
                <div class="view-container">
                    @yield('content')
                </div>
            </td>
        </tr>

        <!-- Footer -->
        <tr class="footer">
            <td colspan="3">
                © 2025 Government MCA College, Maninagar. All Rights Reserved.
            </td>
        </tr>

    </table>
</body>

</html>