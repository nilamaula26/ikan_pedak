-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 25 Agu 2023 pada 12.45
-- Versi server: 10.4.28-MariaDB
-- Versi PHP: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dataipeda`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `desa`
--

CREATE TABLE `desa` (
  `nama_desa` text NOT NULL,
  `kelas_desa` text NOT NULL,
  `dukuh` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `sawah`
--

CREATE TABLE `sawah` (
  `no_data` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_persil` text NOT NULL,
  `luas_ha` int(11) NOT NULL,
  `luas_da` int(11) NOT NULL,
  `ipeda_r` text NOT NULL,
  `ipeda_s` text NOT NULL,
  `sebab_perubahan` text NOT NULL,
  `tgl_perubahan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `tanah_kering`
--

CREATE TABLE `tanah_kering` (
  `no_data` int(11) NOT NULL,
  `nama` varchar(100) NOT NULL,
  `no_persil` text NOT NULL,
  `luas_ha` int(11) NOT NULL,
  `luas_ra` int(11) NOT NULL,
  `ipeda_r` text NOT NULL,
  `ipeda_s` text NOT NULL,
  `sebab_perubahan` text NOT NULL,
  `tgl_perubahan` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Struktur dari tabel `wajibipeda`
--

CREATE TABLE `wajibipeda` (
  `no_data` int(11) NOT NULL,
  `tmpt_tinggal` varchar(100) DEFAULT NULL,
  `nama` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `desa`
--
ALTER TABLE `desa`
  ADD KEY `dukuh` (`dukuh`);

--
-- Indeks untuk tabel `sawah`
--
ALTER TABLE `sawah`
  ADD KEY `no_data` (`no_data`),
  ADD KEY `nama` (`nama`);

--
-- Indeks untuk tabel `tanah_kering`
--
ALTER TABLE `tanah_kering`
  ADD KEY `no_data` (`no_data`),
  ADD KEY `nama` (`nama`);

--
-- Indeks untuk tabel `wajibipeda`
--
ALTER TABLE `wajibipeda`
  ADD PRIMARY KEY (`no_data`),
  ADD KEY `nama` (`nama`),
  ADD KEY `tmpt_tinggal` (`tmpt_tinggal`);

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `sawah`
--
ALTER TABLE `sawah`
  ADD CONSTRAINT `sawah_ibfk_1` FOREIGN KEY (`no_data`) REFERENCES `wajibipeda` (`no_data`),
  ADD CONSTRAINT `sawah_ibfk_2` FOREIGN KEY (`nama`) REFERENCES `wajibipeda` (`nama`);

--
-- Ketidakleluasaan untuk tabel `tanah_kering`
--
ALTER TABLE `tanah_kering`
  ADD CONSTRAINT `tanah_kering_ibfk_1` FOREIGN KEY (`no_data`) REFERENCES `wajibipeda` (`no_data`),
  ADD CONSTRAINT `tanah_kering_ibfk_2` FOREIGN KEY (`nama`) REFERENCES `wajibipeda` (`nama`);

--
-- Ketidakleluasaan untuk tabel `wajibipeda`
--
ALTER TABLE `wajibipeda`
  ADD CONSTRAINT `wajibipeda_ibfk_1` FOREIGN KEY (`tmpt_tinggal`) REFERENCES `desa` (`dukuh`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
