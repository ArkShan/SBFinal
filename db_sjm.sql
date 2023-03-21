-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 21 Mar 2023 pada 07.24
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
(21, 20, 1, '2023-03-20 08:20:35', 4000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `b_masuk`
--

CREATE TABLE `b_masuk` (
  `id_bm` int(11) NOT NULL,
  `id_b` int(100) NOT NULL,
  `id_p` int(11) NOT NULL,
  `tanggal` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `qtym` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `b_masuk`
--

INSERT INTO `b_masuk` (`id_bm`, `id_b`, `id_p`, `tanggal`, `qtym`) VALUES
(4, 8, 2, '2023-03-01 08:42:25', 100),
(5, 20, 2, '2023-03-20 07:59:48', 4000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `orderan`
--

CREATE TABLE `orderan` (
  `id_o` int(11) NOT NULL,
  `id_b` int(11) NOT NULL,
  `id_w` int(11) NOT NULL,
  `id_toko` int(11) NOT NULL,
  `no_order` varchar(100) NOT NULL,
  `qtyp` int(100) NOT NULL,
  `tgl_order` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `orderan`
--

INSERT INTO `orderan` (`id_o`, `id_b`, `id_w`, `id_toko`, `no_order`, `qtyp`, `tgl_order`) VALUES
(1, 2, 1, 1, 'AK0001', 50, '2023-03-02 08:37:53'),
(2, 5, 1, 2, 'PC0001', 100, '2023-03-03 08:04:26'),
(4, 13, 2, 3, 'YT0001', 50, '2023-03-16 08:27:49'),
(5, 0, 0, 0, 'YT0002', 50, '2023-03-16 08:22:27'),
(6, 0, 0, 0, '', 0, '2023-03-16 08:34:14'),
(7, 0, 0, 0, '', 0, '2023-03-16 08:34:14'),
(8, 0, 0, 0, 'PC004', 50, '2023-03-16 08:36:36'),
(9, 0, 0, 0, '', 0, '2023-03-16 08:36:36'),
(10, 0, 0, 0, '', 0, '2023-03-16 08:36:36'),
(11, 0, 0, 0, 'PC005', 50, '2023-03-16 09:03:42'),
(12, 0, 0, 0, '', 0, '2023-03-16 09:03:42'),
(13, 0, 0, 0, '', 0, '2023-03-16 09:03:42');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_barang`
--

CREATE TABLE `tb_barang` (
  `id_b` int(100) NOT NULL,
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
(1, '10A', 'Fuses DX', 'Universal', 'Brand Fuses DX', 260, 10000, '-', 500000),
(2, '15A', 'Fuses DX', 'Universal', 'Brand Fuses DX', 260, 10000, '-', 500000),
(3, '20A', 'Fuses DX', 'Universal', 'Brand Fuses DX', 260, 10000, '-', 500000),
(4, '25A', 'Fuses DX', 'Universal', 'Brand Fuses DX', 260, 10000, '-', 500000),
(5, '30A', 'Fuses DX', 'Universal', 'Brand Fuses DX', 260, 10000, '-', 500000),
(6, '10A', 'Fuses DX (Ceramic)', 'Universal', 'Brand Fuses DX Ceramic', 500, 10000, '-', 500000),
(7, '15A', 'Fuses DX (Ceramic)', 'Universal', 'Brand Fuses DX Ceramic', 500, 10000, '-', 450000),
(8, '20A', 'Fuses DX (Ceramic)', 'Universal', 'Brand Fuses DX Ceramic', 500, 10000, '-', 475000),
(9, '25A', 'Fuses DX (Ceramic)', 'Universal', 'Brand Fuses DX Ceramic', 500, 10000, '-', 500000),
(10, '30A', 'Fuses DX (Ceramic)', 'Universal', 'Brand Fuses DX Ceramic', 500, 10000, '-', 540000),
(11, '7,5A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(12, '10A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(13, '15A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(17, '20A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(18, '25A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(19, '30A', 'Fuses DX (Mini)', 'Universal', 'Brand Fuses DX Mini', 270, 20000, '-', 600000),
(20, 'MB-097585', 'Bracket Stay (LH)', 'PS-100', 'Brand Bracker Stay (Kaca Spion) (Dus Polos)', 30000, 150, '-', 15000);

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_kategori`
--

CREATE TABLE `tb_kategori` (
  `id_kat` int(11) NOT NULL,
  `kategori` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_kategori`
--

INSERT INTO `tb_kategori` (`id_kat`, `kategori`) VALUES
(1, 'Accelerator Cable'),
(2, 'Air Dryer'),
(3, 'Air Hose'),
(4, 'As Drive Shaft'),
(5, 'As Balak'),
(6, 'As Roda'),
(7, 'Alternator Brush'),
(8, 'Brake Pipe'),
(9, 'Brake Pipe Meteran'),
(10, 'Bolt Solar'),
(11, 'Back Up Horn');

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
(1, 'Pabrik A'),
(2, 'Pabrik B');

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
(3, 'kira@gmail.com', 'Kira', 'Yamato', '123', 'Gudang');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_toko`
--

CREATE TABLE `tb_toko` (
  `id_toko` int(11) NOT NULL,
  `id_w` int(11) NOT NULL,
  `nama_toko` varchar(100) NOT NULL,
  `cs_toko` varchar(100) NOT NULL,
  `no_telp` varchar(100) NOT NULL,
  `alamat` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_toko`
--

INSERT INTO `tb_toko` (`id_toko`, `id_w`, `nama_toko`, `cs_toko`, `no_telp`, `alamat`) VALUES
(1, 1, 'Sinar Mulia', ' ABC', '02587456', 'Jl. amn'),
(2, 4, 'abc', 'FGH', '02587456', 'Jl. amn'),
(3, 3, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(4, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(5, 1, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(6, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(7, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(8, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(9, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(10, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(11, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(12, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(13, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(14, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(15, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(16, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(17, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(18, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(19, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(20, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(21, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(22, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(23, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn'),
(24, 2, 'XYZ', 'FGH', '02587456', 'Jl. amn');

-- --------------------------------------------------------

--
-- Struktur dari tabel `tb_wilayah`
--

CREATE TABLE `tb_wilayah` (
  `id_w` int(11) NOT NULL,
  `wilayah` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data untuk tabel `tb_wilayah`
--

INSERT INTO `tb_wilayah` (`id_w`, `wilayah`) VALUES
(1, 'Medan'),
(2, 'Pontianak'),
(3, 'Semarang'),
(4, 'Surabaya');

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `b_keluar`
--
ALTER TABLE `b_keluar`
  ADD PRIMARY KEY (`id_bk`);

--
-- Indeks untuk tabel `b_masuk`
--
ALTER TABLE `b_masuk`
  ADD PRIMARY KEY (`id_bm`);

--
-- Indeks untuk tabel `orderan`
--
ALTER TABLE `orderan`
  ADD PRIMARY KEY (`id_o`);

--
-- Indeks untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  ADD PRIMARY KEY (`id_b`);

--
-- Indeks untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  ADD PRIMARY KEY (`id_kat`);

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
-- Indeks untuk tabel `tb_wilayah`
--
ALTER TABLE `tb_wilayah`
  ADD PRIMARY KEY (`id_w`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `b_keluar`
--
ALTER TABLE `b_keluar`
  MODIFY `id_bk` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT untuk tabel `b_masuk`
--
ALTER TABLE `b_masuk`
  MODIFY `id_bm` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT untuk tabel `orderan`
--
ALTER TABLE `orderan`
  MODIFY `id_o` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT untuk tabel `tb_barang`
--
ALTER TABLE `tb_barang`
  MODIFY `id_b` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT untuk tabel `tb_kategori`
--
ALTER TABLE `tb_kategori`
  MODIFY `id_kat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT untuk tabel `tb_pabrik`
--
ALTER TABLE `tb_pabrik`
  MODIFY `id_p` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT untuk tabel `tb_register`
--
ALTER TABLE `tb_register`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `tb_toko`
--
ALTER TABLE `tb_toko`
  MODIFY `id_toko` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT untuk tabel `tb_wilayah`
--
ALTER TABLE `tb_wilayah`
  MODIFY `id_w` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
