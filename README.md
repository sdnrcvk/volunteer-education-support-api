# Volunteer Education Support Platform

This is the backend portion of the Volunteer Education Support Platform project.

## Getting Started

To run and develop this project on your local machine, you can follow these steps:

1. Clone this repository to your local machine:
```bash
git clone https://github.com/sdnrcvk/volunteer-education-support-api.git
```
2. Create a .env file to configure database connections and other settings, and add the necessary information:
```bash   
DB_CONNECTION_STRING=your_database_connection_string
```
3. `composer install` -> Install project dependencies using Composer.
 
4. `php artisan migrate:refresh` -> Refresh the database migrations.

5. `php artisan db:seed` -> Run database migrations and seed the database.

6. `php artisan serve` -> Start the Laravel development server.

## Used Technologies
 
### Backend
 
-**Laravel:** Laravel is a popular PHP framework for building web applications. It provides a robust set of tools and features for web development.
 
-**Laravel Sanctum:** Laravel Sanctum is a package for Laravel that provides a simple way to authenticate and manage API tokens. It's commonly used for securing APIs and ensuring that only authorized users can access protected resources.

-**MySql:** MySQL is used as the database system for this project.
 
### Frontend

The frontend for this project can be found in <a href="https://github.com/sdnrcvk/volunteer_education_support_frontend">this repository.</a>
