# Aplikasi Sistem Informasi Keuangan

Sistem informasi Keuangan berbasis Web sebagai sarana pengumpulan, pengolahan dan pemaparan data keuangan dari SD Katolik Rekas 2.

## Clone Project from Git

```bash
git init
git clone https://github.com/wiradrm/Sistem-Informasi-Keuangan.git
cd Sistem Informasi Keuangan
```

## Installation
Buat database baru di phpmyadmin <br>Cek file `.env` jika tidak ada rename file `.env.example` menjadi `.env` set `DB_DATABASE` sesuai nama database dan set `DB_USERNAME=root`

```bash
npm install
```
jalankan perintah dibawah untuk melakukan migration table dan seed data
```bash
composer dump-autoload
php artisan migrate
php artisan db:seed
```

## Usage
```bash
php artisan serve
```

## Default Account

<b>Kepala Sekolah</b> <br>
Username : gaspargarung <br>
Password : gaspar1234

<b>Staff</b> <br>
Username : thomasaquino <br>
Password : thomas1234
