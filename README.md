# Arsip Surat Desa Karangduren


Aplikasi sederhana untuk mengarsipkan surat (PDF) dengan Laravel + MySQL.


## Tujuan
Membantu kelurahan mengelola arsip surat hasil pemindaian (PDF) berdasarkan kategori.


## Fitur
- CRUD Arsip Surat (upload PDF only, lihat, unduh, hapus dengan konfirmasi)
- Pencarian judul (substring, case-insensitive)
- CRUD Kategori (ID auto)
- Halaman About (Foto, Nama, NIM, Tanggal pembuatan)


## Cara Menjalankan
1. `composer install` (jika belum)
2. Salin `.env.example` menjadi `.env` lalu atur koneksi database
3. `php artisan key:generate`
4. `php artisan migrate --seed`
5. `php artisan storage:link`
6. `php artisan serve` lalu buka `http://127.0.0.1:8000`


## Screenshot
<img width="959" height="439" alt="utama" src="https://github.com/user-attachments/assets/9691be8e-e1fe-4126-ba22-0058eb61592c" />
<img width="955" height="435" alt="about" src="https://github.com/user-attachments/assets/4c9d0004-2590-46f3-bd22-a11eb04fe305" />
<img width="959" height="442" alt="hapus" src="https://github.com/user-attachments/assets/5a55c238-0e32-4ba8-96e0-ce6f0cf88bdb" />
<img width="959" height="440" alt="detail"<img width="957" height="434" alt="kategori" src="https://github.com/user-attachments/assets/e3bf5c83-adab-4878-95dd-7a46f702abbd" />
<img width="955" height="432" alt="upload" src="https://github.com/user-attachments/assets/e257d356-3bb2-458e-9f5a-6020ee0b9fc8" />
<img width="959" height="440" alt="detail" src="https://github.com/user-attachments/assets/ae6b4a5c-1c44-440a-83d8-9beb8f567566" />


## Teknologi
- Laravel 12, Blade, Tailwind (CDN)
, Blade, Tailwind (CDN)
- MySQL/MariaDB
