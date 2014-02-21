-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 21/02/2014 às 11h09min
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=386 ;

--
-- Extraindo dados da tabela `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(192, NULL, NULL, NULL, 'controllers', 1, 388),
(193, 192, NULL, NULL, 'Badges', 2, 23),
(194, 193, NULL, NULL, 'index', 3, 4),
(195, 193, NULL, NULL, 'view', 5, 6),
(196, 193, NULL, NULL, 'add', 7, 8),
(197, 193, NULL, NULL, 'edit', 9, 10),
(198, 193, NULL, NULL, 'delete', 11, 12),
(199, 193, NULL, NULL, 'admin_index', 13, 14),
(200, 193, NULL, NULL, 'admin_view', 15, 16),
(201, 193, NULL, NULL, 'admin_add', 17, 18),
(202, 193, NULL, NULL, 'admin_edit', 19, 20),
(203, 193, NULL, NULL, 'admin_delete', 21, 22),
(204, 192, NULL, NULL, 'Comments', 24, 47),
(205, 204, NULL, NULL, 'index', 25, 26),
(206, 204, NULL, NULL, 'view', 27, 28),
(207, 204, NULL, NULL, 'add', 29, 30),
(208, 204, NULL, NULL, 'edit', 31, 32),
(209, 204, NULL, NULL, 'delete', 33, 34),
(210, 204, NULL, NULL, 'getUserById', 35, 36),
(211, 204, NULL, NULL, 'admin_index', 37, 38),
(212, 204, NULL, NULL, 'admin_view', 39, 40),
(213, 204, NULL, NULL, 'admin_add', 41, 42),
(214, 204, NULL, NULL, 'admin_edit', 43, 44),
(215, 204, NULL, NULL, 'admin_delete', 45, 46),
(216, 192, NULL, NULL, 'Evidences', 48, 69),
(217, 216, NULL, NULL, 'index', 49, 50),
(218, 216, NULL, NULL, 'view', 51, 52),
(219, 216, NULL, NULL, 'add', 53, 54),
(220, 216, NULL, NULL, 'edit', 55, 56),
(221, 216, NULL, NULL, 'delete', 57, 58),
(222, 216, NULL, NULL, 'admin_index', 59, 60),
(223, 216, NULL, NULL, 'admin_view', 61, 62),
(224, 216, NULL, NULL, 'admin_add', 63, 64),
(225, 216, NULL, NULL, 'admin_edit', 65, 66),
(226, 216, NULL, NULL, 'admin_delete', 67, 68),
(227, 192, NULL, NULL, 'Evokations', 70, 91),
(228, 227, NULL, NULL, 'index', 71, 72),
(229, 227, NULL, NULL, 'view', 73, 74),
(230, 227, NULL, NULL, 'add', 75, 76),
(231, 227, NULL, NULL, 'edit', 77, 78),
(232, 227, NULL, NULL, 'delete', 79, 80),
(233, 227, NULL, NULL, 'admin_index', 81, 82),
(234, 227, NULL, NULL, 'admin_view', 83, 84),
(235, 227, NULL, NULL, 'admin_add', 85, 86),
(236, 227, NULL, NULL, 'admin_edit', 87, 88),
(237, 227, NULL, NULL, 'admin_delete', 89, 90),
(238, 192, NULL, NULL, 'Groups', 92, 113),
(239, 238, NULL, NULL, 'index', 93, 94),
(240, 238, NULL, NULL, 'view', 95, 96),
(241, 238, NULL, NULL, 'add', 97, 98),
(242, 238, NULL, NULL, 'edit', 99, 100),
(243, 238, NULL, NULL, 'delete', 101, 102),
(244, 238, NULL, NULL, 'admin_index', 103, 104),
(245, 238, NULL, NULL, 'admin_view', 105, 106),
(246, 238, NULL, NULL, 'admin_add', 107, 108),
(247, 238, NULL, NULL, 'admin_edit', 109, 110),
(248, 238, NULL, NULL, 'admin_delete', 111, 112),
(249, 192, NULL, NULL, 'GroupsUsers', 114, 137),
(250, 249, NULL, NULL, 'index', 115, 116),
(251, 249, NULL, NULL, 'view', 117, 118),
(252, 249, NULL, NULL, 'storeFileInfo', 119, 120),
(253, 249, NULL, NULL, 'add', 121, 122),
(254, 249, NULL, NULL, 'edit', 123, 124),
(255, 249, NULL, NULL, 'delete', 125, 126),
(256, 249, NULL, NULL, 'admin_index', 127, 128),
(257, 249, NULL, NULL, 'admin_view', 129, 130),
(258, 249, NULL, NULL, 'admin_add', 131, 132),
(259, 249, NULL, NULL, 'admin_edit', 133, 134),
(260, 249, NULL, NULL, 'admin_delete', 135, 136),
(261, 192, NULL, NULL, 'Issues', 138, 159),
(262, 261, NULL, NULL, 'index', 139, 140),
(263, 261, NULL, NULL, 'view', 141, 142),
(264, 261, NULL, NULL, 'add', 143, 144),
(265, 261, NULL, NULL, 'edit', 145, 146),
(266, 261, NULL, NULL, 'delete', 147, 148),
(267, 261, NULL, NULL, 'admin_index', 149, 150),
(268, 261, NULL, NULL, 'admin_view', 151, 152),
(269, 261, NULL, NULL, 'admin_add', 153, 154),
(270, 261, NULL, NULL, 'admin_edit', 155, 156),
(271, 261, NULL, NULL, 'admin_delete', 157, 158),
(272, 192, NULL, NULL, 'MissionIssues', 160, 181),
(273, 272, NULL, NULL, 'index', 161, 162),
(274, 272, NULL, NULL, 'view', 163, 164),
(275, 272, NULL, NULL, 'add', 165, 166),
(276, 272, NULL, NULL, 'edit', 167, 168),
(277, 272, NULL, NULL, 'delete', 169, 170),
(278, 272, NULL, NULL, 'admin_index', 171, 172),
(279, 272, NULL, NULL, 'admin_view', 173, 174),
(280, 272, NULL, NULL, 'admin_add', 175, 176),
(281, 272, NULL, NULL, 'admin_edit', 177, 178),
(282, 272, NULL, NULL, 'admin_delete', 179, 180),
(283, 192, NULL, NULL, 'Missions', 182, 211),
(284, 283, NULL, NULL, 'index', 183, 184),
(285, 283, NULL, NULL, 'view', 185, 186),
(286, 283, NULL, NULL, 'add', 187, 188),
(287, 283, NULL, NULL, 'learn', 189, 190),
(288, 283, NULL, NULL, 'act', 191, 192),
(289, 283, NULL, NULL, 'imagine', 193, 194),
(290, 283, NULL, NULL, 'evoke', 195, 196),
(291, 283, NULL, NULL, 'edit', 197, 198),
(292, 283, NULL, NULL, 'delete', 199, 200),
(293, 283, NULL, NULL, 'admin_index', 201, 202),
(294, 283, NULL, NULL, 'admin_view', 203, 204),
(295, 283, NULL, NULL, 'admin_add', 205, 206),
(296, 283, NULL, NULL, 'admin_edit', 207, 208),
(297, 283, NULL, NULL, 'admin_delete', 209, 210),
(298, 192, NULL, NULL, 'Organizations', 212, 233),
(299, 298, NULL, NULL, 'index', 213, 214),
(300, 298, NULL, NULL, 'view', 215, 216),
(301, 298, NULL, NULL, 'add', 217, 218),
(302, 298, NULL, NULL, 'edit', 219, 220),
(303, 298, NULL, NULL, 'delete', 221, 222),
(304, 298, NULL, NULL, 'admin_index', 223, 224),
(305, 298, NULL, NULL, 'admin_view', 225, 226),
(306, 298, NULL, NULL, 'admin_add', 227, 228),
(307, 298, NULL, NULL, 'admin_edit', 229, 230),
(308, 298, NULL, NULL, 'admin_delete', 231, 232),
(309, 192, NULL, NULL, 'Pages', 234, 237),
(310, 309, NULL, NULL, 'display', 235, 236),
(311, 192, NULL, NULL, 'Panels', 238, 259),
(312, 311, NULL, NULL, 'index', 239, 240),
(313, 311, NULL, NULL, 'loadInfo', 241, 242),
(314, 311, NULL, NULL, 'groups', 243, 244),
(315, 311, NULL, NULL, 'roles', 245, 246),
(316, 311, NULL, NULL, 'users', 247, 248),
(317, 311, NULL, NULL, 'usersRole', 249, 250),
(318, 311, NULL, NULL, 'missionsIssues', 251, 252),
(319, 311, NULL, NULL, 'organizations', 253, 254),
(320, 311, NULL, NULL, 'issues', 255, 256),
(321, 311, NULL, NULL, 'badges', 257, 258),
(322, 192, NULL, NULL, 'Quests', 260, 281),
(323, 322, NULL, NULL, 'index', 261, 262),
(324, 322, NULL, NULL, 'view', 263, 264),
(325, 322, NULL, NULL, 'add', 265, 266),
(326, 322, NULL, NULL, 'edit', 267, 268),
(327, 322, NULL, NULL, 'delete', 269, 270),
(328, 322, NULL, NULL, 'admin_index', 271, 272),
(329, 322, NULL, NULL, 'admin_view', 273, 274),
(330, 322, NULL, NULL, 'admin_add', 275, 276),
(331, 322, NULL, NULL, 'admin_edit', 277, 278),
(332, 322, NULL, NULL, 'admin_delete', 279, 280),
(333, 192, NULL, NULL, 'Roles', 282, 293),
(334, 333, NULL, NULL, 'index', 283, 284),
(335, 333, NULL, NULL, 'view', 285, 286),
(336, 333, NULL, NULL, 'add', 287, 288),
(337, 333, NULL, NULL, 'edit', 289, 290),
(338, 333, NULL, NULL, 'delete', 291, 292),
(339, 192, NULL, NULL, 'UserIssues', 294, 315),
(340, 339, NULL, NULL, 'index', 295, 296),
(341, 339, NULL, NULL, 'view', 297, 298),
(342, 339, NULL, NULL, 'add', 299, 300),
(343, 339, NULL, NULL, 'edit', 301, 302),
(344, 339, NULL, NULL, 'delete', 303, 304),
(345, 339, NULL, NULL, 'admin_index', 305, 306),
(346, 339, NULL, NULL, 'admin_view', 307, 308),
(347, 339, NULL, NULL, 'admin_add', 309, 310),
(348, 339, NULL, NULL, 'admin_edit', 311, 312),
(349, 339, NULL, NULL, 'admin_delete', 313, 314),
(350, 192, NULL, NULL, 'Users', 316, 353),
(351, 350, NULL, NULL, 'login', 317, 318),
(352, 350, NULL, NULL, 'logout', 319, 320),
(353, 350, NULL, NULL, 'index', 321, 322),
(354, 350, NULL, NULL, 'register', 323, 324),
(355, 350, NULL, NULL, 'dashboard', 325, 326),
(356, 350, NULL, NULL, 'dashboardByIssue', 327, 328),
(357, 350, NULL, NULL, 'leaderboard', 329, 330),
(358, 350, NULL, NULL, 'add_friend', 331, 332),
(359, 350, NULL, NULL, 'remove_friend', 333, 334),
(360, 350, NULL, NULL, 'view', 335, 336),
(361, 350, NULL, NULL, 'add', 337, 338),
(362, 350, NULL, NULL, 'edit', 339, 340),
(363, 350, NULL, NULL, 'delete', 341, 342),
(364, 350, NULL, NULL, 'admin_index', 343, 344),
(365, 350, NULL, NULL, 'admin_view', 345, 346),
(366, 350, NULL, NULL, 'admin_add', 347, 348),
(367, 350, NULL, NULL, 'admin_edit', 349, 350),
(368, 350, NULL, NULL, 'admin_delete', 351, 352),
(369, 192, NULL, NULL, 'Votes', 354, 375),
(370, 369, NULL, NULL, 'index', 355, 356),
(371, 369, NULL, NULL, 'view', 357, 358),
(372, 369, NULL, NULL, 'add', 359, 360),
(373, 369, NULL, NULL, 'edit', 361, 362),
(374, 369, NULL, NULL, 'delete', 363, 364),
(375, 369, NULL, NULL, 'admin_index', 365, 366),
(376, 369, NULL, NULL, 'admin_view', 367, 368),
(377, 369, NULL, NULL, 'admin_add', 369, 370),
(378, 369, NULL, NULL, 'admin_edit', 371, 372),
(379, 369, NULL, NULL, 'admin_delete', 373, 374),
(380, 192, NULL, NULL, 'AclExtras', 376, 377),
(381, 192, NULL, NULL, 'DebugKit', 378, 385),
(382, 381, NULL, NULL, 'ToolbarAccess', 379, 384),
(383, 382, NULL, NULL, 'history_state', 380, 381),
(384, 382, NULL, NULL, 'sql_explain', 382, 383),
(385, 192, NULL, NULL, 'Upload', 386, 387);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Role', 1, 'Administrator', 1, 8),
(2, NULL, 'Role', 2, 'Manager', 9, 12),
(3, NULL, 'Role', 3, 'User', 13, 16),
(4, NULL, 'User', 1, NULL, 19, 20),
(5, NULL, 'User', 2, NULL, 17, 18),
(6, NULL, 'User', 3, NULL, 21, 22);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=27 ;

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
(24, 3, 156, '1', '1', '1', '1'),
(25, 1, 311, '1', '1', '1', '1'),
(26, 1, 193, '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `attachments`
--

CREATE TABLE IF NOT EXISTS `attachments` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(20) NOT NULL,
  `foreign_key` int(16) NOT NULL,
  `name` varchar(32) NOT NULL,
  `attachment` varchar(255) NOT NULL,
  `dir` varchar(255) DEFAULT NULL,
  `type` varchar(255) DEFAULT NULL,
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
  `trigger` varchar(120) NOT NULL,
  `language` varchar(120) DEFAULT NULL,
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
  `evidence_id` int(16) unsigned NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `content` text CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
  `phase_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `evidences`
--

INSERT INTO `evidences` (`id`, `title`, `content`, `user_id`, `quest_id`, `mission_id`, `phase_id`, `created`, `modified`) VALUES
(1, 'New Evidence', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis luctus metus et dapibus. Suspendisse faucibus interdum viverra. Aliquam purus est, accumsan vel eros quis, ultricies fringilla nunc. Fusce id leo adipiscing nisi semper ullamcorper. Aliquam iaculis dolor in risus commodo, sit amet dictum magna venenatis. Ut tristique sed diam eu dapibus. Vestibulum lorem magna, ultricies nec cursus eget, ornare id purus.', 3, NULL, 1, 1, '2014-02-21 01:53:33', '2014-02-21 07:06:07'),
(4, 'jkhk', '', 1, 2, 1, 1, '2014-02-21 09:29:01', '2014-02-21 09:29:01');

-- --------------------------------------------------------

--
-- Estrutura da tabela `evokations`
--

CREATE TABLE IF NOT EXISTS `evokations` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `group_id` int(16) unsigned NOT NULL,
  `gdrive_file_id` text,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `abstract` text CHARACTER SET utf8 NOT NULL,
  `language` varchar(120) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=24 ;

--
-- Extraindo dados da tabela `evokations`
--

INSERT INTO `evokations` (`id`, `group_id`, `gdrive_file_id`, `title`, `abstract`, `language`, `created`, `modified`) VALUES
(18, 3, '0B9uWvehaHYz2aWdjdmRfZWZLR0E', 'tmp_title', 'tmp_abstract', NULL, '2014-02-28 19:36:00', '2014-02-28 19:36:00'),
(19, 3, '0B9uWvehaHYz2NUVrVHNSSUV4WjA', 'tmp_title', 'tmp_abstract', NULL, '2014-02-28 19:47:42', '2014-02-28 19:47:42'),
(20, 0, NULL, 'Evokation', '', NULL, '2014-02-20 23:27:31', '2014-02-20 23:27:31'),
(21, 0, NULL, 'New Evokation', 'Test', NULL, '2014-02-21 01:50:36', '2014-02-21 01:50:36'),
(22, 0, NULL, 'New Evokation', 'Test', NULL, '2014-02-21 01:50:42', '2014-02-21 01:50:42'),
(23, 0, NULL, 'New Evokation', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis luctus metus et dapibus. Suspendisse faucibus interdum viverra. Aliquam purus est, accumsan vel eros quis, ultricies fringilla nunc. Fusce id leo adipiscing nisi semper ullamcorper. Aliquam iaculis dolor in risus commodo, sit amet dictum magna venenatis. Ut tristique sed diam eu dapibus. Vestibulum lorem magna, ultricies nec cursus eget, ornare id purus.', NULL, '2014-02-21 01:51:25', '2014-02-21 01:51:25');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `title`, `user_id`, `created`, `modified`) VALUES
(6, 'Pawnee', 3, '2014-02-21 10:39:03', '2014-02-21 10:39:03');

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

-- --------------------------------------------------------

--
-- Estrutura da tabela `issues`
--

CREATE TABLE IF NOT EXISTS `issues` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `parent_id` int(16) unsigned DEFAULT NULL,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `slug` varchar(120) NOT NULL COMMENT 'This is just the sanitized name',
  `language` varchar(120) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `issues`
--

INSERT INTO `issues` (`id`, `parent_id`, `name`, `slug`, `language`, `created`, `modified`) VALUES
(1, NULL, 'Water', 'water', NULL, '2014-03-05 15:38:10', '2014-03-05 15:38:10'),
(2, NULL, 'Economy', 'economy', NULL, '2014-03-05 15:38:28', '2014-03-05 15:38:28'),
(3, NULL, 'Health', 'health', NULL, '2014-03-05 15:38:40', '2014-03-05 15:38:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `missions`
--

CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `image` varchar(120) DEFAULT NULL,
  `language` varchar(120) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `missions`
--

INSERT INTO `missions` (`id`, `title`, `description`, `image`, `language`, `created`, `modified`) VALUES
(1, 'Loren Mission', 'some mission', NULL, NULL, NULL, NULL),
(2, 'Quantica', 'mission quantica', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `mission_issues`
--

CREATE TABLE IF NOT EXISTS `mission_issues` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `mission_id` int(16) unsigned NOT NULL,
  `issue_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `mission_issues`
--

INSERT INTO `mission_issues` (`id`, `mission_id`, `issue_id`) VALUES
(1, 1, 2),
(2, 2, 1),
(3, 2, 2),
(4, 1, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `organizations`
--

CREATE TABLE IF NOT EXISTS `organizations` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `birthdate` date DEFAULT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `website` varchar(120) DEFAULT NULL,
  `facerbook` varchar(120) DEFAULT NULL,
  `twitter` varchar(120) DEFAULT NULL,
  `blog` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `phases`
--

CREATE TABLE IF NOT EXISTS `phases` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `mission_id` int(16) unsigned NOT NULL,
  `position` int(16) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `phases`
--

INSERT INTO `phases` (`id`, `name`, `description`, `mission_id`, `position`, `type`, `created`, `modified`) VALUES
(1, 'Phase 1', '', 1, 1, 1, '2014-02-20 23:44:02', '2014-02-21 08:13:48'),
(2, 'Phase 2', '', 1, 2, 1, '2014-02-20 23:44:12', '2014-02-21 08:18:16'),
(3, 'Phase 3', '', 1, 3, 0, '2014-02-20 23:44:24', '2014-02-21 03:43:12');

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
  `phase_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `quests`
--

INSERT INTO `quests` (`id`, `title`, `description`, `mission_id`, `phase_id`, `created`, `modified`) VALUES
(1, 'Quest One', '', 1, 1, '2014-02-21 08:52:41', '2014-02-21 08:52:41'),
(2, 'Quest Ow', '', 1, 1, '2014-02-21 08:52:53', '2014-02-21 08:52:53');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'User');

-- --------------------------------------------------------

--
-- Estrutura da tabela `settings`
--

CREATE TABLE IF NOT EXISTS `settings` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `key` varchar(120) CHARACTER SET utf8 NOT NULL,
  `value` text CHARACTER SET utf8 NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `settings`
--

INSERT INTO `settings` (`id`, `key`, `value`, `created`, `modified`) VALUES
(18, 'google_auth_refresh_token', '{"access_token":"ya29.1.AADtN_XZrVOpuli9ZfeMcOz7RA8kVMdVjEOHFzjngx7RI365LVPnFm4wgRFYhY4","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImY2MDNhODlhNzQ0OGEyMjM5MDcxZjI4YTk3MzViNjUwNWM2YWJjYTgifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiY2lkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXpwIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwidG9rZW5faGFzaCI6ImhYZjJzUVV5c1Zma09GbHpIbmtKMkEiLCJhdF9oYXNoIjoiaFhmMnNRVXlzVmZrT0Zsekhua0oyQSIsImlkIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwic3ViIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwiYXVkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJtc29sZWRhZGVAcXVhbnRpLmNhIiwiaGQiOiJxdWFudGkuY2EiLCJ2ZXJpZmllZF9lbWFpbCI6InRydWUiLCJlbWFpbF92ZXJpZmllZCI6InRydWUiLCJpYXQiOjEzOTM1MjQyNTUsImV4cCI6MTM5MzUyODE1NX0.c9WNn8ubqvqkVxJpcpW_Xs9xWhbZ_HHdP6_ROM7uUi81UvQEQXlmckCluf46GR4MLIrMKyejhgoYp5kD0uRo8zel5lFu7ucaZTCAZHT1C5wMniYPzhuVonlWazwX19MefJhDR67pEa6xKUFpA5IhlnvAvTLRT0-_v2aCiODr-CQ","refresh_token":"1\\/hF_NMUf2qVGOip0lzm15Bluw48dK5-7M4Q4TBXMqYnc","created":1393524537}', '2014-02-27 15:08:57', '2014-02-27 15:08:57'),
(19, 'google_auth_access_token', '{"access_token":"ya29.1.AADtN_XkZEMDx2JYvC66rskr0z2CuWnv84uZ_w87CJpLWadCJ1m9Zj2H0qCncs5v","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImY2MDNhODlhNzQ0OGEyMjM5MDcxZjI4YTk3MzViNjUwNWM2YWJjYTgifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiY2lkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXpwIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwidG9rZW5faGFzaCI6ImhYZjJzUVV5c1Zma09GbHpIbmtKMkEiLCJhdF9oYXNoIjoiaFhmMnNRVXlzVmZrT0Zsekhua0oyQSIsImlkIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwic3ViIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwiYXVkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJtc29sZWRhZGVAcXVhbnRpLmNhIiwiaGQiOiJxdWFudGkuY2EiLCJ2ZXJpZmllZF9lbWFpbCI6InRydWUiLCJlbWFpbF92ZXJpZmllZCI6InRydWUiLCJpYXQiOjEzOTM1MjQyNTUsImV4cCI6MTM5MzUyODE1NX0.c9WNn8ubqvqkVxJpcpW_Xs9xWhbZ_HHdP6_ROM7uUi81UvQEQXlmckCluf46GR4MLIrMKyejhgoYp5kD0uRo8zel5lFu7ucaZTCAZHT1C5wMniYPzhuVonlWazwX19MefJhDR67pEa6xKUFpA5IhlnvAvTLRT0-_v2aCiODr-CQ","refresh_token":"1\\/hF_NMUf2qVGOip0lzm15Bluw48dK5-7M4Q4TBXMqYnc","created":1393625384}', '2014-02-27 15:08:57', '2014-02-21 10:27:54');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `role_id` int(16) unsigned NOT NULL DEFAULT '3',
  `facebook_id` varchar(120) DEFAULT NULL,
  `facebook_token` text,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `birthdate` date NOT NULL,
  `email` varchar(120) DEFAULT NULL,
  `sex` tinyint(2) NOT NULL,
  `biography` text CHARACTER SET utf8 NOT NULL,
  `username` varchar(120) NOT NULL,
  `password` varchar(120) NOT NULL,
  `facebook` varchar(120) DEFAULT NULL,
  `twitter` varchar(120) DEFAULT NULL,
  `instagram` varchar(120) DEFAULT NULL,
  `website` varchar(120) DEFAULT NULL,
  `blog` varchar(120) DEFAULT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `role_id`, `facebook_id`, `facebook_token`, `name`, `birthdate`, `email`, `sex`, `biography`, `username`, `password`, `facebook`, `twitter`, `instagram`, `website`, `blog`, `created`, `modified`) VALUES
(1, 3, '100001280484261', 'CAAJeTV3YsC8BANSI4W7xYD35n5mG3DZBvZB0H4PofqOauOyZBAJYNBzByRxnHsU5HozaYOGF0YJy5iNTLY04T6cD96dH7TfKCszKvDjlNDxhLJxgWzqW7BPCQCauBimWJQIZAE2dAGvdOyG4IkmDwoS8JAlyMSof5HqxcHfZBFOjZBBA0FpWyLtqktpozw2vcZD', 'Alexandre Rossi Alvares', '0000-00-00', NULL, 1, '', '', '', 'https://www.facebook.com/alerossialvares', NULL, NULL, NULL, NULL, '2014-03-06 12:46:26', '2014-03-06 15:21:17'),
(2, 1, NULL, NULL, 'Ale Admin', '0000-00-00', NULL, 0, '', 'root', '39c3730c51df48f65defc5a94dbd1312df8ebb05', NULL, NULL, NULL, NULL, NULL, '2014-03-06 12:47:22', '2014-03-06 12:47:22'),
(3, 3, '100002031279809', 'CAAJeTV3YsC8BAM0LcW0aopdK9rrBkmS9mVcSOBYEia9VWdYDsOYuxmV1iZAEQpv6wt5C9pnzZB2DreX4yAZAoDsNNwThaYzLDcZAWW4qKxiHv8EJYY4DRkW0gykWx0sk2bRQbiZBubAZCe2hghk2wsEOTUlhtRAnDUHXVORCMrKlbFsX7gKZBlwyFFy5gAURrUZD', 'Renata Japur', '2034-01-01', 'rjapur@quanti.ca', 1, 'Renata', 'rjapur', '701c59892bf3938f21d262dbf354224e2c72b19c', 'https://www.facebook.com/renata.japur', '', '', '', '', '2014-02-20 20:54:19', '2014-02-21 10:40:28');

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
-- Estrutura da tabela `user_issues`
--

CREATE TABLE IF NOT EXISTS `user_issues` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `issue_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
  `evidence_id` int(16) unsigned NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `value` tinyint(4) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `votes`
--

INSERT INTO `votes` (`id`, `evidence_id`, `user_id`, `value`, `created`, `modified`) VALUES
(1, 1, 3, 4, '2014-02-21 08:36:38', '2014-02-21 08:36:38');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
