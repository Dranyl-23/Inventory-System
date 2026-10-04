# Inventory System

A full-stack inventory management system built as a Prof-Elec 5 project. The repository is split into two independent apps:

```
Inventory-System/
├── backend/            # Laravel API
└── inventory-system/   # Vue 3 + TypeScript frontend
```

## Tech Stack

**Backend**
- Laravel 13 (PHP)
- MySQL (via XAMPP)
- Composer

**Frontend**
- Vue 3 + TypeScript
- Vite
- Vuetify

## Prerequisites

- PHP >= 8.2
- Composer
- Node.js & npm
- XAMPP (Apache + MySQL)

## Getting Started

### 1. Clone the repository

```bash
git clone https://github.com/Dranyl-23/Inventory-System.git
cd Inventory-System
```

### 2. Backend setup (Laravel)

```bash
cd backend
composer install
cp .env.example .env
php artisan key:generate
```

Update your `.env` with your local database credentials:

```
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=inventory_system
DB_USERNAME=root
DB_PASSWORD=your_password
```

Create the database in phpMyAdmin (name it `inventory_system`), then run migrations:

```bash
php artisan migrate
```

Start the backend server:

```bash
php artisan serve
```

### 3. Frontend setup (Vue)

```bash
cd ../inventory-system
npm install
npm run dev
```

The frontend will be available at the local Vite dev server URL (usually `http://localhost:5173`).

## Project Structure

### Backend (`/backend`)
- `app/Models` – Eloquent models
- `app/Http/Controllers` – API controllers
- `database/migrations` – Database schema definitions
- `routes` – API route definitions

### Frontend (`/inventory-system`)
- `src` – Vue components, views, and app logic
- `public` – Static assets

## Contributors

- Alfie Lynard S. Polacas ([@Dranyl-23](https://github.com/Dranyl-23))

## License

This project is for academic purposes (Prof-Elec 5).
