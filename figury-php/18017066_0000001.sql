-- phpMyAdmin SQL Dump
-- version home.pl
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Czas wygenerowania: 05 Lip 2016, 21:42
-- Wersja serwera: 5.5.49-37.9-log
-- Wersja PHP: 5.2.17

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Baza danych: `18017066_0000001`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `aktualnosci`
--

CREATE TABLE IF NOT EXISTS `aktualnosci` (
  `ida` int(11) NOT NULL AUTO_INCREMENT,
  `tytul` varchar(30) DEFAULT NULL,
  `tresc` varchar(200) DEFAULT NULL,
  `odnosnik` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`ida`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin2 AUTO_INCREMENT=3 ;

--
-- Zrzut danych tabeli `aktualnosci`
--

INSERT INTO `aktualnosci` (`ida`, `tytul`, `tresc`, `odnosnik`) VALUES
(2, 'Zmiany', 'Zmieniliśmy nasz asortyment', 'produkty');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `figury`
--

CREATE TABLE IF NOT EXISTS `figury` (
  `NrKat` varchar(10) DEFAULT NULL,
  `Cena` decimal(6,2) DEFAULT NULL,
  `Wysokosc` int(11) DEFAULT NULL,
  `Waga` int(11) DEFAULT NULL,
  `Dodatkowe` varchar(200) DEFAULT NULL,
  `Zdjecie1` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin2;

--
-- Zrzut danych tabeli `figury`
--

INSERT INTO `figury` (`NrKat`, `Cena`, `Wysokosc`, `Waga`, `Dodatkowe`, `Zdjecie1`) VALUES
('don087', 210.00, 56, 60, '', 'obrazky/087.jpg'),
('don077', 120.00, 64, 32, '', 'obrazky/077.jpg'),
('don089', 110.00, 60, 26, '', 'obrazky/089.jpg'),
('don090', 125.00, 50, 36, 'fi 41cm', 'obrazky/090.jpg'),
('don098', 150.00, 65, 43, 'fi 39cm', 'obrazky/098.jpg'),
('don104', 170.00, 50, 47, 'fi 49cm', 'obrazky/104.jpg'),
('fon048', 800.00, 180, 200, '', 'obrazky/048.jpg'),
('fig022', 60.00, 26, 7, '', 'obrazky/022.jpg'),
('fig023', 150.00, 75, 44, '', 'obrazky/023.jpg'),
('fon66', 210.00, 96, 60, '', 'obrazky/066.jpg'),
('fon204', 90.00, 69, 20, '', 'obrazky/204.jpg'),
('fon27', 360.00, 84, 98, '', 'obrazky/027.jpg'),
('fig455', 210.00, 44, 60, '', 'obrazky/455.jpg'),
('fig130', 150.00, 56, 38, '', 'obrazky/130.jpg'),
('fig110', 70.00, 30, 15, '', 'obrazky/110.jpg'),
('fig70', 70.00, 41, 14, '', 'obrazky/70.jpg'),
('fig60', 150.00, 57, 38, '', 'obrazky/60.jpg'),
('fig80', 40.00, 25, 2, '', 'obrazky/80.jpg'),
('fig100', 120.00, 55, 28, '', 'obrazky/100.jpg'),
('fig120', 80.00, 25, 17, '', 'obrazky/120.jpg'),
('fig140', 400.00, 135, 126, '', 'obrazky/140.jpg'),
('don097', 160.00, 29, 44, 'długość 71cm', 'obrazky/097.jpg'),
('fig250', 1300.00, 180, 550, 'blat - 120cmx65cmx6cm', 'obrazky/250.jpg'),
('don300', 100.00, 25, 27, '', 'obrazky/300.jpg'),
('don310', 90.00, 25, 24, '', 'obrazky/310.jpg'),
('fig500', 1300.00, 0, 550, 'stół + 3 ławy stół: h=80cm fi=100cm ława: 110cm x 40cm x 40cm', 'obrazky/500.jpg');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
