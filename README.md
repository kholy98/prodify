# Prodify - Product Management Application

**Prodify** is a Laravel-based application for managing products with a user-friendly interface. The app allows users to create, update, delete, and manage products with image uploads. Authentication is required to access the dashboard and features.

## Features
- User Authentication (Register, Login, Logout)
- Dashboard to manage products
- Create, Update, and Delete products
- Upload and manage multiple images per product
- Responsive UI with modern styling

## Requirements
Ensure the following tools are installed on your system:
- PHP (>= 8.2)
- Composer
- MySQL
- Node.js (>= 16.x)
- npm (or yarn)

## Installation
Follow these steps to install and run the project locally:

```bash
# Clone the repository
git clone https://github.com/your-repo/prodify.git
cd prodify 
```

# Install PHP dependencies
```bash
composer install
```

# Set up the environment file
```bash
cp .env.example .env
```

# Update the .env file with your database credentials and other settings

# Generate application key
```bash
php artisan key:generate
```

# Run migrations to create necessary tables
```bash
php artisan migrate
```

# Install frontend dependencies
```bash
npm install
```
# or if you prefer Yarn
```bash
yarn install
```

# Install Laravel Breeze for authentication
```bash
composer require laravel/breeze --dev
php artisan breeze:install
npm install && npm run dev
```


# Install Spatie Media Library for media uploads
```bash
composer require spatie/laravel-medialibrary
```

# Publish the configuration
```bash
php artisan vendor:publish --provider="Spatie\MediaLibrary\MediaLibraryServiceProvider"
```


# Run migrations for the media library
```bash
php artisan migrate
```

# Set up FilePond for image uploads
- Note: FilePond is used for image uploads with CDN links.
    ```html
    <link href="https://unpkg.com/filepond/dist/filepond.css" rel="stylesheet">
    <script src="https://unpkg.com/filepond/dist/filepond.js"></script>
    ```

# Start the development server
```bash
php artisan serve
```



