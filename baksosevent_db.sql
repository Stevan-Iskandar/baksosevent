-- phpMyAdmin SQL Dump
-- version 4.8.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 02, 2019 at 09:04 PM
-- Server version: 10.1.32-MariaDB
-- PHP Version: 7.2.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `baksosevent_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `nama` text NOT NULL,
  `email` text NOT NULL,
  `alamat` text NOT NULL,
  `tlp` text NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`username`, `password`, `nama`, `email`, `alamat`, `tlp`, `is_active`) VALUES
('admin', '$2y$10$6Slgsj1s2i5Kw0Xxckzimu5mzNqV2Tr47PmloPVsojhyUZPuy1i4G', 'Admin', 'admin@email.com', 'Jl. Admin', '081267673355', 1);

-- --------------------------------------------------------

--
-- Table structure for table `admin_menu`
--

CREATE TABLE `admin_menu` (
  `no` int(11) NOT NULL,
  `menu` text NOT NULL,
  `url` text NOT NULL,
  `icon` text NOT NULL,
  `is_active` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin_menu`
--

INSERT INTO `admin_menu` (`no`, `menu`, `url`, `icon`, `is_active`) VALUES
(1, 'Manage data', 'admin', 'fas fa-fw fa-file-signature', '1'),
(2, 'Profile', 'profile', 'fas fa-fw fa-user', '0'),
(3, 'Logout', 'login/logout', 'fas fa-fw fa-sign-out-alt', '1');

-- --------------------------------------------------------

--
-- Table structure for table `cris`
--

CREATE TABLE `cris` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `latitude` text NOT NULL,
  `longitude` text NOT NULL,
  `address` text NOT NULL,
  `time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `image` text NOT NULL,
  `nama` text NOT NULL,
  `lokasi` text NOT NULL,
  `tanggal` text NOT NULL,
  `waktu` text NOT NULL,
  `deskripsi` text NOT NULL,
  `data_donasi` text NOT NULL,
  `maker` varchar(255) NOT NULL,
  `is_active` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `image`, `nama`, `lokasi`, `tanggal`, `waktu`, `deskripsi`, `data_donasi`, `maker`, `is_active`) VALUES
(2, 'animal.jpg', 'Event kumpul kebo', 'Graha Dika 2', '08/10/2019', '10:00 - 17:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vitae augue rutrum ex efficitur rhoncus. Quisque tempor odio vel commodo egestas. Praesent pellentesque dolor ultricies magna varius mollis vel eu turpis. Curabitur dapibus risus ipsum. Integer dolor nibh, faucibus a elit ac, aliquam auctor metus. Ut vulputate arcu quis erat tristique, id imperdiet nisl molestie. Aenean vehicula condimentum dolor ac lobortis. Aliquam tortor sapien, vehicula sed dapibus ac, sagittis eu tellus. Nam tincidunt urna nec nisi pretium, placerat ultricies dolor pharetra.', '123xyzxyz a/n Event | ABC', 'admin', 0),
(3, '8.png', 'Berbagi itu indah', 'Jl. Menuju Kesuksesan', '19/09/2019', '12:00 - 14:00', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vestibulum vitae augue rutrum ex efficitur rhoncus. Quisque tempor odio vel commodo egestas. Praesent pellentesque dolor ultricies magna varius mollis vel eu turpis. Curabitur dapibus risus ipsum. Integer dolor nibh, faucibus a elit ac, aliquam auctor metus. Ut vulputate arcu quis erat tristique, id imperdiet nisl molestie. Aenean vehicula condimentum dolor ac lobortis. Aliquam tortor sapien, vehicula sed dapibus ac, sagittis eu tellus. Nam tincidunt urna nec nisi pretium, placerat ultricies dolor pharetra.', '123xxxx a/n Bambang | ABC', 'admin', 1),
(4, 'WhatsApp_Image_2019-09-12_at_16_00_35.jpeg', 'Charity', 'Jl. Jati Bening 3', '28/09/2019', '12:00 - 14:00', '<p><span xss=removed>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit amet diam maximus, finibus tortor tempus, convallis nulla. Praesent vitae eleifend nibh. Duis fringilla est nisi, a luctus orci sodales vel. Nullam euismod elit eget risus ullamcorper, at consectetur libero ultricies. Phasellus blandit sed nibh nec rhoncus. Fusce gravida elementum arcu, eget imperdiet nulla ullamcorper quis. Curabitur malesuada tortor est, et volutpat libero auctor quis. Cras sagittis sem viverra lorem laoreet vehicula. Nunc vestibulum mauris a erat finibus, at fringilla augue iaculis. Ut ac malesuada nisi. Etiam sit amet est scelerisque, accumsan tellus vel, sollicitudin nisl.</span><br></p>', '123xxxx a/n Moyo | ABC', 'admin', 1),
(5, '81.png', 'Event baru', 'Graha Dika 1', '05/10/2019', '10:00 - 12:00', '<p><span xss=removed>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean sit amet diam maximus, finibus tortor tempus, convallis nulla. Praesent vitae eleifend nibh. Duis fringilla est nisi, a luctus orci sodales vel. Nullam euismod elit eget risus ullamcorper, at consectetur libero ultricies. Phasellus blandit sed nibh nec rhoncus. Fusce gravida elementum arcu, eget imperdiet nulla ullamcorper quis. Curabitur malesuada tortor est, et volutpat libero auctor quis. Cras sagittis sem viverra lorem laoreet vehicula. Nunc vestibulum mauris a erat finibus, at fringilla augue iaculis. Ut ac malesuada nisi. Etiam sit amet est scelerisque, accumsan tellus vel, sollicitudin nisl.</span><br></p>', '123xxxx a/n Stevan Iskandar | ABC', 'admin', 1),
(11, '1568702871904_image_webp.jpg', 'Bootcamp Juara Coding', 'jl. Bendungan Hilir', '23/09/2019', '10:00-17:00', 'qwerty\nasd\nzxc', '123xxxx a/n Dewabrata | ABC', 'stevan', 0),
(12, '3.png', 'Bootcamp', 'Dika 2', '23/09/2019', '09:00-17:00', 'qwerty\r\nasd', 'asdasdasdd', 'admin', 1),
(13, '1568711558515_image_webp.jpg', 'wibo event', 'rumah tian', '22/09/2019', '18:00', 'apa adanya', 'boleh donasi', 'stevan', 1);

-- --------------------------------------------------------

--
-- Table structure for table `peserta`
--

CREATE TABLE `peserta` (
  `id` int(11) NOT NULL,
  `id_event` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `is_registered` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `peserta`
--

INSERT INTO `peserta` (`id`, `id_event`, `username`, `is_registered`) VALUES
(1, 2, 'stevan', 1),
(2, 2, 'moyo', 1),
(6, 4, 'tian', 1),
(7, 4, 'stevan', 0),
(8, 3, 'stevan', 0),
(9, 3, 'roro', 0),
(10, 4, 'roro', 1);

-- --------------------------------------------------------

--
-- Table structure for table `test`
--

CREATE TABLE `test` (
  `id` int(11) NOT NULL,
  `type` varchar(200) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `test`
--

INSERT INTO `test` (`id`, `type`, `date`) VALUES
(1, 'checkin', '2019-09-18 07:00:00'),
(2, 'checkout', '2019-09-18 11:00:00'),
(3, 'checkin', '2019-09-18 13:00:00'),
(4, 'checkout', '2019-09-18 18:00:00'),
(5, 'checkin', '2019-09-19 07:00:00'),
(6, 'checkout', '2019-09-19 11:00:00'),
(7, 'checkin', '2019-09-19 13:00:00'),
(8, 'checkout', '2019-09-19 18:00:00'),
(9, 'checkin', '2019-09-18 19:00:00'),
(10, 'checkout', '2019-09-18 21:00:00'),
(11, 'checkin', '2019-09-20 07:00:00'),
(12, 'checkout', '2019-09-20 11:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `username` varchar(255) NOT NULL,
  `password` text NOT NULL,
  `nama` text NOT NULL,
  `email` text NOT NULL,
  `alamat` text NOT NULL,
  `tlp` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`username`, `password`, `nama`, `email`, `alamat`, `tlp`) VALUES
('a', '$2y$10$ATs6muRD.KNAzanHozX3EuT0aY7Z0e.4MVlLYP/jaElAuUbMp7s1u', 'usmoyo', 'jdhd', 'bxbxb', 'ndbz '),
('aldi', '$2y$10$uHtqB5SDI069eZFPymhdc.Bxogesl8K6DDEAQYriquZwtFmn4eDL2', 'Aldi', 'aldi@gmail.com', 'jl. bendungan hilir', '0987654321'),
('asd', '$2y$10$RahWKFpQEhZY6OmsiCnl.ep0LIHiB.8.Pu4Unpv3Xvi/gxbN2ZQ.u', 'asd', 'asd', 'asd', 'asd'),
('moyo', '$2y$10$/ypU.3/2B9oSW0iN0cqHXOuRF2XDYz48jA0PplD5fV1cqn8GLVhWe', 'Usmoyo', 'contoh@email.com', 'jl. in dulu aja', '0898989898xxx'),
('roro', '$2y$10$SqSn7oYm2wsVgzDDYvCFxOHAsEN5RWFWGGS4xaJEMNrhizqD08ACm', 'rojoko', 'ake@gmail.com', 'Jl. Bendungan Hilir No.14a, RT.2/RW.4, Bend. Hilir, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10210, Indonesia', '08128886755458'),
('stevan', '$2y$10$GdPyNvnBlI/Pw5fWg3c3sef6JdC/SgQ3qpKAgseXiuodheXZ39J.e', 'Stevan Iskandar', 'contoh@email.com', 'jl. in dulu aja', '0898989898xxx'),
('tian', '$2y$10$0dXRcVqUOCYcPdX5GPb7q.P9XhuEyfsY/asMb6QBx.oHzjqQZpwia', 'Christian', 'contoh@email.com', 'Jl. Bendungan Hilir No.14a, RT.2/RW.4, Bend. Hilir, Kecamatan Tanah Abang, Kota Jakarta Pusat, Daerah Khusus Ibukota Jakarta 10210, Indonesia', '0987654321'),
('ui', '$2y$10$xW/SGI6PaTg8Qz7tVFkspeKjapB5KjWuABS0K97ZxSS6E.l7ClKa.', 'usmoyo', 'munandar', 'hshshs', '9598');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `admin_menu`
--
ALTER TABLE `admin_menu`
  ADD PRIMARY KEY (`no`);

--
-- Indexes for table `cris`
--
ALTER TABLE `cris`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `peserta`
--
ALTER TABLE `peserta`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_event` (`id_event`),
  ADD KEY `username` (`username`);

--
-- Indexes for table `test`
--
ALTER TABLE `test`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cris`
--
ALTER TABLE `cris`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `peserta`
--
ALTER TABLE `peserta`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `test`
--
ALTER TABLE `test`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `peserta`
--
ALTER TABLE `peserta`
  ADD CONSTRAINT `peserta_ibfk_1` FOREIGN KEY (`id_event`) REFERENCES `event` (`id`),
  ADD CONSTRAINT `peserta_ibfk_2` FOREIGN KEY (`username`) REFERENCES `user` (`username`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
