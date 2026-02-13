<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400" alt="Laravel Logo"></a></p>

<p align="center">
<a href="https://github.com/laravel/framework/actions"><img src="https://github.com/laravel/framework/workflows/tests/badge.svg" alt="Build Status"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/dt/laravel/framework" alt="Total Downloads"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/v/laravel/framework" alt="Latest Stable Version"></a>
<a href="https://packagist.org/packages/laravel/framework"><img src="https://img.shields.io/packagist/l/laravel/framework" alt="License"></a>
</p>

## Feature

- Simple CRUD Example
- Facade Auth (Authentication)
- Facade Gate (Dynamic Permission Menu Authorize)
- Service Providers (Dependency Injection)
- Logging (Admin Activity, Webhook slack for critical error)
- Filemanager (UniSharp + permission/role)

## Getting Started

- Clone this repository
```bash
git clone https://github.com/anmeidyan/laravel12-admin-panel.git
```

- Rename .env.example to .env
- Make sure your MySQL is connected

- Install and update all vendor
```bash
composer update
```

- Generate App Key
```bash
php artisan key:generate
```

- Migrate and Seed
```bash
php artisan migrate --seed
```

- Run
```bash
php artisan serve
```