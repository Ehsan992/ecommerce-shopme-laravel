Shop Me - Laravel E-Commerce Project

Shop Me is a feature-rich e-commerce platform developed using Laravel. This project integrates advanced functionalities such as real-time text emotion detection and DDoS attack prevention to ensure a secure and personalized shopping experience.

Table of Contents

Features

System Architecture

Technologies Used

Installation Guide

Project Structure

Key Functionalities

Middleware Overview

Testing and Results

Future Improvements

Features

Real-time text emotion detection for customer reviews.

DDoS attack prevention using Laravel middleware.

User-friendly UI with dynamic pages (e.g., Home, Cart, Checkout).

Admin panel with CRUD operations for products, blogs, and categories.

Secure shopping cart and checkout process.

System Architecture

The system is built with modular components:

Frontend: Blade templates for dynamic and responsive UI.

Backend: Laravel framework with Eloquent ORM for database operations.

Middleware: Custom layers for DDoS protection, user-agent inspection, and geolocation blocking.

Technologies Used

Framework: Laravel

Programming Language: PHP

Frontend: HTML, CSS, Bootstrap, Blade

Database: MySQL

Testing Tools: JMeter, HOIC

Installation Guide

Clone the repository:

git clone https://github.com/yourusername/shop-me.git

Navigate to the project directory:

cd shop-me

Install dependencies:

composer install
npm install

Set up the environment file:

cp .env.example .env

Configure your database and other settings in .env.

Run migrations and seed the database:

php artisan migrate --seed

Start the development server:

php artisan serve

Project Structure

shop-me/
|-- app/
|-- config/
|-- database/
|-- public/
|-- resources/
    |-- views/
        |-- admin/
        |-- auth/
        |-- layouts/
        |-- pages/
|-- routes/
|-- storage/
|-- tests/

app/: Core logic, including controllers and models.

resources/views/: Blade templates for UI.

routes/: Web and API routes.

tests/: Unit and feature tests.

Key Functionalities

User Features

Product browsing and search.

Shopping cart and checkout.

Wishlist management.

Real-time emotion analysis on reviews.

Admin Features

Dashboard with analytics.

Manage products, categories, and blogs.

View detailed reports on web traffic and performance.

Middleware Overview

Custom middleware ensures security and performance:

Throttling Middleware: Limits request rates.

IP Blocking Middleware: Blocks malicious IPs.

User-Agent Inspection: Filters requests based on browser types.

Geolocation Blocking: Restricts access from specific regions.

Request Logging: Captures payload data for analytics.

Testing and Results

JMeter Load Testing: Validated middleware effectiveness under heavy traffic.

HOIC Simulation: Ensured the system withstands DDoS attacks.

Graphs and Reports: Showed significant improvement in server response time.

Future Improvements

Enhance the emotion detection model with advanced sentiment analysis.

Add multi-language support for a global audience.

Implement AI-driven product recommendations.

Contributing

Contributions are welcome! Please fork the repository and submit a pull request with detailed information about your changes.

License

This project is open-source and available under the MIT License.


