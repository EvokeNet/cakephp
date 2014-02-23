-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 23/02/2014 às 09h21min
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
-- Estrutura da tabela `evidence_tags`
--

CREATE TABLE IF NOT EXISTS `evidence_tags` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `evidence_id` int(16) unsigned NOT NULL,
  `tag_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evokation_followers`
--

CREATE TABLE IF NOT EXISTS `evokation_followers` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `evokation_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `evokation_followers`
--

INSERT INTO `evokation_followers` (`id`, `user_id`, `evokation_id`, `created`, `modified`) VALUES
(2, 6, 24, '2014-02-22 09:32:08', '2014-02-22 09:32:08');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evokation_tags`
--

CREATE TABLE IF NOT EXISTS `evokation_tags` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `evokation_id` int(16) unsigned NOT NULL,
  `tag_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medias`
--

CREATE TABLE IF NOT EXISTS `medias` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `ref` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `ref_id` int(16) DEFAULT NULL,
  `file` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `position` int(16) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref` (`ref`),
  KEY `ref_id` (`ref_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `medias`
--

INSERT INTO `medias` (`id`, `ref`, `ref_id`, `file`, `position`, `created`, `modified`) VALUES
(1, 'Evidence', 10, '/.jpg', 0, '2014-02-22 19:10:18', '2014-02-22 19:10:18'),
(2, 'Evidence', 21, '/./-1.jpg', 0, '2014-02-22 21:23:35', '2014-02-22 21:23:35'),
(3, 'Evidence', 22, '/img/uploads/2014/02/Penguins.jpg', 0, '2014-02-22 21:26:41', '2014-02-22 21:26:41'),
(6, 'Evidence', 24, '/img/uploads/2014/02/Koala.jpg', 0, '2014-02-22 21:31:04', '2014-02-22 21:31:04'),
(7, 'Evidence', 22, '/webroot/img/uploads/2014/02/Hydrangeas.jpg', 0, '2014-02-22 21:33:45', '2014-02-22 21:33:45'),
(8, 'Evidence', 24, '/img/uploads/2014/02/Penguins-1.jpg', 0, '2014-02-22 21:34:53', '2014-02-22 21:34:53'),
(9, 'Evidence', 24, '/webroot/img/uploads/2014/02/Jellyfish.jpg', 0, '2014-02-22 21:35:34', '2014-02-22 21:35:34'),
(12, 'Evidence', 23, '/../evoke/webroot/img/uploads/2014/02/Koala.jpg', 0, '2014-02-22 21:43:48', '2014-02-22 21:43:48'),
(13, 'Evidence', 23, '/webroot/img/uploads/2014/02/Jellyfish-1.jpg', 0, '2014-02-22 21:44:19', '2014-02-22 21:44:19'),
(14, 'Evidence', 23, '/webroot/img/uploads/2014/02/Lighthouse.jpg', 0, '2014-02-22 21:49:39', '2014-02-22 21:49:39'),
(15, 'Evidence', 25, '/img/uploads/2014/02/Desert.jpg', 0, '2014-02-22 21:51:56', '2014-02-22 21:51:56'),
(17, 'Evidence', 25, '/img/uploads/2014/02/flame_3.avi', 0, '2014-02-23 00:54:06', '2014-02-23 00:54:06'),
(19, 'Evidence', 25, '/img/uploads/2014/02/H264_test1_Talkinghead_mp4_480x360-1.mp4', 0, '2014-02-23 08:37:04', '2014-02-23 08:37:04');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tags`
--

CREATE TABLE IF NOT EXISTS `tags` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `instances` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_friends`
--

CREATE TABLE IF NOT EXISTS `user_friends` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `friend_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `user_friends`
--

INSERT INTO `user_friends` (`id`, `user_id`, `friend_id`, `created`, `modified`) VALUES
(16, 6, 21, '2014-02-23 06:54:09', '2014-02-23 06:54:09');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
