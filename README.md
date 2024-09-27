# Laravel ToDo Application

## Overview

This is a simple ToDo application built using the Laravel framework. The app allows users to create, manage, and track their daily tasks. It includes features like user authentication, task categorization, reminders, and search functionality.

## Features

- User Registration and Authentication
- User Sign in  using Google Account using Laravel Socialite
- Task Creation, Editing, Deletion, and Completion
- Task Categorization and Filtering
- Task Search and Filtering
- Task Priority and Due Date Management
- Email Reminders for Upcoming Tasks in a pedified reminder time assigned for task
- Responsive Design for Desktop and Mobile
-User Profile Managemnt:
Edit profile information, including personal details and profile image.
Upload, delete, or change the profile image with ease.
Securely change the password to enhance account safety.
View user-related data statistics in an aesthetically pleasing format.

  

## Requirements

- PHP 8.0 or higher
- Laravel 9 or higher
- MySQLL
- Composer

## Installation

1. **Clone the Repository**
   ```bash
   git clone https://github.com/mahmoudkhairy159/Laravel_TO_Do_Application.git
   cd Laravel_TO_Do_Application
   Install PHP Dependencies
   composer install
Setup Environment Variables
Create a .env file in the root directory and copy the content of .env.example into it:
```bash
        cp .env.example .env
        Update the following environment variables:
        env
        Copy code
        DB_CONNECTION=mysql
        DB_HOST=127.0.0.1
        DB_PORT=3306
        DB_DATABASE=todo_app
        DB_USERNAME=root
        DB_PASSWORD=your_database_password
        
        MAIL_MAILER=smtp
        MAIL_HOST=smtp.mailtrap.io
        MAIL_PORT=2525
        MAIL_USERNAME=your_mailtrap_username
        MAIL_PASSWORD=your_mailtrap_password
        MAIL_ENCRYPTION=null
        MAIL_FROM_ADDRESS="noreply@todoapp.com"
        MAIL_FROM_NAME="${APP_NAME}"
        Generate Application Key

2. Generate Application Key
        php artisan key:generate
3.Run Migrations and Seed Database
    php artisan migrate --seed
    php artisan serve
