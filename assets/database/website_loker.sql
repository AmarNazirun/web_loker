-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Okt 2025 pada 13.39
-- Versi server: 10.4.32-MariaDB
-- Versi PHP: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `website_loker`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admin_disnaker`
--

CREATE TABLE `admin_disnaker` (
  `id_admin` int(11) NOT NULL,
  `nama_admin` text NOT NULL,
  `no_hp` text NOT NULL,
  `email` text NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admin_disnaker`
--

INSERT INTO `admin_disnaker` (`id_admin`, `nama_admin`, `no_hp`, `email`, `username`) VALUES
(1, 'Disnaker', '0821111111', 'disnaker@email.com', 'disnaker');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_calon`
--

CREATE TABLE `data_calon` (
  `id_calon` int(11) NOT NULL,
  `nama_lengkap` text NOT NULL,
  `handphone` text NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `status_kawin` varchar(15) NOT NULL,
  `email` text NOT NULL,
  `foto` text NOT NULL,
  `username` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_calon`
--

INSERT INTO `data_calon` (`id_calon`, `nama_lengkap`, `handphone`, `tempat_lahir`, `tanggal_lahir`, `jenis_kelamin`, `agama`, `status_kawin`, `email`, `foto`, `username`) VALUES
(17, 'Amar Nazirun', '081122334455', 'Ternate', '2025-06-08', 'Laki-laki', 'Islam', 'Belum Kawin', '11111111111111111', 'amarnazirun.jpg', 'amarnazirun'),
(18, 'Amar Nazirun2', '1111', 'aaaaaaa', '2025-06-08', 'Laki-laki', 'Islam', 'Belum Kawin', 'aaaaaaaa', 'amarnazirun.jpg', 'amarnazirun2'),
(20, 'fajar', '1111', 'aaaaaaa', '2025-08-13', 'Laki-laki', 'Islam', 'Belum Menikah', 'aaaaaaaa', 'default.png', 'fajar'),
(21, 'Elfira', '082345678', 'Ternate', '2025-08-06', 'Perempuan', 'Islam', 'Belum Menikah', '11111111111111', 'default.png', 'elfira'),
(22, 'jumi', '08123456789', 'taliabu', '2025-08-26', 'Perempuan', 'Islam', 'Belum Kawin', '7653426117', 'default.png', 'jumi'),
(23, 'nuris', '08123456789', 'Ternate', '2025-10-01', 'Perempuan', 'Islam', 'Belum Menikah', '', 'default.png', 'nurlis');

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_karyawan`
--

CREATE TABLE `data_karyawan` (
  `id_calon` int(11) NOT NULL,
  `nama_lengkap` text NOT NULL,
  `handphone` text NOT NULL,
  `tempat_lahir` text NOT NULL,
  `tanggal_lahir` date NOT NULL,
  `jenis_kelamin` varchar(10) NOT NULL,
  `agama` varchar(10) NOT NULL,
  `status_kawin` varchar(15) NOT NULL,
  `no_ktp` varchar(17) NOT NULL,
  `foto` text NOT NULL,
  `username` varchar(100) NOT NULL,
  `posisi` text NOT NULL,
  `id_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `data_perusahaan`
--

CREATE TABLE `data_perusahaan` (
  `id_perusahaan` int(11) NOT NULL,
  `nama_perusahaan` text NOT NULL,
  `alamat` text NOT NULL,
  `telepon` text NOT NULL,
  `email` text NOT NULL,
  `facebook` text NOT NULL,
  `instagram` text NOT NULL,
  `x` text NOT NULL,
  `website` text NOT NULL,
  `tentang_perusahaan` text NOT NULL,
  `logo` text NOT NULL,
  `username` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `data_perusahaan`
--

INSERT INTO `data_perusahaan` (`id_perusahaan`, `nama_perusahaan`, `alamat`, `telepon`, `email`, `facebook`, `instagram`, `x`, `website`, `tentang_perusahaan`, `logo`, `username`) VALUES
(1, 'PT. ABC', 'Kota ternate', '0822xxxxx', '', '', '', '', 'www.abc.com', 'Lorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, quasi quos atque quisquam omnis molestiae modi aliquid ipsam quibusdam sint minima dolore eaque ipsa magnam esse! Molestiae eos possimus fugiat?\n\nLorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, quasi quos atque quisquam omnis molestiae modi aliquid ipsam quibusdam sint minima dolore eaque ipsa magnam esse! Molestiae eos possimus fugiat?', '', 'abc'),
(3, 'xx1', 'xxxxxx', 'xxxxx', 'xxxx@gmai.com', 'facebook', 'instagram', 'x', 'xxxxx', 'perusahaan ini merupakannn....\r\n\r\nLorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, quasi quos atque quisquam omnis molestiae modi aliquid ipsam quibusdam sint minima dolore eaque ipsa magnam esse! Molestiae eos possimus fugiat?\r\n\r\nLorem ipsum dolor sit amet consectetur, adipisicing elit. Neque, quasi quos atque quisquam omnis molestiae modi aliquid ipsam quibusdam sint minima dolore eaque ipsa magnam esse! Molestiae eos possimus fugiat?', 'xxxx.png', 'xxxx'),
(4, 'PT Agung Food Industrindo', 'Ternate Selatan', '', '', '', '', '', '', 'PT. Agung Food Industrindo adalah perusahaan Consumer Goods yang berdiri sejak tahun 2012 di Jakarta . Perusahaan ini memproduksi dan memasarkan produk produk di kategori minuman bubuk atau produk lainnya yang berbasis powder seperti pudding premix , Panna cotta .\r\n\r\nDalam menjalankan operasionalnya PT Agung Food Industrindo selalu melakukan proses Inovasi yang terus menerus agar dapat senantiasa memenuhi kebutuhan dan kepuasan pelanggannya . Dan melalui proses ini perusahaan telah menghasilkan produk produk yang berkualitas dan dapat dipercaya oleh masyarakat luas , baik domistik maupun internasional .\r\n\r\nProduk produk yang dihasilkan oleh PT Agung Food Industrindo saat ini telah tersebar hampir disebagian besar wilayah di Indonesia , bahkan telah diexport ke berbagai negara seperti China , Singapore dan Afrika .\r\n\r\nSaat ini PT Agung Food Industrindo , dengan perkembangan kondisi yang ada lebih berfocus pada pengembangan produk produk di pasar Horeka yakni minuman bubuk khusus untuk usaha cafe dan resto . Dan sejalan dengan focus ini , PT Agung Food juga melayani permintaan untuk jasa maklon.\r\n\r\n', '', ''),
(6, 'PT Angin Ribut', 'Ternate Selatan', '088888888', 'angin@mail.com', '', '', '', '', '', 'default.png', 'anginribut');

-- --------------------------------------------------------

--
-- Struktur dari tabel `lowongan`
--

CREATE TABLE `lowongan` (
  `id_lowongan` int(11) NOT NULL,
  `posisi` text NOT NULL,
  `pendidikan_minimal` varchar(10) NOT NULL,
  `jenis_pekerjaan` varchar(10) NOT NULL,
  `gaji` text NOT NULL,
  `tanggal_dibuka` date NOT NULL,
  `tanggal_ditutup` date NOT NULL,
  `deskripsi` text NOT NULL,
  `status` varchar(25) NOT NULL,
  `id_perusahaan` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `lowongan`
--

INSERT INTO `lowongan` (`id_lowongan`, `posisi`, `pendidikan_minimal`, `jenis_pekerjaan`, `gaji`, `tanggal_dibuka`, `tanggal_ditutup`, `deskripsi`, `status`, `id_perusahaan`) VALUES
(1, 'web', '', '', '', '2025-06-06', '2025-06-16', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Nobis optio labore ipsa corrupti. Veritatis rerum eos obcaecati nesciunt, sed cupiditate, dolorem dicta, voluptate repudiandae iste porro eaque perferendis cumque. Aperiam.', 'terverifikasi', 1),
(2, 'mobile', '', '', '', '2025-06-07', '2025-06-16', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Laborum explicabo consequuntur eius cumque voluptatum fuga, non necessitatibus minus porro quasi dolore facilis ipsum quidem doloremque ab rem ratione et provident?\r\n', 'terverifikasi', 1),
(4, 'Data Analisis', '', '', '', '2025-08-03', '2025-08-31', 'Lorem ipsum dolor sit amet, consectetur adipisicing elit. Est quidem similique vel, autem, quis exercitationem eos fuga quae nesciunt numquam nisi provident dignissimos ratione quo reiciendis porro minima cumque suscipit?\r\n', 'terverifikasi', 3),
(5, 'Desain grafis', 'Tidak Ada', 'Remote', '1 juta', '2025-08-05', '2025-08-21', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt adipisci ipsam nesciunt modi quisquam officia optio fugit animi dicta suscipit laudantium, eaque omnis exercitationem itaque numquam, facere ipsa voluptatibus quos!\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt adipisci ipsam nesciunt modi quisquam officia optio fugit animi dicta suscipit laudantium, eaque omnis exercitationem itaque numquam, facere ipsa voluptatibus quos!\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt adipisci ipsam nesciunt modi quisquam officia optio fugit animi dicta suscipit laudantium, eaque omnis exercitationem itaque numquam, facere ipsa voluptatibus quos!\r\n\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Deserunt adipisci ipsam nesciunt modi quisquam officia optio fugit animi dicta suscipit laudantium, eaque omnis exercitationem itaque numquam, facere ipsa voluptatibus quos!\r\n', 'terverifikasi', 3),
(7, 'Admin E-Commers', 'D3', 'Full Time', '1 juta', '2025-08-14', '2025-08-31', 'rjaan berdasarkan pendidikan\r\n\r\nPerbaiki:\r\nDetail lowongan di history pelamar\r\n\r\nbuat data history pelamar di tabel history_pelamar (opsional)\r\n\r\nkalau status pelamar diterima, data pelamar dihapus dari tabel data_calon dan dimasukkan ke tabel pegawai\r\n\r\ntambah fitur:\r\n- tolak lowongan (di detail lowongan & di verifikasi lowongan)\r\n- tolak pelamar (untuk perusahaan)\r\n- jika lowongan sudah melewati tanggal ditutup, maka lowongan otomatis dihapus dan status pelamar otomatis ditolak\r\n- lamar lowongan (untuk user)\r\n- verifikasi lowongan (untuk disnaker)\r\n- tambah user disnaker', 'Terverifikasi', 6),
(9, 'Admin E-Commers', 'D3', 'Full Time', '1 juta', '2025-08-14', '2025-08-31', 'rjaan berdasarkan pendidikan\r\n\r\nPerbaiki:\r\nDetail lowongan di history pelamar\r\n\r\nbuat data history pelamar di tabel history_pelamar (opsional)\r\n\r\nkalau status pelamar diterima, data pelamar dihapus dari tabel data_calon dan dimasukkan ke tabel pegawai\r\n\r\ntambah fitur:\r\n- tolak lowongan (di detail lowongan & di verifikasi lowongan)\r\n- tolak pelamar (untuk perusahaan)\r\n- jika lowongan sudah melewati tanggal ditutup, maka lowongan otomatis dihapus dan status pelamar otomatis ditolak\r\n- lamar lowongan (untuk user)\r\n- verifikasi lowongan (untuk disnaker)\r\n- tambah user disnaker', 'Terverifikasi', 6),
(10, 'Admin E-Commers', 'D3', 'Full Time', '1 juta', '2025-08-14', '2025-08-31', 'rjaan berdasarkan pendidikan\r\n\r\nPerbaiki:\r\nDetail lowongan di history pelamar\r\n\r\nbuat data history pelamar di tabel history_pelamar (opsional)\r\n\r\nkalau status pelamar diterima, data pelamar dihapus dari tabel data_calon dan dimasukkan ke tabel pegawai\r\n\r\ntambah fitur:\r\n- tolak lowongan (di detail lowongan & di verifikasi lowongan)\r\n- tolak pelamar (untuk perusahaan)\r\n- jika lowongan sudah melewati tanggal ditutup, maka lowongan otomatis dihapus dan status pelamar otomatis ditolak\r\n- lamar lowongan (untuk user)\r\n- verifikasi lowongan (untuk disnaker)\r\n- tambah user disnaker', 'Ditolak', 6),
(11, 'Data Analisis', 'S1', 'Full Time', '10 juta', '2025-08-15', '2025-08-31', 'Keterampilan yang harus dimiliki:\r\n\r\n1.\r\n2.', 'Terverifikasi', 6),
(12, 'admin kantor', 'S1', 'Full Time', '5 juta', '2025-08-15', '2025-08-31', 'persyaratan yang diperlukan:\r\n\r\n1. \r\n2.\r\n3.', 'Terverifikasi', 6);

-- --------------------------------------------------------

--
-- Struktur dari tabel `organisasi_calon`
--

CREATE TABLE `organisasi_calon` (
  `id_organisasi` int(11) NOT NULL,
  `lembaga` text NOT NULL,
  `bidang` text NOT NULL,
  `tahun_awal` varchar(4) NOT NULL,
  `tahun_akhir` varchar(4) NOT NULL,
  `negara_kota` text NOT NULL,
  `id_calon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pelamar`
--

CREATE TABLE `pelamar` (
  `id_pelamar` int(11) NOT NULL,
  `tanggal_melamar` date NOT NULL,
  `id_lowongan` int(11) NOT NULL,
  `id_calon` int(11) NOT NULL,
  `status_lamaran` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pelamar`
--

INSERT INTO `pelamar` (`id_pelamar`, `tanggal_melamar`, `id_lowongan`, `id_calon`, `status_lamaran`) VALUES
(1, '2025-08-01', 3, 17, 'Menunggu Konfirmasi'),
(2, '2025-08-04', 1, 17, 'Menunggu Konfirmasi'),
(3, '2025-08-04', 4, 17, 'Diterima'),
(4, '2025-08-04', 4, 18, 'Menunggu Konfirmasi'),
(8, '2025-08-04', 7, 18, 'Diterima'),
(9, '2025-08-04', 7, 20, 'Ditolak'),
(11, '2025-08-14', 7, 17, 'Menunggu Konfirmasi'),
(12, '2025-08-15', 7, 21, 'Diterima'),
(13, '2025-08-15', 5, 21, 'Menunggu Konfirmasi'),
(14, '2025-08-15', 1, 21, 'Menunggu Konfirmasi'),
(15, '2025-08-15', 7, 22, 'Ditolak'),
(16, '2025-08-15', 12, 21, 'Menunggu Konfirmasi');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pendidikan_calon`
--

CREATE TABLE `pendidikan_calon` (
  `id_pendidikan` int(11) NOT NULL,
  `lembaga` text NOT NULL,
  `jurusan` text NOT NULL,
  `tahun_awal` varchar(4) NOT NULL,
  `tahun_akhir` varchar(4) NOT NULL,
  `kota` text NOT NULL,
  `lulus` text NOT NULL,
  `gpa` text NOT NULL,
  `id_calon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengalaman_kerja`
--

CREATE TABLE `pengalaman_kerja` (
  `id_pengalaman` int(11) NOT NULL,
  `perusahaan` text NOT NULL,
  `alamat_perusahaan` text NOT NULL,
  `telepon` text NOT NULL,
  `tahun_awal` varchar(4) NOT NULL,
  `tahun_akhir` varchar(10) NOT NULL,
  `posisi` text NOT NULL,
  `tanggung_jawab` text NOT NULL,
  `alasan_keluar` text NOT NULL,
  `gaji_terakhir` text NOT NULL,
  `id_calon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pengalaman_kerja`
--

INSERT INTO `pengalaman_kerja` (`id_pengalaman`, `perusahaan`, `alamat_perusahaan`, `telepon`, `tahun_awal`, `tahun_akhir`, `posisi`, `tanggung_jawab`, `alasan_keluar`, `gaji_terakhir`, `id_calon`) VALUES
(4, 'cv. yz', 'gambesi2', '0811xxxx2', '2010', 'saat ini', 'web2', 'coding2', 'mau naik jabatan2', '8000000', 17),
(5, 'pt. xyz', 'jati', '0811xxxx2', '2019', '2020', 'web', 'buat tampilan website', 'mau naik jabatan2', '10 juta', 21),
(6, 'pt. yz2', 'jati', '12355789900', '2010', '2022', 'web', 'buat tampilan website', 'malas', '1 juta', 22);

-- --------------------------------------------------------

--
-- Struktur dari tabel `prestasi_calon`
--

CREATE TABLE `prestasi_calon` (
  `id_prestasi` int(11) NOT NULL,
  `lembaga` text NOT NULL,
  `bidang` text NOT NULL,
  `tahun_awal` varchar(4) NOT NULL,
  `tahun_akhir` varchar(4) NOT NULL,
  `negara_kota` text NOT NULL,
  `id_calon` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `username` varchar(100) NOT NULL,
  `password` text NOT NULL,
  `level` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`username`, `password`, `level`) VALUES
('amarnazirun', '$2y$10$FbUa6ABwhIK5yzOyakDOcOSevdd9Yl2BAwgR.d.3XMoQmGH2WuGju', 'user'),
('amarnazirun2', '$2y$10$FbUa6ABwhIK5yzOyakDOcOSevdd9Yl2BAwgR.d.3XMoQmGH2WuGju', 'belum terverifikasi'),
('anginribut', '$2y$10$t4aCjrt.ZzDpxmyL3/JaUevLeo.L24cRvobdHhtX8MRFmgeyZqwUm', 'perusahaan'),
('disnaker', '$2y$10$cAVf0b.liSyQqKUNMdd/FuBNlFpWE4wC5DuEcEVTPGNWbrggjpLCS', 'disnaker'),
('elfira', '$2y$10$I4.apYM6abMQ1D96arFRnuQu4erMUfFm1LIBDtYnS1Ry0AJPyA1gO', 'user'),
('fajar', '$2y$10$sq41NIm5iXbg18AUUYxOaOGeneWMaWQzdrUFelZd8lLR3SMusN1mW', 'user'),
('iki', '123', 'user'),
('isra', '456', 'user'),
('jumi', '$2y$10$SCZ5/cO6p.qwuJaTzEiIZe2wRluB2Q1KmOhP0NRxv5q/VLGK6DIgO', 'user'),
('nurlis', '$2y$10$yDI4VcTYOrxKi21nlDslC.PDEdRM5ssig3kMY/LMjBfa8DP1DSyRG', 'user'),
('xxxx', '$2y$10$hsRV85hIRZj8SClQf3ela.EYdIy/9RebnGuFyodMk2f5XmVfXQVkS', 'perusahaan');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admin_disnaker`
--
ALTER TABLE `admin_disnaker`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indeks untuk tabel `data_calon`
--
ALTER TABLE `data_calon`
  ADD PRIMARY KEY (`id_calon`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  ADD PRIMARY KEY (`id_calon`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indeks untuk tabel `data_perusahaan`
--
ALTER TABLE `data_perusahaan`
  ADD PRIMARY KEY (`id_perusahaan`);

--
-- Indeks untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  ADD PRIMARY KEY (`id_lowongan`);

--
-- Indeks untuk tabel `organisasi_calon`
--
ALTER TABLE `organisasi_calon`
  ADD PRIMARY KEY (`id_organisasi`),
  ADD KEY `id_calon` (`id_calon`);

--
-- Indeks untuk tabel `pelamar`
--
ALTER TABLE `pelamar`
  ADD PRIMARY KEY (`id_pelamar`);

--
-- Indeks untuk tabel `pendidikan_calon`
--
ALTER TABLE `pendidikan_calon`
  ADD PRIMARY KEY (`id_pendidikan`),
  ADD KEY `id_calon` (`id_calon`);

--
-- Indeks untuk tabel `pengalaman_kerja`
--
ALTER TABLE `pengalaman_kerja`
  ADD PRIMARY KEY (`id_pengalaman`),
  ADD KEY `id_calon` (`id_calon`);

--
-- Indeks untuk tabel `prestasi_calon`
--
ALTER TABLE `prestasi_calon`
  ADD PRIMARY KEY (`id_prestasi`),
  ADD KEY `id_calon` (`id_calon`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admin_disnaker`
--
ALTER TABLE `admin_disnaker`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `data_calon`
--
ALTER TABLE `data_calon`
  MODIFY `id_calon` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `data_karyawan`
--
ALTER TABLE `data_karyawan`
  MODIFY `id_calon` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `data_perusahaan`
--
ALTER TABLE `data_perusahaan`
  MODIFY `id_perusahaan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT untuk tabel `lowongan`
--
ALTER TABLE `lowongan`
  MODIFY `id_lowongan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT untuk tabel `organisasi_calon`
--
ALTER TABLE `organisasi_calon`
  MODIFY `id_organisasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pelamar`
--
ALTER TABLE `pelamar`
  MODIFY `id_pelamar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT untuk tabel `pendidikan_calon`
--
ALTER TABLE `pendidikan_calon`
  MODIFY `id_pendidikan` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `pengalaman_kerja`
--
ALTER TABLE `pengalaman_kerja`
  MODIFY `id_pengalaman` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT untuk tabel `prestasi_calon`
--
ALTER TABLE `prestasi_calon`
  MODIFY `id_prestasi` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `data_calon`
--
ALTER TABLE `data_calon`
  ADD CONSTRAINT `username` FOREIGN KEY (`username`) REFERENCES `user` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `organisasi_calon`
--
ALTER TABLE `organisasi_calon`
  ADD CONSTRAINT `organisasi_calon_ibfk_1` FOREIGN KEY (`id_calon`) REFERENCES `data_calon` (`id_calon`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengalaman_kerja`
--
ALTER TABLE `pengalaman_kerja`
  ADD CONSTRAINT `pengalaman_kerja_ibfk_1` FOREIGN KEY (`id_calon`) REFERENCES `data_calon` (`id_calon`);

--
-- Ketidakleluasaan untuk tabel `prestasi_calon`
--
ALTER TABLE `prestasi_calon`
  ADD CONSTRAINT `prestasi_calon_ibfk_1` FOREIGN KEY (`id_calon`) REFERENCES `data_calon` (`id_calon`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
