-- phpMyAdmin SQL Dump
-- version 4.4.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 18 Des 2018 pada 08.01
-- Versi Server: 5.6.26
-- PHP Version: 5.6.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `trust_medis`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `dokter`
--

CREATE TABLE IF NOT EXISTS `dokter` (
  `id` int(11) NOT NULL,
  `dokternama` varchar(50) NOT NULL,
  `id_poli` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `dokter`
--

INSERT INTO `dokter` (`id`, `dokternama`, `id_poli`) VALUES
(1, 'DOKTER UMUM', 1),
(2, 'DOKTER GIGI', 2),
(3, 'DOKTER ANAK', 3);

-- --------------------------------------------------------

--
-- Struktur dari tabel `kelas`
--

CREATE TABLE IF NOT EXISTS `kelas` (
  `id` int(11) NOT NULL,
  `kelas` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `kelas`
--

INSERT INTO `kelas` (`id`, `kelas`) VALUES
(1, 'Kelas 1'),
(2, 'Kelas 2'),
(3, 'Kelas 3');

-- --------------------------------------------------------

--
-- Struktur dari tabel `kondisi_pasien`
--

CREATE TABLE IF NOT EXISTS `kondisi_pasien` (
  `id_rawat` int(11) NOT NULL,
  `tinggi` int(11) NOT NULL,
  `berat` int(11) NOT NULL,
  `detak_jantung` int(11) NOT NULL,
  `tekanan_darah` varchar(20) NOT NULL,
  `suhu_tubuh` int(11) NOT NULL,
  `kondisi_masuk` int(11) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `keluhan` int(11) NOT NULL,
  `konsul_unit_lain` char(6) NOT NULL,
  `kegiatan` enum('Bedah','Suntik','Chekup') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `pasien`
--

CREATE TABLE IF NOT EXISTS `pasien` (
  `no_rm` varchar(11) NOT NULL,
  `idjenis` enum('KTP','SIM') NOT NULL,
  `nik` varchar(20) NOT NULL,
  `nama_pasien` varchar(50) NOT NULL,
  `tgl_lahir` date NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `tempat_lahir` text NOT NULL,
  `jenis_kelamin` varchar(20) NOT NULL,
  `domisili` varchar(10) NOT NULL,
  `alamat` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `pasien`
--

INSERT INTO `pasien` (`no_rm`, `idjenis`, `nik`, `nama_pasien`, `tgl_lahir`, `tgl_masuk`, `tempat_lahir`, `jenis_kelamin`, `domisili`, `alamat`) VALUES
('0000002', 'SIM', '3571929371231111', 'Abdul Jabbarru', '1996-01-13', '2018-12-17 19:33:37', 'Kediri', 'Laki - laki', 'Kediri', 'Lor Kidul1'),
('0000003', 'KTP', '3571929371231112', 'Abdul Jabbarru', '2018-12-18', '2018-12-17 19:40:26', 'Kediri', 'Laki - laki', 'Kediri', 'Cendana'),
('0000004', 'KTP', '3571929371231115', 'Fitriani', '2018-12-10', '2018-12-17 19:42:43', 'Blitar', 'Laki - laki', 'Blitar', 'Sawanwetan'),
('0000005', 'KTP', '3571929371231113', 'Fitriana', '2018-12-14', '2018-12-17 19:44:59', 'Blitar', 'Laki - laki', 'Blitar', 'Sawanetan'),
('0000006', 'KTP', '3571929371231119', 'Nuraini', '2018-12-01', '2018-12-17 19:45:34', 'Malang', 'Laki - laki', 'Blitar', 'Pemenang1');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pembayaran_rawat_jalan`
--

CREATE TABLE IF NOT EXISTS `pembayaran_rawat_jalan` (
  `no_dftr` int(11) NOT NULL,
  `tagihan` int(11) NOT NULL,
  `bayar` int(11) NOT NULL,
  `tgl_tagihan` date NOT NULL,
  `tgl_bayar` date NOT NULL,
  `sisa` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `poli`
--

CREATE TABLE IF NOT EXISTS `poli` (
  `id` int(11) NOT NULL,
  `poli` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `poli`
--

INSERT INTO `poli` (`id`, `poli`) VALUES
(1, 'umum'),
(2, 'gigi'),
(3, 'anak');

-- --------------------------------------------------------

--
-- Struktur dari tabel `rawat_jalan`
--

CREATE TABLE IF NOT EXISTS `rawat_jalan` (
  `id` int(11) NOT NULL,
  `no_dftr` int(11) NOT NULL,
  `no_rm` varchar(11) NOT NULL,
  `id_jenis_bayar` enum('BPJS','UMUM') NOT NULL,
  `no_asuransi` varchar(30) NOT NULL,
  `id_penanggung` enum('Sendiri','Pemerintah') NOT NULL,
  `id_kelas` int(11) NOT NULL,
  `id_poli` int(11) NOT NULL,
  `id_dokter` int(11) NOT NULL,
  `id_masuk` int(11) NOT NULL,
  `tgl_masuk` datetime NOT NULL,
  `tgl_keluar` datetime NOT NULL,
  `status` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `rawat_jalan`
--

INSERT INTO `rawat_jalan` (`id`, `no_dftr`, `no_rm`, `id_jenis_bayar`, `no_asuransi`, `id_penanggung`, `id_kelas`, `id_poli`, `id_dokter`, `id_masuk`, `tgl_masuk`, `tgl_keluar`, `status`) VALUES
(1, 1545115478, '0000002', 'BPJS', '12345678', 'Sendiri', 1, 1, 1, 0, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '');

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(20) NOT NULL,
  `password` text NOT NULL,
  `status` varchar(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`id`, `nama`, `password`, `status`) VALUES
(1, 'master', 'a9c8dcf6a784cb0d0672f8bcd3190b9c', 'master'),
(2, 'gigi', 'a9c8dcf6a784cb0d0672f8bcd3190b9c', 'gigi'),
(3, 'umum', 'a9c8dcf6a784cb0d0672f8bcd3190b9c', 'umum'),
(4, 'anak', 'a9c8dcf6a784cb0d0672f8bcd3190b9c', 'anak'),
(5, 'loket', 'a9c8dcf6a784cb0d0672f8bcd3190b9c', 'loket');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dokter`
--
ALTER TABLE `dokter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kelas`
--
ALTER TABLE `kelas`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pasien`
--
ALTER TABLE `pasien`
  ADD PRIMARY KEY (`no_rm`);

--
-- Indexes for table `poli`
--
ALTER TABLE `poli`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rawat_jalan`
--
ALTER TABLE `rawat_jalan`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dokter`
--
ALTER TABLE `dokter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `kelas`
--
ALTER TABLE `kelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `poli`
--
ALTER TABLE `poli`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `rawat_jalan`
--
ALTER TABLE `rawat_jalan`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=6;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
