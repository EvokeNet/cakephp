-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 28/03/2014 às 19h11min
-- Versão do Servidor: 5.5.35
-- Versão do PHP: 5.3.10-1ubuntu3.9

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Banco de Dados: `evoke`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `dossiers`
--

CREATE TABLE IF NOT EXISTS `dossiers` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `mission_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `dossiers`
--

INSERT INTO `dossiers` (`id`, `mission_id`, `created`, `modified`) VALUES
(4, 146, '2014-03-28 18:54:38', '2014-03-28 19:08:25'),
(5, 146, '2014-03-28 19:07:59', '2014-03-28 19:07:59');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
