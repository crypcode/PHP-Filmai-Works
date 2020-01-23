-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: 2020 m. Sau 22 d. 16:26
-- Server version: 10.1.38-MariaDB
-- PHP Version: 7.3.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `filmai`
--

-- --------------------------------------------------------

--
-- Sukurta duomenų struktūra lentelei `filmaitable`
--

CREATE TABLE `filmaitable` (
  `id` int(11) NOT NULL,
  `pavadinimas` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aprasymas` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `metai` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rezisierius` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `imdb` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL,
  `genre_id` varchar(45) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Sukurta duomenų kopija lentelei `filmaitable`
--

INSERT INTO `filmaitable` (`id`, `pavadinimas`, `aprasymas`, `metai`, `rezisierius`, `imdb`, `genre_id`) VALUES
(1, 'Titanikas', 'Filmas apie laiva su bug\'u', '2000', 'Cameron', '7', '2'),
(2, 'GIMTINĖ', 'Iš Amerikos į gimtinę Viktorija grįžta iškart po to, kai Lietuva atgauna nepriklausomybę. Savo šalį, kurioje praleido vaikystę, kurioje džiaugėsi ir mylėjo, ji nori parodyti už Atlanto gimusiam paaugl', '2018', 'kazkoksRezisierius', '8', '1'),
(3, 'Filmas apie draugyste', 'Filmas apie draugyste', NULL, 'kastentoks', '2.3', NULL),
(4, 'aprasymas tik aprasymas', 'aprasymas tik aprasymas', NULL, 'ggjdghjk', '5.4', NULL),
(5, 'aprasymas tik aprasymas', 'aprasymas tik aprasymas', 'metai', 'rezisierius', '6.0', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `filmaitable`
--
ALTER TABLE `filmaitable`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `filmaitable`
--
ALTER TABLE `filmaitable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
