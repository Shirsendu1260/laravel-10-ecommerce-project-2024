# Laravel 10 E-Commerce Project 2024

## About the Project
This is a robust and responsive e-commerce website built using Laravel 10 with an integrated admin panel for managing products, orders, users, and more. The project includes a Razorpay payment gateway, file uploads, advanced filtering, and interactive UI components.

## Technologies Used
- Laravel 10
- PHP 8.2.12
- MySQL
- jQuery
- HTML
- CSS
- Bootstrap
- Razorpay Payment Gateway
- Image Intervention v3
- Dropzone File Upload
- Range Slider
- Datetimepicker

## How to Run This Project on Your Local Machine
Follow these steps to set up and run the project locally:

1. Create a `.env` file if it doesn't exist.
2. Copy all content from `.env.example` into the new `.env` file.
3. Modify the `.env` file according to your environment settings.
4. Run the following command to generate an application key:
   ```bash
   php artisan key:generate
   ```
5. Run the migration to set up the database tables:
   ```bash
   php artisan migrate
   ```
6. Seed the database (if applicable):
   ```bash
   php artisan db:seed
   ```
   Or, import the provided SQL file.
7. Start the development server:
   ```bash
   php artisan serve
   ```
8. Open your browser and visit `http://127.0.0.1:8000` to access the application.

## Project Screenshots
(Add screenshots here)

---