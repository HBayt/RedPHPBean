-- phpMyAdmin SQL Dump
-- version 5.1.1deb5ubuntu1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jun 05, 2024 at 02:52 PM
-- Server version: 10.6.16-MariaDB-0ubuntu0.22.04.1
-- PHP Version: 8.1.2-1ubuntu2.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `taskmanager`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '$2y$10$qF8aCBhIJ8lu/Yn4l2NO5uenTLMl4catol552h/Wqxedp.jQXx3PK'),
(4, 'mediadesign', '$2y$10$TsxwYf4jDxUoXBc0vRVEPuqISt54xmN8UyIiyddYdI/OnjLATX8QO');

-- --------------------------------------------------------

--
-- Table structure for table `group`
--

CREATE TABLE `group` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(4, 'Informatiker'),
(6, 'MediaDesign'),
(7, 'Verwaltung'),
(8, 'Administration');

-- --------------------------------------------------------

--
-- Table structure for table `group_task`
--

CREATE TABLE `group_task` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED DEFAULT NULL,
  `task_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `group_task`
--

INSERT INTO `group_task` (`id`, `group_id`, `task_id`) VALUES
(66, 4, 16),
(70, 4, 17),
(74, 4, 21),
(67, 6, 16),
(75, 6, 18),
(76, 6, 22),
(68, 7, 16),
(81, 7, 19),
(79, 7, 20),
(69, 8, 16);

-- --------------------------------------------------------

--
-- Table structure for table `mail`
--

CREATE TABLE `mail` (
  `id` int(11) UNSIGNED NOT NULL,
  `text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `mail`
--

INSERT INTO `mail` (`id`, `text`) VALUES
(1, '<p>Aujourd\'hui, le /date , vous &ecirc;tes pri&eacute;s de r&eacute;aliser la t&acirc;che suivante: /name</p>\r\n<p>Visitez http://task-manager pour avoir acc&egrave;s &agrave; la planification compl&egrave;te.</p>\r\n<p>Merci beaucoup et meilleures salutations</p>\r\n<p>-----------------------------------------------------------------------------------------------------------------</p>\r\n<p>Heute am /date sind mit der Aufgabe /name an der Reihe</p>\r\n<p>Die Planung koennen Sie unter http://task-manager einsehen.</p>\r\n<p>Vielen Dank und freundliche Gruesse</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>');

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

CREATE TABLE `task` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `weekdays` varchar(191) DEFAULT NULL,
  `color` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`id`, `name`, `weekdays`, `color`) VALUES
(16, 'Cafeteria', '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]', '#1015e3ff'),
(17, 'Staubsauger / Aspirateur INF', '[\"Wednesday\"]', '#15d0ffff'),
(18, 'Müll / Déchets MDE', '[\"Friday\"]', '#ff0000ff'),
(19, 'Müll, Shredder, Altpapier / Déchets, Déchiqueteuse, Vieux papier VER', '[\"Friday\"]', '#34613aff'),
(20, 'Staubsauger / Aspirateur VER', '[\"Wednesday\"]', '#20ed2aff'),
(21, 'Müll / Déchets INF', '[\"Wednesday\"]', '#ff00ecff'),
(22, 'Staubsauger / Aspirateur MDE', '[\"Friday\"]', '#ffaa00ff');

-- --------------------------------------------------------

--
-- Table structure for table `tasked`
--

CREATE TABLE `tasked` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `task_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasked`
--

INSERT INTO `tasked` (`id`, `title`, `start`, `user_id`, `task_id`) VALUES
(17692, 'Jannik Filardo', '2024-03-18 00:00:00', NULL, 16),
(17693, 'Janick Baumann', '2024-03-19 00:00:00', NULL, 16),
(17694, 'Kevin Locher', '2024-03-20 00:00:00', NULL, 16),
(17695, 'Amin Arslani', '2024-03-20 00:00:00', NULL, 17),
(17696, 'Aaron Bless', '2024-03-20 00:00:00', NULL, 21),
(17697, 'Nevio Romano', '2024-03-21 00:00:00', NULL, 16),
(17698, 'Grittideth Watanakula', '2024-03-22 00:00:00', NULL, 16),
(17699, 'Nicolas Savoy', '2024-03-22 00:00:00', 64, 18),
(17700, 'Julian Schwaar', '2024-03-22 00:00:00', 80, 19),
(17701, 'Darlyn Hernandez', '2024-03-22 00:00:00', 88, 20),
(17702, 'Keenan Thurnes', '2024-03-22 00:00:00', 65, 22),
(17703, 'Andrija Draca', '2024-03-25 00:00:00', NULL, 16),
(17980, 'Janick Baumann', '2024-03-26 00:00:00', NULL, 16),
(17981, 'Jannik Filardo', '2024-03-27 00:00:00', 116, 16),
(17982, 'Kevin Locher', '2024-03-27 00:00:00', 118, 17),
(17983, 'Julian Schwaar', '2024-03-27 00:00:00', 80, 20),
(17984, 'Amin Arslani', '2024-03-27 00:00:00', 119, 21),
(18558, 'Jannik Filardo', '2024-03-28 00:00:00', 116, 16),
(18559, 'Lisa Blumenthal', '2024-03-28 00:00:00', 90, 19),
(18560, 'Nevio Romano', '2024-03-29 00:00:00', 123, 16),
(18561, 'Noé Serravezza', '2024-03-29 00:00:00', 62, 18),
(18562, 'Nicolas Savoy', '2024-03-29 00:00:00', 64, 22),
(18563, 'Janick Baumann', '2024-04-01 00:00:00', 117, 16),
(18847, 'Jannik Filardo', '2024-04-02 00:00:00', 116, 16),
(18848, 'Victor Gashi', '2024-04-03 00:00:00', 124, 16),
(18849, 'Nevio Romano', '2024-04-03 00:00:00', 123, 17),
(18850, 'Livio Vogt', '2024-04-03 00:00:00', 87, 20),
(18851, 'Amin Arslani', '2024-04-03 00:00:00', 119, 21),
(18852, 'Kim Feyer', '2024-04-04 00:00:00', 122, 16),
(18853, 'Livio Vogt', '2024-04-05 00:00:00', 87, 16),
(18854, 'Diogo Da Silva', '2024-04-05 00:00:00', 95, 18),
(18855, 'Lisa Blumenthal', '2024-04-05 00:00:00', 90, 19),
(18856, 'Bruno Zucchetti', '2024-04-05 00:00:00', 101, 22),
(19423, 'Aaron Bless', '2024-04-08 00:00:00', 120, 16),
(19424, 'Janick Baumann', '2024-04-09 00:00:00', 117, 16),
(19425, 'Kevin Locher', '2024-04-10 00:00:00', 118, 16),
(19426, 'Amin Arslani', '2024-04-10 00:00:00', 119, 17),
(19427, 'Julian Schwaar', '2024-04-10 00:00:00', 80, 20),
(19428, 'Aaron Bless', '2024-04-10 00:00:00', 120, 21),
(19429, 'Nevio Romano', '2024-04-11 00:00:00', 123, 16),
(19430, 'Gracia Kamwanya Kamunga', '2024-04-12 00:00:00', 112, 16),
(19431, 'Keenan Thurnes', '2024-04-12 00:00:00', 65, 18),
(19432, 'Darlyn Hernandez', '2024-04-12 00:00:00', 88, 19),
(19433, 'Lionel Hofer', '2024-04-12 00:00:00', 76, 22),
(19434, 'Andrija Draca', '2024-04-15 00:00:00', 121, 16),
(19435, 'Victor Gashi', '2024-04-16 00:00:00', 124, 16),
(19436, 'Alex Salesse', '2024-04-17 00:00:00', 51, 16),
(19437, 'Jannik Filardo', '2024-04-17 00:00:00', 116, 17),
(19438, 'Ariana Grzyb', '2024-04-17 00:00:00', 102, 20),
(19439, 'Grittideth Watanakula', '2024-04-17 00:00:00', 125, 21),
(19440, 'Grittideth Watanakula', '2024-04-18 00:00:00', 125, 16),
(19441, 'Darlyn Hernandez', '2024-04-19 00:00:00', 88, 16),
(19442, 'Noé Serravezza', '2024-04-19 00:00:00', 62, 18),
(19443, 'Lisa Blumenthal', '2024-04-19 00:00:00', 90, 19),
(19444, 'Gabriel Fasel', '2024-04-19 00:00:00', 69, 22),
(19711, 'Noé Serravezza', '2024-04-22 00:00:00', 62, 16),
(19712, 'Janick Baumann', '2024-04-23 00:00:00', 117, 16),
(19713, 'Kevin Locher', '2024-04-24 00:00:00', 118, 16),
(19714, 'Amin Arslani', '2024-04-24 00:00:00', 119, 17),
(19715, 'Julian Schwaar', '2024-04-24 00:00:00', 80, 20),
(19716, 'Aaron Bless', '2024-04-24 00:00:00', 120, 21),
(19717, 'Nevio Romano', '2024-04-25 00:00:00', 123, 16),
(19718, 'Gracia Kamwanya Kamunga', '2024-04-26 00:00:00', 112, 16),
(19719, 'Sam Mpendubundi ', '2024-04-26 00:00:00', 100, 18),
(19720, 'Darlyn Hernandez', '2024-04-26 00:00:00', 88, 19),
(19721, 'Rafael Marques', '2024-04-26 00:00:00', 66, 22),
(19722, 'Jannik Filardo', '2024-04-29 00:00:00', 116, 16),
(19723, 'Victor Gashi', '2024-04-30 00:00:00', 124, 16),
(19724, 'Alex Salesse', '2024-05-01 00:00:00', 51, 16),
(19725, 'Jannik Filardo', '2024-05-01 00:00:00', 116, 17),
(19726, 'Livio Vogt', '2024-05-01 00:00:00', 87, 20),
(19727, 'Janick Baumann', '2024-05-01 00:00:00', 117, 21),
(19728, 'Grittideth Watanakula', '2024-05-02 00:00:00', 125, 16),
(19729, 'Leonora Trena', '2024-05-03 00:00:00', 126, 16),
(19730, 'Rafael Marques', '2024-05-03 00:00:00', 66, 18),
(19731, 'Lisa Blumenthal', '2024-05-03 00:00:00', 90, 19),
(19732, 'Gabriel Fasel', '2024-05-03 00:00:00', 69, 22),
(19733, 'Alex Salesse', '2024-05-06 00:00:00', 51, 16),
(19734, 'Lionel Hofer', '2024-05-07 00:00:00', 76, 16),
(19735, 'Leonora Trena', '2024-05-08 00:00:00', 126, 16),
(19736, 'Kevin Locher', '2024-05-08 00:00:00', 118, 17),
(19737, 'Mara Meier', '2024-05-08 00:00:00', 89, 20),
(19738, 'Amin Arslani', '2024-05-08 00:00:00', 119, 21),
(19739, 'Gabriel Duarte', '2024-05-09 00:00:00', 96, 16),
(19740, 'Sam Mpendubundi ', '2024-05-10 00:00:00', 100, 16),
(19741, 'Bruno Zucchetti', '2024-05-10 00:00:00', 101, 18),
(19742, 'Ariana Grzyb', '2024-05-10 00:00:00', 102, 19),
(19743, 'Killian Vallat', '2024-05-10 00:00:00', 110, 22),
(19744, 'Cindy Dos Santos', '2024-05-13 00:00:00', 103, 16),
(19745, 'Immanuel Studer', '2024-05-14 00:00:00', 114, 16),
(19746, 'Jessy Jacot', '2024-05-15 00:00:00', 115, 16),
(19747, 'Aaron Bless', '2024-05-15 00:00:00', 120, 17),
(19748, 'Pereira Jessica', '2024-05-15 00:00:00', 127, 20),
(19749, 'Andrija Draca', '2024-05-15 00:00:00', 121, 21),
(19750, 'Gracia Kamwanya Kamunga', '2024-05-16 00:00:00', 112, 16),
(19751, 'Darlyn Hernandez', '2024-05-17 00:00:00', 88, 16),
(19752, 'Noé Serravezza', '2024-05-17 00:00:00', 62, 18),
(19753, 'Julian Schwaar', '2024-05-17 00:00:00', 80, 19),
(19754, 'Nicolas Savoy', '2024-05-17 00:00:00', 64, 22),
(19755, 'Kim Feyer', '2024-05-20 00:00:00', 122, 16),
(19756, 'Janick Baumann', '2024-05-21 00:00:00', 117, 16),
(19757, 'Aaron Bless', '2024-05-22 00:00:00', 120, 16),
(19758, 'Jannik Filardo', '2024-05-22 00:00:00', 116, 17),
(19759, 'Livio Vogt', '2024-05-22 00:00:00', 87, 20),
(19760, 'Andrija Draca', '2024-05-22 00:00:00', 121, 21),
(19761, 'Grittideth Watanakula', '2024-05-23 00:00:00', 125, 16),
(19762, 'Leonora Trena', '2024-05-24 00:00:00', 126, 16),
(19763, 'Bruno Zucchetti', '2024-05-24 00:00:00', 101, 18),
(19764, 'Darlyn Hernandez', '2024-05-24 00:00:00', 88, 19),
(19765, 'Immanuel Studer', '2024-05-24 00:00:00', 114, 22),
(19766, 'Alex Salesse', '2024-05-27 00:00:00', 51, 16),
(19767, 'Lionel Hofer', '2024-05-28 00:00:00', 76, 16),
(19768, 'Gabriel Fasel', '2024-05-29 00:00:00', 69, 16),
(19769, 'Kevin Locher', '2024-05-29 00:00:00', 118, 17),
(19770, 'Mara Meier', '2024-05-29 00:00:00', 89, 20),
(19771, 'Amin Arslani', '2024-05-29 00:00:00', 119, 21),
(19772, 'Gabriel Duarte', '2024-05-30 00:00:00', 96, 16),
(19773, 'Leonora Trena', '2024-05-31 00:00:00', 126, 16),
(19774, 'Gabriel Duarte', '2024-05-31 00:00:00', 96, 18),
(19775, 'Lisa Blumenthal', '2024-05-31 00:00:00', 90, 19),
(19776, 'Bruno Zucchetti', '2024-05-31 00:00:00', 101, 22),
(19777, 'Cindy Dos Santos', '2024-06-03 00:00:00', 103, 16),
(19778, 'Killian Vallat', '2024-06-04 00:00:00', 110, 16),
(19779, 'Immanuel Studer', '2024-06-05 00:00:00', 114, 16),
(19780, 'Aaron Bless', '2024-06-05 00:00:00', 120, 17),
(19781, 'Ariana Grzyb', '2024-06-05 00:00:00', 102, 20),
(19782, 'Andrija Draca', '2024-06-05 00:00:00', 121, 21),
(19783, 'Jessy Jacot', '2024-06-06 00:00:00', 115, 16),
(19784, 'Darlyn Hernandez', '2024-06-07 00:00:00', 88, 16),
(19785, 'Noé Serravezza', '2024-06-07 00:00:00', 62, 18),
(19786, 'Leonora Trena', '2024-06-07 00:00:00', 126, 19),
(19787, 'Nicolas Savoy', '2024-06-07 00:00:00', 64, 22),
(19788, 'Pereira Jessica', '2024-06-10 00:00:00', 127, 16),
(19789, 'Victor Gashi', '2024-06-11 00:00:00', 124, 16),
(19790, 'Kim Feyer', '2024-06-12 00:00:00', 122, 16),
(19791, 'Nevio Romano', '2024-06-12 00:00:00', 123, 17),
(19792, 'Julian Schwaar', '2024-06-12 00:00:00', 80, 20),
(19793, 'Jannik Filardo', '2024-06-12 00:00:00', 116, 21),
(19794, 'Grittideth Watanakula', '2024-06-13 00:00:00', 125, 16),
(19795, 'Keenan Thurnes', '2024-06-14 00:00:00', 65, 16),
(19796, 'Rafael Marques', '2024-06-14 00:00:00', 66, 18),
(19797, 'Darlyn Hernandez', '2024-06-14 00:00:00', 88, 19),
(19798, 'Gabriel Fasel', '2024-06-14 00:00:00', 69, 22),
(19799, 'Alex Salesse', '2024-06-17 00:00:00', 51, 16),
(19800, 'Sara Simoes', '2024-06-18 00:00:00', NULL, 16),
(19801, 'Lionel Hofer', '2024-06-19 00:00:00', 76, 16),
(19802, 'Janick Baumann', '2024-06-19 00:00:00', 117, 17),
(19803, 'Livio Vogt', '2024-06-19 00:00:00', 87, 20),
(19804, 'Kevin Locher', '2024-06-19 00:00:00', 118, 21),
(19805, 'Gabriel Duarte', '2024-06-20 00:00:00', 96, 16),
(19806, 'Diogo Da Silva', '2024-06-21 00:00:00', 95, 16),
(19807, 'Sam Mpendubundi ', '2024-06-21 00:00:00', 100, 18),
(19808, 'Lisa Blumenthal', '2024-06-21 00:00:00', 90, 19),
(19809, 'Bruno Zucchetti', '2024-06-21 00:00:00', 101, 22),
(19810, 'Cindy Dos Santos', '2024-06-24 00:00:00', 103, 16),
(19811, 'Killian Vallat', '2024-06-25 00:00:00', 110, 16),
(19812, 'Immanuel Studer', '2024-06-26 00:00:00', 114, 16),
(19813, 'Amin Arslani', '2024-06-26 00:00:00', 119, 17),
(19814, 'Mara Meier', '2024-06-26 00:00:00', 89, 20),
(19815, 'Aaron Bless', '2024-06-26 00:00:00', 120, 21),
(19816, 'Jessy Jacot', '2024-06-27 00:00:00', 115, 16),
(19817, 'Ariana Grzyb', '2024-06-28 00:00:00', 102, 16),
(19818, 'Noé Serravezza', '2024-06-28 00:00:00', 62, 18),
(19819, 'Gracia Kamwanya Kamunga', '2024-06-28 00:00:00', 112, 19),
(19820, 'Nicolas Savoy', '2024-06-28 00:00:00', 64, 22),
(19821, 'Pereira Jessica', '2024-07-01 00:00:00', 127, 16),
(19822, 'Andrija Draca', '2024-07-02 00:00:00', 121, 16),
(19823, 'Kim Feyer', '2024-07-03 00:00:00', 122, 16),
(19824, 'Nevio Romano', '2024-07-03 00:00:00', 123, 17),
(19825, 'Julian Schwaar', '2024-07-03 00:00:00', 80, 20),
(19826, 'Victor Gashi', '2024-07-03 00:00:00', 124, 21),
(19827, 'Grittideth Watanakula', '2024-07-04 00:00:00', 125, 16),
(19828, 'Leonora Trena', '2024-07-05 00:00:00', 126, 16),
(19829, 'Keenan Thurnes', '2024-07-05 00:00:00', 65, 18),
(19830, 'Darlyn Hernandez', '2024-07-05 00:00:00', 88, 19),
(19831, 'Rafael Marques', '2024-07-05 00:00:00', 66, 22),
(19832, 'Alex Salesse', '2024-07-08 00:00:00', 51, 16),
(19833, 'Gabriel Fasel', '2024-07-09 00:00:00', 69, 16),
(19834, 'Sara Simoes', '2024-07-10 00:00:00', NULL, 16),
(19835, 'Jannik Filardo', '2024-07-10 00:00:00', 116, 17),
(19836, 'Livio Vogt', '2024-07-10 00:00:00', 87, 20),
(19837, 'Janick Baumann', '2024-07-10 00:00:00', 117, 21),
(19838, 'Gabriel Duarte', '2024-07-11 00:00:00', 96, 16),
(19839, 'Diogo Da Silva', '2024-07-12 00:00:00', 95, 16),
(19840, 'Sam Mpendubundi ', '2024-07-12 00:00:00', 100, 18),
(19841, 'Lisa Blumenthal', '2024-07-12 00:00:00', 90, 19),
(19842, 'Bruno Zucchetti', '2024-07-12 00:00:00', 101, 22),
(19843, 'Lionel Hofer', '2024-07-15 00:00:00', 76, 16),
(19844, 'Cindy Dos Santos', '2024-07-16 00:00:00', 103, 16),
(19845, 'Killian Vallat', '2024-07-17 00:00:00', 110, 16),
(19846, 'Kevin Locher', '2024-07-17 00:00:00', 118, 17),
(19847, 'Mara Meier', '2024-07-17 00:00:00', 89, 20),
(19848, 'Amin Arslani', '2024-07-17 00:00:00', 119, 21),
(19849, 'Immanuel Studer', '2024-07-18 00:00:00', 114, 16),
(19850, 'Jessy Jacot', '2024-07-19 00:00:00', 115, 16),
(19851, 'Noé Serravezza', '2024-07-19 00:00:00', 62, 18),
(19852, 'Ariana Grzyb', '2024-07-19 00:00:00', 102, 19),
(19853, 'Nicolas Savoy', '2024-07-19 00:00:00', 64, 22),
(19854, 'Gracia Kamwanya Kamunga', '2024-07-22 00:00:00', 112, 16);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL,
  `done_task` int(11) UNSIGNED DEFAULT NULL,
  `group_id` int(11) UNSIGNED DEFAULT NULL,
  `weekdays` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `done_task`, `group_id`, `weekdays`) VALUES
(1, 'Ramon Odermatt', 'ramon.odermatt.ged@gmail.com', 0, NULL, NULL),
(2, 'Jean gaetan', 'ramon.odermatt.ged@gmail.com', 0, NULL, NULL),
(33, 'Grace Rudolph', 'grace.rudolf@battenberg.ch', 0, NULL, NULL),
(34, 'Dejan Simonovski', 'dejan.simonovski@battenberg.ch', 0, NULL, NULL),
(35, 'Thibault Blaser', 'thibault.blaser@battenberg.ch', 0, NULL, NULL),
(36, 'Nora Räber', 'nora.raeber@battenberg.ch', 0, NULL, NULL),
(37, 'Martina Vögeli', 'martina.voegeli@battenberg.ch', 0, NULL, NULL),
(38, 'Myriam Salesse', 'myriam.salesse@battenberg.ch', 0, NULL, NULL),
(39, 'Sael Ngolla', 'sael.ngolla@battenberg.ch', 0, NULL, NULL),
(40, 'Timo Blum', 'timo.blum@battenberg.ch', 0, NULL, NULL),
(41, 'Enzo Marazzato', 'enzo.marazzato@battenberg.ch', 0, NULL, NULL),
(42, 'Dominique Zuber', 'dominique.zuber@battenberg.ch', 0, NULL, NULL),
(43, 'Maricarmen Wyser', 'maricarmen.wyser@battenberg.ch', 0, NULL, NULL),
(44, 'Sandy Nussbaumer', 'sandy.nussbaumer@battenberg.ch', 0, NULL, NULL),
(51, 'Alex Salesse', 'myriam.salesse@battenberg.ch', 4, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(62, 'Noé Serravezza', 'Noe.Serravezza@battenberg.ch', 5, 6, '[\"Monday\",\"Wednesday\",\"Friday\"]'),
(64, 'Nicolas Savoy', 'nicolas.savoy@battenberg.ch', 5, 6, '[\"Monday\",\"Tuesday\",\"Friday\"]'),
(65, 'Keenan Thurnes', 'keenan.thurnes@battenberg.ch', 4, 6, '[\"Monday\",\"Tuesday\",\"Friday\"]'),
(66, 'Rafael Marques', 'rafael.marques@battenberg.ch', 4, 6, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(69, 'Gabriel Fasel', 'gabriel.fasel@battenberg.ch', 4, 6, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(76, 'Lionel Hofer', 'Lionel.Hofer@battenberg.ch', 4, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(79, 'xy', 'xyy@bbla.ch', 0, NULL, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(80, 'Julian Schwaar', 'julian.schwaar@battenberg.ch', 4, 7, '[\"Wednesday\",\"Thursday\",\"Friday\"]'),
(87, 'Livio Vogt', 'livio.vogt@battenberg.ch', 4, 7, '[\"Tuesday\",\"Wednesday\",\"Thursday\"]'),
(88, 'Darlyn Hernandez', 'darlyn.hernandez@battenberg.ch', 4, 7, '[\"Friday\"]'),
(89, 'Mara Meier', 'mara.meier@battenberg.ch', 4, 7, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(90, 'Lisa Blumenthal', 'lisa.blumenthal@battenberg.ch', 4, 7, '[\"Wednesday\",\"Thursday\",\"Friday\"]'),
(94, 'Aaron Soltermann', 'aaron.soltermann@battenberg.ch', 0, 7, 'null'),
(95, 'Diogo Da Silva', 'Diogo.DaSilva@battenberg.ch', 4, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Friday\"]'),
(96, 'Gabriel Duarte', 'gabriel.duarte@battenberg.ch', 4, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(100, 'Sam Mpendubundi ', 'Sam.Mpendubundi@battenberg.ch', 4, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(101, 'Bruno Zucchetti', 'Bruno.Zucchetti@battenberg.ch', 4, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(102, 'Ariana Grzyb', 'ariana.grzyb@battenberg.ch', 4, 7, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(103, 'Cindy Dos Santos', 'Cindy.DosSantos@battenberg.ch', 4, 6, '[\"Monday\",\"Tuesday\"]'),
(110, 'Killian Vallat', 'Killian.Vallat@battenberg.ch', 4, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(112, 'Gracia Kamwanya Kamunga', 'gracia.kamwanyakamunga@battenberg.ch', 4, 7, '[\"Monday\",\"Tuesday\",\"Thursday\",\"Friday\"]'),
(114, 'Immanuel Studer', 'Immanuel.Studer@battenberg.ch', 4, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(115, 'Jessy Jacot', 'Jessy.Jacot@battenberg.ch', 4, 6, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(116, 'Jannik Filardo', 'jannik.filardo@battenberg.ch', 5, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\"]'),
(117, 'Janick Baumann', 'janick.baumann@battenberg.ch', 5, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\"]'),
(118, 'Kevin Locher', 'kevin.locher@battenberg.ch', 5, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\"]'),
(119, 'Amin Arslani', 'amin.arslani@battenberg.ch', 5, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(120, 'Aaron Bless', 'aaron.bless@battenberg.ch', 4, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(121, 'Andrija Draca', 'andrija.draca@battenberg.ch', 4, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(122, 'Kim Feyer', 'kim.feyer@battenberg.ch', 4, 4, '[\"Monday\",\"Wednesday\",\"Thursday\"]'),
(123, 'Nevio Romano', 'nevio.romano@battenberg.ch', 4, 4, '[\"Wednesday\",\"Thursday\",\"Friday\"]'),
(124, 'Victor Gashi', 'victor.gashi@battenberg.ch', 4, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\"]'),
(125, 'Grittideth Watanakula', 'grittideth.watanakula@battenberg.ch', 4, 4, '[\"Monday\",\"Thursday\",\"Friday\"]'),
(126, 'Leonora Trena', 'leonora.trena@battenberg.ch', 4, 7, '[\"Friday\"]'),
(127, 'Pereira Jessica', 'jessica.pereira@battenberg.ch', 4, 7, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]');

-- --------------------------------------------------------

--
-- Table structure for table `vacation`
--

CREATE TABLE `vacation` (
  `id` int(11) UNSIGNED NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `vacation`
--

INSERT INTO `vacation` (`id`, `start`, `end`, `user_id`) VALUES
(1, '2021-12-27', '2021-01-07', NULL),
(2, '2022-04-11', '2022-04-22', NULL),
(3, '2021-12-27', '2022-01-07', NULL),
(4, '2022-07-25', '2022-08-05', NULL),
(5, '2022-04-11', '2022-04-15', NULL),
(6, '2022-07-25', '2022-06-05', NULL),
(7, '2022-07-18', '2022-07-29', NULL),
(8, '2022-12-27', '2022-12-31', NULL),
(9, '2022-04-19', '2022-04-25', NULL),
(10, '2022-12-27', '2022-12-31', NULL),
(11, '2022-04-11', '2022-04-18', NULL),
(12, '2022-07-18', '2022-07-29', NULL),
(13, '2022-12-27', '2022-01-07', NULL),
(15, '2022-04-18', '2022-04-22', NULL),
(16, '2022-07-18', '2022-07-29', NULL),
(17, '2022-12-27', '2021-12-31', NULL),
(18, '2022-04-18', '2022-04-22', NULL),
(19, '2022-07-04', '2022-07-22', NULL),
(20, '2021-12-27', '2021-12-31', NULL),
(21, '2022-04-15', '2022-04-22', NULL),
(22, '2022-07-11', '2022-07-22', NULL),
(23, '2021-12-27', '2021-12-31', NULL),
(24, '2022-04-11', '2022-04-24', NULL),
(25, '2022-07-18', '2022-07-31', NULL),
(26, '2021-12-27', '2021-12-31', NULL),
(27, '2022-04-18', '2022-04-25', NULL),
(28, '2022-07-18', '2022-07-29', NULL),
(29, '2021-12-27', '2022-01-03', NULL),
(30, '2022-04-18', '2022-04-22', NULL),
(31, '2022-07-18', '2022-07-29', NULL),
(32, '2021-12-27', '2021-12-31', NULL),
(33, '2022-04-18', '2022-04-22', NULL),
(34, '2022-07-15', '2022-07-31', NULL),
(35, '2022-04-14', '2022-04-14', NULL),
(45, '2021-12-27', '2021-12-31', NULL),
(46, '2022-07-18', '2022-07-29', NULL),
(47, '2022-10-17', '2022-10-28', NULL),
(49, '2021-12-12', '2021-12-17', NULL),
(50, '2021-12-17', '2021-12-17', NULL),
(51, '2021-12-17', '2021-12-17', NULL),
(57, '2022-02-21', '2022-02-25', NULL),
(58, '2022-04-18', '2022-04-22', NULL),
(59, '2022-07-04', '2022-07-15', NULL),
(60, '2022-04-11', '2022-04-15', NULL),
(61, '2022-07-18', '2022-07-29', NULL),
(63, '2022-05-02', '2022-05-09', NULL),
(64, '2022-03-14', '2022-03-17', NULL),
(67, '2022-01-31', '2022-02-04', NULL),
(68, '2022-02-21', '2022-02-25', NULL),
(69, '2022-03-28', '2022-04-01', NULL),
(70, '2022-04-04', '2022-04-08', NULL),
(71, '2022-04-14', '2022-04-14', NULL),
(72, '2022-04-21', '2022-04-22', NULL),
(74, '2022-07-18', '2022-08-05', NULL),
(75, '2022-05-16', '2022-05-27', NULL),
(81, '2022-07-20', '2022-07-29', NULL),
(82, '2022-09-05', '2022-09-09', NULL),
(83, '2022-08-11', '2022-10-02', NULL),
(84, '2023-01-16', '2023-02-17', NULL),
(85, '2023-03-01', '2023-03-31', NULL),
(87, '2023-07-10', '2023-07-20', NULL),
(88, '2023-07-10', '2023-07-21', 65),
(89, '2023-07-10', '2023-07-14', NULL),
(90, '2023-07-17', '2023-08-04', 62),
(91, '2023-08-07', '2023-08-18', 64),
(92, '2023-07-24', '2023-08-11', NULL),
(93, '2023-07-24', '2023-08-04', 69),
(94, '2023-07-31', '2023-08-11', 51),
(95, '2023-07-20', '2023-08-11', 66),
(96, '2023-07-21', '2023-07-31', 76),
(97, '2023-07-10', '2023-07-14', 64),
(98, '2023-07-17', '2023-08-11', NULL),
(99, '2023-07-28', '2023-08-13', NULL),
(100, '2023-07-17', '2023-08-01', 89),
(101, '2023-08-01', '2023-08-13', 90),
(102, '2023-08-28', '2023-10-02', 94),
(103, '2023-10-09', '2023-10-13', 69),
(104, '2023-09-22', '2023-09-22', 80),
(105, '2023-10-05', '2023-10-13', 80),
(106, '2023-10-02', '2023-10-13', 90),
(107, '2023-09-28', '2023-09-29', 80),
(108, '2023-12-25', '2023-12-29', 90),
(109, '2023-12-25', '2023-12-29', 80),
(110, '2023-09-25', '2023-09-27', 80),
(111, '2023-10-28', '2024-07-31', 94),
(112, '2023-12-23', '2024-01-02', 80),
(113, '2024-01-01', '2024-01-31', NULL),
(114, '2024-02-05', '2024-02-09', 90),
(115, '2024-04-01', '2024-04-06', 80);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `group_task`
--
ALTER TABLE `group_task`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_18ba3a510a57e886d7f55b3057b27684eb2e9690` (`group_id`,`task_id`),
  ADD KEY `index_foreignkey_group_task_group` (`group_id`),
  ADD KEY `index_foreignkey_group_task_task` (`task_id`);

--
-- Indexes for table `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tasked`
--
ALTER TABLE `tasked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_tasked_user` (`user_id`),
  ADD KEY `index_foreignkey_tasked_task` (`task_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_user_group` (`group_id`);

--
-- Indexes for table `vacation`
--
ALTER TABLE `vacation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_vacation_user` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `group_task`
--
ALTER TABLE `group_task`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=82;

--
-- AUTO_INCREMENT for table `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tasked`
--
ALTER TABLE `tasked`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19855;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=128;

--
-- AUTO_INCREMENT for table `vacation`
--
ALTER TABLE `vacation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=116;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `group_task`
--
ALTER TABLE `group_task`
  ADD CONSTRAINT `c_fk_group_task_group_id` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_fk_group_task_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `tasked`
--
ALTER TABLE `tasked`
  ADD CONSTRAINT `c_fk_tasked_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_tasked_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `c_fk_user_group_id` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints for table `vacation`
--
ALTER TABLE `vacation`
  ADD CONSTRAINT `c_fk_vacation_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
