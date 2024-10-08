-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Gegenereerd op: 08 okt 2024 om 11:33
-- Serverversie: 10.4.28-MariaDB
-- PHP-versie: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `tandartsplatform`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `afspraken`
--

CREATE TABLE `afspraken` (
  `AfspraakID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `TandartsID` int(11) DEFAULT NULL,
  `DatumTijd` datetime DEFAULT NULL,
  `Status` enum('Gepland','Gewijzigd','Geannuleerd') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `behandelingsgeschiedenis`
--

CREATE TABLE `behandelingsgeschiedenis` (
  `BehandelingID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `Datum` datetime DEFAULT NULL,
  `BehandelingOmschrijving` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `communicatie`
--

CREATE TABLE `communicatie` (
  `BerichtID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `TandartsID` int(11) DEFAULT NULL,
  `DatumTijd` datetime DEFAULT NULL,
  `Inhoud` text DEFAULT NULL,
  `Status` enum('Ontvangen','Beantwoord') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `contactinformatie`
--

CREATE TABLE `contactinformatie` (
  `ContactID` int(11) NOT NULL,
  `PraktijkNaam` varchar(100) DEFAULT NULL,
  `Adres` varchar(255) DEFAULT NULL,
  `Telefoonnummer` varchar(20) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `educatiefmateriaal`
--

CREATE TABLE `educatiefmateriaal` (
  `MateriaalID` int(11) NOT NULL,
  `Titel` varchar(100) DEFAULT NULL,
  `Type` enum('Video','Informatiepagina') DEFAULT NULL,
  `URL` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `feedback`
--

CREATE TABLE `feedback` (
  `FeedbackID` int(11) NOT NULL,
  `PatientID` int(11) DEFAULT NULL,
  `TandartsID` int(11) DEFAULT NULL,
  `DatumTijd` datetime DEFAULT NULL,
  `Beoordeling` int(11) DEFAULT NULL,
  `Opmerking` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `patiënten`
--

CREATE TABLE `patiënten` (
  `PatientID` int(11) NOT NULL,
  `Naam` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Wachtwoord` varchar(255) DEFAULT NULL,
  `Adres` varchar(255) DEFAULT NULL,
  `Telefoonnummer` varchar(20) DEFAULT NULL,
  `Verzekeringsnummer` varchar(50) DEFAULT NULL,
  `Taal` enum('Nederlands','Engels') DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `patiënten`
--

INSERT INTO `patiënten` (`PatientID`, `Naam`, `Email`, `Wachtwoord`, `Adres`, `Telefoonnummer`, `Verzekeringsnummer`, `Taal`) VALUES
(12, 'amr', 'amr@gmail.nl', '$2y$10$p7BClX5pj6h5YTcigMtgNu6HE7lfnEW247VCG5.VDs1n38JvJKe2W', '23 Buiten Kadijken', '0684041011', '2332', 'Nederlands'),
(15, 'mous', 'mous@gmail.nl', '$2y$10$/BRAxdbnxyTsis2YnvSYau4wq.qxz5eSQEnok/D.CAYa8oInDNizC', 'west', '0612121212', '2111', 'Nederlands'),
(16, 'aa', 'aa@GMAIL.NL', '$2y$10$5XmitjXpXRmEmO86/aBySe0NdP4hOd.eKXMryP7D2l2HhT23A53pC', 'amsterdm', '111111111', '111111', 'Nederlands'),
(17, '33', 'mous@11', '$2y$10$Grnvmt1S25vXsAzwrqQrEuCI2oUYdj/Sz5qFT/mJt6F58zxw9A6Nu', 'amsterdm', '22', '22', 'Nederlands'),
(18, 'ss', 'ss@44', '$2y$10$vo/PE6NDhbL60aqu/MU0YOVVziesANAh.oqBl928WnqjLl8jkx6p2', '33', '33', '33', 'Nederlands'),
(19, 'nou', 'nou@11.nl', '$2y$10$byP0R2tlnOGY7.lihkxx7uVHGzEcm/kMDC2Q.wtBjG.KI5AGcG0UW', 'west', '223232', '2322', 'Nederlands'),
(20, 'kev', 'kev@11', '$2y$10$Fa4Ubbcu7wcnPEEjJAbWqOU0A99Eq.2pDdsWfgXjeE6aGNARw/vDC', 'amsterdm', '123456', '`11', 'Nederlands'),
(21, 'm', 'm@123', '$2y$10$/YfEnYiJULXtsNJA1OhC5uq7f0miIqpuk9SNMQ9N.DJ8rIa7ZX222', 'amsterdam', '223232', '2111', 'Nederlands');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `tandartsen`
--

CREATE TABLE `tandartsen` (
  `TandartsID` int(11) NOT NULL,
  `Naam` varchar(100) DEFAULT NULL,
  `Email` varchar(100) DEFAULT NULL,
  `Wachtwoord` varchar(255) DEFAULT NULL,
  `Specialisatie` varchar(255) DEFAULT NULL,
  `Bio` text DEFAULT NULL,
  `Beoordeling` decimal(3,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `tandartsen`
--

INSERT INTO `tandartsen` (`TandartsID`, `Naam`, `Email`, `Wachtwoord`, `Specialisatie`, `Bio`, `Beoordeling`) VALUES
(1, 'ARTS', 'arts@gmail.nl', '11111', 'hygiene', 'ik ben arts ', NULL);

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `afspraken`
--
ALTER TABLE `afspraken`
  ADD PRIMARY KEY (`AfspraakID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `TandartsID` (`TandartsID`);

--
-- Indexen voor tabel `behandelingsgeschiedenis`
--
ALTER TABLE `behandelingsgeschiedenis`
  ADD PRIMARY KEY (`BehandelingID`),
  ADD KEY `PatientID` (`PatientID`);

--
-- Indexen voor tabel `communicatie`
--
ALTER TABLE `communicatie`
  ADD PRIMARY KEY (`BerichtID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `TandartsID` (`TandartsID`);

--
-- Indexen voor tabel `contactinformatie`
--
ALTER TABLE `contactinformatie`
  ADD PRIMARY KEY (`ContactID`);

--
-- Indexen voor tabel `educatiefmateriaal`
--
ALTER TABLE `educatiefmateriaal`
  ADD PRIMARY KEY (`MateriaalID`);

--
-- Indexen voor tabel `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`FeedbackID`),
  ADD KEY `PatientID` (`PatientID`),
  ADD KEY `TandartsID` (`TandartsID`);

--
-- Indexen voor tabel `patiënten`
--
ALTER TABLE `patiënten`
  ADD PRIMARY KEY (`PatientID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexen voor tabel `tandartsen`
--
ALTER TABLE `tandartsen`
  ADD PRIMARY KEY (`TandartsID`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `afspraken`
--
ALTER TABLE `afspraken`
  MODIFY `AfspraakID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `behandelingsgeschiedenis`
--
ALTER TABLE `behandelingsgeschiedenis`
  MODIFY `BehandelingID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `communicatie`
--
ALTER TABLE `communicatie`
  MODIFY `BerichtID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `contactinformatie`
--
ALTER TABLE `contactinformatie`
  MODIFY `ContactID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `educatiefmateriaal`
--
ALTER TABLE `educatiefmateriaal`
  MODIFY `MateriaalID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `feedback`
--
ALTER TABLE `feedback`
  MODIFY `FeedbackID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `patiënten`
--
ALTER TABLE `patiënten`
  MODIFY `PatientID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT voor een tabel `tandartsen`
--
ALTER TABLE `tandartsen`
  MODIFY `TandartsID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Beperkingen voor geëxporteerde tabellen
--

--
-- Beperkingen voor tabel `afspraken`
--
ALTER TABLE `afspraken`
  ADD CONSTRAINT `afspraken_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patiënten` (`PatientID`),
  ADD CONSTRAINT `afspraken_ibfk_2` FOREIGN KEY (`TandartsID`) REFERENCES `tandartsen` (`TandartsID`);

--
-- Beperkingen voor tabel `behandelingsgeschiedenis`
--
ALTER TABLE `behandelingsgeschiedenis`
  ADD CONSTRAINT `behandelingsgeschiedenis_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patiënten` (`PatientID`);

--
-- Beperkingen voor tabel `communicatie`
--
ALTER TABLE `communicatie`
  ADD CONSTRAINT `communicatie_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patiënten` (`PatientID`),
  ADD CONSTRAINT `communicatie_ibfk_2` FOREIGN KEY (`TandartsID`) REFERENCES `tandartsen` (`TandartsID`);

--
-- Beperkingen voor tabel `feedback`
--
ALTER TABLE `feedback`
  ADD CONSTRAINT `feedback_ibfk_1` FOREIGN KEY (`PatientID`) REFERENCES `patiënten` (`PatientID`),
  ADD CONSTRAINT `feedback_ibfk_2` FOREIGN KEY (`TandartsID`) REFERENCES `tandartsen` (`TandartsID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
