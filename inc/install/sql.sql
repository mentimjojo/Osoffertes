-- phpMyAdmin SQL Dump
-- version 3.5.8.2
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 19 apr 2014 om 13:27
-- Serverversie: 5.5.37
-- PHP-versie: 5.3.28

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `tnijborg_panel`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers`
--

CREATE TABLE IF NOT EXISTS `customers` (
  `klantnummer` varchar(6) NOT NULL,
  `initalen` varchar(255) NOT NULL,
  `tussenvoegsel` varchar(5) NOT NULL,
  `achternaam` varchar(255) NOT NULL,
  `geboortedatum` varchar(255) NOT NULL,
  `postcode` varchar(255) NOT NULL,
  `adres` varchar(255) NOT NULL,
  `huisnummer` varchar(255) NOT NULL,
  `toevoeginghn` varchar(255) NOT NULL,
  `land` varchar(2) NOT NULL,
  `telefoon` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `geslacht` varchar(255) NOT NULL,
  `nieuws_balk_read` int(1) NOT NULL,
  `project_map` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers_activation`
--

CREATE TABLE IF NOT EXISTS `customers_activation` (
  `klantnummer` varchar(255) NOT NULL,
  `activatie_status` varchar(255) NOT NULL DEFAULT '0',
  `activatie_code` bigint(15) NOT NULL,
  `activatie_geldig` int(1) NOT NULL DEFAULT '1'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers_email_changes`
--

CREATE TABLE IF NOT EXISTS `customers_email_changes` (
  `klantnummer` varchar(255) NOT NULL,
  `datum` bigint(10) NOT NULL,
  `email_verfi` varchar(1) NOT NULL DEFAULT '1',
  `email_verfi_code` varchar(255) NOT NULL,
  `email_verfi_geldig` varchar(1) NOT NULL,
  `email_verfi_terug_code` varchar(255) NOT NULL,
  `email_verfi_terug_geldig` varchar(1) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers_nieuws`
--

CREATE TABLE IF NOT EXISTS `customers_nieuws` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `titel` varchar(40) NOT NULL DEFAULT '',
  `titel_en` varchar(40) NOT NULL,
  `naam` varchar(40) NOT NULL DEFAULT '',
  `klantnummer` int(6) NOT NULL,
  `bericht` text NOT NULL,
  `bericht_en` text NOT NULL,
  `datum` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=18 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers_registratie`
--

CREATE TABLE IF NOT EXISTS `customers_registratie` (
  `klantnummer` varchar(255) NOT NULL,
  `cookie_hash` varchar(255) NOT NULL,
  `register_ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers_support_tickets`
--

CREATE TABLE IF NOT EXISTS `customers_support_tickets` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `klantnummer` varchar(255) NOT NULL,
  `ticket_naam` varchar(255) NOT NULL,
  `ticket_datum` varchar(255) NOT NULL,
  `ticket_text` text NOT NULL,
  `ticket_status` int(2) NOT NULL DEFAULT '0',
  `ticket_verwijderd` int(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers_system_facturen`
--

CREATE TABLE IF NOT EXISTS `customers_system_facturen` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `factuur_id` varchar(25) NOT NULL DEFAULT '',
  `factuur_klantnummer` varchar(6) NOT NULL,
  `factuur_koppeling_id` varchar(255) NOT NULL DEFAULT '',
  `factuur_prijs` varchar(255) NOT NULL,
  `factuur_status` int(1) NOT NULL DEFAULT '1',
  `factuur_delete` int(1) NOT NULL DEFAULT '0',
  `datum` varchar(20) NOT NULL DEFAULT '',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `customers_system_products`
--

CREATE TABLE IF NOT EXISTS `customers_system_products` (
  `id` int(3) NOT NULL AUTO_INCREMENT,
  `klantnummer` varchar(6) NOT NULL,
  `product` varchar(255) NOT NULL DEFAULT '',
  `valuta` varchar(255) NOT NULL,
  `budget` varchar(255) NOT NULL DEFAULT '',
  `tijd` varchar(255) NOT NULL DEFAULT '',
  `omschrijving` text NOT NULL,
  `budget_wijzig` varchar(255) NOT NULL,
  `tijd_wijzig` varchar(255) NOT NULL,
  `omschrijving_wijzig` text NOT NULL,
  `datum` varchar(20) NOT NULL DEFAULT '',
  `status` int(1) NOT NULL,
  `status_omschrijving` text NOT NULL,
  `behandeltdoor` varchar(255) NOT NULL DEFAULT '',
  `project_map` int(1) NOT NULL DEFAULT '0',
  `project_link` varchar(255) NOT NULL,
  `project_info` text NOT NULL,
  `project_download` varchar(255) NOT NULL,
  `betaald` varchar(255) NOT NULL DEFAULT '',
  `gewijzigd` int(1) NOT NULL,
  `verwijderd` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=13 ;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `staff_logs_login_ips`
--

CREATE TABLE IF NOT EXISTS `staff_logs_login_ips` (
  `klantnummer` varchar(255) NOT NULL,
  `datum` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `staff_logs_pages_visit`
--

CREATE TABLE IF NOT EXISTS `staff_logs_pages_visit` (
  `klantnummer` varchar(255) NOT NULL,
  `datum` varchar(10) NOT NULL,
  `page` varchar(255) NOT NULL,
  `ip` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `staff_settings`
--

CREATE TABLE IF NOT EXISTS `staff_settings` (
  `site_titel` varchar(255) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `site_seo` int(1) NOT NULL DEFAULT '0',
  `site_version` varchar(255) NOT NULL,
  `onderhoud` int(1) NOT NULL,
  `bericht_onderhoud_nl` varchar(255) NOT NULL,
  `bericht_onderhoud_en` varchar(255) NOT NULL,
  `bericht_nieuws_nl` varchar(255) NOT NULL,
  `bericht_nieuws_en` varchar(255) NOT NULL,
  `login_aan` bigint(1) NOT NULL DEFAULT '1',
  `id` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `staff_settings_logs`
--

CREATE TABLE IF NOT EXISTS `staff_settings_logs` (
  `log_visit_on` int(1) NOT NULL,
  `log_iplogins_on` int(1) NOT NULL,
  `id` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `staff_settings_onderhoud`
--

CREATE TABLE IF NOT EXISTS `staff_settings_onderhoud` (
  `onderhoud_aan` int(1) NOT NULL,
  `onderhoud_bericht` text NOT NULL,
  `id` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `staff_stafflogin_ips`
--

CREATE TABLE IF NOT EXISTS `staff_stafflogin_ips` (
  `staff_klantnummer` varchar(255) NOT NULL,
  `ip1` varchar(255) NOT NULL,
  `ip2` varchar(255) NOT NULL,
  `ip3` varchar(255) NOT NULL,
  `ip4` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `staff_toegang`
--

CREATE TABLE IF NOT EXISTS `staff_toegang` (
  `klantnummer` varchar(255) NOT NULL,
  `toegang` int(2) NOT NULL DEFAULT '0',
  `toegang_loc` int(1) NOT NULL,
  `toegang_delete` int(1) NOT NULL DEFAULT '0',
  `toegang_change` int(1) NOT NULL DEFAULT '0'
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `website_pages`
--

CREATE TABLE IF NOT EXISTS `website_pages` (
  `page_name` varchar(255) NOT NULL,
  `page_define` varchar(255) NOT NULL,
  `page_titel` varchar(255) NOT NULL,
  `page_seo` varchar(255) NOT NULL,
  `page_link` varchar(255) NOT NULL,
  `page_ext` varchar(255) NOT NULL,
  `page_toegang` int(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
