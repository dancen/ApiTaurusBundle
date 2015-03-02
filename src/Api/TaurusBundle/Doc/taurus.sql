-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generato il: Mar 01, 2015 alle 21:20
-- Versione del server: 5.5.41
-- Versione PHP: 5.3.10-1ubuntu3.16

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `taurus`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `Bank`
--

CREATE TABLE IF NOT EXISTS `Bank` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bankcode` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `bankurl` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bankinfo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `Bank`
--

INSERT INTO `Bank` (`id`, `bankcode`, `bankurl`, `bankinfo`, `created_at`) VALUES
(1, '0001223', 'https://www.bank.com/application/execute/transaction', 'UBI Banca - banca dell''industria e dell''artigianato, filiale 221, Torrevecchia Pia, 20072, Pavia, Italia', '2015-03-01 00:00:00');

-- --------------------------------------------------------

--
-- Struttura della tabella `Beneficiary`
--

CREATE TABLE IF NOT EXISTS `Beneficiary` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) DEFAULT NULL,
  `beneficiaryname` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `beneficiaryaccount` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `banknote` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_FC23CBBDA76ED395` (`user_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dump dei dati per la tabella `Beneficiary`
--

INSERT INTO `Beneficiary` (`id`, `user_id`, `beneficiaryname`, `beneficiaryaccount`, `banknote`, `created_at`) VALUES
(9, 1, 'Daniele Centamore', 'IT9813280029820dd9090', 'asdca', '2015-03-01 15:48:31'),
(10, 1, 'Daniele Centamore', 'IT9813280029820dd9090', 'asdca', '2015-03-01 16:02:11'),
(11, 1, 'Daniele Centamore', 'IT9813280029820dd9090', 'asdca', '2015-03-01 18:33:43'),
(12, 1, 'Daniele Centamore', 'IT9813280029820dd9090', 'pagamento fattura 1202', '2015-03-01 18:39:17'),
(13, 1, 'Daniele Centamore', 'IT9813280029820dd9090', 'prova fattura', '2015-03-01 19:45:02'),
(14, 1, 'Daniele Centamore', 'IT9813280029820dd9090', 'prova fattura', '2015-03-01 19:55:17');

-- --------------------------------------------------------

--
-- Struttura della tabella `Transaction`
--

CREATE TABLE IF NOT EXISTS `Transaction` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `beneficiary_id` bigint(20) DEFAULT NULL,
  `transactionid` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `authorizationcode` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `bankresponsecode` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `statusmessage` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(8,2) NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_F4AB8A06ECCAAFA0` (`beneficiary_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=8 ;

--
-- Dump dei dati per la tabella `Transaction`
--

INSERT INTO `Transaction` (`id`, `beneficiary_id`, `transactionid`, `authorizationcode`, `bankresponsecode`, `created_at`, `statusmessage`, `amount`, `updated_at`) VALUES
(2, 9, 'l7qs9glmttj7k6tjkmcf4rsc36-6777', '999999999999', '5500002992', '2015-03-01 15:48:31', 'transacion-completed', 123.00, '2015-03-01 15:48:31'),
(3, 10, 'l7qs9glmttj7k6tjkmcf4rsc36-4570', '999999999999', '5500002992', '2015-03-01 16:02:11', 'transacion-completed', 123.00, '2015-03-01 16:02:11'),
(4, 11, 'l7qs9glmttj7k6tjkmcf4rsc36-8110', '999999999999', '5500002992', '2015-03-01 18:33:43', 'transacion-completed', 123.00, '2015-03-01 18:33:43'),
(5, 12, 'l7qs9glmttj7k6tjkmcf4rsc36-3638', '999999999999', '5500002992', '2015-03-01 18:39:17', 'transacion-completed', 150.00, '2015-03-01 18:39:17'),
(6, 13, 'l7qs9glmttj7k6tjkmcf4rsc36-8553', '999999999999', '5500002992', '2015-03-01 19:45:02', 'transacion-completed', 1200.90, '2015-03-01 19:45:02'),
(7, 14, 'l7qs9glmttj7k6tjkmcf4rsc36-4475', '999999999999', '5500002992', '2015-03-01 19:55:17', 'transacion-completed', 1200.90, '2015-03-01 19:55:17');

-- --------------------------------------------------------

--
-- Struttura della tabella `User`
--

CREATE TABLE IF NOT EXISTS `User` (
  `id` bigint(20) NOT NULL AUTO_INCREMENT,
  `bank_id` bigint(20) DEFAULT NULL,
  `secretcode` varchar(6) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `location` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `lastaccess` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_2DA1797711C8FB41` (`bank_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=2 ;

--
-- Dump dei dati per la tabella `User`
--

INSERT INTO `User` (`id`, `bank_id`, `secretcode`, `email`, `location`, `created_at`, `lastaccess`) VALUES
(1, 1, '111111', 'daniele.centamore@gmail.com', 'IT', '2015-03-01 00:00:00', '2015-03-01 00:00:00');

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `Beneficiary`
--
ALTER TABLE `Beneficiary`
  ADD CONSTRAINT `FK_FC23CBBDA76ED395` FOREIGN KEY (`user_id`) REFERENCES `User` (`id`);

--
-- Limiti per la tabella `Transaction`
--
ALTER TABLE `Transaction`
  ADD CONSTRAINT `FK_F4AB8A06ECCAAFA0` FOREIGN KEY (`beneficiary_id`) REFERENCES `Beneficiary` (`id`);

--
-- Limiti per la tabella `User`
--
ALTER TABLE `User`
  ADD CONSTRAINT `FK_2DA1797711C8FB41` FOREIGN KEY (`bank_id`) REFERENCES `Bank` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
