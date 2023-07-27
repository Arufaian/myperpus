-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 27 Jul 2023 pada 18.02
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
-- Database: `mypus`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `admins`
--

CREATE TABLE `admins` (
  `id` int(10) NOT NULL,
  `id_admin` varchar(30) NOT NULL,
  `nama_admin` varchar(30) NOT NULL,
  `email_admin` varchar(40) NOT NULL,
  `pw_admin` varchar(100) NOT NULL,
  `foto` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `admins`
--

INSERT INTO `admins` (`id`, `id_admin`, `nama_admin`, `email_admin`, `pw_admin`, `foto`) VALUES
(6, 'ADM0002', 'admin ganteng', 'alfianilyasya13@gmail.com', '123', '64bfcc8027f12.png');

-- --------------------------------------------------------

--
-- Struktur dari tabel `anggota`
--

CREATE TABLE `anggota` (
  `id` int(10) NOT NULL,
  `id_anggota` varchar(30) NOT NULL,
  `nama` varchar(30) NOT NULL,
  `jk` varchar(10) NOT NULL,
  `foto` varchar(255) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `anggota`
--

INSERT INTO `anggota` (`id`, `id_anggota`, `nama`, `jk`, `foto`, `alamat`, `email`, `password`) VALUES
(3, 'AG00001', 'alfian', ' pria', '64bfcc42cc0f0.png', 'dumpit', 'alfianilyasya13@gmail.com', '123'),
(8, 'AG00003', 'asep surasep', ' pria', '64c0a839bc91a.png', 'jalan kecipir raya', 'asep12@gmail.com', '123'),
(10, 'AG00004', 'tolo', ' pria', '64c1d94f57769.png', 'mars', 'tolo@gmail.com', '123'),
(11, 'AG00005', 'test', ' pria', '64c26b20101c7.png', 'bumi', 'alfianilyasy@gmail.com', '123');

-- --------------------------------------------------------

--
-- Struktur dari tabel `buku`
--

CREATE TABLE `buku` (
  `id` int(16) NOT NULL,
  `id_buku` varchar(64) NOT NULL,
  `judul` varchar(64) NOT NULL,
  `foto` varchar(100) NOT NULL,
  `nama_penulis` varchar(64) NOT NULL,
  `status` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `buku`
--

INSERT INTO `buku` (`id`, `id_buku`, `judul`, `foto`, `nama_penulis`, `status`) VALUES
(15, 'BK00001', 'bumi manusia', '64bfcc68195ad.png', 'Pramoedya Ananta Toer', 'dipinjam'),
(17, 'BK00002', 'Ayat-ayat cinta', '64c07775ce75f.png', 'Habiburrahman El Shirazy', 'tersedia');

-- --------------------------------------------------------

--
-- Struktur dari tabel `pinjam`
--

CREATE TABLE `pinjam` (
  `id` int(10) NOT NULL,
  `id_peminjam` varchar(30) NOT NULL,
  `id_buku` varchar(30) NOT NULL,
  `nama_peminjam` varchar(30) NOT NULL,
  `tp` date NOT NULL,
  `tk` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data untuk tabel `pinjam`
--

INSERT INTO `pinjam` (`id`, `id_peminjam`, `id_buku`, `nama_peminjam`, `tp`, `tk`) VALUES
(4, 'AG00003', 'BK00001', ' asep surasep', '2023-07-27', '0000-00-00');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `admins`
--
ALTER TABLE `admins`
  ADD PRIMARY KEY (`id`,`id_admin`);

--
-- Indeks untuk tabel `anggota`
--
ALTER TABLE `anggota`
  ADD PRIMARY KEY (`id`,`id_anggota`);

--
-- Indeks untuk tabel `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`,`id_buku`);

--
-- Indeks untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `admins`
--
ALTER TABLE `admins`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `anggota`
--
ALTER TABLE `anggota`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT untuk tabel `pinjam`
--
ALTER TABLE `pinjam`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
