-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 19/02/2014 às 13h02min
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
-- Estrutura da tabela `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) CHARACTER SET utf8 NOT NULL,
  `foreign_key` int(16) NOT NULL,
  `name` varchar(32) CHARACTER SET utf8 NOT NULL,
  `attachment` varchar(255) CHARACTER SET utf8 NOT NULL,
  `dir` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `type` varchar(255) CHARACTER SET utf8 DEFAULT NULL,
  `size` int(11) DEFAULT '0',
  `active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `badges`
--

CREATE TABLE IF NOT EXISTS `badges` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `language` varchar(120) CHARACTER SET utf8 NOT NULL,
  `trigger` varchar(120) CHARACTER SET utf8 NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chatrooms`
--

CREATE TABLE IF NOT EXISTS `chatrooms` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chatroom_messages`
--

CREATE TABLE IF NOT EXISTS `chatroom_messages` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `chatroom_user_id` int(16) unsigned NOT NULL,
  `message` text CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `chatroom_users`
--

CREATE TABLE IF NOT EXISTS `chatroom_users` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `chatroom_id` int(16) unsigned NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `comments`
--

CREATE TABLE IF NOT EXISTS `comments` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `content` text CHARACTER SET utf8 NOT NULL,
  `evidence_id` int(16) unsigned NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Extraindo dados da tabela `comments`
--

INSERT INTO `comments` (`id`, `content`, `evidence_id`, `user_id`, `created`, `modified`) VALUES
(1, 'oi', 1, 10, '2014-02-19 03:53:32', '2014-02-19 04:00:20'),
(2, 'one', 2, 10, '2014-02-19 06:00:16', '2014-02-19 06:00:16'),
(3, 'two', 2, 10, '2014-02-19 06:01:12', '2014-02-19 06:01:12'),
(4, 'three', 2, 10, '2014-02-19 06:03:10', '2014-02-19 06:03:10'),
(5, 'comment', 8, 10, '2014-02-19 10:27:48', '2014-02-19 10:27:48');

-- --------------------------------------------------------

--
-- Estrutura da tabela `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `start` datetime NOT NULL,
  `end` datetime NOT NULL,
  `is_system` tinyint(1) NOT NULL COMMENT 'Flag to determine wether an event is created by users or by system.',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `evidences`
--

CREATE TABLE IF NOT EXISTS `evidences` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `quest_id` int(16) unsigned DEFAULT NULL,
  `mission_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=10 ;

--
-- Extraindo dados da tabela `evidences`
--

INSERT INTO `evidences` (`id`, `title`, `content`, `user_id`, `quest_id`, `mission_id`, `created`, `modified`) VALUES
(1, 'Lorem ipsum dolor sit amet', 'Suspendisse potenti. Sed lobortis sagittis nulla, in feugiat massa rhoncus vel. Cras mauris erat, eleifend ut libero eu, malesuada ullamcorper urna. Mauris et vestibulum nibh. Cras cursus urna et accumsan viverra. Sed pharetra, risus ac posuere malesuada, lectus mauris semper lectus, non vestibulum nibh augue sit amet sem. Cras ac ultricies justo. Curabitur a justo urna. Sed placerat condimentum velit et tincidunt. Etiam tortor odio, molestie nec nulla at, rutrum tincidunt velit. Vivamus euismod lorem velit, vitae suscipit lectus volutpat eget. Praesent tincidunt turpis quis lacus placerat elementum.', 10, NULL, 1, '2014-02-19 02:40:39', '2014-02-19 03:03:07'),
(2, 'Second evidence', 'Duis et nunc eu ante venenatis consectetur. Maecenas laoreet nisl nec ipsum sagittis, non auctor purus pulvinar. Sed venenatis nibh enim, eget pellentesque neque scelerisque ut. Pellentesque vel metus dictum, porta ante sit amet, porttitor turpis. Etiam nibh nisi, gravida sed laoreet at, commodo et orci. Nunc id magna non metus scelerisque bibendum. Nullam pretium ante metus, ut fringilla mi viverra sed. Vestibulum suscipit, urna vitae iaculis consectetur, erat sem semper quam, quis rutrum est urna non nunc. Donec non tellus non risus pretium tincidunt sed at purus. Aenean rutrum urna non odio auctor mollis. Proin mattis id neque eget ullamcorper. Donec quam felis, bibendum non lobortis eu, auctor id est. Duis euismod adipiscing augue, sed fringilla mi pretium et. Nulla ac pulvinar libero.', 12, 1, 1, '2014-02-19 04:20:56', '2014-02-19 04:20:56'),
(8, 'Quisque nisl dolor, suscipit eget quam elementum, consequat aliquet erat. Maecenas in justo non lorem pellentesque bland', 'Quisque nisl dolor, suscipit eget quam elementum, consequat aliquet erat. Maecenas in justo non lorem pellentesque blandit. Nunc sit amet velit rhoncus, porta sapien hendrerit, tempus tortor. Sed sagittis rutrum quam ultricies porta. Cras interdum at erat ac fermentum. Donec at tristique dolor. Aenean at felis odio. Morbi malesuada neque ipsum, eget faucibus tortor congue id. Maecenas laoreet justo id est posuere rhoncus. Suspendisse fringilla dictum elit, nec lacinia magna rhoncus at.', 5, 1, 1, '2014-02-19 05:49:24', '2014-02-19 05:49:24');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evokations`
--

CREATE TABLE IF NOT EXISTS `evokations` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(16) unsigned NOT NULL,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `abstract` text CHARACTER SET utf8 NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `language` varchar(120) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `friends_users`
--

CREATE TABLE IF NOT EXISTS `friends_users` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_from` int(16) unsigned NOT NULL,
  `user_to` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_from` (`user_from`),
  UNIQUE KEY `user_to` (`user_to`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `title`, `created`, `modified`) VALUES
(3, 'the prionics', '2014-02-19 06:14:15', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups_users`
--

CREATE TABLE IF NOT EXISTS `groups_users` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `group_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `groups_users`
--

INSERT INTO `groups_users` (`id`, `user_id`, `group_id`, `created`, `modified`) VALUES
(1, 5, 3, '2014-02-19 15:52:27', '2014-02-19 15:52:27'),
(2, 7, 3, '2014-02-19 15:52:33', '2014-02-19 15:52:33');

-- --------------------------------------------------------

--
-- Estrutura da tabela `issues`
--

CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(16) unsigned DEFAULT NULL,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(120) CHARACTER SET utf8 NOT NULL COMMENT 'This is just the sanitized name',
  `language` varchar(120) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `issues`
--

INSERT INTO `issues` (`id`, `parent_id`, `name`, `slug`, `language`, `created`, `modified`) VALUES
(1, NULL, 'Water', '', '', '2014-02-19 02:49:56', '2014-02-19 02:49:56'),
(2, NULL, 'Solar ', '', '', '2014-02-19 07:18:16', '2014-02-19 07:18:16'),
(3, NULL, 'Racing', '', '', '2014-02-19 07:24:18', '2014-02-19 07:24:18');

-- --------------------------------------------------------

--
-- Estrutura da tabela `missions`
--

CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `image` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `language` varchar(120) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `missions`
--

INSERT INTO `missions` (`id`, `title`, `description`, `image`, `language`, `created`, `modified`) VALUES
(1, 'New mission', 'Integer imperdiet bibendum vulputate. Phasellus congue massa arcu, ut tempus lectus molestie quis. In hac habitasse platea dictumst. Phasellus laoreet tempor imperdiet. Nam blandit sem at nisl sagittis, molestie fermentum mi commodo. Sed molestie, nunc quis venenatis dignissim, magna risus condimentum odio, eget sollicitudin ipsum enim eu diam. Nulla tristique sem nisi, eu tristique ipsum mollis sit amet. Nulla consectetur tellus sit amet metus vehicula, vestibulum congue sapien lacinia. Suspendisse hendrerit purus nisl, a suscipit risus facilisis et. Praesent faucibus quis dolor eu bibendum. Praesent condimentum rutrum libero, non luctus mauris consequat quis. Etiam adipiscing sodales est, et semper mauris convallis ut. Phasellus iaculis libero id viverra feugiat. Sed vitae ante sit amet mauris suscipit tincidunt a id nulla. Integer eu dapibus nulla. Phasellus sit amet nibh venenatis, pulvinar lacus nec, mattis lectus.', '', '', '2014-02-19 02:39:05', '2014-02-19 03:03:48'),
(2, 'Second Mission ', 'Donec scelerisque neque nibh, eget semper dolor tincidunt vel. Etiam molestie elit ac egestas rutrum. Morbi eget pharetra magna, eu fermentum lectus. Nulla ut mi sed tortor porta semper. In urna felis, sollicitudin ut lorem id, iaculis rutrum felis. Aliquam dolor sapien, sollicitudin ut ligula sit amet, sodales condimentum risus. Nunc arcu turpis, tincidunt a pharetra quis, fermentum eget sem. Nam sed interdum orci. Duis eu augue sed dolor iaculis hendrerit. Pellentesque sit amet tellus blandit, convallis ligula vitae, pharetra nisl. Nulla molestie justo massa, a malesuada nisl egestas id. Donec aliquet urna non turpis porttitor aliquet. Fusce non sodales libero. Curabitur et nibh eros. Curabitur eget euismod libero, ut pellentesque dolor', '', '', '2014-02-19 07:17:06', '2014-02-19 07:17:06');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mission_issues`
--

CREATE TABLE IF NOT EXISTS `mission_issues` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `mission_id` int(16) unsigned NOT NULL,
  `issue_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `mission_issues`
--

INSERT INTO `mission_issues` (`id`, `mission_id`, `issue_id`) VALUES
(1, 1, 1),
(2, 2, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `birthdate` date DEFAULT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `website` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `facebook` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `twitter` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `blog` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `points`
--

CREATE TABLE IF NOT EXISTS `points` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `value` double NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `quests`
--

CREATE TABLE IF NOT EXISTS `quests` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `mission_id` int(16) unsigned NOT NULL,
  `language` varchar(120) CHARACTER SET utf8 NOT NULL,
  `phase` varchar(120) CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `quests`
--

INSERT INTO `quests` (`id`, `title`, `description`, `mission_id`, `language`, `phase`, `created`, `modified`) VALUES
(1, 'New Quest', 'Vestibulum posuere varius metus, imperdiet gravida ipsum adipiscing et. Cras tincidunt ullamcorper tellus, vitae viverra tellus sagittis porta. Sed leo eros, ultrices vitae ipsum et, fringilla dictum nunc. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Ut vitae tristique augue. Maecenas dictum tempor nisl et fringilla. Quisque laoreet porttitor neque quis porttitor. Donec at libero lorem. Quisque a ante ultrices, luctus ligula id, molestie lorem. Duis semper metus et gravida faucibus.', 1, '', '', '2014-02-19 03:12:06', '2014-02-19 03:12:06'),
(2, 'Second Quest', 'Integer imperdiet bibendum vulputate. Phasellus congue massa arcu, ut tempus lectus molestie quis. In hac habitasse platea dictumst. Phasellus laoreet tempor imperdiet. Nam blandit sem at nisl sagittis, molestie fermentum mi commodo. Sed molestie, nunc quis venenatis dignissim, magna risus condimentum odio, eget sollicitudin ipsum enim eu diam. Nulla tristique sem nisi, eu tristique ipsum mollis sit amet. Nulla consectetur tellus sit amet metus vehicula, vestibulum congue sapien lacinia. Suspendisse hendrerit purus nisl, a suscipit risus facilisis et. Praesent faucibus quis dolor eu bibendum. Praesent condimentum rutrum libero, non luctus mauris consequat quis. Etiam adipiscing sodales est, et semper mauris convallis ut. Phasellus iaculis libero id viverra feugiat. Sed vitae ante sit amet mauris suscipit tincidunt a id nulla. Integer eu dapibus nulla. Phasellus sit amet nibh venenatis, pulvinar lacus nec, mattis lectus', 1, '', '', '2014-02-19 03:12:29', '2014-02-19 03:12:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `facebook_id` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `facebook_token` text CHARACTER SET utf8,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `birthdate` date NOT NULL,
  `sex` tinyint(1) NOT NULL,
  `biography` text CHARACTER SET utf8 NOT NULL,
  `username` varchar(120) CHARACTER SET utf8 NOT NULL,
  `password` varchar(120) CHARACTER SET utf8 NOT NULL,
  `facebook` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `twitter` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `instagram` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `website` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `blog` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `facebook_id`, `facebook_token`, `name`, `birthdate`, `sex`, `biography`, `username`, `password`, `facebook`, `twitter`, `instagram`, `website`, `blog`, `created`, `modified`) VALUES
(5, '100000218093892', 'CAAJeTV3YsC8BACELbHPZAhvEgrvQZAsA1ZC5oGZAeTjK3ZBOSc0lsjZAkjv29L6DX5SHJZArNd1Ns1kzgYoRuPjhcMTZATJvoOideaJbDPfY8Eb74Uon7V9U4osAUI5LO64aLYyAyRstIqz1X6CPnsFRD9L6ZAz10hN82gkImNZCKvx7iEZB6ZBMO6OsvbWo4PEbuugZD', 'Marcos Soledade Jr.', '0000-00-00', 1, '', '', '', 'https://www.facebook.com/marcosoledadejr', NULL, NULL, NULL, NULL, '2014-02-18 15:11:49', '2014-02-21 15:20:25'),
(7, NULL, NULL, 'Juan Gutierrez', '1994-06-10', 1, '', 'jgutierrez', '7c4a8d09ca3762af61e59520943dc26494f8941b', NULL, NULL, NULL, NULL, NULL, '2014-02-18 15:13:08', '0000-00-00 00:00:00'),
(10, '100002031279809', 'CAAJeTV3YsC8BAFLYWUTmNkw1dMoWiLEZBOQbeWJXAVDHXZAGckJEc1iXRAibE9i4igvTQWl6OgaEWKCUdKl6GZCCWt3ZBnUu0ZBOxmCs1ntaXIsLri6AqTEsHcKuh7d3pfGuFEPa8BMDXUxGoZCsthR55oq0i4QZCeVykBfzVq2YqNRAZCuStdwMtTovZBNNBrH8ZD', 'Renata Japur', '0000-00-00', 1, '', '', '', 'https://www.facebook.com/renata.japur', NULL, NULL, NULL, NULL, '2014-02-18 23:18:56', '2014-02-19 11:12:25'),
(11, NULL, NULL, 'noob', '2034-01-01', 0, 'ok', 'noob', 'f77038076e5ce6f09cd74dcb3466ce6f4dc9232c', '', '', '', '', '', '2014-02-18 23:25:20', '2014-02-18 23:30:42'),
(12, NULL, NULL, 'neww', '2034-01-01', 0, 'ew', 'neww', 'ed4bec84a1e493a668377beddc2c043d57395b60', '', '', '', '', '', '2014-02-18 23:29:35', '2014-02-18 23:29:54'),
(13, NULL, NULL, 'oops', '2034-01-01', 0, 'de', 'oops', 'c1f4b947f91aca5aaa0e0cd04b2ff0245a3797ee', '', '', '', '', '', '2014-02-18 23:57:51', '2014-02-18 23:59:32'),
(14, NULL, NULL, 'Username', '2034-01-01', 0, 'oi', 'username', 'd863b8d9bf33ad99835305171267e7d7de75e25d', '', '', '', '', '', '2014-02-19 01:19:17', '2014-02-19 01:19:26'),
(15, NULL, NULL, 'Newbs', '2034-01-01', 0, 'de', 'newbs', '0a8c02daa3125e7ab6c10cff11e072eec41a54a0', '', '', '', '', '', '2014-02-19 01:29:05', '2014-02-19 01:29:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_badges`
--

CREATE TABLE IF NOT EXISTS `user_badges` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `badge_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_organizations`
--

CREATE TABLE IF NOT EXISTS `user_organizations` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `organization_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `votes`
--

CREATE TABLE IF NOT EXISTS `votes` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `value` tinyint(4) NOT NULL,
  `evidence_id` int(16) unsigned NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=11 ;

--
-- Extraindo dados da tabela `votes`
--

INSERT INTO `votes` (`id`, `value`, `evidence_id`, `user_id`, `created`, `modified`) VALUES
(10, 4, 8, 10, '2014-02-19 07:09:03', '2014-02-19 07:09:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
