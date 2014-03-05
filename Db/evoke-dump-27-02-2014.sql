-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 27/02/2014 às 17h25min
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
-- Estrutura da tabela `acos`
--

CREATE TABLE IF NOT EXISTS `acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=192 ;

--
-- Extraindo dados da tabela `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, NULL, NULL, 'controllers', 1, 382),
(2, 1, NULL, NULL, 'Badges', 2, 23),
(3, 2, NULL, NULL, 'index', 3, 4),
(4, 2, NULL, NULL, 'view', 5, 6),
(5, 2, NULL, NULL, 'add', 7, 8),
(6, 2, NULL, NULL, 'edit', 9, 10),
(7, 2, NULL, NULL, 'delete', 11, 12),
(8, 2, NULL, NULL, 'admin_index', 13, 14),
(9, 2, NULL, NULL, 'admin_view', 15, 16),
(10, 2, NULL, NULL, 'admin_add', 17, 18),
(11, 2, NULL, NULL, 'admin_edit', 19, 20),
(12, 2, NULL, NULL, 'admin_delete', 21, 22),
(13, 1, NULL, NULL, 'Comments', 24, 47),
(14, 13, NULL, NULL, 'index', 25, 26),
(15, 13, NULL, NULL, 'view', 27, 28),
(16, 13, NULL, NULL, 'add', 29, 30),
(17, 13, NULL, NULL, 'edit', 31, 32),
(18, 13, NULL, NULL, 'delete', 33, 34),
(19, 13, NULL, NULL, 'getUserById', 35, 36),
(20, 13, NULL, NULL, 'admin_index', 37, 38),
(21, 13, NULL, NULL, 'admin_view', 39, 40),
(22, 13, NULL, NULL, 'admin_add', 41, 42),
(23, 13, NULL, NULL, 'admin_edit', 43, 44),
(24, 13, NULL, NULL, 'admin_delete', 45, 46),
(25, 1, NULL, NULL, 'Evidences', 48, 69),
(26, 25, NULL, NULL, 'index', 49, 50),
(27, 25, NULL, NULL, 'view', 51, 52),
(28, 25, NULL, NULL, 'add', 53, 54),
(29, 25, NULL, NULL, 'edit', 55, 56),
(30, 25, NULL, NULL, 'delete', 57, 58),
(31, 25, NULL, NULL, 'admin_index', 59, 60),
(32, 25, NULL, NULL, 'admin_view', 61, 62),
(33, 25, NULL, NULL, 'admin_add', 63, 64),
(34, 25, NULL, NULL, 'admin_edit', 65, 66),
(35, 25, NULL, NULL, 'admin_delete', 67, 68),
(36, 1, NULL, NULL, 'Evokations', 70, 91),
(37, 36, NULL, NULL, 'index', 71, 72),
(38, 36, NULL, NULL, 'view', 73, 74),
(39, 36, NULL, NULL, 'add', 75, 76),
(40, 36, NULL, NULL, 'edit', 77, 78),
(41, 36, NULL, NULL, 'delete', 79, 80),
(42, 36, NULL, NULL, 'admin_index', 81, 82),
(43, 36, NULL, NULL, 'admin_view', 83, 84),
(44, 36, NULL, NULL, 'admin_add', 85, 86),
(45, 36, NULL, NULL, 'admin_edit', 87, 88),
(46, 36, NULL, NULL, 'admin_delete', 89, 90),
(47, 1, NULL, NULL, 'Groups', 92, 113),
(48, 47, NULL, NULL, 'index', 93, 94),
(49, 47, NULL, NULL, 'view', 95, 96),
(50, 47, NULL, NULL, 'add', 97, 98),
(51, 47, NULL, NULL, 'edit', 99, 100),
(52, 47, NULL, NULL, 'delete', 101, 102),
(53, 47, NULL, NULL, 'admin_index', 103, 104),
(54, 47, NULL, NULL, 'admin_view', 105, 106),
(55, 47, NULL, NULL, 'admin_add', 107, 108),
(56, 47, NULL, NULL, 'admin_edit', 109, 110),
(57, 47, NULL, NULL, 'admin_delete', 111, 112),
(58, 1, NULL, NULL, 'GroupsUsers', 114, 135),
(59, 58, NULL, NULL, 'index', 115, 116),
(60, 58, NULL, NULL, 'view', 117, 118),
(61, 58, NULL, NULL, 'add', 119, 120),
(62, 58, NULL, NULL, 'edit', 121, 122),
(63, 58, NULL, NULL, 'delete', 123, 124),
(64, 58, NULL, NULL, 'admin_index', 125, 126),
(65, 58, NULL, NULL, 'admin_view', 127, 128),
(66, 58, NULL, NULL, 'admin_add', 129, 130),
(67, 58, NULL, NULL, 'admin_edit', 131, 132),
(68, 58, NULL, NULL, 'admin_delete', 133, 134),
(69, 1, NULL, NULL, 'Issues', 136, 157),
(70, 69, NULL, NULL, 'index', 137, 138),
(71, 69, NULL, NULL, 'view', 139, 140),
(72, 69, NULL, NULL, 'add', 141, 142),
(73, 69, NULL, NULL, 'edit', 143, 144),
(74, 69, NULL, NULL, 'delete', 145, 146),
(75, 69, NULL, NULL, 'admin_index', 147, 148),
(76, 69, NULL, NULL, 'admin_view', 149, 150),
(77, 69, NULL, NULL, 'admin_add', 151, 152),
(78, 69, NULL, NULL, 'admin_edit', 153, 154),
(79, 69, NULL, NULL, 'admin_delete', 155, 156),
(80, 1, NULL, NULL, 'MissionIssues', 158, 179),
(81, 80, NULL, NULL, 'index', 159, 160),
(82, 80, NULL, NULL, 'view', 161, 162),
(83, 80, NULL, NULL, 'add', 163, 164),
(84, 80, NULL, NULL, 'edit', 165, 166),
(85, 80, NULL, NULL, 'delete', 167, 168),
(86, 80, NULL, NULL, 'admin_index', 169, 170),
(87, 80, NULL, NULL, 'admin_view', 171, 172),
(88, 80, NULL, NULL, 'admin_add', 173, 174),
(89, 80, NULL, NULL, 'admin_edit', 175, 176),
(90, 80, NULL, NULL, 'admin_delete', 177, 178),
(91, 1, NULL, NULL, 'Missions', 180, 209),
(92, 91, NULL, NULL, 'index', 181, 182),
(93, 91, NULL, NULL, 'view', 183, 184),
(94, 91, NULL, NULL, 'add', 185, 186),
(95, 91, NULL, NULL, 'learn', 187, 188),
(96, 91, NULL, NULL, 'act', 189, 190),
(97, 91, NULL, NULL, 'imagine', 191, 192),
(98, 91, NULL, NULL, 'evoke', 193, 194),
(99, 91, NULL, NULL, 'edit', 195, 196),
(100, 91, NULL, NULL, 'delete', 197, 198),
(101, 91, NULL, NULL, 'admin_index', 199, 200),
(102, 91, NULL, NULL, 'admin_view', 201, 202),
(103, 91, NULL, NULL, 'admin_add', 203, 204),
(104, 91, NULL, NULL, 'admin_edit', 205, 206),
(105, 91, NULL, NULL, 'admin_delete', 207, 208),
(106, 1, NULL, NULL, 'Organizations', 210, 231),
(107, 106, NULL, NULL, 'index', 211, 212),
(108, 106, NULL, NULL, 'view', 213, 214),
(109, 106, NULL, NULL, 'add', 215, 216),
(110, 106, NULL, NULL, 'edit', 217, 218),
(111, 106, NULL, NULL, 'delete', 219, 220),
(112, 106, NULL, NULL, 'admin_index', 221, 222),
(113, 106, NULL, NULL, 'admin_view', 223, 224),
(114, 106, NULL, NULL, 'admin_add', 225, 226),
(115, 106, NULL, NULL, 'admin_edit', 227, 228),
(116, 106, NULL, NULL, 'admin_delete', 229, 230),
(117, 1, NULL, NULL, 'Pages', 232, 235),
(118, 117, NULL, NULL, 'display', 233, 234),
(119, 1, NULL, NULL, 'Panels', 236, 253),
(120, 119, NULL, NULL, 'index', 237, 238),
(121, 119, NULL, NULL, 'loadInfo', 239, 240),
(122, 119, NULL, NULL, 'groups', 241, 242),
(123, 119, NULL, NULL, 'users', 243, 244),
(124, 119, NULL, NULL, 'missionsIssues', 245, 246),
(125, 119, NULL, NULL, 'organizations', 247, 248),
(126, 119, NULL, NULL, 'issues', 249, 250),
(127, 119, NULL, NULL, 'badges', 251, 252),
(128, 1, NULL, NULL, 'Quests', 254, 275),
(129, 128, NULL, NULL, 'index', 255, 256),
(130, 128, NULL, NULL, 'view', 257, 258),
(131, 128, NULL, NULL, 'add', 259, 260),
(132, 128, NULL, NULL, 'edit', 261, 262),
(133, 128, NULL, NULL, 'delete', 263, 264),
(134, 128, NULL, NULL, 'admin_index', 265, 266),
(135, 128, NULL, NULL, 'admin_view', 267, 268),
(136, 128, NULL, NULL, 'admin_add', 269, 270),
(137, 128, NULL, NULL, 'admin_edit', 271, 272),
(138, 128, NULL, NULL, 'admin_delete', 273, 274),
(139, 1, NULL, NULL, 'Roles', 276, 287),
(140, 139, NULL, NULL, 'index', 277, 278),
(141, 139, NULL, NULL, 'view', 279, 280),
(142, 139, NULL, NULL, 'add', 281, 282),
(143, 139, NULL, NULL, 'edit', 283, 284),
(144, 139, NULL, NULL, 'delete', 285, 286),
(145, 1, NULL, NULL, 'UserIssues', 288, 309),
(146, 145, NULL, NULL, 'index', 289, 290),
(147, 145, NULL, NULL, 'view', 291, 292),
(148, 145, NULL, NULL, 'add', 293, 294),
(149, 145, NULL, NULL, 'edit', 295, 296),
(150, 145, NULL, NULL, 'delete', 297, 298),
(151, 145, NULL, NULL, 'admin_index', 299, 300),
(152, 145, NULL, NULL, 'admin_view', 301, 302),
(153, 145, NULL, NULL, 'admin_add', 303, 304),
(154, 145, NULL, NULL, 'admin_edit', 305, 306),
(155, 145, NULL, NULL, 'admin_delete', 307, 308),
(156, 1, NULL, NULL, 'Users', 310, 347),
(157, 156, NULL, NULL, 'login', 311, 312),
(158, 156, NULL, NULL, 'logout', 313, 314),
(159, 156, NULL, NULL, 'index', 315, 316),
(160, 156, NULL, NULL, 'register', 317, 318),
(161, 156, NULL, NULL, 'dashboard', 319, 320),
(162, 156, NULL, NULL, 'dashboardByIssue', 321, 322),
(163, 156, NULL, NULL, 'leaderboard', 323, 324),
(164, 156, NULL, NULL, 'add_friend', 325, 326),
(165, 156, NULL, NULL, 'remove_friend', 327, 328),
(166, 156, NULL, NULL, 'view', 329, 330),
(167, 156, NULL, NULL, 'add', 331, 332),
(168, 156, NULL, NULL, 'edit', 333, 334),
(169, 156, NULL, NULL, 'delete', 335, 336),
(170, 156, NULL, NULL, 'admin_index', 337, 338),
(171, 156, NULL, NULL, 'admin_view', 339, 340),
(172, 156, NULL, NULL, 'admin_add', 341, 342),
(173, 156, NULL, NULL, 'admin_edit', 343, 344),
(174, 156, NULL, NULL, 'admin_delete', 345, 346),
(175, 1, NULL, NULL, 'Votes', 348, 369),
(176, 175, NULL, NULL, 'index', 349, 350),
(177, 175, NULL, NULL, 'view', 351, 352),
(178, 175, NULL, NULL, 'add', 353, 354),
(179, 175, NULL, NULL, 'edit', 355, 356),
(180, 175, NULL, NULL, 'delete', 357, 358),
(181, 175, NULL, NULL, 'admin_index', 359, 360),
(182, 175, NULL, NULL, 'admin_view', 361, 362),
(183, 175, NULL, NULL, 'admin_add', 363, 364),
(184, 175, NULL, NULL, 'admin_edit', 365, 366),
(185, 175, NULL, NULL, 'admin_delete', 367, 368),
(186, 1, NULL, NULL, 'AclExtras', 370, 371),
(187, 1, NULL, NULL, 'DebugKit', 372, 379),
(188, 187, NULL, NULL, 'ToolbarAccess', 373, 378),
(189, 188, NULL, NULL, 'history_state', 374, 375),
(190, 188, NULL, NULL, 'sql_explain', 376, 377),
(191, 1, NULL, NULL, 'Upload', 380, 381);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aros`
--

CREATE TABLE IF NOT EXISTS `aros` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) DEFAULT NULL,
  `model` varchar(255) DEFAULT NULL,
  `foreign_key` int(10) DEFAULT NULL,
  `alias` varchar(255) DEFAULT NULL,
  `lft` int(10) DEFAULT NULL,
  `rght` int(10) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- Extraindo dados da tabela `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Role', 1, NULL, 1, 8),
(2, NULL, 'Role', 2, NULL, 9, 12),
(3, NULL, 'Role', 3, NULL, 13, 16),
(6, 1, 'User', 1, NULL, 6, 7),
(7, 2, 'User', 2, NULL, 10, 11),
(8, 3, 'User', 3, NULL, 14, 15);

-- --------------------------------------------------------

--
-- Estrutura da tabela `aros_acos`
--

CREATE TABLE IF NOT EXISTS `aros_acos` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `aro_id` int(10) NOT NULL,
  `aco_id` int(10) NOT NULL,
  `_create` varchar(2) NOT NULL DEFAULT '0',
  `_read` varchar(2) NOT NULL DEFAULT '0',
  `_update` varchar(2) NOT NULL DEFAULT '0',
  `_delete` varchar(2) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `ARO_ACO_KEY` (`aro_id`,`aco_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `aros_acos`
--

INSERT INTO `aros_acos` (`id`, `aro_id`, `aco_id`, `_create`, `_read`, `_update`, `_delete`) VALUES
(1, 1, 1, '1', '1', '1', '1'),
(2, 2, 1, '-1', '-1', '-1', '-1'),
(3, 2, 91, '1', '1', '1', '1'),
(4, 2, 106, '1', '1', '1', '1'),
(5, 3, 1, '-1', '-1', '-1', '-1'),
(6, 2, 175, '1', '1', '1', '1'),
(7, 2, 13, '1', '1', '1', '1'),
(8, 2, 25, '1', '1', '1', '1'),
(9, 2, 128, '1', '1', '1', '1'),
(10, 3, 175, '1', '1', '1', '1'),
(11, 3, 13, '1', '1', '1', '1'),
(12, 3, 25, '1', '1', '1', '1'),
(13, 2, 4, '1', '1', '1', '1'),
(14, 2, 3, '1', '1', '1', '1'),
(15, 3, 4, '1', '1', '1', '1'),
(16, 3, 3, '1', '1', '1', '1'),
(17, 2, 36, '1', '1', '1', '1'),
(18, 3, 36, '1', '1', '1', '1'),
(19, 3, 129, '1', '1', '1', '1'),
(20, 3, 130, '1', '1', '1', '1'),
(21, 2, 47, '1', '1', '1', '1'),
(22, 3, 47, '1', '1', '1', '1'),
(23, 2, 156, '1', '1', '1', '1'),
(24, 3, 156, '1', '1', '1', '1');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `group_id` int(16) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `missions`
--

INSERT INTO `missions` (`id`, `title`, `description`, `image`, `language`, `created`, `modified`, `group_id`) VALUES
(1, 'New mission', 'Integer imperdiet bibendum vulputate. Phasellus congue massa arcu, ut tempus lectus molestie quis. In hac habitasse platea dictumst. Phasellus laoreet tempor imperdiet. Nam blandit sem at nisl sagittis, molestie fermentum mi commodo. Sed molestie, nunc quis venenatis dignissim, magna risus condimentum odio, eget sollicitudin ipsum enim eu diam. Nulla tristique sem nisi, eu tristique ipsum mollis sit amet. Nulla consectetur tellus sit amet metus vehicula, vestibulum congue sapien lacinia. Suspendisse hendrerit purus nisl, a suscipit risus facilisis et. Praesent faucibus quis dolor eu bibendum. Praesent condimentum rutrum libero, non luctus mauris consequat quis. Etiam adipiscing sodales est, et semper mauris convallis ut. Phasellus iaculis libero id viverra feugiat. Sed vitae ante sit amet mauris suscipit tincidunt a id nulla. Integer eu dapibus nulla. Phasellus sit amet nibh venenatis, pulvinar lacus nec, mattis lectus.', '', '', '2014-02-19 02:39:05', '2014-02-19 03:03:48', 0),
(2, 'Second Mission ', 'Donec scelerisque neque nibh, eget semper dolor tincidunt vel. Etiam molestie elit ac egestas rutrum. Morbi eget pharetra magna, eu fermentum lectus. Nulla ut mi sed tortor porta semper. In urna felis, sollicitudin ut lorem id, iaculis rutrum felis. Aliquam dolor sapien, sollicitudin ut ligula sit amet, sodales condimentum risus. Nunc arcu turpis, tincidunt a pharetra quis, fermentum eget sem. Nam sed interdum orci. Duis eu augue sed dolor iaculis hendrerit. Pellentesque sit amet tellus blandit, convallis ligula vitae, pharetra nisl. Nulla molestie justo massa, a malesuada nisl egestas id. Donec aliquet urna non turpis porttitor aliquet. Fusce non sodales libero. Curabitur et nibh eros. Curabitur eget euismod libero, ut pellentesque dolor', '', '', '2014-02-19 07:17:06', '2014-02-19 07:17:06', 0);

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
-- Estrutura da tabela `role`
--

CREATE TABLE IF NOT EXISTS `role` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `role`
--

INSERT INTO `role` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'User');

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
  `role_id` int(16) NOT NULL DEFAULT '3',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `facebook_id`, `facebook_token`, `name`, `birthdate`, `sex`, `biography`, `username`, `password`, `facebook`, `twitter`, `instagram`, `website`, `blog`, `created`, `modified`, `role_id`) VALUES
(1, NULL, NULL, 'alexandre', '2014-02-27', 1, '', 'alexandre', 'cdeeae3ed8f20ad05252bd6dcf6fa20af7d82901', '', '', '', '', '', '2014-02-27 16:08:36', '2014-02-27 16:08:36', 1),
(2, NULL, NULL, 'manager teste', '2014-02-27', 0, '', 'manager', 'cdeeae3ed8f20ad05252bd6dcf6fa20af7d82901', '', '', '', '', '', '2014-02-27 16:09:15', '2014-02-27 16:09:15', 2),
(3, NULL, NULL, 'user teste', '2014-02-27', 0, '', 'user', '37807a199d6bc3b96f41882a84372f596914305b', '', '', '', '', '', '2014-02-27 16:09:36', '2014-02-27 16:09:36', 3);

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
