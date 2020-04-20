-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 20 Apr 2020 pada 12.19
-- Versi server: 10.4.11-MariaDB
-- Versi PHP: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project_ci`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id` int(11) NOT NULL,
  `nama` varchar(125) NOT NULL,
  `keterangan` varchar(125) NOT NULL,
  `kategori` varchar(125) NOT NULL,
  `harga` int(125) NOT NULL,
  `stock` int(50) NOT NULL,
  `gambar` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id`, `nama`, `keterangan`, `kategori`, `harga`, `stock`, `gambar`) VALUES
(35, 'sepatu', '122', 'Pakaian Pria', 700000, 2, 'sepatu.jpg'),
(36, 'laptop', '11', 'Elektronik', 12000000, 7, 'laptop.jpg'),
(37, 'kamera', '122', 'Elektronik', 12000000, 11, 'kamera.jpg'),
(38, 'ada', '111', 'Pakaian Pria', 12000000, 11, ''),
(39, 'aadw', 'bagus', 'kkka', 100, 222, 'www'),
(40, 'ada', '122', 'Pakaian Wanita', 12000000, 11, '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_invoice`
--

CREATE TABLE `tb_invoice` (
  `id` int(11) NOT NULL,
  `nama` varchar(255) NOT NULL,
  `alamat` varchar(255) NOT NULL,
  `tgl_pesan` date NOT NULL,
  `batas_bayar` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_invoice`
--

INSERT INTO `tb_invoice` (`id`, `nama`, `alamat`, `tgl_pesan`, `batas_bayar`) VALUES
(1, 'aa', 'aaass', '2020-04-05', '2020-04-06'),
(2, 'aa', 'aaass', '2020-04-05', '2020-04-06'),
(3, 'dwdwdwd', 'adadwww', '2020-04-05', '2020-04-06'),
(4, 'ada', 'ada111', '2020-04-05', '2020-04-06'),
(5, 'ada', 'ada111', '2020-04-05', '2020-04-06'),
(6, 'aa', 'alaall', '2020-04-05', '2020-04-06'),
(7, '', '', '2020-04-10', '2020-04-11'),
(8, 'topik', 'aaa', '2020-04-10', '2020-04-11'),
(9, '', '', '2020-04-10', '2020-04-11'),
(10, '', '', '2020-04-10', '2020-04-11'),
(11, '', '', '2020-04-10', '2020-04-11'),
(12, '', '', '2020-04-10', '2020-04-11'),
(13, '', '', '2020-04-10', '2020-04-11'),
(14, '', '', '2020-04-10', '2020-04-11');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pemesanan`
--

CREATE TABLE `tb_pemesanan` (
  `id` int(11) NOT NULL,
  `id_invoice` int(11) NOT NULL,
  `id_brg` int(11) NOT NULL,
  `nama_brg` varchar(225) NOT NULL,
  `jumlah` int(3) NOT NULL,
  `harga` int(20) NOT NULL,
  `pilihan` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pemesanan`
--

INSERT INTO `tb_pemesanan` (`id`, `id_invoice`, `id_brg`, `nama_brg`, `jumlah`, `harga`, `pilihan`) VALUES
(1, 1, 25, 'Laptop', 1, 12000000, ''),
(2, 2, 25, 'Laptop', 1, 12000000, ''),
(3, 3, 27, 'Kamera', 1, 12000000, ''),
(4, 4, 33, 'ada', 1, 12000000, ''),
(5, 4, 27, 'Kamera', 1, 12000000, ''),
(6, 5, 33, 'ada', 1, 12000000, ''),
(7, 5, 27, 'Kamera', 1, 12000000, ''),
(8, 6, 27, 'Kamera', 1, 12000000, ''),
(9, 6, 25, 'Laptop', 1, 12000000, ''),
(13, 10, 35, 'sepatu', 1, 700000, ''),
(14, 11, 36, 'laptop', 1, 12000000, ''),
(15, 12, 36, 'laptop', 2, 12000000, ''),
(16, 13, 36, 'laptop', 1, 12000000, ''),
(17, 14, 36, 'laptop', 2, 12000000, '');

--
-- Trigger `tb_pemesanan`
--
DELIMITER $$
CREATE TRIGGER `pesanan_produk` AFTER INSERT ON `tb_pemesanan` FOR EACH ROW BEGIN
UPDATE tb_barang SET stock = stock - NEW.jumlah
WHERE id = NEW.id_brg;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `image` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `image`, `password`, `role_id`, `is_active`, `date_created`) VALUES
(1, 'aaaassss', 'taufik.akbar741@yahoo.com', 'images__1_-removebg-preview_(1).png', '$2y$10$fKh/Q/.e3kKBbUWUnHzpPuPlPt7TpSCYJ4sUa2VEvM0cMtyPwBcLS', 1, 1, 1581048167),
(2, 'adada', 'uyee@gmail.com', 'default.jpg', '$2y$10$3qWpZJoCaXa03Gml66ghrOcwMOwMiT8Qn4aAhiFM.UYMBRuWg03pS', 2, 1, 1581048277),
(19, 'digidww', 'taufikakbarxtfl2@gmail.com', 'default.jpg', '$2y$10$yS1YXJhOjCDHk58JXXLa1.WYyNniD6NT68JjmE7tDYzAJyxItaLDC', 2, 0, 1582553873);

-- --------------------------------------------------------

--
-- Struktur dari tabel `users_role`
--

CREATE TABLE `users_role` (
  `id` int(11) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `users_role`
--

INSERT INTO `users_role` (`id`, `role`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'dadaad');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_access_menu`
--

CREATE TABLE `user_access_menu` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_access_menu`
--

INSERT INTO `user_access_menu` (`id`, `role_id`, `menu_id`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 2, 2),
(4, 1, 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_menu`
--

CREATE TABLE `user_menu` (
  `id` int(11) NOT NULL,
  `menu` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_menu`
--

INSERT INTO `user_menu` (`id`, `menu`) VALUES
(1, 'Admin'),
(2, 'User'),
(3, 'Menu');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_sub_menu`
--

CREATE TABLE `user_sub_menu` (
  `id` int(11) NOT NULL,
  `menu_id` int(11) NOT NULL,
  `title` varchar(128) NOT NULL,
  `field_url` varchar(128) NOT NULL,
  `icon` varchar(128) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_sub_menu`
--

INSERT INTO `user_sub_menu` (`id`, `menu_id`, `title`, `field_url`, `icon`, `is_active`) VALUES
(1, 1, 'Dashboard Admin', 'admin', 'fas fa-fw fa-tachometer-alt', 1),
(2, 2, 'My Profile', 'user', 'fas fa-fw fa-user', 1),
(3, 2, 'Edit Profile', 'user/edit', 'fas fa-fw fa-user-edit', 1),
(4, 3, 'Menu Management', 'menu', 'fas fa-fw fa-folder', 1),
(5, 3, 'Submenu Management', 'menu/submenu', 'fas fa-fw fa-folder-open', 1),
(7, 1, 'Role', 'admin/role', 'fas fa-fw fa-user-tie', 1),
(8, 2, 'Change Password', 'user/changepassword', 'fas fa-fw fa-key', 1),
(9, 2, 'Toko Online', 'user/toko_online', 'fas fa-fw fa-database', 1),
(10, 2, 'Elektronik', 'user/elektronik', 'fas fa-fw fa-tv', 1),
(11, 2, 'Pakaian Pria', 'user/pakaian_pria', 'fas fa-fw fa-tshirt', 1),
(12, 2, 'Pakaian Wanita', 'user/pakaian_wanita', 'fas fa-fw fa-tshirt', 1),
(13, 2, 'Pakaian Anak-anak', 'user/pakaian_anak', 'fas fa-fw fa-tshirt', 1),
(14, 2, 'Peralatan Olahraga', 'user/alat_olahraga', 'fas fa-fw fa-futbol', 1),
(15, 1, 'Data Barang', 'admin/data_barang', 'fas fa-fw fa-database', 1),
(16, 1, 'Invoice', 'admin/invoice', 'fas fa-fw fa-futbol', 1);

-- --------------------------------------------------------

--
-- Struktur dari tabel `user_token`
--

CREATE TABLE `user_token` (
  `id` int(11) NOT NULL,
  `email` varchar(128) NOT NULL,
  `token` varchar(128) NOT NULL,
  `date_created` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `user_token`
--

INSERT INTO `user_token` (`id`, `email`, `token`, `date_created`) VALUES
(26, 'taufikakbarxtfl2@gmail.com', 'ajPNTW58jdKw/cgY94dQERMZEHdJCSJiL+sPuHkJpKI=', 1582552715),
(27, 'taufikakbarxtfl2@gmail.com', 'WNRs4Sir9ackEsH3n95SultLQS0SMNNn4gD4kiYqw8k=', 1582552829),
(28, 'taufikakbarxtfl2@gmail.com', 'FCvNA2kaPEwFvCAmlSRMkSPkneNQXLFctOVNkflgfZw=', 1582553765),
(29, 'taufikakbarxtfl2@gmail.com', 'aUgonwtNwwBESTB95E5qwdkf9PcJn85Ew/52sFitT5k=', 1582553873);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `users_role`
--
ALTER TABLE `users_role`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  ADD PRIMARY KEY (`id`);

--
-- Indeks untuk tabel `user_token`
--
ALTER TABLE `user_token`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- AUTO_INCREMENT untuk tabel `tb_invoice`
--
ALTER TABLE `tb_invoice`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `tb_pemesanan`
--
ALTER TABLE `tb_pemesanan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `users_role`
--
ALTER TABLE `users_role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `user_access_menu`
--
ALTER TABLE `user_access_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `user_menu`
--
ALTER TABLE `user_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `user_sub_menu`
--
ALTER TABLE `user_sub_menu`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT untuk tabel `user_token`
--
ALTER TABLE `user_token`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
