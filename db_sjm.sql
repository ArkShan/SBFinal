-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 11 Bulan Mei 2023 pada 16.44
-- Versi server: 10.4.22-MariaDB
-- Versi PHP: 8.0.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_sjm`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `b_keluar`
--

CREATE TABLE `b_keluar` (
  `id_bk` int(11) NOT NULL,
  `id_b` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qtyk` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `b_keluar`
--

INSERT INTO `b_keluar` (`id_bk`, `id_b`, `id_toko`, `tanggal`, `qtyk`) VALUES
(2, 4, 1, '2023-03-01 07:47:48', 0),
(8, 2, 1, '2023-03-01 07:46:22', 10),
(9, 3, 1, '2023-03-01 07:43:14', 50),
(20, 0, 1, '2023-03-20 08:18:40', 10000),
(21, 20, 1, '2023-03-20 08:20:35', 4000),
(22, 22, 1, '2023-03-30 10:26:02', 1000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `b_masuk`
--

CREATE TABLE `b_masuk` (
  `id_bm` int(11) NOT NULL,
  `id_b` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qtym` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `b_masuk`
--

INSERT INTO `b_masuk` (`id_bm`, `id_b`, `id_p`, `tanggal`, `qtym`) VALUES
(7, 3, 1, '2023-04-09 13:49:09', 1000),
(19, 23, 1, '2023-05-10 08:03:07', 10000),
(20, 23, 1, '2023-05-10 08:04:40', 1100),
(21, 23, 1, '2023-05-10 08:07:34', 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderan`
--

CREATE TABLE `orderan` (
  `id_o` int(11) NOT NULL,
  `id_b` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `no_order` varchar(100) NOT NULL,
  `qtyp` int(100) NOT NULL,
  `tgl_order` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `kirim` int(11) NOT NULL DEFAULT 0,
  `bayar` int(11) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orderan`
--

INSERT INTO `orderan` (`id_o`, `id_b`, `id_toko`, `no_order`, `qtyp`, `tgl_order`, `kirim`, `bayar`) VALUES
(1, 5, 1, 'AK0001', 50, '2023-05-10 06:58:04', 2, 0),
(2, 12, 2, 'PC0001', 100, '2023-05-10 06:58:16', 2, 0),
(4, 16, 3, 'YT0001', 50, '2023-05-10 06:58:41', 0, 0),
(5, 0, 0, 'YT0002', 50, '2023-03-16 08:22:27', 0, 0),
(6, 0, 0, '', 0, '2023-03-16 08:34:14', 0, 0),
(7, 0, 0, '', 0, '2023-03-16 08:34:14', 0, 0),
(8, 0, 0, 'PC004', 50, '2023-03-16 08:36:36', 0, 0),
(9, 0, 0, '', 0, '2023-03-16 08:36:36', 0, 0),
(10, 0, 0, '', 0, '2023-03-16 08:36:36', 0, 0),
(11, 0, 0, 'PC005', 50, '2023-03-16 09:03:42', 0, 0),
(12, 0, 0, '', 0, '2023-03-16 09:03:42', 0, 0),
(13, 0, 0, '', 0, '2023-03-16 09:03:42', 0, 0),
(14, 21, 3, 'YT0001', 50, '2023-03-16 08:27:49', 0, 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_o`
--

CREATE TABLE `retur_o` (
  `id_ro` int(11) NOT NULL,
  `id_b` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qtyro` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `retur_o`
--

INSERT INTO `retur_o` (`id_ro`, `id_b`, `id_toko`, `tanggal`, `qtyro`) VALUES
(1, 4, 2, '2023-04-11 07:17:08', 5000),
(2, 4, 1, '2023-04-11 07:19:26', 1),
(3, 4, 1, '2023-04-11 07:18:20', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `retur_p`
--

CREATE TABLE `retur_p` (
  `id_rp` int(11) NOT NULL,
  `id_b` int(11) NOT NULL,
  `id_p` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qtyrp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `retur_p`
--

INSERT INTO `retur_p` (`id_rp`, `id_b`, `id_p`, `tanggal`, `qtyrp`) VALUES
(2, 3, 1, '2023-04-11 06:27:57', 1000),
(4, 1, 1, '2023-04-11 07:00:21', 2000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_b` int(11) NOT NULL,
  `kode_b` varchar(100) NOT NULL,
  `nama_b` varchar(500) NOT NULL,
  `tipe_mobil` varchar(100) NOT NULL,
  `kategori` varchar(100) NOT NULL,
  `harga` int(100) NOT NULL,
  `pcs_dus` int(11) NOT NULL,
  `harga_p` varchar(100) NOT NULL,
  `qty` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_barang`
--

INSERT INTO `tb_barang` (`id_b`, `kode_b`, `nama_b`, `tipe_mobil`, `kategori`, `harga`, `pcs_dus`, `harga_p`, `qty`) VALUES
(1, '10A', 'Fuses DX', 'Universal', 'Brand Fuses DX', 260, 10000, '-', 600000),
(2, '15A', 'Fuses DX', 'Universal', 'Brand Fuses DX', 260, 10000, '-', 500000),
(3, '20A', 'Fuses DX', 'Universal', 'Brand Fuses DX', 260, 10000, '-', 495000),
(4, '25A', 'Fuses DX', 'Universal', 'Brand Fuses DX', 260, 10000, '-', 500000),
(5, '30A', 'Fuses DX', 'Universal', 'Brand Fuses DX', 260, 10000, '-', 500000),
(6, '10A', 'Fuses DX (Ceramic)', 'Universal', 'Brand Fuses DX Ceramic', 500, 10000, '-', 490000),
(7, '15A', 'Fuses DX (Ceramic)', 'Universal', 'Brand Fuses DX Ceramic', 500, 10000, '-', 450000),
(8, '20A', 'Fuses DX (Ceramic)', 'Universal', 'Brand Fuses DX Ceramic', 500, 10000, '-', 475000),
(9, '25A', 'Fuses DX (Ceramic)', 'Universal', 'Brand Fuses DX Ceramic', 500, 10000, '-', 500000),
(10, '30A', 'Fuses DX (Ceramic)', 'Universal', 'Brand Fuses DX Ceramic', 500, 10000, '-', 570000),
(11, '7,5A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(12, '10A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(13, '15A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(17, '20A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(18, '25A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(19, '30A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(20, 'MB-097585', 'Bracket Stay (LH)', 'PS-100', 'Brand Bracker Stay (Kaca Spion) (Dus Polos)', 30000, 150, '-', 35000),
(21, '18590-79F00', 'Sensor Map', 'APV/Futura Injection', 'Brand Sensor MAD (Mitomo)', 110000, 250, '-', 60000),
(22, '34910-77310', 'Cable Speedometer', 'Extra', 'Brand Cable Speedometer NSM', 50000, 50, '-', 600000),
(23, '53630-87603', 'Cable Cap Mesin', 'F-70 / 5K', 'Brand Cable Cap Mesin (NSM)', 25000, 50, '-', 140000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_pabrik`
--

CREATE TABLE `tb_pabrik` (
  `id_p` int(11) NOT NULL,
  `nama_p` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_pabrik`
--

INSERT INTO `tb_pabrik` (`id_p`, `nama_p`) VALUES
(1, 'QUANZHOU NEW RONGSHUN MACHINERY DEVELOPMENT CO.,LTD.'),
(2, 'HAOMING AUTO PARTS MANUFACTURE CO.,LTD'),
(3, 'TAIZHOU WONDERFUL MACHINERY CO.,LTD.'),
(5, 'HONGXING AUTOMOBILE FITTINGS CO.,LTD.'),
(6, 'QUANZHOU XINGXING MACHINERY ACCESSORIES CO.,LTD'),
(7, 'FUJIAN GUANWEI AUTO PARTS CO.,LTD.'),
(8, 'NANAN RUICHENG TRANSPORTATION MACHINERY CO.,LTD');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_register`
--

CREATE TABLE `tb_register` (
  `id_user` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `namadepan` varchar(100) NOT NULL,
  `namabelakang` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_register`
--

INSERT INTO `tb_register` (`id_user`, `email`, `namadepan`, `namabelakang`, `password`, `role`) VALUES
(1, 'malvin@gmail.com', 'Malvin', 'Adrianus', '123', 'Owner'),
(2, 'ken@gmail.com', 'Ken', 'Adrianus', '123', 'Sales'),
(3, 'kira@gmail.com', 'Kira', 'Yamato', '123', 'Gudang'),
(4, 'udin@gmail.com', 'Udin', 'Jamaludin', '123', 'Admin');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id_toko` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `cs_toko` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL,
  `wilayah` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `nama_toko`, `cs_toko`, `no_telp`, `alamat`, `wilayah`) VALUES
(1, 'Sinar Mulia', 'ABC', '08126034186', 'Jl. Batu Bara No. 60', 'Medan'),
(3, 'XYZ', 'FGH', '02587456', 'Jl. amn', ''),
(4, 'YJM Motor', 'Yendi', '081299282839', 'Mega Glodok Kemayoran Lt. GF Blok D07 No. 3', 'Jakarta'),
(5, 'Daihatsu Baru', 'FGH', '(061) 4518716', 'Jl. Semarang No. 48', ''),
(6, 'XYZ', 'FGH', '02587456', 'Jl. amn', ''),
(7, 'XYZ', 'FGH', '02587456', 'Jl. amn', ''),
(8, 'XYZ', 'FGH', '02587456', 'Jl. amn', ''),
(9, 'XYZ', 'FGH', '02587456', 'Jl. amn', ''),
(10, 'XYZ', 'FGH', '02587456', 'Jl. amn', '');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `b_keluar`
--
ALTER TABLE `b_keluar`
  ADD PRIMARY KEY (`id_bk`),
  ADD KEY `id_toko` (`id_toko`),
  ADD KEY `id_b` (`id_b`);

--
-- Indeks untuk tabel `b_masuk`
--
ALTER TABLE `b_masuk`
  ADD PRIMARY KEY (`id_bm`),
  ADD KEY `id_b` (`id_b`),
  ADD KEY `id_p` (`id_p`);

--
-- Indeks untuk tabel `orderan`
--
ALTER TABLE `orderan`
  ADD PRIMARY KEY (`id_o`),
  ADD KEY `id_b` (`id_b`);

--
-- Indeks untuk tabel `retur_o`
--
ALTER TABLE `retur_o`
  ADD PRIMARY KEY (`id_ro`),
  ADD KEY `id_b` (`id_b`),
  ADD KEY `id_toko` (`id_toko`);

--
-- Indeks untuk tabel `retur_p`
--
ALTER TABLE `retur_p`
  ADD PRIMARY KEY (`id_rp`),
  ADD KEY `id_pab` (`id_p`),
  ADD KEY `id_bar` (`id_b`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_b`);

--
-- Indeks untuk tabel `tb_pabrik`
--
ALTER TABLE `tb_pabrik`
  ADD PRIMARY KEY (`id_p`);

--
-- Indeks untuk tabel `tb_register`
--
ALTER TABLE `tb_register`
  ADD PRIMARY KEY (`id_user`);

--
-- Indeks untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  ADD PRIMARY KEY (`id_toko`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `b_keluar`
--
ALTER TABLE `b_keluar`
  MODIFY `id_bk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT untuk tabel `b_masuk`
--
ALTER TABLE `b_masuk`
  MODIFY `id_bm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT untuk tabel `orderan`
--
ALTER TABLE `orderan`
  MODIFY `id_o` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT untuk tabel `retur_o`
--
ALTER TABLE `retur_o`
  MODIFY `id_ro` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `retur_p`
--
ALTER TABLE `retur_p`
  MODIFY `id_rp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_b` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT untuk tabel `tb_pabrik`
--
ALTER TABLE `tb_pabrik`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `tb_register`
--
ALTER TABLE `tb_register`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `b_keluar`
--
ALTER TABLE `b_keluar`
  ADD CONSTRAINT `id_toko` FOREIGN KEY (`id_toko`) REFERENCES `tb_toko` (`id_toko`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `b_masuk`
--
ALTER TABLE `b_masuk`
  ADD CONSTRAINT `b_masuk_ibfk_1` FOREIGN KEY (`id_b`) REFERENCES `tb_barang` (`id_b`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `retur_p`
--
ALTER TABLE `retur_p`
  ADD CONSTRAINT `id_bar` FOREIGN KEY (`id_b`) REFERENCES `tb_barang` (`id_b`),
  ADD CONSTRAINT `id_pab` FOREIGN KEY (`id_p`) REFERENCES `tb_pabrik` (`id_p`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
