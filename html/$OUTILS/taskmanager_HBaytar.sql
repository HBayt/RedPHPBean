-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 15. Jul 2024 um 08:40
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `taskmanager`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `addressee`
--

CREATE TABLE `addressee` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `email` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `addressee`
--

INSERT INTO `addressee` (`id`, `name`, `email`) VALUES
(1, 'Raphael CRIVELLI', 'raphael.crivelli@battenberg.ch'),
(2, 'Robin GOTTARDO', 'robin.gottardo@battenberg.ch'),
(3, 'Andy LINDER', 'andy.linder@battenberg.ch'),
(4, 'Richard Grandgirard', 'Richard.Grandgirard@battenberg.ch'),
(5, 'Adriana Aniello', 'Adriana.Aniello@battenberg.ch'),
(6, 'Mohamed Ibrahim', 'mohamed.ibrahim@battenberg.ch'),
(7, 'Quentin Keller', 'Quentin.Keller@battenberg.ch'),
(8, 'Corinne Stotzer', 'corinne.stotzer@battenberg.ch'),
(9, 'Stefanie Hostettler', 'stefanie.hostettler@battenberg.ch'),
(10, 'Sylvia Bälli', 'sylvia.baelli@battenberg.ch'),
(11, 'Monika von Aesch', 'monika.vonaesch@battenberg.ch'),
(12, 'Elisabeth Ruckstuhl', 'elisabeth.ruckstuhl@battenberg.ch'),
(13, 'Frank Krumm', 'frank.krumm@battenberg.ch'),
(14, 'Dalai Wenger', 'dalai.wenger@battenberg.ch'),
(15, 'Chloe Kessi', 'chloe.kessi@battenberg.ch'),
(16, 'HGmail', 'halide.baytar@gmail.com'),
(19, 'Batten_HB ', 'halide.baytar@battenberg.ch'),
(21, 'user utilisateur', 'utilisateur@gmail.com');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `admin`
--

CREATE TABLE `admin` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `password` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`) VALUES
(1, 'admin', '$2y$10$qF8aCBhIJ8lu/Yn4l2NO5uenTLMl4catol552h/Wqxedp.jQXx3PK'),
(4, 'mediadesign', '$2y$10$TsxwYf4jDxUoXBc0vRVEPuqISt54xmN8UyIiyddYdI/OnjLATX8QO'),
(5, 'developpeur', '$2y$10$22hBYNRRFiJ7f.lTHqlk7.peDfO05pqZoP26y.YyrfQzBnwAbFuCK');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `group`
--

CREATE TABLE `group` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `group`
--

INSERT INTO `group` (`id`, `name`) VALUES
(4, 'Informatik'),
(6, 'MediaDesign'),
(7, 'Verwaltung'),
(8, 'Administration');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `group_task`
--

CREATE TABLE `group_task` (
  `id` int(11) UNSIGNED NOT NULL,
  `group_id` int(11) UNSIGNED DEFAULT NULL,
  `task_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `group_task`
--

INSERT INTO `group_task` (`id`, `group_id`, `task_id`) VALUES
(131, 4, 16),
(70, 4, 17),
(74, 4, 21),
(132, 6, 16),
(75, 6, 18),
(76, 6, 22),
(133, 7, 16),
(81, 7, 19),
(79, 7, 20),
(123, 7, 27);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mail`
--

CREATE TABLE `mail` (
  `id` int(11) UNSIGNED NOT NULL,
  `text` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `mail`
--

INSERT INTO `mail` (`id`, `text`) VALUES
(1, '<p>Aujourd\'hui, le /date , vous êtes priés de réaliser la tâche suivante: /name</p>\r\n<p>Visitez SVP http://task-manager pour avoir accès à la planification complète.</p>\r\n<p>Merci beaucoup et meilleures salutations</p>\r\n<p>-----------------------------------------------------------------------------------------------------------------</p>\r\n<p>Heute am /date sind mit der Aufgabe /name an der Reihe</p>\r\n<p>Die Planung koennen Sie unter http://task-manager einsehen.</p>\r\n<p>Vielen Dank und freundliche Gruesse</p>\r\n<p> </p>\r\n<p> </p>');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `task`
--

CREATE TABLE `task` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(191) DEFAULT NULL,
  `weekdays` varchar(191) DEFAULT NULL,
  `color` varchar(191) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `task`
--

INSERT INTO `task` (`id`, `name`, `weekdays`, `color`) VALUES
(16, 'Cafeterias', '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]', '#1015e3ff'),
(17, 'Staubsauger / Aspirateur INF', '[\"Wednesday\"]', '#15d0ffff'),
(18, 'Müll / Déchets MDE', '[\"Friday\"]', '#ff0000ff'),
(19, 'Müll, Shredder, Altpapier / Déchets, Déchiqueteuse, Vieux papier VER', '[\"Friday\"]', '#34613aff'),
(20, 'Staubsauger / Aspirateur VER', '[\"Wednesday\"]', '#20ed2aff'),
(21, 'Müll / Déchets INF', '[\"Wednesday\"]', '#ff00ecff'),
(22, 'Staubsauger / Aspirateur MDE', '[\"Friday\"]', '#ffaa00ff'),
(27, ' Kühlschrank / Frigo ', '[\"Friday\"]', 'violet');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `tasked`
--

CREATE TABLE `tasked` (
  `id` int(11) UNSIGNED NOT NULL,
  `title` varchar(191) DEFAULT NULL,
  `start` datetime DEFAULT NULL,
  `done_task` int(11) DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL,
  `task_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `tasked`
--

INSERT INTO `tasked` (`id`, `title`, `start`, `done_task`, `user_id`, `task_id`) VALUES
(1, 'Bruno Zucchetti', '2024-07-10 00:00:00', NULL, 101, 16),
(2, 'Andrija Draca', '2024-07-10 00:00:00', NULL, 121, 17),
(3, 'Maricarmen Wyser', '2024-07-10 00:00:00', NULL, 43, 20),
(4, 'Kim Feyer', '2024-07-10 00:00:00', NULL, 122, 21),
(5, 'xy', '2024-07-11 00:00:00', NULL, 79, 16),
(6, 'Jean gaetan', '2024-07-12 00:00:00', NULL, 2, 16),
(7, 'Sam Mpendubundi ', '2024-07-12 00:00:00', NULL, 100, 18),
(8, 'Lisa Blumenthal', '2024-07-12 00:00:00', NULL, 90, 19),
(9, 'Killian Vallat', '2024-07-12 00:00:00', NULL, 110, 22),
(10, 'Leonora Trena', '2024-07-12 00:00:00', NULL, 126, 27),
(11, 'Diogo Da Silva', '2024-07-15 00:00:00', NULL, 95, 16),
(12, 'Ariana Grzyb', '2024-07-16 00:00:00', NULL, 102, 16),
(13, 'Ariana Grzyb', '2024-07-17 00:00:00', NULL, 102, 16),
(14, 'Battenberg SF2024', '2024-07-17 00:00:00', NULL, 135, 17),
(15, 'Lisa Blumenthal', '2024-07-17 00:00:00', NULL, 90, 20),
(16, 'HB2018', '2024-07-17 00:00:00', NULL, 147, 21),
(17, 'Kim Feyer', '2024-07-18 00:00:00', NULL, 122, 16),
(18, 'Nevio Romano', '2024-07-19 00:00:00', NULL, 123, 16),
(19, 'Keenan Thurnes', '2024-07-19 00:00:00', NULL, 65, 18),
(20, 'Ariana Grzyb', '2024-07-19 00:00:00', NULL, 102, 19),
(21, 'Nicolas Savoy', '2024-07-19 00:00:00', NULL, 64, 22),
(22, 'Leonora Trena', '2024-07-19 00:00:00', NULL, 126, 27),
(23, 'Diogo Da Silva', '2024-07-22 00:00:00', NULL, 95, 16),
(24, 'Thibault Blaser', '2024-07-23 00:00:00', NULL, 35, 16),
(25, 'Alex Salesse', '2024-07-24 00:00:00', NULL, 51, 16),
(26, 'Aaron Bless', '2024-07-24 00:00:00', NULL, 120, 17),
(27, 'Livio Vogt', '2024-07-24 00:00:00', NULL, 87, 20),
(28, 'Janick Baumann', '2024-07-24 00:00:00', NULL, 117, 21),
(29, 'Gabriel Duarte', '2024-07-25 00:00:00', NULL, 96, 16),
(30, 'Lisa Blumenthal', '2024-07-26 00:00:00', NULL, 90, 16),
(31, 'Noé Serravezza', '2024-07-26 00:00:00', NULL, 62, 18),
(32, 'Julian Schwaar', '2024-07-26 00:00:00', NULL, 80, 19),
(33, 'Sandy Nussbaumer', '2024-07-26 00:00:00', NULL, 44, 22),
(34, 'Darlyn Hernandez', '2024-07-26 00:00:00', NULL, 88, 27),
(35, 'Gabriel Duarte', '2024-07-29 00:00:00', NULL, 96, 16),
(36, 'Diogo Da Silva', '2024-07-30 00:00:00', NULL, 95, 16),
(37, 'Lisa Blumenthal', '2024-07-31 00:00:00', NULL, 90, 16),
(38, 'Kim Feyer', '2024-07-31 00:00:00', NULL, 122, 17),
(39, 'Lisa Blumenthal', '2024-07-31 00:00:00', NULL, 90, 20),
(40, 'Nevio Romano', '2024-07-31 00:00:00', NULL, 123, 21),
(41, 'Gabriel Duarte', '2024-08-01 00:00:00', NULL, 96, 16),
(42, 'Nevio Romano', '2024-08-02 00:00:00', NULL, 123, 16),
(43, 'Gabriel Duarte', '2024-08-02 00:00:00', NULL, 96, 18),
(44, 'Ariana Grzyb', '2024-08-02 00:00:00', NULL, 102, 19),
(45, 'xy', '2024-08-02 00:00:00', NULL, 79, 22),
(46, 'Gracia Kamwanya Kamunga', '2024-08-02 00:00:00', NULL, 112, 27),
(47, 'Pereira Jessica', '2024-08-05 00:00:00', NULL, 127, 16),
(48, 'Aaron Soltermann', '2024-08-06 00:00:00', NULL, 94, 16),
(49, 'Gabriel Duarte', '2024-08-07 00:00:00', NULL, 96, 16),
(50, 'Amin Arslani', '2024-08-07 00:00:00', NULL, 119, 17),
(51, 'Aaron Soltermann', '2024-08-07 00:00:00', NULL, 94, 20),
(52, 'Kevin Locher', '2024-08-07 00:00:00', NULL, 118, 21),
(53, 'Bruno Zucchetti', '2024-08-08 00:00:00', NULL, 101, 16),
(54, 'Keenan Thurnes', '2024-08-09 00:00:00', NULL, 65, 16),
(55, 'Keenan Thurnes', '2024-08-09 00:00:00', NULL, 65, 18),
(56, 'Lisa Blumenthal', '2024-08-09 00:00:00', NULL, 90, 19),
(57, 'Sandy Nussbaumer', '2024-08-09 00:00:00', NULL, 44, 22),
(58, 'Aaron Soltermann', '2024-08-09 00:00:00', NULL, 94, 27);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
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
-- Daten für Tabelle `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `done_task`, `group_id`, `weekdays`) VALUES
(1, 'Ramon Odermatt', 'ramon.odermatt.ged@gmail.com', 0, 4, '[\"Monday\",\"Tuesday\"]'),
(2, 'Jean gaetan', 'ramon.odermatt.ged@gmail.com', 0, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(33, 'Grace Rudolph', 'grace.rudolf@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\"]'),
(34, 'Dejan Simonovski', 'dejan.simonovski@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\"]'),
(35, 'Thibault Blaser', 'thibault.blaser@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\",\"Friday\"]'),
(36, 'Nora Räber', 'nora.raeber@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\"]'),
(37, 'Martina Vögeli', 'martina.voegeli@battenberg.ch', 0, 8, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(38, 'Myriam Salesse', 'myriam.salesse@battenberg.ch', 0, 8, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(39, 'Sael Ngolla', 'sael.ngolla@battenberg.ch', 0, 8, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(40, 'Timo Blum', 'timo.blum@battenberg.ch', 0, 8, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(41, 'Enzo Marazzato', 'enzo.marazzato@battenberg.ch', 0, 8, '[\"Monday\",\"Tuesday\",\"Friday\"]'),
(42, 'Dominique Zuber', 'dominique.zuber@battenberg.ch', 0, 7, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(43, 'Maricarmen Wyser', 'maricarmen.wyser@battenberg.ch', 0, 7, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(44, 'Sandy Nussbaumer', 'sandy.nussbaumer@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Friday\"]'),
(51, 'Alex Salesse', 'myriam.salesse@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(62, 'Noé Serravezza', 'Noe.Serravezza@battenberg.ch', 0, 6, '[\"Monday\",\"Wednesday\",\"Friday\"]'),
(64, 'Nicolas Savoy', 'nicolas.savoy@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Friday\"]'),
(65, 'Keenan Thurnes', 'keenan.thurnes@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Friday\"]'),
(66, 'Rafael Marques', 'rafael.marques@battenberg.ch', 0, 6, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(69, 'Gabriel Fasel', 'gabriel.fasel@battenberg.ch', 0, 6, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(76, 'Lionel Hofer', 'Lionel.Hofer@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(79, 'xy', 'xyy@bblabla.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(80, 'Julian Schwaar', 'julian.schwaar@battenberg.ch', 0, 7, '[\"Wednesday\",\"Thursday\",\"Friday\"]'),
(87, 'Livio Vogt', 'livio.vogt@battenberg.ch', 0, 7, '[\"Tuesday\",\"Wednesday\",\"Thursday\"]'),
(88, 'Darlyn Hernandez', 'darlyn.hernandez@battenberg.ch', 0, 7, '[\"Friday\"]'),
(89, 'Mara Meier', 'mara.meier@battenberg.ch', 0, 7, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(90, 'Lisa Blumenthal', 'lisa.blumenthal@battenberg.ch', 0, 7, '[\"Wednesday\",\"Thursday\",\"Friday\"]'),
(94, 'Aaron Soltermann', 'aaron.soltermann@battenberg.ch', 0, 7, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(95, 'Diogo Da Silva', 'Diogo.DaSilva@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Friday\"]'),
(96, 'Gabriel Duarte', 'gabriel.duarte@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(100, 'Sam Mpendubundi ', 'Sam.Mpendubundi@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(101, 'Bruno Zucchetti', 'Bruno.Zucchetti@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(102, 'Ariana Grzyb', 'ariana.grzyb@battenberg.ch', 0, 7, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(103, 'Cindy Dos Santos', 'Cindy.DosSantos@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\"]'),
(110, 'Killian Vallat', 'Killian.Vallat@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(112, 'Gracia Kamwanya Kamunga', 'gracia.kamwanyakamunga@battenberg.ch', 0, 7, '[\"Monday\",\"Tuesday\",\"Thursday\",\"Friday\"]'),
(114, 'Immanuel Studer', 'Immanuel.Studer@battenberg.ch', 0, 6, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(115, 'Jessy Jacot', 'Jessy.Jacot@battenberg.ch', 0, 6, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(116, 'Jannik Filardo', 'jannik.filardo@battenberg.ch', 0, 4, '[\"Tuesday\",\"Wednesday\",\"Thursday\"]'),
(117, 'Janick Baumann', 'janick.baumann@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\"]'),
(118, 'Kevin Locher', 'kevin.locher@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\"]'),
(119, 'Amin Arslani', 'amin.arslani@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(120, 'Aaron Bless', 'aaron.bless@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(121, 'Andrija Draca', 'andrija.draca@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\"]'),
(122, 'Kim Feyer', 'kim.feyer@battenberg.ch', 0, 4, '[\"Monday\",\"Wednesday\",\"Thursday\"]'),
(123, 'Nevio Romano', 'nevio.romano@battenberg.ch', 0, 4, '[\"Wednesday\",\"Thursday\",\"Friday\"]'),
(124, 'Victor Gashi', 'victor.gashi@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\"]'),
(125, 'Grittideth Watanakula', 'grittideth.watanakula@battenberg.ch', 0, 4, '[\"Monday\",\"Thursday\",\"Friday\"]'),
(126, 'Leonora Trena', 'leonora.trena@battenberg.ch', 0, 7, '[\"Friday\"]'),
(127, 'Pereira Jessica', 'jessica.pereira@battenberg.ch', 0, 7, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(128, 'Halide Baytar', 'halide.baytar@battenberg.ch', 0, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(135, 'Battenberg SF2024', 'battenberg.sf2024@gmail.com', 0, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(147, 'HB2018', 'halide.baytar2018@gmail.com', 0, 4, '[\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]'),
(148, 'GMAIL HB2024', 'halide.baytar@gmail.com', 0, 4, '[\"Monday\",\"Tuesday\",\"Wednesday\",\"Thursday\",\"Friday\"]');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `vacation`
--

CREATE TABLE `vacation` (
  `id` int(11) UNSIGNED NOT NULL,
  `start` date DEFAULT NULL,
  `end` date DEFAULT NULL,
  `user_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Daten für Tabelle `vacation`
--

INSERT INTO `vacation` (`id`, `start`, `end`, `user_id`) VALUES
(88, '2023-07-10', '2023-07-21', 65),
(90, '2023-07-17', '2023-08-04', 62),
(91, '2023-08-07', '2023-08-18', NULL),
(93, '2023-07-24', '2023-08-04', 69),
(94, '2023-07-31', '2023-08-11', 51),
(95, '2023-07-20', '2023-08-11', 66),
(96, '2023-07-21', '2023-07-31', 76),
(97, '2023-08-10', '2023-08-14', NULL),
(100, '2023-07-17', '2023-08-01', 89),
(101, '2023-08-01', '2023-08-13', 90),
(102, '2024-08-28', '2024-10-02', 94),
(103, '2023-10-09', '2023-10-13', 69),
(104, '2023-09-22', '2023-09-22', 80),
(105, '2023-10-05', '2023-10-13', 80),
(106, '2023-10-02', '2023-10-13', 90),
(107, '2023-09-28', '2023-09-29', 80),
(108, '2023-12-25', '2023-12-29', 90),
(109, '2023-12-25', '2023-12-29', 80),
(110, '2023-09-25', '2023-09-27', 80),
(111, '2024-10-28', '2024-10-31', 94),
(112, '2023-12-23', '2024-01-02', 80),
(114, '2024-02-05', '2024-02-09', 90),
(115, '2024-04-01', '2024-04-06', 80),
(123, '2027-11-30', '2028-11-30', 128),
(132, '2024-06-15', '2024-06-15', 66),
(136, '2024-09-01', '2024-09-08', NULL),
(140, '2024-06-30', '2024-06-30', 80),
(141, '2024-06-30', '2024-06-30', 76),
(142, '2024-05-04', '2024-05-04', 90),
(144, '2024-06-30', '2024-06-30', 89),
(148, '2024-06-25', '2024-06-25', 66),
(149, '2024-06-03', '2024-06-11', 147),
(163, '2024-08-01', '2024-08-01', 147),
(164, '2023-06-08', '2023-07-08', 128),
(166, '2043-06-01', '2043-06-10', 80),
(167, '2033-06-01', '2033-06-01', 80),
(168, '2024-07-07', '2024-07-07', 128),
(173, '2024-07-08', '2024-07-09', 147),
(193, '2024-07-24', '2024-07-28', NULL),
(196, '2024-07-30', '2024-07-30', 147),
(197, '2024-08-01', '2024-07-01', 147),
(198, '2024-09-01', '2024-09-02', 147);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `addressee`
--
ALTER TABLE `addressee`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `group`
--
ALTER TABLE `group`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `group_task`
--
ALTER TABLE `group_task`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UQ_18ba3a510a57e886d7f55b3057b27684eb2e9690` (`group_id`,`task_id`),
  ADD KEY `index_foreignkey_group_task_group` (`group_id`),
  ADD KEY `index_foreignkey_group_task_task` (`task_id`);

--
-- Indizes für die Tabelle `mail`
--
ALTER TABLE `mail`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `task`
--
ALTER TABLE `task`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `tasked`
--
ALTER TABLE `tasked`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_tasked_user` (`user_id`),
  ADD KEY `index_foreignkey_tasked_task` (`task_id`);

--
-- Indizes für die Tabelle `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_user_group` (`group_id`);

--
-- Indizes für die Tabelle `vacation`
--
ALTER TABLE `vacation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `index_foreignkey_vacation_user` (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `addressee`
--
ALTER TABLE `addressee`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT für Tabelle `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT für Tabelle `group`
--
ALTER TABLE `group`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT für Tabelle `group_task`
--
ALTER TABLE `group_task`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=137;

--
-- AUTO_INCREMENT für Tabelle `mail`
--
ALTER TABLE `mail`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT für Tabelle `task`
--
ALTER TABLE `task`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT für Tabelle `tasked`
--
ALTER TABLE `tasked`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT für Tabelle `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT für Tabelle `vacation`
--
ALTER TABLE `vacation`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `group_task`
--
ALTER TABLE `group_task`
  ADD CONSTRAINT `c_fk_group_task_group_id` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `c_fk_group_task_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints der Tabelle `tasked`
--
ALTER TABLE `tasked`
  ADD CONSTRAINT `c_fk_tasked_task_id` FOREIGN KEY (`task_id`) REFERENCES `task` (`id`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `c_fk_tasked_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints der Tabelle `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `c_fk_user_group_id` FOREIGN KEY (`group_id`) REFERENCES `group` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Constraints der Tabelle `vacation`
--
ALTER TABLE `vacation`
  ADD CONSTRAINT `c_fk_vacation_user_id` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
