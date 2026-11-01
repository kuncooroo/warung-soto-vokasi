# Warung Soto Vokasi

Toko daring untuk menu, pemesanan, testimoni, dan panel admin. Pembayaran memakai Midtrans.

Stack yang terpasang di `composer.json`: Laravel 12, PHP 8.2, SQLite, Vite, Tailwind CSS, Laravel Breeze, dan `midtrans/midtrans-php`.

## Yang perlu dipasang

- PHP 8.2 atau lebih baru
- Composer 2
- Node.js 20 atau lebih baru, plus npm
- Kunci Midtrans hanya jika ingin mencoba checkout. Tanpa kunci itu, halaman toko tetap bisa dibuka.

## Menjalankan di komputer sendiri

```bash
git clone https://github.com/kuncooroo/warung-soto-vokasi.git
cd warung-soto-vokasi
```

Database bawaan adalah SQLite. Buat file kosongnya dulu.

Windows PowerShell:

```powershell
New-Item -ItemType File -Force -Path database\database.sqlite
```

macOS / Linux:

```bash
touch database/database.sqlite
```

```bash
composer run setup
php artisan db:seed
composer run dev
```

`composer run setup` menyalin `.env.example` ke `.env`, membuat `APP_KEY`, migrasi, memasang paket npm, dan membangun asset. `composer run dev` menjalankan server, antrean, log, dan Vite.

Buka [http://127.0.0.1:8000](http://127.0.0.1:8000). Di `.env`, set `APP_URL=http://127.0.0.1:8000`.

Untuk checkout, tambahkan nilai dari dashboard Midtrans ke `.env`:

```env
MIDTRANS_SERVER_KEY=
MIDTRANS_CLIENT_KEY=
MIDTRANS_IS_PRODUCTION=false
```

Nama variabel itu dipakai di `config/midtrans.php`.

## Akun contoh

Akun ini dibuat oleh `database/seeders`.

| Peran | Email | Password | Masuk di |
| --- | --- | --- | --- |
| Pelanggan | `test@example.com` | `password` | `/login` |
| Super admin | `superadmin@warung-soto.com` | `password123` | `/admin/login` |
| Admin | `admin@warung-soto.com` | `password123` | `/admin/login` |

Ganti password ini jika situs dipasang di tempat yang bisa diakses orang lain.

## Halaman

- `/` beranda, `/menu` katalog, `/checkout` pemesanan setelah profil pelanggan lengkap
- `/orders` pesanan pelanggan yang sudah masuk
- `/admin/dashboard` panel admin
