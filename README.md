# Aplikasi Monitoring Order

Sistem informasi Monitoring Order berbasis Web sebagai sarana pengumpulan data orderan pelanggan dan analisis informasi secara sistematis mengenai perkembangan program atau kegiatan.

## Clone Project from Git

```bash
git init
git clone https://gitlab.com/Gempong/dian-larasati-skripsi.git
cd dian-larasati-skripsi
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

<b>Inputer</b> <br>
Username : dianlarasati <br>
Password : dian12345

<b>Staff</b> <br>
Username : bagus <br>
Password : bagus12345
