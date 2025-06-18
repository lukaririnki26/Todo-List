#  Todo List

API untuk membuat list tugas, mengunduh list tugas dalam format excel berdasarkan filter dan chart data tugas sesuai tipe

##  Fitur

- Create Todo List
- Get Todo List to Generate Excel
- Get Todo List to Provide Chart Data by Status
- Get Todo List to Provide Chart Data by Priority
- Get Todo List to Provide Chart Data by Assignee

##  Teknologi yang Digunakan

- [x] PHP 8 / Laravel 12
- [x] MySQL
- [x] Postman Collection

##  Instalasi & Setup

1. Clone repository:
   ```bash
   git clone https://github.com/lukaririnki26/Todo-List.git
   cd repo-backend
   ```

2. Install dependensi:
   ```bash
   composer install
   ```

3. Salin file `.env` dan sesuaikan:
   ```bash
   cp .env.example .env
   php artisan key:generate
   ```

4. Jalankan migrasi database:
   ```bash
   php artisan migrate
   ```

5. Jalankan server:
   ```bash
   php artisan serve
   ```


##  Dokumentasi API

Kamu bisa lihat dokumentasi API di:
- [Postman Docs Link](https://documenter.getpostman.com/view/16472298/2sB2x9jWZn)

