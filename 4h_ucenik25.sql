-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 26, 2021 at 12:12 PM
-- Server version: 8.0.19
-- PHP Version: 7.4.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `4h_ucenik25`
--

-- --------------------------------------------------------

--
-- Table structure for table `fotografija`
--

CREATE TABLE `fotografija` (
  `id_fotografije` int NOT NULL,
  `naslov` varchar(50) COLLATE utf8_bin NOT NULL,
  `opis` varchar(50) COLLATE utf8_bin NOT NULL,
  `url` varchar(200) COLLATE utf8_bin NOT NULL,
  `id_korisnika` int NOT NULL,
  `id_kategorije` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `fotografija`
--

INSERT INTO `fotografija` (`id_fotografije`, `naslov`, `opis`, `url`, `id_korisnika`, `id_kategorije`) VALUES
(1, 'Bella', 'moj pas Bella', 'images/fotografije/bella.jpg', 4, 6),
(2, 'Čevo', 'planina Čevo', 'images/fotografije/cevo.jpg', 4, 3),
(3, 'Cvijet', 'cvijet na grani', 'images/fotografije/cvijet.jpg', 3, 4),
(4, 'Deva', 'deva', 'images/fotografije/deva.jpg', 5, 6),
(5, 'Zidine 2', 'zidine grada Dubrovnika', 'images/fotografije/du.jpg', 5, 2),
(6, 'Game of thrones', 'mjesto gdje se snimala poznata serija', 'images/fotografije/gameofthrones.jpg', 2, 2),
(7, 'Koliba', 'koliba u šumi', 'images/fotografije/kuca.jpg', 3, 4),
(8, 'monkey', 'darivanje ljudi', 'images/fotografije/dar.jpg', 1, 6),
(9, 'Planine', 'slika plaina iz daljine ', 'images/fotografije/planine.jpg', 4, 3),
(10, 'Polje', 'polje u b&w', 'images/fotografije/crnobijelo.jpg', 1, 1),
(11, 'Zgrada u Rijeci', 'grafit na zgradi', 'images/fotografije/rijekaart.jpg', 1, 5),
(12, 'Ulica', 'ulica u Rijeci po noći', 'images/fotografije/rijekanoc.jpg', 1, 5),
(13, 'Pecine', 'kupalište Pečine u rijeci', 'images/fotografije/ripecine.jpg', 1, 5),
(14, 'Riječina', 'zalazak sunca', 'images/fotografije/rijeka.jpg', 1, 5),
(15, 'Sijeno', 'bala sijena', 'images/fotografije/sijeno.jpg', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `grupa_korisnika`
--

CREATE TABLE `grupa_korisnika` (
  `id_grupe` int NOT NULL,
  `naziv_grupe` varchar(20) COLLATE utf8_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `grupa_korisnika`
--

INSERT INTO `grupa_korisnika` (`id_grupe`, `naziv_grupe`) VALUES
(1, 'Administrator'),
(2, 'Moderator'),
(3, 'Korisnik');

-- --------------------------------------------------------

--
-- Table structure for table `kategorija`
--

CREATE TABLE `kategorija` (
  `id_kategorije` int NOT NULL,
  `ime_kategorije` varchar(30) COLLATE utf8_bin NOT NULL,
  `slika_kategorije` varchar(200) COLLATE utf8_bin NOT NULL,
  `id_korisnika` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `kategorija`
--

INSERT INTO `kategorija` (`id_kategorije`, `ime_kategorije`, `slika_kategorije`, `id_korisnika`) VALUES
(1, 'B&W', 'images/kategorije/poljebw.jpg', 2),
(2, 'Dubrovnik', 'images/kategorije/dubrovnik.jpg', 3),
(3, 'Planine', 'images/kategorije/planine.jpg', 3),
(4, 'Priroda', 'images/kategorije/priroda.jpg', 2),
(5, 'Rijeka', 'images/kategorije/rizalazak.jpg', 2),
(6, 'Životinje', 'images/kategorije/bella.jpg', 9),
(8, 'test', 'images/kategorije/Screenshot_2021-05-03_15-51-36.png', 2);

-- --------------------------------------------------------

--
-- Table structure for table `komentar`
--

CREATE TABLE `komentar` (
  `id_komentara` int NOT NULL,
  `ocjena` int NOT NULL,
  `komentar` varchar(200) COLLATE utf8_bin NOT NULL,
  `id_fotografije` int NOT NULL,
  `id_korisnika` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `komentar`
--

INSERT INTO `komentar` (`id_komentara`, `ocjena`, `komentar`, `id_fotografije`, `id_korisnika`) VALUES
(1, 3, 'Ok!', 1, 3),
(2, 5, 'Predivno', 2, 4),
(3, 4, 'Okej!', 3, 5),
(4, 4, 'Deve su presuper', 4, 2),
(5, 5, 'Wow bas je super', 5, 5),
(6, 4, 'Predivan zalazak', 14, 2),
(7, 5, 'Gdje je to?', 7, 5),
(8, 5, 'Super', 8, 5),
(10, 5, 'Preslatka je ^^', 1, 4),
(14, 4, 'predivno', 5, 1),
(16, 3, 'Test', 8, 1),
(17, 5, 'lijepo je', 5, 1),
(18, 2, 'f', 5, 1),
(19, 2, 'h', 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `korisnik`
--

CREATE TABLE `korisnik` (
  `id_korisnika` int NOT NULL,
  `korisnicko_ime` varchar(30) COLLATE utf8_bin NOT NULL,
  `lozinka` varchar(32) COLLATE utf8_bin NOT NULL,
  `ime_prezime` varchar(50) COLLATE utf8_bin NOT NULL,
  `email` varchar(200) COLLATE utf8_bin NOT NULL,
  `adresa` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `broj_mobitela` int DEFAULT NULL,
  `slika_profila` varchar(200) COLLATE utf8_bin DEFAULT NULL,
  `id_grupe` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Dumping data for table `korisnik`
--

INSERT INTO `korisnik` (`id_korisnika`, `korisnicko_ime`, `lozinka`, `ime_prezime`, `email`, `adresa`, `broj_mobitela`, `slika_profila`, `id_grupe`) VALUES
(1, 'admin', '40ce25363485f06bac9e7861db46e09c', 'Ivo Ivić', 'admin@gmail.com', NULL, NULL, 'images/korisnici/ivo.jpg', 1),
(2, 'moderator1', '9e9d1ba9f78ad3b7871099944a1d56a5', 'Tomo Tomić', 'tomo@gmail.com', 'Ulica Kralja Tomislava 15', 987585215, 'images/korisnici/moderator1.jpg', 2),
(3, 'moderator2', '43e341a57b610035a5b6f1adeecca5e1', 'Marta Martić', 'marta@gmail.com', 'Ulica Bana Jelačića 23', NULL, 'images/korisnici/moderator2.jpg', 2),
(4, 'ana', '38107303966b78ae457d3b5af233a9b6', 'Ana Jelić', 'ana@gmail.com', NULL, NULL, 'images/korisnici/ana.jpg', 3),
(5, 'luka', '38107303966b78ae457d3b5af233a9b6', 'Luka Lukić', 'luka@gmail.com', NULL, 998475212, 'images/korisnici/luka.jpg', 3),
(8, 'a', '0cc175b9c0f1b6a831c399e269772661', 'a', 'a', NULL, 481231, 'images/fotografije/55.jpg', 2),
(9, 'c', '4a8a08f09d37b73795649038408b5f33', 'c', 'c', 'c', 8888, 'images/fotografije/4234.jpg', 2);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `fotografija`
--
ALTER TABLE `fotografija`
  ADD PRIMARY KEY (`id_fotografije`),
  ADD UNIQUE KEY `naslov` (`naslov`),
  ADD UNIQUE KEY `opis` (`opis`),
  ADD UNIQUE KEY `url` (`url`),
  ADD KEY `id_korisnika_inx` (`id_korisnika`),
  ADD KEY `id_kategorije_inx` (`id_kategorije`);

--
-- Indexes for table `grupa_korisnika`
--
ALTER TABLE `grupa_korisnika`
  ADD PRIMARY KEY (`id_grupe`);

--
-- Indexes for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD PRIMARY KEY (`id_kategorije`),
  ADD UNIQUE KEY `ime_kategorije` (`ime_kategorije`),
  ADD UNIQUE KEY `slika_kategorije` (`slika_kategorije`),
  ADD KEY `id_korisnika_inx` (`id_korisnika`);

--
-- Indexes for table `komentar`
--
ALTER TABLE `komentar`
  ADD PRIMARY KEY (`id_komentara`),
  ADD KEY `id_fotografije_inx` (`id_fotografije`),
  ADD KEY `id_korisnika_inx` (`id_korisnika`);

--
-- Indexes for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD PRIMARY KEY (`id_korisnika`),
  ADD UNIQUE KEY `korisnicko_ime` (`korisnicko_ime`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `broj_mobitela` (`broj_mobitela`),
  ADD UNIQUE KEY `slika_profila` (`slika_profila`),
  ADD KEY `id_grupe_inx` (`id_grupe`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `fotografija`
--
ALTER TABLE `fotografija`
  MODIFY `id_fotografije` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `grupa_korisnika`
--
ALTER TABLE `grupa_korisnika`
  MODIFY `id_grupe` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `kategorija`
--
ALTER TABLE `kategorija`
  MODIFY `id_kategorije` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `komentar`
--
ALTER TABLE `komentar`
  MODIFY `id_komentara` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `korisnik`
--
ALTER TABLE `korisnik`
  MODIFY `id_korisnika` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `fotografija`
--
ALTER TABLE `fotografija`
  ADD CONSTRAINT `fotografija_ibfk_1` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fotografija_ibfk_2` FOREIGN KEY (`id_kategorije`) REFERENCES `kategorija` (`id_kategorije`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `kategorija`
--
ALTER TABLE `kategorija`
  ADD CONSTRAINT `kategorija_ibfk_1` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `komentar`
--
ALTER TABLE `komentar`
  ADD CONSTRAINT `komentar_ibfk_1` FOREIGN KEY (`id_fotografije`) REFERENCES `fotografija` (`id_fotografije`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `komentar_ibfk_2` FOREIGN KEY (`id_korisnika`) REFERENCES `korisnik` (`id_korisnika`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `korisnik`
--
ALTER TABLE `korisnik`
  ADD CONSTRAINT `korisnik_ibfk_1` FOREIGN KEY (`id_grupe`) REFERENCES `grupa_korisnika` (`id_grupe`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
