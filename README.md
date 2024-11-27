<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>
<h1 align="center">Hotel Booking Service</h1>

## Installation

1. Clone the repository:
    ```sh
   git clone git@github.com:MirsaidovUmed/Booking.git

2. Navigate to the project directory:
    ```sh
   cd Booking

3. Install the required dependencies:
    ```sh
   composer update
   cp .env.example .env
   php artisan key:generate
   
4. If using Laravel Sail
    ```sh
   composer require laravel/sail --dev
   php artisan sail:install
   
5. Using Makefile with sail (Info in Makefile)

## Project Overview
A hotel booking service is an online platform that allows users to search for hotels and book rooms globally. Users can filter hotels by price, location, amenities, and more.

## Core Features
1. User registration and authorization
2. Hotel search with filters (price, stars, amenities, etc.)
3. Detailed hotel pages (photos, descriptions, location)
4. Room reservation and booking confirmation via email
5. View, edit, and cancel bookings
6. Admin functions: manage hotels, rooms, and amenities

## Technical Stack
<div>
    <img src="https://cdn-icons-png.flaticon.com/512/673/673065.png" title="Openserver" alt="Openserver" height="40"/>&nbsp;
    <img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" title="Laravel_Logo" alt="Laravel_Logo" height="40"/>&nbsp;
    <img src="https://raw.githubusercontent.com/devicons/devicon/6910f0503efdd315c8f9b858234310c06e04d9c0/icons/mysql/mysql-original-wordmark.svg" title="MySQL" alt="MySQL" height="40"/>&nbsp;
</div>

## Security Features
- User authentication and access control
- Regular updates and security maintenance
- Password encryption
- Eloquent ORM for data interaction

## User Roles
- **Admin**: Full access to manage hotels, bookings, and users
- **Registered User**: Can search hotels, book rooms, and view their bookings
- **Guest**: Limited access to hotel listings without booking

## Key Pages
- `/hotels`: List of hotels with filter options
- `/hotels/{id}`: Hotel details and booking form
- `/bookings`: User’s booking history
- `/booking/{id}`: Booking details
- `/register` and `/login`: User registration and login

## Database Schema Overview
- `hotels`: Basic hotel details
- `rooms`: Room information, including price and type
- `users`: User data with authentication fields
- `bookings`: Booking history with related hotel and user details
- `facilities`: Hotel and room amenities
- Pivot tables for hotel and room facilities

