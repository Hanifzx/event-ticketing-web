# Olinevent - E-Ticketing Event Platform

**Olinevent** adalah platform manajemen event dan penjualan tiket elektronik berbasis web. Sistem ini menghubungkan Event Organizer yang ingin mempromosikan acaranya dengan Pengunjung yang mencari hiburan, serta dikelola oleh Administrator pusat.

Dibangun menggunakan **Laravel**, **Livewire**, dan **Tailwind CSS** dengan arsitektur **Service Pattern** yang rapi.

## Fitur Utama

### 1. Multi-Role User System
* **Admin:** Super user yang memiliki akses penuh ke seluruh sistem.
    * Dashboard Statistik (Pendapatan, Event Aktif, User).
    * Approval Akun Organizer (Terima/Tolak pendaftaran mitra).
    * Moderasi Event & Transaksi Global.
    * Manajemen User (Promote user, Delete user).
* **Event Organizer (OEM):** Mitra penyelenggara acara.
    * Pendaftaran khusus (menunggu persetujuan Admin).
    * Dashboard Manajemen Event sendiri.
    * CRUD Event & Tiket (Multiple ticket types).
    * Manajemen Pesanan Masuk (Approve/Reject bukti bayar/booking).
* **Registered User:** Pengunjung/Pembeli tiket.
    * Explore & Search Event (Filter Kategori, Lokasi, Waktu).
    * Booking Tiket (Sistem kuota & limit pembelian per user).
    * Riwayat Pesanan & Status Tiket.
    * Simpan Event ke Favorit.
* **Guest:** Pengunjung umum yang bisa melihat katalog event.

### 2. Fitur Unggulan
* **Livewire SPA Feel:** Interaksi tanpa reload halaman (Pagination, Search, Booking, Approval).
* **Service Repository Pattern:** Logika bisnis dipisahkan dari Controller/Livewire Component untuk kode yang lebih bersih.
* **Dynamic Ticket Management:** Satu event bisa memiliki banyak jenis tiket dengan kuota dan harga berbeda.
* **Booking Validation:** Validasi stok tiket real-time dan batas pembelian per akun.
* **Secure Authentication:** Menggunakan Laravel Breeze dengan kustomisasi role & status akun.

---

## Teknologi yang Digunakan

* **Backend:** Laravel 12
* **Frontend Logic:** Livewire 3 (Volt & Class Component)
* **Styling:** Tailwind CSS
* **Scripting:** Alpine.js
* **Database:** MySQL

---

## Cara Instalasi (Local Development)

Ikuti langkah-langkah berikut untuk menjalankan proyek ini di komputer lokal Anda:

1.  **Clone Repository**
    ```bash
    git clone [https://github.com/Hanifzx/event-ticketing-web.git](https://github.com/Hanifzx/event-ticketing-web.git)
    cd event-ticketing-web
    ```

2.  **Install Dependencies**
    ```bash
    composer install
    npm install
    ```

3.  **Setup Environment**
    Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database Anda.
    ```bash
    cp .env.example .env
    php artisan key:generate
    ```

4.  **Database Migration & Seeding**
    Jalankan migrasi dan isi data dummy (User, Event, Tiket).
    ```bash
    php artisan migrate --seed
    ```

5.  **Storage Link**
    Wajib dijalankan agar gambar event bisa muncul.
    ```bash
    php artisan storage:link
    ```

6.  **Jalankan Aplikasi**
    Buka dua terminal terpisah untuk menjalankan server Laravel dan Vite (untuk asset).
    
    *Terminal 1:*
    ```bash
    php artisan serve
    ```
    
    *Terminal 2:*
    ```bash
    npm run dev
    ```

7.  **Buka di Browser**
    Akses `http://127.0.0.1:8000`

---

## Struktur Folder Penting

* `app/Livewire`: Berisi semua komponen UI reaktif (Admin, Organizer, User, dll).
* `app/Services`: Berisi logika bisnis berat (BookingService, EventService, UserService, dll).
* `resources/views/components`: Komponen Blade reusable (Toast, Confirm Button, Cards, dll).
* `app/Http/Middleware`: Middleware kustom (`AdminMiddleware`, `OrganizerMiddleware`).

---

## Kredit & Lisensi

Project ini dibuat untuk **Individual Final Project Lab: E-Ticketing Event**.
* **Developer:** Muh. Hanif Nurmahdin
* **Framework:** Laravel