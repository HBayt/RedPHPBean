-- phpMyAdmin SQL Dump
-- Host: localhost:3306

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";
-- Database: `taskmanager`

-- --------------------------------------------------------
-- --------------------------------------------------------

-- Table structure for table `user`
DROP TABLE IF EXISTS addressee;
CREATE TABLE `addressee` ( `id` int(11) UNSIGNED NOT NULL,  `name` varchar(191) DEFAULT NULL,  `email` varchar(191) DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;


-- Dumping data for table `addressee`
INSERT INTO addressee (id, email, name) VALUES
(1, 'raphael.crivelli@battenberg.ch', 'Raphael CRIVELLI'), 
(2, 'robin.gottardo@battenberg.ch','Robin GOTTARDO'),
(3, 'andy.linder@battenberg.ch','Andy LINDER'), 
(4, 'Richard.Grandgirard@battenberg.ch','Richard Grandgirard'),
(5, 'Adriana.Aniello@battenberg.ch','Adriana Aniello'), 
(6, 'mohamed.ibrahim@battenberg.ch','Mohamed Ibrahim'),
(7, 'Quentin.Keller@battenberg.ch', 'Quentin Keller'), 
(8, 'corinne.stotzer@battenberg.ch','Corinne Stotzer'),
(9, 'stefanie.hostettler@battenberg.ch','Stefanie Hostettler'), 
(10, 'sylvia.baelli@battenberg.ch','Sylvia Bälli'),
(11, 'monika.vonaesch@battenberg.ch','Monika von Aesch'), 
(12, 'elisabeth.ruckstuhl@battenberg.ch','Elisabeth Ruckstuhl'),
(13, 'frank.krumm@battenberg.ch','Frank Krumm'), 
(14, 'dalai.wenger@battenberg.ch','Dalai Wenger'),
(15, 'chloe.kessi@battenberg.ch','Chloe Kessi');


INSERT INTO `addressee`(`name`, `email`) VALUES ('halide BAY','hb@gmail.com'); 
INSERT INTO `addressee`(`name`, `email`) VALUES ('Home BAC','hb2@gmail.com'); 

-- --------------------------------------------------------

-- Indexes (PK)  & AUTO_INCREMENT for table `addressee`
ALTER TABLE `addressee` ADD PRIMARY KEY (`id`);
ALTER TABLE `addressee` MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;


-- --------------------------------------------------------
-- --------------------------------------------------------

/* 

-- Table structure for table `mail`
CREATE TABLE `mail` ( `id` int(11) UNSIGNED NOT NULL, `text` text DEFAULT NULL) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `mail`
INSERT INTO `mail` (`id`, `text`) VALUES
(1, '<p>Aujourd\'hui, le /date , vous &ecirc;tes pri&eacute;s de r&eacute;aliser la t&acirc;che suivante: /name</p>\r\n<p>Visitez http://task-manager pour avoir acc&egrave;s &agrave; la planification compl&egrave;te.</p>\r\n<p>Merci beaucoup et meilleures salutations</p>\r\n<p>-----------------------------------------------------------------------------------------------------------------</p>\r\n<p>Heute am /date sind mit der Aufgabe /name an der Reihe</p>\r\n<p>Die Planung koennen Sie unter http://task-manager einsehen.</p>\r\n<p>Vielen Dank und freundliche Gruesse</p>\r\n<p>&nbsp;</p>\r\n<p>&nbsp;</p>');

-- Indexes (PK)  & AUTO_INCREMENT for table `mail`
ALTER TABLE `mail` ADD PRIMARY KEY (`id`);
ALTER TABLE `mail` MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;


*/ 