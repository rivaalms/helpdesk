## Tentang Aplikasi

Aplikasi <i>Helpdesk</i> Berbasis Web adalah sebuah aplikasi yang dibuat berdasarkan studi kasus yang dilakukan di PT Bank Pembangunan Daerah Kalimantan Barat. Tujuan dari aplikasi ini adalah untuk mengelola keluhan permasalahan teknis perangkat komputer di Kantor Pusat PT Bank Pembangunan Daerah Kalimantan Barat.

Aplikasi ini merupakan studi kasus sebagai projek Tugas Akhir, sehingga tidak diimplementasikan oleh PT Bank Pembangunan Daerah Kalimantan Barat. Aplikasi ini dikembangan dengan menggunakan metode pengembangan <i>Rapid Application Development</i> dimana pengembangan aplikasi dilakukan secara <i>incremental</i> dan menggunakan pendekatan berorientasi objek untuk pengembangan sistem.


## Fitur

Aplikasi <i>Helpdesk</i> berbasis Web ini dilengkapi dengan halaman <i>FAQ</i>, yaitu kumpulan pertanyaan yang sering ditanyakan oleh pengguna. Aplikasi <i>Helpdesk</i> berbasis Web ini juga terintegrasi dengan aplikasi perpesanan <i>Telegram</i> sehingga notifikasi dari pembaruan tiket yang dibuat oleh pengguna dikirimkan melalui <i>Bot Telegram</i>. Integrasi aplikasi dengan <i>Telegram</i> menggunakan <i>Ngrok</i> sebagai jembatan penghubung antara kedua aplikasi. <i>Ngrok</i> berperan sebagai <i>Web Hoster</i> sehingga Aplikasi <i>Helpdesk</i> dapat terintegrasi dengan <i>Telegram</i> dengan menggunakan metode <i>Webhook</i>.


## Deskripsi Pengguna

<table>
<thead>
<tr>
<th>Tipe pengguna</th>
<th>Deskripsi</th>
</tr>
</thead>
<tbody>
<tr>
<td>Guest</td>
<td>Melihat FAQ, membuat tiket, membuat balasan tiket, menyunting akun.</td>
</tr>
<tr>
<td>Admin</td>
<td>Melihat FAQ, membuat tiket, menyunting tiket, menghapus tiket, membuat balasan tiket, menghapus balasan tiket, menyunting akun, mengakses Dasbor Admin.</td>
</tr>
<tr>
<td>Superadmin</td>
<td>Melihat FAQ, membuat tiket, menyunting tiket, menghapus tiket, membuat balasan tiket, menghapus balasan tiket, menyunting akun, mengakses Dasbor Admin, menyetujui permintaan pembuatan akun baru.</td>
</tr>
</tbody>
</table>


## Akses Pengguna

Pengguna dapat mengakses aplikasi ini dengan menggunakan akun yang tertera di bawah ini:

Guest:
guest@example.com | password

Admin:
admin@example.com | password

Superadmin:
superadmin@example.com | password

## Code of Conduct

In order to ensure that the Laravel community is welcoming to all, please review and abide by the [Code of Conduct](https://laravel.com/docs/contributions#code-of-conduct).

## Security Vulnerabilities

If you discover a security vulnerability within Laravel, please send an e-mail to Taylor Otwell via [taylor@laravel.com](mailto:taylor@laravel.com). All security vulnerabilities will be promptly addressed.

## License

The Laravel framework is open-sourced software licensed under the [MIT license](https://opensource.org/licenses/MIT).
