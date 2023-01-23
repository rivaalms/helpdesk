<?php

namespace Database\Seeders;

use App\Models\Admin;
use App\Models\Category;
use App\Models\Article;
use App\Models\Departement;
use App\Models\RegisterRequest;
use App\Models\Reply;
use App\Models\Status;
use App\Models\Ticket;
use App\Models\User;
use App\Models\UserRole;
use App\Models\Worker;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        RegisterRequest::factory(3)->create();
        UserRole::create([
            'name' => 'Pegawai'
        ]);
        UserRole::create([
            'name' => 'Teknisi'
        ]);
        
        \App\Models\User::factory(5)->create();
        User::create([
            'name' => 'Riva Almero',
            'user_role_id' => 2,
            'email' => 'riva.alms@gmail.com',
            'phone_number' => '+6285159200175',
            'departement_id' => 5,
            'telegram_username' => 'rivaalms',
            'password' => bcrypt('password')
        ]);
        
        Departement::factory(15)->create();
        // Departement::create([
        //     'name' => 'Admin'
        // ]);

        // Article::factory(20)->create();

        Article::create([
            'subject' => 'Komputer saya diserang virus. Apa yang harus saya lakukan?',
            'content' => '<p>Ikuti langkah-langkah berikut untuk menghapus virus di komputer Anda: <br>
            Buka aplikasi antivirus yang ada di komputer Anda. Pilih <b>Computer scan</b>. Pilih <b>Scan your computer</b>. Tunggu proses pemindaian virus di keseluruhan komputer hingga selesai. Setelah proses pemindaian selesai, antivirus akan menampilkan total file yang berhasil dipindai, file mana saja yang terinfeksi virus dan lain sebagainya. Anda bisa menghapus file yang terinfeksi tersebut.</p>',
            'category_id' => 1
        ]);
        Article::create([
            'subject' => 'Peramban tidak bisa dibuka',
            'content' => '<p>Komputer mungkin kehabisan memori dan tidak dapat menjalankan peramban sebagaimana mestinya. Anda dapat memulai komputer Anda untuk melihat apakah tindakan tersebut berhasil memperbaiki masalah.</p>',
            'category_id' => 2
        ]);
        Article::create([
            'subject' => 'Saya tidak bisa terhubung ke jaringan intranet',
            'content' => '<p>Ikuti langkah-langkah berikut untuk menghubungkan komputer ke jaringan intranet: <br>
            Pastikan kabel ethernet sudah terpasang kek komputer dengan baik. Klik <b>Start</b> > <b>Control Panel</b>. Pada halaman Control Panel, klik menu <b>Network and Internet</b>. Klik menu <b>Network and Sharing Center</b>. Klik menu <b>Change Adapter Settings</b>. Pilih pilihan koneksi <b>Ethernet</b>, klik kanan kemudian klik <b>Properties</b>. Klik pada <b>TCP/IPv4</b>, kemudian klik <b>Properties</b>. Pastikan <b>IP Address</b>, <b>Default Gateway</b>, dan <b>Subnet Mask</b> sudah sesuai dengan pengaturan yang diberikan oleh perusahaan.</p>',
            'category_id' => 3
        ]);
        Article::create([
            'subject' => 'Saya tidak bisa terhubung dengan printer yang dibagikan.',
            'content' => '<p>Ada beberapa alasan mengapa komputer tidak bisa terhubung dengan printer yang dibagikan, alasan-alasan utamanya termasuk pengaturan <b>File and Printer Sharing</b> dimatikan. Selain itu, File and Printer Sharing tidak diizinkan melalui <b>Windows Firewall</b> di komputer Anda dan komputer yang terhubung dengan printer. Dalam hal ini, untuk memperbaiki masalah, aktifkan <b>File and Printer Sharing</b> dan juga pastikan <b>Network Discovery</b> diaktifkan pada komputer Anda.</p>',
            'category_id' => 3
        ]);
        Article::create([
            'subject' => 'Saya ingin menggunakan jaringan intranet dan internet bersamaan. Apa yang harus saya lakukan?',
            'content' => '<p>Silakan membuat tiket bantuan untuk meminta bantuan teknisi.</p>',
            'category_id' => 3
        ]);
        Article::create([
            'subject' => 'Bagaimana cara mengatasi kertas macet pada printer?',
            'content' => '<p>Matikan printer. Periksa lokasi atau baki tempat kertas yang dicetak dikeluarkan. Jika ada kertas macet terlihat, keluarkan dengan cara ditarik perlahan. Keluarkan semua baki kertas dan semua kertas yang mungkin tersangkut di antara baki dan printer. Buka pintu printer yang memungkinkan Anda mengakses kartrid tinta atau toner printer dan cari kertas yang tersangkut. Jika kertas macet terlihat, tarik keluar secara perlahan. Hidupkan kembali printer.</p>',
            'category_id' => 1
        ]);
        Article::create([
            'subject' => 'Komputer tidak bisa menyala.',
            'content' => '<p>Periksa kabel daya komputer untuk memastikan kabel benar-benar tersambung dengan stop kontak. Jika Anda menggunakan power strip, pastikan power strip tersambung dengan stop kontak dan sakelar daya pada power strip dihidupkan. Jika komputer masih tidak bisa menyala, silakan laporkan masalah kepada teknisi.</p>',
            'category_id' => 1
        ]);
        Article::create([
            'subject' => 'Saya tidak bisa masuk ke akun sistem perusahaan saya. Apa yang harus saya lakukan?',
            'content' => '<p>Periksa kembali data akun yang Anda masukkan pada form masuk sudah benar. Jika masalah berlanjut, silakan hubungi teknisi melaporkan masalah.</p>',
            'category_id' => 2
        ]);
        Article::create([
            'subject' => 'Aplikasi Microsoft Word di komputer saya tidak bisa digunakan',
            'content' => '<p>Pastikan Microsoft Word yang terpasang di komputer Anda adalah versi terbaru. Buka <b>Control Panel - Programs and Features</b>. Klik Microsoft Office di daftar aplikasi yang diinstal. Pada bagian atas, klik <b>Change</b>. Pada dialog yang dihasilkan, klik <b>Repair</b>, ini adalah perbaikan yang komprehensif.</p>',
            'category_id' => 2
        ]);

        // <html>
        //     <p>Matikan printer. Periksa lokasi atau baki tempat kertas yang dicetak dikeluarkan. Jika ada kertas macet terlihat, keluarkan dengan cara ditarik perlahan. Keluarkan semua baki kertas dan semua kertas yang mungkin tersangkut di antara baki dan printer. Buka pintu printer yang memungkinkan Anda mengakses kartrid tinta atau toner printer dan cari kertas yang tersangkut. Jika kertas macet terlihat, tarik keluar secara perlahan. Hidupkan kembali printer.</p>
        // </html>

        // Category::create([
        //     'name' => 'Tidak '
        // ]);
        Category::create([
            'name' => 'Komputer'
        ]);
        Category::create([
            'name' => 'Perangkat Lunak'
        ]);
        Category::create([
            'name' => 'Jaringan'
        ]);

        Status::create([
            'name' => 'Diproses'
        ]);
        Status::create([
            'name' => 'Selesai'
        ]);

        Ticket::factory(15)->create();

        Reply::factory(20)->create();
    }
}
