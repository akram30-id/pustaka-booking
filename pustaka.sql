-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2022 at 03:26 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pustaka`
--

-- --------------------------------------------------------

--
-- Table structure for table `buku`
--

CREATE TABLE `buku` (
  `id` int(11) NOT NULL,
  `judul_buku` varchar(128) NOT NULL,
  `id_kategori` int(5) NOT NULL,
  `pengarang` varchar(64) NOT NULL,
  `penerbit` varchar(64) NOT NULL,
  `tahun_terbit` year(4) NOT NULL,
  `isbn` varchar(64) NOT NULL,
  `stok` int(11) NOT NULL,
  `dipinjam` int(11) NOT NULL,
  `dibooking` int(11) NOT NULL,
  `image` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `buku`
--

INSERT INTO `buku` (`id`, `judul_buku`, `id_kategori`, `pengarang`, `penerbit`, `tahun_terbit`, `isbn`, `stok`, `dipinjam`, `dibooking`, `image`) VALUES
(1, 'Statistika dengan Program Komputer', 1, 'Ahmad Kholiqul Amin', 'Deep Publish', 2016, '9786022809432', 15, 1, 1, 'img1655212866.jpg'),
(2, 'Mudah Belajar Komputer Untuk Anak', 1, 'Bambang Agus Setiawan', 'Huta Media', 2014, '9786025118500', 5, 3, 1, 'img1638149158.jpg'),
(3, 'PHP Komplet', 1, 'Jublie', 'Elex Media Komputindo', 2019, '8345753547', 50, 1, 1, 'img1638149170.jpg'),
(4, 'Detektif Conan Ep200', 9, 'Okigawa Sasuke', 'Cultura', 2016, '874387583987', 60, 0, 0, 'img1638149137.jpg'),
(5, 'Bahasa Indonesia', 2, 'Umri Nur\'aini dan Indriyani', 'pusat pembukuan', 2015, '75725472884', 3, 0, 0, 'img1638149179.jpg\r\n'),
(6, 'Komunitas Lintas Budaya', 5, 'Dr. Dedy Kurnia', 'Published', 2015, '878674646488', 5, 0, 0, 'img1638149194.jpg'),
(7, 'Koloborasi CodeIgneter dan Ajax dalam Perancangan', 1, 'Anton Subagia', 'Elex Media Komputindo', 2017, '43345356577', 5, 0, 0, 'img1638149215.jpg'),
(8, 'From Hobby to Money', 4, 'Deasylawati', 'Elex Media Komputindo', 2015, '879668686787879', 5, 0, 0, 'img1638149228.jpg'),
(9, 'Buku Saku Pramuka', 8, 'Rudi Himawan', 'Pusat Perbukuan', 2016, '9786868797978796', 6, 0, 0, 'img1638149238.jpg'),
(10, 'Rahasia Keajaiban Bumi', 3, 'Nurul Ihsan', 'Luxima', 2014, '565756565768868', 5, 0, 0, 'img1638149250.jpg'),
(12, 'List Building Black Book', 11, 'Denny Santoso', 'Tribelio', 2021, '1234-123456789-10000', 5, 0, 0, 'img1654678482.jpg'),
(14, 'Never Split The Difference', 11, 'Chris Voss', 'Kindle Store', 2016, '11111-111-22244-9229', 70, 0, 0, 'img1655211893.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `kategori`
--

CREATE TABLE `kategori` (
  `id_kategori` int(5) NOT NULL,
  `kategori` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `kategori`
--

INSERT INTO `kategori` (`id_kategori`, `kategori`) VALUES
(1, 'Komputer dan Teknologi'),
(2, 'Bahasa'),
(3, 'Sains'),
(4, 'Hobi'),
(5, 'Komunikasi'),
(6, 'Hukum'),
(7, 'Agama'),
(8, 'Populer'),
(9, 'Manga'),
(11, 'Bisnis');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `id` int(11) NOT NULL,
  `role` varchar(128) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`id`, `role`) VALUES
(1, 'Administrator'),
(2, 'Member');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `nama` varchar(128) NOT NULL,
  `alamat` text NOT NULL,
  `email` varchar(128) NOT NULL,
  `image` varchar(128) NOT NULL,
  `password` varchar(256) NOT NULL,
  `role_id` int(11) NOT NULL,
  `is_active` int(1) NOT NULL,
  `tanggal_input` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `nama`, `alamat`, `email`, `image`, `password`, `role_id`, `is_active`, `tanggal_input`) VALUES
(1, 'test1', 'Tangerang Selatan', 'test1@mail.com', 'pro1605864121.jpg', '$2y$10$jLgqE1IBWTdVFuBfgq4u/upFdTkdRmKSigfZ7M8qHbjkTmnf26D5a', 1, 1, 1554218983),
(2, 'test2', 'Cengkareng', 'test2@mail.com', 'pro1579684727.jpg', '$2y$10$beSdsua15A.A.tmiLIsmfuQCLWGdptUwjXlGI2u2kqxlpPXpXqZ72', 2, 1, 1554219788),
(4, 'test3', 'Tangerang Selatan', 'test3@mail.com', 'pro1579677559.jpg', '$2y$10$N6itMt2sWT1dPXwedtmhsOFC/2eYoQ9k.MI5t1jNwGPE06oVv5Oqm', 2, 1, 1579677559),
(27, 'test4', 'Bekasi', 'test4@mail.com', 'TA_9_4.jpg', '$2y$10$UL6rCPqGaR6SK0G2lWlnzOFDuRj/UMIv4daIEmrq7j4t4YRxmXPdm', 2, 1, 1652758127),
(28, 'Ananda Akram', '', 'test@mail.com', 'pro1654655883.png', '$2y$10$mZ2x/Y9j8rqjWQZYltMjS.84xumD06ctgYZZcqgk3Or6z9nEYhxpG', 1, 1, 2022),
(29, 'Imam Nawawi', 'Jala Cenderawasih No. 12, Kota Bekasi.', 'imam.imw@gmail.com', 'pro1654669021.png', '$2y$10$cOfjwl0MLCOoEMmz04aGSu0U4PYjxcxoNLonoP5h6.iMdzPK.ziFK', 1, 1, 2022);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buku`
--
ALTER TABLE `buku`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kategori`
--
ALTER TABLE `kategori`
  ADD PRIMARY KEY (`id_kategori`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
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
-- AUTO_INCREMENT for table `buku`
--
ALTER TABLE `buku`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `kategori`
--
ALTER TABLE `kategori`
  MODIFY `id_kategori` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
