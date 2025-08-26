# Website Laravel + FilamentPHP

Proyek ini dibangun menggunakan Laravel dan FilamentPHP sebagai admin panel yang modern, ringan, dan mudah dikustomisasi.

## Fitur Utama

-   Framework Laravel yang powerful dan scalable.
-   Admin panel menggunakan FilamentPHP v4.
-   Migrasi database yang cepat dan fleksibel.
-   Sistem autentikasi dengan user admin bawaan.

## ⚙️ Instalasi & Penggunaan

Ikuti langkah-langkah berikut untuk menjalankan proyek:

1. Clone repositori
   git clone <url-repository-anda>
   cd nama-folder

2. Install dependency Laravel
   composer install

3. Install FilamentPHP
   composer require filament/filament:"^4.0"

4. Salin file environment
   cp .env.example .env

5. Atur konfigurasi Sesuaikan database dan environment variable pada file .env

6. Generate application key
   php artisan key:generate

7. Migrasi database
   php artisan migrate

8. Buat akun admin
   php artisan make:filament-user

## 🛠️ Teknologi yang Digunakan

-   Laravel 12
-   FilamentPHP 4
-   PHP 8.3+
-   MySQL
