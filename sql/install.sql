-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Erstellungszeit: 11. Mai 2014 um 13:35
-- Server Version: 5.5.36
-- PHP-Version: 5.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Datenbank: `rfh`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `contribution`
--

CREATE TABLE IF NOT EXISTS `contribution` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Identifier des Beitrags',
  `userid` int(11) DEFAULT NULL COMMENT 'ID des Benutzers, ',
  `name` varchar(255) DEFAULT NULL,
  `entryid` int(11) NOT NULL COMMENT 'ID des Eintrags zu einem Event',
  `quantity` int(11) NOT NULL DEFAULT '1' COMMENT 'Menge, die Mitgebracht/besorgt wird',
  `stamp` int NOT NULL DEFAULT '0' COMMENT 'ETAG, Versionierung',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `entry`
--

CREATE TABLE IF NOT EXISTS `entry` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Identifier des Eintrags',
  `eventid` int(11) NOT NULL COMMENT 'Unique Identifier des zugehörigen Events',
  `title` varchar(255) NOT NULL COMMENT 'Titel des Eintrags',
  `note` mediumtext COMMENT 'Notiz zum Eintrag',
  `total_qty` int(11) NOT NULL DEFAULT '1' COMMENT 'Mengenangabe zum Eintrag',
  `stamp` int NOT NULL DEFAULT '0' COMMENT 'ETAG, Versionierung',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Einträge zu Events' AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `event`
--

CREATE TABLE IF NOT EXISTS `event` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Primärschlüssel',
  `add_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP COMMENT 'Datum an dem das Event angelegt wurde',
  `date` datetime DEFAULT NULL COMMENT 'Datum und Uhrzeit der Veranstaltung',
  `title` mediumtext NOT NULL COMMENT 'Titel der Veranstaltung',
  `location` mediumtext COMMENT 'Ort an dem das Event stattfindet',
  `description` mediumtext COMMENT 'Beschreibungstext zum Event',
  `type` int(11) NOT NULL COMMENT 'Typ des Events (Geschenkeliste/Mitbringsel)',
  `stamp` int NOT NULL DEFAULT '0' COMMENT 'ETAG, Versionierung',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `host`
--

CREATE TABLE IF NOT EXISTS `host` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Identifier des Datensatzes',
  `eventid` int(11) NOT NULL COMMENT 'ID des Events',
  `userid` int(11) NOT NULL COMMENT 'ID des Benutzers, welcher als Veranstalter fungiert',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique Identifier des Users',
  `name` varchar(255) NOT NULL COMMENT 'Name des Benutzers',
  `email` varchar(255) DEFAULT NULL COMMENT 'E-Mail des Benutzers',
  `passwort` char(32) NOT NULL COMMENT 'Passwort des Benutzers (MD5)',
  `sa` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Kennzeichnet den User als Superadmin',
  `stamp` int NOT NULL DEFAULT '0' COMMENT 'ETAG, Versionierung',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
