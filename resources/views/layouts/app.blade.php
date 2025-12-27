@php
    use Illuminate\Support\Facades\DB;

    $fullName = '';

    if (auth()->check()) {
        $profile = DB::table('student_profile')
            ->where('user_id', auth()->id())
            ->first();

        if ($profile) {
            $fullName = trim($profile->fname . ' ' . $profile->lname);
        }
    }
@endphp

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />

    <title>@yield('title', 'WTP Project')</title>

    <!-- Auth meta -->
    <meta name="is-logged-in" content="{{ auth()->check() ? '1' : '0' }}">
    <meta name="current-user" content="{{ $fullName }}">

    <!-- CSS -->
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <link rel="stylesheet" href="{{ url('css/login.css') }}">
    <link rel="stylesheet" href="{{ url('css/register.css') }}">
    <link rel="stylesheet" href="{{ url('css/studentform.css') }}">
</head>

<body>
    <table class="main-table">

        <!-- Header -->
        <tr class="header">
            <td colspan="3">
                <div class="header-container">

                    <div class="header-left">
                        <img src="{{ url('Asset/Dhruvil.jpg') }}"
                             class="student-img"
                             onclick="autoLogin('Dhruvil')" />

                        <img src="{{ url('Asset/Dhrumil.jpg') }}"
                             class="student-img"
                             onclick="autoLogin('Dhrumil')" />

                        <img src="{{ url('Asset/Chirag.jpg') }}"
                             class="student-img"
                             onclick="autoLogin('Chirag')" />
                    </div>

                    <div class="header-content">
                        <h1>Welcome to Group 8 Webpage</h1>
                        <h3>Student ID: 25GMCA36, 25GMCA34, 25GMCA50</h3>

                        @auth
                            <p class="header-status">
                                Logged in as
                                <span>{{ $fullName }}</span>
                            </p>
                        @endauth

                        @guest
                            <p class="header-status">Not logged in</p>
                        @endguest
                    </div>

                    <div class="header-right">
                        <img src="{{ url('Asset/GMCA.png') }}" class="logo" />
                    </div>

                </div>
            </td>
        </tr>

        <!-- Navbar -->
        <tr class="navbar">
            <td colspan="3">
                <a href="{{ url('/') }}">Home</a> |
                <a href="{{ url('/about') }}">About Us</a> |
                <a href="{{ url('/services') }}">Services</a> |
                <a href="{{ url('/contact') }}">Contact</a> |

                @guest
                    <a href="{{ route('register') }}">Register</a> |
                    <a href="{{ route('login') }}">Login</a>
                @endguest

                @auth
                    <a href="{{ url('/profile') }}">Profile</a> |
                    <a href="{{ url('/calc') }}">Calculator</a> |
                    <a href="{{ url('/studentform') }}">Student Form</a> |
                    <a href="#"
                       onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                        Logout
                    </a>

                    <form id="logout-form" method="POST"
                          action="{{ route('logout') }}" style="display:none;">
                        @csrf
                    </form>
                @endauth
            </td>
        </tr>

        <!-- Page Content -->
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

    <!-- Auto Login Script -->
    <script>
        function autoLogin(who) {

            const isLoggedIn =
                document.querySelector('meta[name="is-logged-in"]').content === "1";

            const currentUser =
                document.querySelector('meta[name="current-user"]').content;

            if (isLoggedIn) {
                const lowerCurrent = currentUser.toLowerCase();
                const lowerWho = who.toLowerCase();

                if (lowerCurrent.includes(lowerWho)) {
                    alert("You are already logged in as " + currentUser);
                } else {
                    alert("Please logout first to switch user.");
                }
                return;
            }

            window.location.href = "/auto-login/" + who;
        }
    </script>

</body>
</html>
