<p align="center"><a href="#" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/yourusername/ShopMe/actions"><img src="https://github.com/yourusername/ShopMe/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/yourusername/ShopMe"><img src="https://img.shields.io/packagist/dt/yourusername/ShopMe" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/yourusername/ShopMe"><img src="https://img.shields.io/packagist/v/yourusername/ShopMe" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/yourusername/ShopMe"><img src="https://img.shields.io/packagist/l/yourusername/ShopMe" alt="License"></a>
</p>

## About ShopMe

**ShopMe** is an advanced e-commerce platform built with Laravel, integrating real-time text emotion detection and robust DDoS attack protection. This platform ensures secure, seamless, and personalized shopping experiences with features like:

- User management for admins, customers, and vendors.
- Intuitive product management with search and filters.
- Real-time text emotion analysis for customer feedback.
- A powerful admin dashboard with analytics and settings.
- Advanced middleware for DDoS attack prevention and geolocation filtering.

This project demonstrates the power of Laravel for scalable and secure web applications.
Table of Contents

## Features
- 1.System Architecture
- 2.Technologies Used
- 3.Installation Guide
- 4.Project Structure
- 5.Key Functionalities
- 6.Middleware Overview
- 7.Testing and Results
- 8.Future Improvements

## System Architecture
- The system is built with modular components:
- Frontend: Blade templates for dynamic and responsive UI.
- Backend: Laravel framework with Eloquent ORM for database operations.
- Middleware: Custom layers for DDoS protection, user-agent inspection, and geolocation blocking.

## Key Features
- **Real-time Text Emotion Detection:** Analyze customer feedback and reviews using machine learning.
- **DDoS Attack Mitigation:** Middleware to prevent malicious traffic and secure your platform.
- **Dynamic Shopping Cart:** A user-friendly cart with seamless checkout.
- **Admin Tools:** Category, brand, and blog management with detailed dashboards.
- **Custom Middleware:** For enhanced security and throttling.

## Technologies Used
- **Framework:** Laravel
- **Programming Language:** PHP
- **Frontend:** HTML, CSS, Bootstrap, Blade
- **Database:** MySQL
- **Testing Tools:** JMeter, HOIC

# Project Structure
shop-me/ │ ├── app/ # Core logic, including controllers and models. ├── config/ # Configuration files for the application. ├── database/ # Database migrations and seeds. ├── public/ # Publicly accessible files (e.g., images, JS, CSS). ├── resources/ # Resources like language files, views, and assets. │ ├── views/ # Blade templates for UI. │ ├── admin/ # Admin-related resources. │ ├── auth/ # Authentication-related views. │ ├── layouts/ # Layouts for the application. │ └── pages/ # Pages for different sections of the application. ├── routes/ # Web and API routes. ├── storage/ # Storage for file uploads, logs, etc. └── tests/ # Unit and feature tests.

- **app/**: Core logic, including controllers and models.
- **resources/views/**: Blade templates for UI.
- **routes/**: Web and API routes.
- **tests/**: Unit and feature tests.
# Key Functionalities

## User Features
- **Product browsing and search:** Browse and search products with ease.
- **Shopping cart and checkout:** Seamless cart functionality and checkout process.
- **Wishlist management:** Manage and save favorite products for future purchase.
- **Real-time emotion analysis on reviews:** Analyze customer sentiment on product reviews in real-time.

## Admin Features
- **Dashboard with analytics:** View real-time analytics and insights.
- **Manage products, categories, and blogs:** CRUD operations for products, categories, and blog posts.
- **View detailed reports on web traffic and performance:** Gain insights into traffic and system performance.

## Middleware Overview
Custom middleware ensures security and performance:
- **Throttling Middleware:** Limits request rates to prevent overloading.
- **IP Blocking Middleware:** Blocks malicious IP addresses to prevent attacks.
- **User-Agent Inspection:** Filters requests based on browser types.
- **Geolocation Blocking:** Restricts access from specific regions.
- **Request Logging:** Captures payload data for analytics and debugging.

## Screenshots
![image](https://github.com/user-attachments/assets/47e7a830-7bcc-4fc6-a030-f87fe8dc7f58)


## Testing and Results
- **JMeter Load Testing:** Validated the middleware's effectiveness under heavy traffic.
- **HOIC Simulation:** Ensured the system withstands DDoS attacks.
- **Graphs and Reports:** Showed significant improvement in server response time under high load.

## Future Improvements
- Enhance the emotion detection model with advanced sentiment analysis.
- Add multi-language support for a global audience.
- Implement AI-driven product recommendations based on customer preferences.

## Contributing
Contributions are welcome! Please fork the repository and submit a pull request with detailed information about your changes.

## License
This project is open-source and available under the MIT License.

## Learning ShopMe

Detailed documentation and guides will help you get started with the project. Additionally, comments in the codebase ensure ease of understanding for contributors.

## Sponsors and Contributions

We appreciate community contributions to improve this project. Please review the [Contribution Guide](CONTRIBUTING.md) for guidelines.

## Security Vulnerabilities

If you identify any security issues, please report them promptly via [your email here].

## License

The ShopMe project is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
