<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
# Task Manager

This is a simple Task Manager application built with Laravel for managing tasks.

## Features

- Create, Read, Update, and Delete (CRUD) operations on tasks
- Add due dates to tasks
- Implement task status (completed/incomplete)
- Basic styling for better user experience

## Installation

1. Clone the repository to your local machine:
   git clone https://github.com/Osamaislam1/task-manager.git
2. Navigate to the project directory:
    cd task-manager
3. Install dependencies using Composer:
   composer install
4. Copy the .env.example file to .env:
   cp .env.example .env
5. Generate an application key:
   php artisan key:generate
6.Configure your database settings in the .env file.
7. Run database migrations:
   php artisan migrate
8. Start the Laravel development server:
   php artisan serve
   
Visit http://localhost:8000 in your web browser to access the application.





