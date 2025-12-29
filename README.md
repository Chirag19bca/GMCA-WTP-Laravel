# WTP Laravel Student Portal

A Laravel-based Student Management Portal developed as part of the Web Technology Project (WTP).  
The system provides authentication, student profile management, academic form submission, and utility features with a clean UI.

## Features

- User registration and login using enrollment number or email
- Session-based authentication and auto login
- Student profile page with personal and education details
- Multi-step student application form
- First-time submission and update handling
- Live client-side validation
- Change password with current password verification
- Forgot password and reset password functionality
- Dynamic navigation bar based on login status
- Services page with student form and calculator access
- Secure route protection
- Existing database integration without forced migrations

## Tech Stack

- Backend: Laravel (PHP)
- Frontend: Blade Templates, HTML, CSS, JavaScript
- Database: MySQL
- Server: XAMPP (Apache + MySQL)
- Version Control: Git & GitHub

## Project Setup (Local System)

1. Install XAMPP and start Apache and MySQL.
2. Clone the repository into the htdocs folder:
   git clone https://github.com/Chirag19bca/GMCA-WTP-Laravel.git
3. Navigate to the project directory:
   cd GMCA-WTP-Laravel
4. Copy .env.example and rename it to .env.
5. Update database credentials in the .env file.
6. Create the database in phpMyAdmin.
7. Install dependencies:
   composer install
8. Generate application key:
   php artisan key:generate
9. Run the project:
   php artisan serve
10. Open the browser and visit:
    http://127.0.0.1:8000

## Database Notes

- The project works with an existing database structure.
- Laravel migrations are not mandatory.
- Main tables used:
  - users
  - student_profile
  - education_details

## Usage Flow

1. Register a new user.
2. Login using enrollment number or email.
3. Complete the student application form.
4. View and update profile details.
5. Change password if required.
6. Access calculator and services page.
7. Logout securely.

## Collaboration

- Team members can sync updates using:
  git pull origin main
- Commit or stash local changes before pulling to avoid conflicts.

## Project Status

- Core functionality completed
- UI polished and validated
- Ready for college submission and viva
