-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 06, 2023 at 07:18 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `helpdesk`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins`
--

CREATE TABLE `admins` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_closed` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

CREATE TABLE `articles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`id`, `subject`, `content`, `category_id`, `created_at`, `updated_at`) VALUES
(1, 'Komputer saya diserang virus. Apa yang harus saya lakukan?', '<p>Ikuti langkah-langkah berikut untuk menghapus virus di komputer Anda: <br>\n            Buka aplikasi antivirus yang ada di komputer Anda. Pilih <b>Computer scan</b>. Pilih <b>Scan your computer</b>. Tunggu proses pemindaian virus di keseluruhan komputer hingga selesai. Setelah proses pemindaian selesai, antivirus akan menampilkan total file yang berhasil dipindai, file mana saja yang terinfeksi virus dan lain sebagainya. Anda bisa menghapus file yang terinfeksi tersebut.</p>', 1, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(2, 'Peramban tidak bisa dibuka', '<p>Komputer mungkin kehabisan memori dan tidak dapat menjalankan peramban sebagaimana mestinya. Anda dapat memulai komputer Anda untuk melihat apakah tindakan tersebut berhasil memperbaiki masalah.</p>', 2, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(3, 'Saya tidak bisa terhubung ke jaringan intranet', '<p>Ikuti langkah-langkah berikut untuk menghubungkan komputer ke jaringan intranet: <br>\n            Pastikan kabel ethernet sudah terpasang kek komputer dengan baik. Klik <b>Start</b> > <b>Control Panel</b>. Pada halaman Control Panel, klik menu <b>Network and Internet</b>. Klik menu <b>Network and Sharing Center</b>. Klik menu <b>Change Adapter Settings</b>. Pilih pilihan koneksi <b>Ethernet</b>, klik kanan kemudian klik <b>Properties</b>. Klik pada <b>TCP/IPv4</b>, kemudian klik <b>Properties</b>. Pastikan <b>IP Address</b>, <b>Default Gateway</b>, dan <b>Subnet Mask</b> sudah sesuai dengan pengaturan yang diberikan oleh perusahaan.</p>', 3, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(4, 'Saya tidak bisa terhubung dengan printer yang dibagikan.', '<p>Ada beberapa alasan mengapa komputer tidak bisa terhubung dengan printer yang dibagikan, alasan-alasan utamanya termasuk pengaturan <b>File and Printer Sharing</b> dimatikan. Selain itu, File and Printer Sharing tidak diizinkan melalui <b>Windows Firewall</b> di komputer Anda dan komputer yang terhubung dengan printer. Dalam hal ini, untuk memperbaiki masalah, aktifkan <b>File and Printer Sharing</b> dan juga pastikan <b>Network Discovery</b> diaktifkan pada komputer Anda.</p>', 3, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(5, 'Saya ingin menggunakan jaringan intranet dan internet bersamaan. Apa yang harus saya lakukan?', '<p>Silakan membuat tiket bantuan untuk meminta bantuan teknisi.</p>', 3, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(6, 'Bagaimana cara mengatasi kertas macet pada printer?', '<p>Matikan printer. Periksa lokasi atau baki tempat kertas yang dicetak dikeluarkan. Jika ada kertas macet terlihat, keluarkan dengan cara ditarik perlahan. Keluarkan semua baki kertas dan semua kertas yang mungkin tersangkut di antara baki dan printer. Buka pintu printer yang memungkinkan Anda mengakses kartrid tinta atau toner printer dan cari kertas yang tersangkut. Jika kertas macet terlihat, tarik keluar secara perlahan. Hidupkan kembali printer.</p>', 1, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(7, 'Komputer tidak bisa menyala.', '<p>Periksa kabel daya komputer untuk memastikan kabel benar-benar tersambung dengan stop kontak. Jika Anda menggunakan power strip, pastikan power strip tersambung dengan stop kontak dan sakelar daya pada power strip dihidupkan. Jika komputer masih tidak bisa menyala, silakan laporkan masalah kepada teknisi.</p>', 1, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(8, 'Saya tidak bisa masuk ke akun sistem perusahaan saya. Apa yang harus saya lakukan?', '<p>Periksa kembali data akun yang Anda masukkan pada form masuk sudah benar. Jika masalah berlanjut, silakan hubungi teknisi melaporkan masalah.</p>', 2, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(9, 'Aplikasi Microsoft Word di komputer saya tidak bisa digunakan', '<p>Pastikan Microsoft Word yang terpasang di komputer Anda adalah versi terbaru. Buka <b>Control Panel - Programs and Features</b>. Klik Microsoft Office di daftar aplikasi yang diinstal. Pada bagian atas, klik <b>Change</b>. Pada dialog yang dihasilkan, klik <b>Repair</b>, ini adalah perbaikan yang komprehensif.</p>', 2, '2023-02-06 17:54:53', '2023-02-06 17:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Komputer', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(2, 'Perangkat Lunak', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(3, 'Jaringan', '2023-02-06 17:54:53', '2023-02-06 17:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Tabib', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(2, 'Petani / Pekebun', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(3, 'Pengacara', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(4, 'Akuntan', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(5, 'Tukang Gigi', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(6, 'Nelayan / Perikanan', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(7, 'Paraji', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(8, 'Ustaz / Mubaligh', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(9, 'Pegawai Negeri Sipil (PNS)', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(10, 'Penulis', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(11, 'Jaksa', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(12, 'Tentara Nasional Indonesia (TNI)', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(13, 'Penata Rambut', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(14, 'Bidan', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(15, 'Perangkat Desa', '2023-02-06 17:54:53', '2023-02-06 17:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2022_04_15_174859_create_articles_table', 1),
(6, '2022_04_15_181430_create_categories_table', 1),
(7, '2022_04_25_124659_create_user_roles_table', 1),
(8, '2022_04_25_214734_create_tickets_table', 1),
(9, '2022_04_25_215309_create_statuses_table', 1),
(10, '2022_04_29_203415_create_replies_table', 1),
(11, '2022_05_06_034020_create_departements_table', 1),
(12, '2022_05_13_151629_create_workers_table', 1),
(13, '2022_05_13_151958_create_admins_table', 1),
(14, '2022_06_21_215243_create_webhooks_table', 1),
(15, '2022_06_21_220445_create_webhook_data_table', 1),
(16, '2022_09_12_124424_create_register_requests_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `register_requests`
--

CREATE TABLE `register_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `telegram_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `register_requests`
--

INSERT INTO `register_requests` (`id`, `name`, `email`, `phone_number`, `departement_id`, `telegram_username`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Murti Mustofa Wijaya', 'paris28@example.com', '+3586406150857', 1, 'irnanto54', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(2, 'Farah Pratiwi', 'purwanti.candrakanta@example.com', '+689134134921', 3, 'farhunnisa32', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(3, 'Balijan Candra Jailani', 'pratama.dalima@example.org', '+218083484350', 4, 'bmansur', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2023-02-06 17:54:53', '2023-02-06 17:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `replies`
--

CREATE TABLE `replies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `ticket_id` bigint(20) UNSIGNED NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `replies`
--

INSERT INTO `replies` (`id`, `user_id`, `ticket_id`, `message`, `created_at`, `updated_at`) VALUES
(1, 5, 10, 'Vel distinctio incidunt quos corporis. Corrupti corporis sed quas dolor. Nostrum et iusto ut mollitia omnis quaerat dicta. Aliquam aut eum nostrum deleniti a sint. Dolores vitae perferendis itaque est odit est reiciendis.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(2, 1, 3, 'Explicabo minus reprehenderit qui laudantium a inventore suscipit qui. Et eum aliquid aut sapiente sapiente. Et et tempore et amet et qui ex. Sunt vel voluptate aliquam facere facilis quasi. Laborum sed sunt eligendi vero vero.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(3, 4, 9, 'Est magnam odit veritatis exercitationem id corrupti voluptatem. Blanditiis facere autem qui magnam voluptatem facilis nesciunt. Nihil exercitationem in aut cupiditate odio aut. Eos ducimus ut laudantium repellat eaque qui. Asperiores saepe doloremque sit vel vitae et iusto.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(4, 5, 3, 'Dolorum in est quae dolor aut aliquam vel unde. Omnis maiores nihil harum eos. Eum corrupti non aut nihil aut porro. Eveniet soluta eos non debitis. Vel est ipsam voluptates quaerat labore aliquid praesentium.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(5, 4, 7, 'Est hic quia sit perferendis. Culpa pariatur id quis ut sed maxime eaque fugiat. Illum doloremque officiis reprehenderit ut. Quo quo eveniet ipsam laudantium corrupti dolor expedita. Et praesentium voluptas enim qui saepe hic ut.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(6, 2, 6, 'Fugiat nihil sint voluptatum atque dolorem. Illum quia quia impedit perspiciatis. Ut et cumque rerum tempora beatae ducimus. Reprehenderit ipsam enim et amet. Rem neque ea voluptatibus doloremque.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(7, 1, 14, 'Quia distinctio laudantium et quaerat eos. Omnis expedita qui dolores sint dolorem. Nobis voluptatibus nihil perspiciatis maxime ipsam nesciunt. Cumque consequatur explicabo fugit tempore autem quia. Consequatur commodi eius sint aspernatur id non omnis.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(8, 1, 11, 'Odit ratione voluptate voluptatibus ea. Veniam ullam ex officiis consequuntur eos blanditiis asperiores. Quasi recusandae illum autem aspernatur ea recusandae. Aut nobis iste aliquid officia. Non excepturi dolores quia facilis beatae consequatur.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(9, 4, 15, 'Mollitia quam adipisci officia esse. Vero corporis odio recusandae non. Odio repellat amet quam porro. Et omnis quam possimus ea in. Dolore quam illo deleniti est.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(10, 1, 15, 'Corrupti ad molestias fugit sed ipsam ea blanditiis ea. Quo modi quia eum voluptatem excepturi porro. Possimus fuga non quis autem ut. Praesentium recusandae et est nihil non. Aperiam omnis et incidunt eligendi fugit nihil et voluptatem.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(11, 5, 2, 'Commodi enim tempore assumenda laudantium sunt enim. Consequatur assumenda iusto voluptas consequuntur et. Dolores mollitia quia veritatis qui numquam ea sit. Est non voluptas excepturi similique neque alias ut. Repellat odit asperiores dolorem voluptatibus dolor quasi et.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(12, 5, 12, 'Quia qui maxime rem illum quo est qui. Voluptate quia alias enim deleniti. Delectus impedit soluta eligendi ipsum magni. Minima iusto totam facilis dolor. Itaque quam quo blanditiis eligendi nostrum.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(13, 5, 2, 'Sed dolores eos perspiciatis perspiciatis autem ex. Minima asperiores deleniti pariatur ut cumque illum totam occaecati. Non non reiciendis non maxime quia voluptatem impedit. Accusantium quasi aut veritatis vero ut atque. Magnam quae sint quam et.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(14, 5, 14, 'Voluptatem eius consectetur sint aut quas. Quidem fuga incidunt culpa rerum ea quia earum inventore. Ullam ex commodi fugiat eligendi quibusdam itaque. Id voluptas odio eligendi dolor quisquam et. Minima magnam et voluptatum assumenda quia enim.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(15, 1, 5, 'Porro eos ratione in. Sit quam voluptas odit delectus voluptates cupiditate. Laboriosam necessitatibus id neque omnis. Placeat est ut ut ad voluptatem delectus quod eos. Nisi laborum modi ea quas.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(16, 1, 10, 'Atque aut ea perspiciatis voluptatibus. Et voluptas corrupti quo et omnis et autem. Consequuntur illo nihil eum. Est et dolores quas eius aperiam consequuntur. Ducimus dolores repellendus et ut.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(17, 1, 13, 'Non et ut blanditiis animi fugit et. Debitis facilis nihil occaecati corporis et laudantium. A iure dolor omnis rerum temporibus et exercitationem animi. Quibusdam explicabo provident atque sed quia natus. Modi voluptatem voluptatem voluptas suscipit.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(18, 3, 8, 'Quia quasi expedita porro eos ducimus eaque. Accusamus minus recusandae ad provident consectetur. Porro minus et ut error consequatur amet. Aut aperiam itaque consequuntur possimus a. Adipisci dolores pariatur et quo accusantium sequi laudantium.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(19, 2, 6, 'Beatae itaque veritatis qui amet labore. Et et placeat assumenda ab possimus quam qui eveniet. Doloremque perspiciatis et ipsam nostrum qui. A omnis quia sequi corporis. Et quia voluptates esse voluptas ut et.', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(20, 5, 3, 'Qui saepe impedit error quis officia. Et eum rem repellendus numquam modi. Ullam ut natus id. Sed quia necessitatibus illo. Molestiae autem assumenda enim iste nam earum aliquid.', '2023-02-06 17:54:53', '2023-02-06 17:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `statuses`
--

CREATE TABLE `statuses` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `statuses`
--

INSERT INTO `statuses` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Diproses', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(2, 'Selesai', '2023-02-06 17:54:53', '2023-02-06 17:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `subject` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `detail` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category_id` bigint(20) UNSIGNED NOT NULL,
  `status_id` bigint(20) UNSIGNED NOT NULL,
  `closed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `subject`, `detail`, `category_id`, `status_id`, `closed_at`, `created_at`, `updated_at`) VALUES
(1, 3, 'Vero error totam minus placeat.', 'Non corporis recusandae incidunt cupiditate ducimus accusamus. Aut ut enim excepturi. Consequuntur fuga quos vero repellat enim soluta. Temporibus veritatis est dolorum et. Deserunt voluptatem quo impedit deserunt et a consequatur. Voluptatem quia veritatis est quas impedit quisquam reprehenderit est. Nihil voluptatem quia fuga quas. Aut fugiat exercitationem similique ut neque. Sit expedita totam nulla debitis incidunt omnis alias. Modi vel et voluptas laborum. Non harum natus omnis deleniti. Vel tempore vel omnis suscipit qui. Eum ut nulla quasi aut soluta tempore.', 3, 1, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(2, 1, 'Ut rem.', 'Enim expedita autem fugiat ea. Ipsam dolor quo quo magnam laudantium. Assumenda nobis consequatur quia ut optio velit. Totam est sunt veritatis. Qui repudiandae error ullam explicabo fuga quam voluptatem laborum. Veritatis consequuntur qui quis culpa molestiae magnam autem.', 3, 2, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(3, 3, 'Aut eius dolorum in est molestiae.', 'Repudiandae odit voluptates tempore id. Et et labore aut qui aperiam odio. Et quae optio et aut itaque. Facere et impedit impedit dolores. Nihil autem odit laboriosam molestiae velit est consequatur. Rerum esse suscipit dignissimos voluptatem dolores labore. Explicabo non error doloremque autem. Harum deleniti similique error ducimus. Dolorum qui veritatis officia nihil rerum vel. Quia molestiae assumenda corporis omnis aut rerum.', 1, 2, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(4, 1, 'Quis repudiandae et.', 'Labore molestiae incidunt neque. Distinctio inventore doloremque itaque. Velit magnam blanditiis natus dolorum omnis inventore. Ad voluptatum aut porro iure sit. Earum natus quos unde ut sapiente aut. Quis dolorum voluptate est et. Ut fugiat occaecati sint occaecati consequuntur natus adipisci. Eaque tempora aspernatur ut praesentium id exercitationem.', 1, 2, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(5, 3, 'Rerum possimus quia ut consectetur.', 'Unde sit vel sed a ex. Non vero rerum amet provident ut ut sapiente. Ut nulla error eveniet. Voluptatum quibusdam molestias vel consequatur reiciendis. Qui ullam voluptatem quia et dolores et natus. Repudiandae quia quo possimus.', 3, 1, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(6, 1, 'Dolor totam velit magni alias et.', 'Molestiae magnam facilis excepturi totam velit tempora distinctio eveniet. Nisi nostrum vero vel numquam. Amet architecto veritatis corrupti occaecati expedita voluptates in. Iusto tempore consequuntur quibusdam laboriosam. Quasi ratione repellat quos iusto consectetur excepturi aut. Quia architecto dolorem error excepturi voluptatem dignissimos excepturi. Esse ex voluptatum reprehenderit alias nam voluptatem.', 1, 2, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(7, 1, 'Et tenetur aliquid.', 'In occaecati quo velit dolores aut similique deleniti. Laboriosam velit necessitatibus pariatur doloribus autem reprehenderit. Qui fugiat nostrum veritatis rerum id sapiente. Ut explicabo et ratione vitae. Eaque tenetur qui minima ea earum expedita.', 2, 2, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(8, 2, 'Corporis aut vero.', 'Expedita recusandae unde porro nobis. Laboriosam illo officiis molestiae voluptatibus est. Nihil est et id ea officia. Magni architecto recusandae voluptate est rem est nam. Odio sapiente dolore consectetur voluptates iste. Id architecto voluptatem est sit quod sit temporibus veniam. Quos in officiis magnam voluptatum. Doloribus consequatur rem distinctio quia sint. Autem et omnis consequatur ut. Quisquam sit consequatur eos tempore perspiciatis aliquam voluptatibus. Voluptas dolorem enim laboriosam.', 3, 2, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(9, 4, 'Natus voluptates ut minus suscipit.', 'Est nihil qui animi aut illum. Et reiciendis est aperiam nulla dolor. Distinctio incidunt sit cum sed voluptatibus. Aspernatur hic iusto sequi assumenda dolorem. Possimus ea ducimus sint totam praesentium. Porro et natus accusamus qui. Placeat aliquam doloribus optio hic voluptates molestiae. Sit laudantium voluptatem praesentium incidunt et facilis.', 2, 1, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(10, 1, 'Deleniti voluptas consequatur.', 'Praesentium sunt est quo quis dignissimos in iste. Esse aut et ut veritatis. Molestias est beatae fugit. Alias omnis voluptatem incidunt sunt vero omnis assumenda. Tenetur quia nemo doloribus quos dolor. Eos magnam sit consequatur sint. Aut natus eligendi saepe ipsa.', 2, 1, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(11, 5, 'Maiores quis.', 'Et exercitationem corrupti tempore natus magni repudiandae explicabo. Eos voluptates autem qui eius asperiores sed saepe. Cumque ab repellendus atque optio voluptatum. Natus ut vitae quos repellat nemo omnis. Earum sit recusandae dolorem. Repudiandae nihil et fugit explicabo sunt assumenda sapiente et.', 2, 2, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(12, 2, 'Sunt sint consequatur.', 'Placeat beatae odio ipsum sunt optio natus. Quo voluptates necessitatibus quia et ad expedita amet. Consectetur dolor quo quidem id dolorem architecto pariatur iusto. In voluptatem rerum et veniam earum. Unde praesentium doloremque et et distinctio.', 3, 1, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(13, 1, 'Ut eligendi molestias maiores itaque quis aut.', 'Aut dolore sunt et. Ut illum quod et eum nihil ducimus ipsam suscipit. Itaque dolorum exercitationem quia labore modi et. Et fugit molestiae quae nisi consequuntur. Sunt rerum rerum ut laboriosam et assumenda quidem. Molestiae impedit reprehenderit deserunt quisquam.', 1, 2, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(14, 1, 'Nulla quis illo.', 'Aliquid accusamus possimus molestias nulla. Corrupti et autem rem deserunt suscipit quibusdam non sint. Dolorem aut aut iure impedit enim eum neque officia. Aspernatur corporis placeat ipsam magnam iste et. Odit placeat nobis velit deleniti. Autem cum voluptas autem nesciunt suscipit vel beatae. Voluptatibus corrupti quibusdam iste explicabo.', 1, 1, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(15, 4, 'Eos repellat tempore.', 'Quis ratione error dolorum sint aliquam fugiat. Explicabo vero doloribus eius ut non ratione consequatur quia. Quasi eius consequatur dolores quibusdam corrupti quo. Est ullam doloribus magni aut quidem. Voluptate quam ipsum repellendus quibusdam. Doloremque architecto accusantium cupiditate magnam qui reprehenderit. Ratione enim deleniti aut ratione occaecati quo.', 2, 2, NULL, '2023-02-06 17:54:53', '2023-02-06 17:54:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_role_id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `phone_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `telegram_username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `telegram_chat_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_role_id`, `email`, `phone_number`, `departement_id`, `telegram_username`, `telegram_chat_id`, `password`, `created_at`, `updated_at`) VALUES
(1, 'Kamaria Hassanah', 1, 'laksita.chelsea@example.org', '+67511085144', 4, 'indra.agustina', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(2, 'Empluk Nugroho S.Pt', 1, 'olga88@example.org', '+50569021173', 2, 'tpratama', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(3, 'Anggabaya Ardianto', 1, 'rika.nasyiah@example.com', '+50328303012', 4, 'marsito.hutasoit', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(4, 'Danu Purwanto Iswahyudi', 1, 'nurdiyanti.cinta@example.com', '+9663987154461', 3, 'qardianto', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(5, 'Laila Agustina', 1, 'natalia.budiyanto@example.org', '+6783450643', 3, 'gfarida', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(6, 'Admin', 2, 'admin@example.com', '+6280000000000', 9, 'admintelegramusername', NULL, '$2y$10$yHadOnYP3lbJpP0Q3MpU..FGcHpytdZql3yDpFN2tV/5nyGGkEoJS', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(7, 'Guest', 1, 'guest@example.com', '+62888000000000', 3, 'guesttelegramusername', NULL, '$2y$10$yHadOnYP3lbJpP0Q3MpU..FGcHpytdZql3yDpFN2tV/5nyGGkEoJS', '2023-02-06 17:59:01', '2023-02-06 17:59:01'),
(8, 'Superadmin', 3, 'superadmin@example.com', '+6281111110000', 9, 'superadmintelegramusername', NULL, '$2y$10$yHadOnYP3lbJpP0Q3MpU..FGcHpytdZql3yDpFN2tV/5nyGGkEoJS', '2023-02-06 18:00:54', '2023-02-06 18:00:54');

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Pegawai', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(2, 'Teknisi', '2023-02-06 17:54:53', '2023-02-06 17:54:53'),
(3, 'Superadmin', '2023-02-06 18:00:23', '2023-02-06 18:00:23');

-- --------------------------------------------------------

--
-- Table structure for table `webhooks`
--

CREATE TABLE `webhooks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `chat_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `webhook_data`
--

CREATE TABLE `webhook_data` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `webhook_id` bigint(20) UNSIGNED NOT NULL,
  `message_id` int(11) NOT NULL,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

CREATE TABLE `workers` (
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `departement_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `articles`
--
ALTER TABLE `articles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `register_requests`
--
ALTER TABLE `register_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `replies`
--
ALTER TABLE `replies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `statuses`
--
ALTER TABLE `statuses`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webhooks`
--
ALTER TABLE `webhooks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `webhook_data`
--
ALTER TABLE `webhook_data`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `articles`
--
ALTER TABLE `articles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `register_requests`
--
ALTER TABLE `register_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `replies`
--
ALTER TABLE `replies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `statuses`
--
ALTER TABLE `statuses`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `webhooks`
--
ALTER TABLE `webhooks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `webhook_data`
--
ALTER TABLE `webhook_data`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
