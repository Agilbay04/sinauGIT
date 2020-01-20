-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Waktu pembuatan: 10 Des 2019 pada 11.19
-- Versi server: 10.4.6-MariaDB
-- Versi PHP: 7.3.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `new1`
--

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_pengadaan`
--

CREATE TABLE `detail_pengadaan` (
  `ID_DETAIL_PENGADAAN` int(11) NOT NULL,
  `ID_PENGADAAN_BARANG` int(11) NOT NULL,
  `ID_DET_LAPTOP` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `detail_transaksi`
--

CREATE TABLE `detail_transaksi` (
  `ID_DETAIL_TRANSAKSI` int(11) NOT NULL,
  `ID_TRANSAKSI` int(11) NOT NULL,
  `ID_DET_LAPTOP` int(11) NOT NULL,
  `JUMLAH_BELI` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Trigger `detail_transaksi`
--
DELIMITER $$
CREATE TRIGGER `ubah_stok_detail` AFTER INSERT ON `detail_transaksi` FOR EACH ROW update det_laptop set stok_detail = stok_detail - new.jumlah_beli
where id_det_laptop = new.id_det_laptop
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `det_laptop`
--

CREATE TABLE `det_laptop` (
  `ID_DET_LAPTOP` int(11) NOT NULL,
  `ID_LAPTOP` int(11) NOT NULL,
  `HARGA_BELI` int(11) DEFAULT NULL,
  `HARGA_JUAL` int(11) DEFAULT NULL,
  `stok_detail` int(11) NOT NULL,
  `STATUS_GARANSI` int(11) DEFAULT NULL,
  `LAMA_GARANSI` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `det_laptop`
--

INSERT INTO `det_laptop` (`ID_DET_LAPTOP`, `ID_LAPTOP`, `HARGA_BELI`, `HARGA_JUAL`, `stok_detail`, `STATUS_GARANSI`, `LAMA_GARANSI`) VALUES
(1, 5, 2500000, 3000000, 3, 0, NULL),
(2, 5, 3000000, 4000000, 2, 1, '1 Tahun');

--
-- Trigger `det_laptop`
--
DELIMITER $$
CREATE TRIGGER `tambah_stok_laptop` AFTER INSERT ON `det_laptop` FOR EACH ROW update laptop set stok = stok + new.stok_detail
where id_laptop = new.id_laptop
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `ubah_stok_laptop` AFTER UPDATE ON `det_laptop` FOR EACH ROW update laptop set stok = stok - (old.stok_detail - new.stok_detail)
where id_laptop = new.id_laptop
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Struktur dari tabel `laptop`
--

CREATE TABLE `laptop` (
  `ID_LAPTOP` int(11) NOT NULL,
  `GAMBAR_LAPTOP` varchar(30) DEFAULT NULL,
  `NAMA_LAPTOP` varchar(45) DEFAULT NULL,
  `PROCESSOR` varchar(25) DEFAULT NULL,
  `RAM` varchar(20) DEFAULT NULL,
  `HARDDISK` varchar(20) DEFAULT NULL,
  `VGA` varchar(20) DEFAULT NULL,
  `UKURAN_LAYAR` varchar(20) DEFAULT NULL,
  `SOUND_CARD` varchar(20) DEFAULT NULL,
  `STOK` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `laptop`
--

INSERT INTO `laptop` (`ID_LAPTOP`, `GAMBAR_LAPTOP`, `NAMA_LAPTOP`, `PROCESSOR`, `RAM`, `HARDDISK`, `VGA`, `UKURAN_LAYAR`, `SOUND_CARD`, `STOK`) VALUES
(5, NULL, 'DELL', 'Intel core i5', '8gb', '256 GB SSD', 'Nvidia GTX', '15', 'dolby atmos', 10),
(6, '5ded161c3dd0d.jpg', 'MSI', 'Intel Core I7 ', '32GB', '512 SSD', 'Nvidia RTX 2080', '16 Inch', 'Dolby Atmos', 0),
(7, '5ded1ced53413.jpg', 'PREDATOR', 'Intel Core I9', '64GB', '2TB SSD', 'Nvidia RTX 2080', '17 Inch', 'Dolby Atmos', 0),
(8, '5ded1dd36f5ec.jpg', 'ASUS VIVO BOOK', 'Intel Core I7 ', '32GB', '512 SSD', 'Nvidia RTX 2080', '16 Inch', 'Dolby Atmos', 0);

-- --------------------------------------------------------

--
-- Struktur dari tabel `pengadaan_barang`
--

CREATE TABLE `pengadaan_barang` (
  `ID_PENGADAAN_BARANG` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `TANGGAL_PENGADAAN_BARANG` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `posting`
--

CREATE TABLE `posting` (
  `ID_POSTING` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `JUDUL_POSTING` varchar(50) DEFAULT NULL,
  `FOTO_POSTING` varchar(30) NOT NULL,
  `ISI_POSTING` tinytext DEFAULT NULL,
  `TANGGAL_POSTING` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `posting`
--

INSERT INTO `posting` (`ID_POSTING`, `ID_USER`, `JUDUL_POSTING`, `FOTO_POSTING`, `ISI_POSTING`, `TANGGAL_POSTING`) VALUES
(10, 7, 'LAPTOP GAHAR  GAK BIKIN DOMPET KOAR KOAR', '5dedc5168a5d3.jpg', '.....................................................................................', '2019-12-09');

-- --------------------------------------------------------

--
-- Struktur dari tabel `reset`
--

CREATE TABLE `reset` (
  `ID_RESET` int(11) NOT NULL,
  `TOKEN_USER` varchar(255) NOT NULL,
  `EMAIL_USER` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `reset`
--

INSERT INTO `reset` (`ID_RESET`, `TOKEN_USER`, `EMAIL_USER`) VALUES
(1, '15def69dcded69', 'kurak4647@gmail.com');

-- --------------------------------------------------------

--
-- Struktur dari tabel `transaksi`
--

CREATE TABLE `transaksi` (
  `ID_TRANSAKSI` int(11) NOT NULL,
  `ID_USER` int(11) NOT NULL,
  `TANGGAL_TRANSAKSI` date DEFAULT NULL,
  `STATUS_TRANSAKSI` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktur dari tabel `user`
--

CREATE TABLE `user` (
  `ID_USER` int(11) NOT NULL,
  `NAMA_USER` varchar(45) DEFAULT NULL,
  `JENIS_KELAMIN` enum('Laki-laki','Perempuan') NOT NULL,
  `ALAMAT_USER` varchar(50) DEFAULT NULL,
  `NO_HP_USER` varchar(13) DEFAULT NULL,
  `EMAIL_USER` varchar(30) DEFAULT NULL,
  `PASSWORD_USER` varchar(60) DEFAULT NULL,
  `FOTO_PROFIL_USER` varchar(30) DEFAULT NULL,
  `TOKEN_USER` varchar(20) DEFAULT NULL,
  `HAK_AKSES_USER` int(11) DEFAULT NULL,
  `TANGGAL_DAFTAR` date DEFAULT NULL,
  `STATUS_AKTIVASI` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data untuk tabel `user`
--

INSERT INTO `user` (`ID_USER`, `NAMA_USER`, `JENIS_KELAMIN`, `ALAMAT_USER`, `NO_HP_USER`, `EMAIL_USER`, `PASSWORD_USER`, `FOTO_PROFIL_USER`, `TOKEN_USER`, `HAK_AKSES_USER`, `TANGGAL_DAFTAR`, `STATUS_AKTIVASI`) VALUES
(2, 'Kura-kura Salto', 'Laki-laki', 'batu nisan', '081444555666', 'kurak4647@gmail.com', '$2y$10$vaYe3Bfekqsay2w2WfTApe2PhK4FUzGbQdqWeDUEFQkkLCC/pS2li', '1012201910415815279.jpg', '', 0, '2019-12-02', 0),
(3, 'Andreanto', 'Laki-laki', 'Jl. Mastrip', '085331176998', 'andreanto@gmail.com', '$2y$10$aOuCf.zpaSovMkRG9a3L/O0vWnboVMdU2Vn3J.kWDmqgrKKKPZrrO', '03122019085443cust.jpg', '', 1, '2019-12-03', 0),
(4, 'Budi Setiawan', 'Laki-laki', 'Bali', '089756334190', 'setiabudi77@gmail.com', '$2y$10$jw9qITIroGGWzylJCUvg9uQKszG9z8fMxQ6l2AKdpUl1lD9BKxYf6', '5de47a3891958.jpg', '', 2, '2019-12-02', 0),
(7, 'Paijan', 'Laki-laki', 'Surabaya', '087655644555', 'paijan@gmail.com', '$2y$10$vJFCTMWrwMbEH3aZpZzds.B39r0wYwvKOmRbxRijO3OjhNSJhpwMe', '5dedb64bad217.jpg', '', 1, '2019-12-09', 0);

--
-- Indexes for dumped tables
--

--
-- Indeks untuk tabel `detail_pengadaan`
--
ALTER TABLE `detail_pengadaan`
  ADD PRIMARY KEY (`ID_DETAIL_PENGADAAN`),
  ADD KEY `ID_PENGADAAN_BARANG` (`ID_PENGADAAN_BARANG`),
  ADD KEY `ID_DET_LAPTOP` (`ID_DET_LAPTOP`);

--
-- Indeks untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD PRIMARY KEY (`ID_DETAIL_TRANSAKSI`),
  ADD KEY `ID_TRANSAKSI` (`ID_TRANSAKSI`),
  ADD KEY `ID_DET_LAPTOP` (`ID_DET_LAPTOP`);

--
-- Indeks untuk tabel `det_laptop`
--
ALTER TABLE `det_laptop`
  ADD PRIMARY KEY (`ID_DET_LAPTOP`),
  ADD KEY `ID_LAPTOP` (`ID_LAPTOP`);

--
-- Indeks untuk tabel `laptop`
--
ALTER TABLE `laptop`
  ADD PRIMARY KEY (`ID_LAPTOP`);

--
-- Indeks untuk tabel `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  ADD PRIMARY KEY (`ID_PENGADAAN_BARANG`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indeks untuk tabel `posting`
--
ALTER TABLE `posting`
  ADD PRIMARY KEY (`ID_POSTING`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indeks untuk tabel `reset`
--
ALTER TABLE `reset`
  ADD PRIMARY KEY (`ID_RESET`);

--
-- Indeks untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD PRIMARY KEY (`ID_TRANSAKSI`),
  ADD KEY `ID_USER` (`ID_USER`);

--
-- Indeks untuk tabel `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID_USER`),
  ADD UNIQUE KEY `EMAIL_USER` (`EMAIL_USER`);

--
-- AUTO_INCREMENT untuk tabel yang dibuang
--

--
-- AUTO_INCREMENT untuk tabel `detail_pengadaan`
--
ALTER TABLE `detail_pengadaan`
  MODIFY `ID_DETAIL_PENGADAAN` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  MODIFY `ID_DETAIL_TRANSAKSI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `det_laptop`
--
ALTER TABLE `det_laptop`
  MODIFY `ID_DET_LAPTOP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT untuk tabel `laptop`
--
ALTER TABLE `laptop`
  MODIFY `ID_LAPTOP` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT untuk tabel `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  MODIFY `ID_PENGADAAN_BARANG` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `posting`
--
ALTER TABLE `posting`
  MODIFY `ID_POSTING` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT untuk tabel `reset`
--
ALTER TABLE `reset`
  MODIFY `ID_RESET` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  MODIFY `ID_TRANSAKSI` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT untuk tabel `user`
--
ALTER TABLE `user`
  MODIFY `ID_USER` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Ketidakleluasaan untuk tabel pelimpahan (Dumped Tables)
--

--
-- Ketidakleluasaan untuk tabel `detail_pengadaan`
--
ALTER TABLE `detail_pengadaan`
  ADD CONSTRAINT `detail_pengadaan_ibfk_1` FOREIGN KEY (`ID_PENGADAAN_BARANG`) REFERENCES `pengadaan_barang` (`ID_PENGADAAN_BARANG`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_pengadaan_ibfk_2` FOREIGN KEY (`ID_DET_LAPTOP`) REFERENCES `det_laptop` (`ID_DET_LAPTOP`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `detail_transaksi`
--
ALTER TABLE `detail_transaksi`
  ADD CONSTRAINT `detail_transaksi_ibfk_1` FOREIGN KEY (`ID_TRANSAKSI`) REFERENCES `transaksi` (`ID_TRANSAKSI`) ON UPDATE CASCADE,
  ADD CONSTRAINT `detail_transaksi_ibfk_2` FOREIGN KEY (`ID_DET_LAPTOP`) REFERENCES `det_laptop` (`ID_DET_LAPTOP`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `det_laptop`
--
ALTER TABLE `det_laptop`
  ADD CONSTRAINT `det_laptop_ibfk_1` FOREIGN KEY (`ID_LAPTOP`) REFERENCES `laptop` (`ID_LAPTOP`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `pengadaan_barang`
--
ALTER TABLE `pengadaan_barang`
  ADD CONSTRAINT `pengadaan_barang_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `posting`
--
ALTER TABLE `posting`
  ADD CONSTRAINT `posting_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`) ON UPDATE CASCADE;

--
-- Ketidakleluasaan untuk tabel `transaksi`
--
ALTER TABLE `transaksi`
  ADD CONSTRAINT `transaksi_ibfk_1` FOREIGN KEY (`ID_USER`) REFERENCES `user` (`ID_USER`) ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
