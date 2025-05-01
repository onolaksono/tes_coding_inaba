Aplikasi Kasir Laravel (Tanpa Login)
Aplikasi ini adalah sistem kasir sederhana berbasis Laravel menggunakan database PostgreSQL. Fitur utamanya meliputi:

CRUD Produk
Fitur Checkout Produk
Validasi Stok
🚀 Langkah Instalasi
1. Clone Repository
git clone https://github.com/onolaksono/tes_coding_inaba.git
cd kasir-app
2. Install Dependency Laravel
composer install
3. Setup File .env
Copy file .env.example lalu rename menjadi .env dan sesuaikan konfigurasi database PostgreSQL

Edit file .env
DB_CONNECTION=pgsql
DB_HOST=127.0.0.1
DB_PORT=5432
DB_DATABASE=kasir_app
DB_USERNAME=postgres
DB_PASSWORD=admin(sesuaikan dengan password pada PGAdmin)
Pastikan database PostgreSQL bernama kasir_app sudah dibuat terlebih dahulu.

4. Generate Application Key
php artisan key:generate
5. Jalankan Migrasi dan Seeder (Data Awal)
php artisan migrate
php artisan db:seed
6. Jalankan Server Laravel
php artisan serve
secara default Aplikasi akan berjalan di: http://127.0.0.1:8000
