-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 13, 2019 at 11:39 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 7.2.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskmaster`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_users`
--

CREATE TABLE `app_users` (
  `id_user` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(100) NOT NULL,
  `administrator` varchar(1) NOT NULL,
  `operater` varchar(1) NOT NULL,
  `korisnik` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `app_users`
--

INSERT INTO `app_users` (`id_user`, `username`, `hashed_password`, `administrator`, `operater`, `korisnik`) VALUES
(1, 'no_operater', '$2y$10$OTA1NTE5NjY5OWI2YWUyOODaNdysC7SVd4vMxJKQ7zRIKVjpeyfiS', '0', '1', '0'),
(2, 'dambam', '$2y$10$OTVjMjk4YmEzZDJlYTNkYOfRDDXB.6leYATbcgLJo7NQvMBmaCCpO', '0', '1', '0'),
(3, 'mir_ko', '$2y$10$OTA1NTE5NjY5OWI2YWUyOODaNdysC7SVd4vMxJKQ7zRIKVjpeyfiS', '1', '1', '0'),
(4, 'vedis', '$2y$10$M2UzYWQ1YmIwZTIxZTA0NOUonh7uVk2WO.yy0bHB0dQFIZT.bkEUu', '0', '0', '1'),
(5, 'vedin', '$2y$10$Y2E4NjM2ODcyNWZkMmJlYu5rEpNJRl2lxScQ8t.kkp5aPgOaGNjpi', '0', '0', '1'),
(6, 'bmiltiades', '$2y$10$NWY0MDEzYThlMWUyN2M5Z.JhNH6K.c4oUI6LiMciXfxHgOv/pNI22', '0', '0', '1'),
(7, 'nadis', '$2y$10$OTUzYWNmMzRmYmRjMDc2YuhurDCPj0jfXdEdIiplE2vKn/DgS9PV6', '0', '0', '1'),
(8, 'peldo', '$2y$10$NTJkM2UxZmFmZWJjYjAzNeCe2cyfuuqy3h3NLMnWgjkSqXzp9Cdcu', '0', '1', '0'),
(9, 'hazmirmanija', '$2y$10$MDliN2E3MGM5MzBjYjMwNO3p1buyfMRVAMmgHUGck0nIyZa.VfYSm', '0', '1', '0'),
(10, 'tangoadnan', '$2y$10$NDFkMTBmM2FmZTNlYmIzNu/zLPqpBCDaL0/Q2ZiLNLwyIkdMPgKTO', '0', '0', '1'),
(11, 'h_dzin', '$2y$10$ZDE1MDZiYzZiNzdhYWI0N.4H2/wcVWAafdFPK391JbD0wB84dqbOe', '0', '0', '1'),
(12, 'tangoadnan', '$2y$10$YzQxMDBlZDNiNjI2MjdiMO81Y8vKekUhh52jyCMiLQczOJ3u5RoDy', '0', '0', '1'),
(13, 'tadnan', '$2y$10$YjE1ZDQ3ZmQ2MmQ0MTY0Yu0xBc5vGSu0rUdam6QVb2vV7OdshG1TK', '0', '0', '1'),
(14, 'eagic', '$2y$10$ZjE3ZDE0NWY2ZDRkZjhkNuv2q3Wke2nlGsDYuZIBfZzwMdAdAh3Fi', '0', '1', '0'),
(15, 'animal', '$2y$10$ZThkODgxNjcxYWU3MTZjYew.VPc2mSRef2zZZRDbebSy/w.5.ROJK', '0', '0', '1'),
(16, 'vadil', '$2y$10$ZGEwOWY4MjA2Y2I2ODNkZeX3SX/GzhaP1wrolPRnEiLEHBbnO0vQG', '0', '0', '1'),
(17, 'alko123', '$2y$10$YzJkNDE0YmEwMTE1MDUyYOeCyV58M8ZU52PRcTF9CqAsrsRe5QFmK', '0', '1', '0');

-- --------------------------------------------------------

--
-- Table structure for table `komentari`
--

CREATE TABLE `komentari` (
  `id_komentar` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `logovani_user` varchar(50) COLLATE utf8_croatian_mysql561_ci DEFAULT NULL,
  `komentar` text COLLATE utf8_croatian_mysql561_ci,
  `datum_i_vrijeme` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_mysql561_ci;

--
-- Dumping data for table `komentari`
--

INSERT INTO `komentari` (`id_komentar`, `id_task`, `logovani_user`, `komentar`, `datum_i_vrijeme`) VALUES
(1, 1, 'mirsad korjenic', 'TEST KOMENTAR 1', '2015-06-17 21:52:45'),
(2, 1, 'mirsad korjenic', 'TEST KOMENTAR 2', '2015-06-17 22:08:38'),
(3, 1, 'mirsad korjenic', 'TEST KOMENTAR 3: NEPARNI KOMENTARI SU BIJELI, PARNI SU PLAVI !!!', '2015-06-17 22:14:28'),
(4, 1, 'mirsad korjenic', 'TEST KOMENTAR 4 : ADMIN KOMENTARISE', '2015-06-19 01:03:43'),
(5, 1, 'eldin fazlic', 'TEST KOMENTAR 5 : OPERATER KOMENTARISE', '2015-06-19 01:09:50'),
(6, 3, 'mirsad korjenic', 'TEST KOMENTAR 1 : ADMIN', '2015-06-19 01:30:15'),
(7, 3, 'mirsad korjenic', 'TEST KOMENTAR 2 : ADMIN', '2015-06-19 01:34:40'),
(8, 3, 'eldin fazlic', 'TEST KOMENTAR : OPERATER', '2015-06-19 01:38:05'),
(9, 3, 'eldin fazlic', 'TEST KOMENTAR : OPERATER', '2015-06-19 01:43:30'),
(10, 3, 'edis velicanin', 'TEST KOMENTAR : KORISNIK', '2015-06-19 01:52:49'),
(11, 3, 'eldin fazlic', 'TEST KOMENTAR : OPERATER', '2015-06-19 01:53:46'),
(12, 3, 'mirsad korjenic', 'TEST KOMENTAR 2 : ADMIN', '2015-06-19 01:54:51'),
(13, 2, 'eldin fazlic', 'test komentar', '2015-07-03 23:53:55'),
(14, 2, 'eldin fazlic', 'test', '2015-07-11 07:19:48'),
(15, 3, 'edis velicanin', 'Dokle je ovo?', '2018-08-26 10:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `korisnici`
--

CREATE TABLE `korisnici` (
  `id_korisnik` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `telefon` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `hashed_password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `korisnici`
--

INSERT INTO `korisnici` (`id_korisnik`, `ime`, `prezime`, `telefon`, `email`, `username`, `hashed_password`) VALUES
(1, 'edis', 'velicanin', '062 104 575', 'velicanin.edis@gmail.com', 'vedis', '$2y$10$M2UzYWQ1YmIwZTIxZTA0NOUonh7uVk2WO.yy0bHB0dQFIZT.bkEUu'),
(2, 'edin', 'velicanin', '062 562 539', 'velicanin.edin@gmail.com', 'vedin', '$2y$10$Y2E4NjM2ODcyNWZkMmJlYu5rEpNJRl2lxScQ8t.kkp5aPgOaGNjpi'),
(3, 'miltiades', 'becirbegovic', '062 345 678', 'bmiltiades@gmail.com', 'bmiltiades', '$2y$10$NWY0MDEzYThlMWUyN2M5Z.JhNH6K.c4oUI6LiMciXfxHgOv/pNI22'),
(4, 'adis', 'novic', '061 234 765', 'nadis@hotmail.com', 'nadis', '$2y$10$OTUzYWNmMzRmYmRjMDc2YuhurDCPj0jfXdEdIiplE2vKn/DgS9PV6'),
(5, 'adnan', 'tangoman', '987456321', 'adnan@tangoman.com', 'tadnan', '$2y$10$YjE1ZDQ3ZmQ2MmQ0MTY0Yu0xBc5vGSu0rUdam6QVb2vV7OdshG1TK'),
(6, 'Haris', 'Dzinovic', '098765432', 'dzina@pink.rs', 'h_dzin', '$2y$10$ZDE1MDZiYzZiNzdhYWI0N.4H2/wcVWAafdFPK391JbD0wB84dqbOe'),
(7, 'fadil', 'cerimagic', '987456123', 'fadil@visa.ba', 'fadilc', '$2y$10$ZDI2Mzg0ZTY0YWE1YWM4MewGxlWR4xjzsvBFRxkS9wWEbPHBnNW6W'),
(8, 'adil', 'velicanin', '093245678', 'adil@gmail.com', 'vadil', '$2y$10$OWQwNDYwOGM4ZjJmNGJhZ.QnUdClY1zNoEKgp/Aps/vHzm5tedUNi'),
(9, 'elvir', 'isanovic', '987654234', 'animal@gmail.com', 'animal', '$2y$10$ZThkODgxNjcxYWU3MTZjYew.VPc2mSRef2zZZRDbebSy/w.5.ROJK');

-- --------------------------------------------------------

--
-- Table structure for table `operateri`
--

CREATE TABLE `operateri` (
  `id_operater` int(11) NOT NULL,
  `ime` varchar(50) NOT NULL,
  `prezime` varchar(50) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL DEFAULT 'edistizu@gmail.com',
  `hashed_password` varchar(100) NOT NULL,
  `administrator` varchar(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `operateri`
--

INSERT INTO `operateri` (`id_operater`, `ime`, `prezime`, `username`, `email`, `hashed_password`, `administrator`) VALUES
(1, 'nedodijeljeni', 'task', 'no_operater', 'no_mail@gmail.com', '$2y$10$OTA1NTE5NjY5OWI2YWUyOODaNdysC7SVd4vMxJKQ7zRIKVjpeyfiS', '0'),
(2, 'damjan', 'bandic', 'dambam', 'mirsad@fixit.ba ', '$2y$10$OTVjMjk4YmEzZDJlYTNkYOfRDDXB.6leYATbcgLJo7NQvMBmaCCpO', '0'),
(3, 'mirsad', 'korjenic', 'mir_ko', 'mirsad.korjenic@outlook.com', '$2y$10$OTA1NTE5NjY5OWI2YWUyOODaNdysC7SVd4vMxJKQ7zRIKVjpeyfiS', '1'),
(4, 'eldin', 'fazlic', 'peldo', 'mirsad@fixit.ba ', '$2y$10$NTJkM2UxZmFmZWJjYjAzNeCe2cyfuuqy3h3NLMnWgjkSqXzp9Cdcu', '0'),
(5, 'hazmir', 'husejnovic', 'hazmirmanija', 'mirsad@fixit.ba ', '$2y$10$MDliN2E3MGM5MzBjYjMwNO3p1buyfMRVAMmgHUGck0nIyZa.VfYSm', '0'),
(6, 'emir', 'agic', 'eagic', 'mirsad@fixit.ba ', '$2y$10$OWQ2NjUzYjVjYzY1ZDk3MueY9kyarEsclpR46PYZXVkbkyQDSXmB.', '0'),
(7, 'almin', 'mulabegovic', 'alko123', 'mirsad@fixit.ba ', '$2y$10$YzJkNDE0YmEwMTE1MDUyYOeCyV58M8ZU52PRcTF9CqAsrsRe5QFmK', '0');

-- --------------------------------------------------------

--
-- Table structure for table `taskovi`
--

CREATE TABLE `taskovi` (
  `id_task` int(11) NOT NULL,
  `id_korisnik` int(11) NOT NULL,
  `id_operater` int(11) NOT NULL,
  `naslov` varchar(100) NOT NULL,
  `tip_uredjaja` varchar(50) NOT NULL,
  `dodatna_oprema` varchar(50) DEFAULT NULL,
  `pn_broj` varchar(50) NOT NULL,
  `sn_broj` varchar(50) NOT NULL,
  `opis_problema` text,
  `id_status` int(1) NOT NULL,
  `task_start` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `task_rok` date DEFAULT NULL,
  `task_end` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `taskovi`
--

INSERT INTO `taskovi` (`id_task`, `id_korisnik`, `id_operater`, `naslov`, `tip_uredjaja`, `dodatna_oprema`, `pn_broj`, `sn_broj`, `opis_problema`, `id_status`, `task_start`, `task_rok`, `task_end`) VALUES
(1, 3, 4, 'Popravka HP laptopa', 'HP LAPTOP', 'Torba, Kablovi(punjac)', 'PN123456789876', 'SN123456789876', 'Laptop se gasi usred rada !!!', 1, '2015-06-19 01:22:14', '2015-06-20', NULL),
(2, 5, 4, 'Popravka DELL PC-a', 'DELL PC', 'Nema', 'PN123456789877', 'SN123456789877', 'RaÄunar zaraÅ¾en virusima', 1, '2015-07-11 07:19:58', '2015-06-15', NULL),
(3, 1, 5, 'popravka PC-a', 'PC MAC OS', 'Torba', '1234567891023', '1234567891023', 'popravka starog PC-a', 2, '2015-07-11 06:07:08', '2015-06-20', NULL),
(4, 2, 5, 'Ekran popravka', 'assus', 'nema', '9998887776665', '9998887776666', 'nema slike', 1, '2016-11-22 00:39:00', '1970-01-01', NULL),
(5, 9, 1, 'LENOVO PC Popravka Napojne jedinice', 'PC', 'kuÄ‡iÅ¡te', '9182736450987', '9182736450777', 'Veoma bucno tokom rada', 1, '2015-07-04 08:01:51', '1970-01-01', NULL),
(6, 7, 7, 'Popravka tastature', 'APLLE LAPTOP', 'Torba I Kablovi', '12345678910233', '12345678910244', 'Pojedine tipke ne reaguju na dodir', 1, '2015-06-12 02:10:05', '2015-06-05', NULL),
(7, 5, 6, 'TABLET PC s pokvarenom baterijom', 'TABLET', 'nema', '1234567654321', '1234567654321', 'Baterija se ne moÅ¾e nikako napuniti', 1, '2015-06-12 01:15:13', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `task_istorija`
--

CREATE TABLE `task_istorija` (
  `id` int(11) NOT NULL,
  `id_task` int(11) NOT NULL,
  `logovani_user` varchar(50) COLLATE utf8_croatian_mysql561_ci DEFAULT NULL,
  `akcija` text COLLATE utf8_croatian_mysql561_ci,
  `vrijeme_izmjene` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_croatian_mysql561_ci;

--
-- Dumping data for table `task_istorija`
--

INSERT INTO `task_istorija` (`id`, `id_task`, `logovani_user`, `akcija`, `vrijeme_izmjene`) VALUES
(1, 1, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : damjan bandic | rok taska : 17-07-2015', '2015-06-17 00:36:23'),
(2, 1, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : hazmir husejnovic | rok taska : 17-07-2015', '2015-06-17 00:37:45'),
(3, 1, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : hazmir husejnovic | rok taska : 18-06-2015', '2015-06-17 00:37:49'),
(4, 1, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-06-17 00:38:20'),
(5, 1, 'mirsad korjenic', 'NOVI KOMENTAR', '2015-06-17 21:52:45'),
(6, 1, 'mirsad korjenic', 'NOVI KOMENTAR', '2015-06-17 22:08:38'),
(7, 1, 'mirsad korjenic', 'NOVI KOMENTAR', '2015-06-17 22:14:28'),
(8, 1, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : eldin fazlic | rok taska : 20-06-2015', '2015-06-19 00:55:39'),
(9, 1, 'mirsad korjenic', 'NOVI KOMENTAR', '2015-06-19 01:03:44'),
(10, 1, 'eldin fazlic', 'NOVI KOMENTAR', '2015-06-19 01:09:50'),
(11, 1, 'eldin fazlic', 'IZMJENA TASKA | status : ANALIZIRAN | operater : eldin fazlic', '2015-06-19 01:18:54'),
(12, 1, 'eldin fazlic', 'IZMJENA TASKA | status : OTVOREN | operater : eldin fazlic', '2015-06-19 01:22:15'),
(13, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : eldin fazlic | rok taska : 20-06-2015', '2015-06-19 01:29:59'),
(14, 3, 'mirsad korjenic', 'NOVI KOMENTAR', '2015-06-19 01:30:15'),
(15, 3, 'mirsad korjenic', 'NOVI KOMENTAR', '2015-06-19 01:34:40'),
(16, 3, 'eldin fazlic', 'NOVI KOMENTAR', '2015-06-19 01:38:05'),
(17, 3, 'eldin fazlic', 'IZMJENA TASKA | status : ANALIZIRAN | operater : eldin fazlic', '2015-06-19 01:43:12'),
(18, 3, 'eldin fazlic', 'NOVI KOMENTAR', '2015-06-19 01:43:30'),
(19, 3, 'edis velicanin', 'IZMJENA TASKA | status : PRIHVACEN | operater : eldin fazlic', '2015-06-19 01:52:08'),
(20, 3, 'edis velicanin', 'IZMJENA TASKA | status : ODBIJEN | operater : eldin fazlic', '2015-06-19 01:52:19'),
(21, 3, 'edis velicanin', 'IZMJENA TASKA | status : OTVOREN | operater : eldin fazlic', '2015-06-19 01:52:30'),
(22, 3, 'edis velicanin', 'NOVI KOMENTAR', '2015-06-19 01:52:49'),
(23, 3, 'eldin fazlic', 'IZMJENA TASKA | status : ANALIZIRAN | operater : eldin fazlic', '2015-06-19 01:53:32'),
(24, 3, 'eldin fazlic', 'NOVI KOMENTAR', '2015-06-19 01:53:47'),
(25, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : ZATVOREN | operater : eldin fazlic | rok taska : 20-06-2015', '2015-06-19 01:54:19'),
(26, 3, 'mirsad korjenic', 'NOVI KOMENTAR', '2015-06-19 01:54:51'),
(27, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : ODBIJEN | operater : eldin fazlic | rok taska : 20-06-2015', '2015-06-19 01:59:13'),
(28, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : eldin fazlic | rok taska : 20-06-2015', '2015-06-19 01:59:22'),
(29, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : ZATVOREN | operater : eldin fazlic | rok taska : 20-06-2015', '2015-06-19 01:59:37'),
(30, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : ODBIJEN | operater : eldin fazlic | rok taska : 20-06-2015', '2015-06-19 01:59:45'),
(31, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : eldin fazlic | rok taska : 20-06-2015', '2015-06-19 01:59:53'),
(32, 3, 'edis velicanin', 'IZMJENA TASKA | status : ODBIJEN | operater : eldin fazlic', '2015-06-19 02:02:22'),
(33, 3, 'edis velicanin', 'IZMJENA TASKA | status : ZATVOREN | operater : eldin fazlic', '2015-06-19 02:02:50'),
(34, 3, 'edis velicanin', 'IZMJENA TASKA | status : OTVOREN | operater : eldin fazlic', '2015-06-19 02:03:01'),
(35, 2, 'eldin fazlic', 'NOVI KOMENTAR', '2015-07-03 23:53:55'),
(36, 2, 'eldin fazlic', 'IZMJENA TASKA | status : ANALIZIRAN | operater : eldin fazlic', '2015-07-03 23:54:11'),
(37, 2, 'eldin fazlic', 'IZMJENA TASKA | status : ODBIJEN | operater : eldin fazlic', '2015-07-03 23:54:21'),
(38, 2, 'eldin fazlic', 'IZMJENA TASKA | status : ZATVOREN | operater : eldin fazlic', '2015-07-03 23:54:28'),
(39, 5, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : nedodijeljeni task | rok taska : 01-01-1970', '2015-07-04 06:32:54'),
(40, 5, 'mirsad korjenic', 'IZMJENA TASKA | status : ODBIJEN | operater : nedodijeljeni task | rok taska : 01-01-1970', '2015-07-04 07:03:53'),
(41, 5, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : nedodijeljeni task | rok taska : 01-01-1970', '2015-07-04 08:01:51'),
(42, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-04 11:58:23'),
(43, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : ANALIZIRAN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 05:36:34'),
(44, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : PRIHVACEN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 05:38:31'),
(45, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : ANALIZIRAN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 05:41:16'),
(46, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 05:42:24'),
(47, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : ANALIZIRAN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 05:47:58'),
(48, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 05:50:16'),
(49, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : ANALIZIRAN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 05:52:32'),
(50, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 05:54:27'),
(51, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : ANALIZIRAN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 05:56:10'),
(52, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : PRIHVACEN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 05:59:35'),
(53, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 06:01:58'),
(54, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 06:03:11'),
(55, 3, 'mirsad korjenic', 'IZMJENA TASKA | status : ANALIZIRAN | operater : hazmir husejnovic | rok taska : 20-06-2015', '2015-07-11 06:07:08'),
(56, 2, 'eldin fazlic', 'NOVI KOMENTAR', '2015-07-11 07:19:48'),
(57, 2, 'eldin fazlic', 'IZMJENA TASKA | status : OTVOREN | operater : eldin fazlic', '2015-07-11 07:19:58'),
(58, 4, 'mirsad korjenic', 'IZMJENA TASKA | status : OTVOREN | operater : hazmir husejnovic | rok taska : 01-01-1970', '2016-11-22 00:39:00'),
(59, 3, 'edis velicanin', 'NOVI KOMENTAR', '2018-08-26 10:53:03');

-- --------------------------------------------------------

--
-- Table structure for table `task_statusi`
--

CREATE TABLE `task_statusi` (
  `id_status` int(1) NOT NULL,
  `status` text
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `task_statusi`
--

INSERT INTO `task_statusi` (`id_status`, `status`) VALUES
(1, 'OTVOREN'),
(2, 'ANALIZIRAN'),
(3, 'PRIHVACEN'),
(4, 'ODBIJEN'),
(5, 'ZATVOREN');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_users`
--
ALTER TABLE `app_users`
  ADD PRIMARY KEY (`id_user`);

--
-- Indexes for table `komentari`
--
ALTER TABLE `komentari`
  ADD PRIMARY KEY (`id_komentar`),
  ADD KEY `id_task` (`id_task`),
  ADD KEY `id_task_2` (`id_task`);

--
-- Indexes for table `korisnici`
--
ALTER TABLE `korisnici`
  ADD PRIMARY KEY (`id_korisnik`);

--
-- Indexes for table `operateri`
--
ALTER TABLE `operateri`
  ADD PRIMARY KEY (`id_operater`);

--
-- Indexes for table `taskovi`
--
ALTER TABLE `taskovi`
  ADD PRIMARY KEY (`id_task`),
  ADD KEY `id_korisnik` (`id_korisnik`),
  ADD KEY `id_operater` (`id_operater`),
  ADD KEY `id_korisnik_2` (`id_korisnik`),
  ADD KEY `id_operater_2` (`id_operater`);

--
-- Indexes for table `task_istorija`
--
ALTER TABLE `task_istorija`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_task` (`id_task`),
  ADD KEY `id_task_2` (`id_task`);

--
-- Indexes for table `task_statusi`
--
ALTER TABLE `task_statusi`
  ADD PRIMARY KEY (`id_status`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_users`
--
ALTER TABLE `app_users`
  MODIFY `id_user` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `komentari`
--
ALTER TABLE `komentari`
  MODIFY `id_komentar` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `korisnici`
--
ALTER TABLE `korisnici`
  MODIFY `id_korisnik` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `operateri`
--
ALTER TABLE `operateri`
  MODIFY `id_operater` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `taskovi`
--
ALTER TABLE `taskovi`
  MODIFY `id_task` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `task_istorija`
--
ALTER TABLE `task_istorija`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=60;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
