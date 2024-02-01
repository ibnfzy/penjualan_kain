# Penjualan Kain

## Setup

- Buat database Sql dengan nama `penjualan_kain`
- Lakukan migration database dengan `php spark migrate` di root folder project
- Jalankan seeder dengan `php spark db:seed Seed`
- Jalankan server dengan `php spark serve`

Setelah itu website penjualan kain ini sudah dapat kamu pakai, kamu cukup menjalankan `php spark serve` setelah melakukan langka diatas 🆗

## Server Requirements

PHP version 7.4 or higher is required, with the following extensions installed:

- [intl](http://php.net/manual/en/intl.requirements.php)
- [mbstring](http://php.net/manual/en/mbstring.installation.php)

Additionally, make sure that the following extensions are enabled in your PHP:

- json (enabled by default - don't turn it off)
- [mysqlnd](http://php.net/manual/en/mysqlnd.install.php) if you plan to use MySQL
- [libcurl](http://php.net/manual/en/curl.requirements.php) if you plan to use the HTTP\CURLRequest library
