-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 jun 2017 om 12:56
-- Serverversie: 10.1.13-MariaDB
-- PHP-versie: 5.5.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `designking`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `bestelling`
--

CREATE TABLE `bestelling` (
  `ID_bestelling` int(11) NOT NULL,
  `besteltijdstip` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `ref_klant` int(11) NOT NULL,
  `ref_vestiging` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `bestelling`
--

INSERT INTO `bestelling` (`ID_bestelling`, `besteltijdstip`, `ref_klant`, `ref_vestiging`) VALUES
(1, '2017-06-01 01:44:36', 11, 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `klant`
--

CREATE TABLE `klant` (
  `ID_klant` int(11) NOT NULL,
  `naam` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL,
  `adres` varchar(200) NOT NULL,
  `telefoonnummer` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `klant`
--

INSERT INTO `klant` (`ID_klant`, `naam`, `email`, `adres`, `telefoonnummer`) VALUES
(8, 'Fortune Blom', 'erros123@hotmail.com', 'okkernootstraat 230 2555ZM', '0633053377'),
(9, 'fortune', 'fortuneb1142@gmail.com', 'wesselburg', '0644535544'),
(10, 'daan ', 'daan', 'daan ', 'daan'),
(11, 'daan ', 'dan@daan.nl', 'daan', 'daan06xxl');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `shirt`
--

CREATE TABLE `shirt` (
  `ID_pizza` int(11) NOT NULL,
  `aantal` int(11) NOT NULL,
  `ref_bestelling` int(11) NOT NULL,
  `ref_soort_pizza` int(11) NOT NULL,
  `ref_type_pizza` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `soort_hemd`
--

CREATE TABLE `soort_hemd` (
  `ID_soort_hemd` int(11) NOT NULL,
  `naam` varchar(200) NOT NULL,
  `omschrijving` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `prijs` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Gegevens worden geëxporteerd voor tabel `soort_hemd`
--

INSERT INTO `soort_hemd` (`ID_soort_hemd`, `naam`, `omschrijving`, `image`, `prijs`) VALUES
(1, 'Design Splash T-shirt', 'Het T-shirt is gemaakt van duurzame grondstoffen en is van hoge kwaliteit. *Het shirt is ook in het wit beschikbaar*', 'Design Splash.jpg', 20),
(2, 'Design Arabic T-shirt', 'Het T-shirt is gemaakt van duurzame grondstoffen en is van hoge kwaliteit. *Het shirt is ook in het wit beschikbaar*', 'Design2.jpg', 20),
(3, 'Soccer Design T-shirt', 'Het T-shirt is gemaakt van duurzame grondstoffen en is van hoge kwaliteit. *Het shirt is ook in het wit beschikbaar*', 'Design3 01.jpg', 20);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `soort_pet`
--

CREATE TABLE `soort_pet` (
  `ID_soort_pet` int(11) NOT NULL,
  `naam` varchar(200) NOT NULL,
  `omschrijving` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `prijs` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `soort_pet`
--

INSERT INTO `soort_pet` (`ID_soort_pet`, `naam`, `omschrijving`, `image`, `prijs`) VALUES
(1, 'Splash Design Cap', 'Deze cap is gemaakt van duurzame grondstoffen en is van hoge kwaliteit.\r\n *Het shirt is ook in het wit beschikbaar*', 'Design1 cap.jpg', 18),
(2, 'Arabic Design Cap', 'Deze cap is gemaakt van duurzame grondstoffen en is van hoge kwaliteit. *Het shirt is ook in het wit beschikbaar*', 'Design2 cap nosplash.jpg', 18),
(3, 'Soccer Design Cap', 'Deze cap is gemaakt van duurzame grondstoffen en is van hoge kwaliteit. *Het shirt is ook in het wit beschikbaar*', 'cappie.png', 18);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `soort_shirt`
--

CREATE TABLE `soort_shirt` (
  `ID_soort_shirt` int(11) NOT NULL,
  `naam` varchar(200) NOT NULL,
  `omschrijving` text NOT NULL,
  `image` varchar(50) NOT NULL,
  `prijs` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Gegevens worden geëxporteerd voor tabel `soort_shirt`
--

INSERT INTO `soort_shirt` (`ID_soort_shirt`, `naam`, `omschrijving`, `image`, `prijs`) VALUES
(1, 'Splash Design', 'Het shirt is gemaakt van duurzame grondstoffen en is van hoge kwaliteit. \r\n\r\n*Het shirt is ook in het wit beschikbaar', 'Design1 longsleeve.jpg', 22),
(2, 'Arabic Design', 'Het shirt is gemaakt van duurzame grondstoffen en is van hoge kwaliteit. \r\n\r\n*Het shirt is ook in het wit beschikbaar*', 'Design2 longsleeve.jpg', 22),
(3, 'Soccer Design', 'Het shirt is gemaakt van duurzame grondstoffen en is van hoge kwaliteit. \r\n\r\n*Het shirt is ook in het wit beschikbaar*', 'Design3 longsleeve.jpg', 22);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `type_hemd`
--

CREATE TABLE `type_hemd` (
  `ID_type_hemd` int(11) NOT NULL,
  `omschrijving` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Gegevens worden geëxporteerd voor tabel `type_hemd`
--

INSERT INTO `type_hemd` (`ID_type_hemd`, `omschrijving`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XXL');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `type_pet`
--

CREATE TABLE `type_pet` (
  `ID_type_shirt` int(11) NOT NULL,
  `omschrijving` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `type_pet`
--

INSERT INTO `type_pet` (`ID_type_shirt`, `omschrijving`) VALUES
(1, 'Small'),
(2, 'Medium'),
(3, 'Large');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `type_shirt`
--

CREATE TABLE `type_shirt` (
  `ID_type_shirt` int(11) NOT NULL,
  `omschrijving` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `type_shirt`
--

INSERT INTO `type_shirt` (`ID_type_shirt`, `omschrijving`) VALUES
(1, 'S'),
(2, 'M'),
(3, 'L'),
(4, 'XL'),
(5, 'XXL');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `vestiging`
--

CREATE TABLE `vestiging` (
  `ID_vestiging` int(11) NOT NULL,
  `naam` varchar(200) NOT NULL,
  `email` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `vestiging`
--

INSERT INTO `vestiging` (`ID_vestiging`, `naam`, `email`) VALUES
(1, 'Rotterdam ', 'rotterdam@sopranos.nl'),
(2, 'Amsterdam', 'amsterdam@sopranos.nl'),
(3, 'Utrecht', 'utrecht@sopranos.nl');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `bestelling`
--
ALTER TABLE `bestelling`
  ADD PRIMARY KEY (`ID_bestelling`);

--
-- Indexen voor tabel `klant`
--
ALTER TABLE `klant`
  ADD PRIMARY KEY (`ID_klant`);

--
-- Indexen voor tabel `shirt`
--
ALTER TABLE `shirt`
  ADD PRIMARY KEY (`ID_pizza`);

--
-- Indexen voor tabel `soort_hemd`
--
ALTER TABLE `soort_hemd`
  ADD PRIMARY KEY (`ID_soort_hemd`);

--
-- Indexen voor tabel `soort_pet`
--
ALTER TABLE `soort_pet`
  ADD PRIMARY KEY (`ID_soort_pet`);

--
-- Indexen voor tabel `soort_shirt`
--
ALTER TABLE `soort_shirt`
  ADD PRIMARY KEY (`ID_soort_shirt`);

--
-- Indexen voor tabel `type_hemd`
--
ALTER TABLE `type_hemd`
  ADD PRIMARY KEY (`ID_type_hemd`);

--
-- Indexen voor tabel `type_pet`
--
ALTER TABLE `type_pet`
  ADD PRIMARY KEY (`ID_type_shirt`);

--
-- Indexen voor tabel `type_shirt`
--
ALTER TABLE `type_shirt`
  ADD PRIMARY KEY (`ID_type_shirt`);

--
-- Indexen voor tabel `vestiging`
--
ALTER TABLE `vestiging`
  ADD PRIMARY KEY (`ID_vestiging`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `bestelling`
--
ALTER TABLE `bestelling`
  MODIFY `ID_bestelling` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT voor een tabel `klant`
--
ALTER TABLE `klant`
  MODIFY `ID_klant` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
--
-- AUTO_INCREMENT voor een tabel `shirt`
--
ALTER TABLE `shirt`
  MODIFY `ID_pizza` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT voor een tabel `soort_shirt`
--
ALTER TABLE `soort_shirt`
  MODIFY `ID_soort_shirt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT voor een tabel `type_shirt`
--
ALTER TABLE `type_shirt`
  MODIFY `ID_type_shirt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT voor een tabel `vestiging`
--
ALTER TABLE `vestiging`
  MODIFY `ID_vestiging` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
