-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 17/03/2014 às 16h10min
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=438 ;

--
-- Extraindo dados da tabela `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(192, NULL, NULL, NULL, 'controllers', 1, 368),
(193, 192, NULL, NULL, 'Badges', 2, 13),
(194, 193, NULL, NULL, 'index', 3, 4),
(195, 193, NULL, NULL, 'view', 5, 6),
(196, 193, NULL, NULL, 'add', 7, 8),
(197, 193, NULL, NULL, 'edit', 9, 10),
(198, 193, NULL, NULL, 'delete', 11, 12),
(204, 192, NULL, NULL, 'Comments', 14, 37),
(205, 204, NULL, NULL, 'index', 15, 16),
(206, 204, NULL, NULL, 'view', 17, 18),
(207, 204, NULL, NULL, 'add', 19, 20),
(208, 204, NULL, NULL, 'edit', 21, 22),
(209, 204, NULL, NULL, 'delete', 23, 24),
(210, 204, NULL, NULL, 'getUserById', 25, 26),
(211, 204, NULL, NULL, 'admin_index', 27, 28),
(212, 204, NULL, NULL, 'admin_view', 29, 30),
(213, 204, NULL, NULL, 'admin_add', 31, 32),
(214, 204, NULL, NULL, 'admin_edit', 33, 34),
(215, 204, NULL, NULL, 'admin_delete', 35, 36),
(216, 192, NULL, NULL, 'Evidences', 38, 59),
(217, 216, NULL, NULL, 'index', 39, 40),
(218, 216, NULL, NULL, 'view', 41, 42),
(219, 216, NULL, NULL, 'add', 43, 44),
(220, 216, NULL, NULL, 'edit', 45, 46),
(221, 216, NULL, NULL, 'delete', 47, 48),
(222, 216, NULL, NULL, 'admin_index', 49, 50),
(223, 216, NULL, NULL, 'admin_view', 51, 52),
(224, 216, NULL, NULL, 'admin_add', 53, 54),
(225, 216, NULL, NULL, 'admin_edit', 55, 56),
(226, 216, NULL, NULL, 'admin_delete', 57, 58),
(227, 192, NULL, NULL, 'Evokations', 60, 81),
(228, 227, NULL, NULL, 'index', 61, 62),
(229, 227, NULL, NULL, 'view', 63, 64),
(230, 227, NULL, NULL, 'add', 65, 66),
(231, 227, NULL, NULL, 'edit', 67, 68),
(232, 227, NULL, NULL, 'delete', 69, 70),
(233, 227, NULL, NULL, 'admin_index', 71, 72),
(234, 227, NULL, NULL, 'admin_view', 73, 74),
(235, 227, NULL, NULL, 'admin_add', 75, 76),
(236, 227, NULL, NULL, 'admin_edit', 77, 78),
(237, 227, NULL, NULL, 'admin_delete', 79, 80),
(238, 192, NULL, NULL, 'Groups', 82, 103),
(239, 238, NULL, NULL, 'index', 83, 84),
(240, 238, NULL, NULL, 'view', 85, 86),
(241, 238, NULL, NULL, 'add', 87, 88),
(242, 238, NULL, NULL, 'edit', 89, 90),
(243, 238, NULL, NULL, 'delete', 91, 92),
(244, 238, NULL, NULL, 'admin_index', 93, 94),
(245, 238, NULL, NULL, 'admin_view', 95, 96),
(246, 238, NULL, NULL, 'admin_add', 97, 98),
(247, 238, NULL, NULL, 'admin_edit', 99, 100),
(248, 238, NULL, NULL, 'admin_delete', 101, 102),
(249, 192, NULL, NULL, 'GroupsUsers', 104, 129),
(250, 249, NULL, NULL, 'index', 105, 106),
(251, 249, NULL, NULL, 'view', 107, 108),
(252, 249, NULL, NULL, 'storeFileInfo', 109, 110),
(253, 249, NULL, NULL, 'add', 111, 112),
(254, 249, NULL, NULL, 'edit', 113, 114),
(255, 249, NULL, NULL, 'delete', 115, 116),
(256, 249, NULL, NULL, 'admin_index', 117, 118),
(257, 249, NULL, NULL, 'admin_view', 119, 120),
(258, 249, NULL, NULL, 'admin_add', 121, 122),
(259, 249, NULL, NULL, 'admin_edit', 123, 124),
(260, 249, NULL, NULL, 'admin_delete', 125, 126),
(261, 192, NULL, NULL, 'Issues', 130, 151),
(262, 261, NULL, NULL, 'index', 131, 132),
(263, 261, NULL, NULL, 'view', 133, 134),
(264, 261, NULL, NULL, 'add', 135, 136),
(265, 261, NULL, NULL, 'edit', 137, 138),
(266, 261, NULL, NULL, 'delete', 139, 140),
(267, 261, NULL, NULL, 'admin_index', 141, 142),
(268, 261, NULL, NULL, 'admin_view', 143, 144),
(269, 261, NULL, NULL, 'admin_add', 145, 146),
(270, 261, NULL, NULL, 'admin_edit', 147, 148),
(271, 261, NULL, NULL, 'admin_delete', 149, 150),
(272, 192, NULL, NULL, 'MissionIssues', 152, 173),
(273, 272, NULL, NULL, 'index', 153, 154),
(274, 272, NULL, NULL, 'view', 155, 156),
(275, 272, NULL, NULL, 'add', 157, 158),
(276, 272, NULL, NULL, 'edit', 159, 160),
(277, 272, NULL, NULL, 'delete', 161, 162),
(278, 272, NULL, NULL, 'admin_index', 163, 164),
(279, 272, NULL, NULL, 'admin_view', 165, 166),
(280, 272, NULL, NULL, 'admin_add', 167, 168),
(281, 272, NULL, NULL, 'admin_edit', 169, 170),
(282, 272, NULL, NULL, 'admin_delete', 171, 172),
(283, 192, NULL, NULL, 'Missions', 174, 195),
(284, 283, NULL, NULL, 'index', 175, 176),
(285, 283, NULL, NULL, 'view', 177, 178),
(286, 283, NULL, NULL, 'add', 179, 180),
(291, 283, NULL, NULL, 'edit', 181, 182),
(292, 283, NULL, NULL, 'delete', 183, 184),
(293, 283, NULL, NULL, 'admin_index', 185, 186),
(294, 283, NULL, NULL, 'admin_view', 187, 188),
(295, 283, NULL, NULL, 'admin_add', 189, 190),
(296, 283, NULL, NULL, 'admin_edit', 191, 192),
(297, 283, NULL, NULL, 'admin_delete', 193, 194),
(298, 192, NULL, NULL, 'Organizations', 196, 207),
(299, 298, NULL, NULL, 'index', 197, 198),
(300, 298, NULL, NULL, 'view', 199, 200),
(301, 298, NULL, NULL, 'add', 201, 202),
(302, 298, NULL, NULL, 'edit', 203, 204),
(303, 298, NULL, NULL, 'delete', 205, 206),
(309, 192, NULL, NULL, 'Pages', 208, 211),
(310, 309, NULL, NULL, 'display', 209, 210),
(311, 192, NULL, NULL, 'Panels', 212, 239),
(312, 311, NULL, NULL, 'index', 213, 214),
(322, 192, NULL, NULL, 'Quests', 240, 261),
(323, 322, NULL, NULL, 'index', 241, 242),
(324, 322, NULL, NULL, 'view', 243, 244),
(325, 322, NULL, NULL, 'add', 245, 246),
(326, 322, NULL, NULL, 'edit', 247, 248),
(327, 322, NULL, NULL, 'delete', 249, 250),
(328, 322, NULL, NULL, 'admin_index', 251, 252),
(329, 322, NULL, NULL, 'admin_view', 253, 254),
(330, 322, NULL, NULL, 'admin_add', 255, 256),
(331, 322, NULL, NULL, 'admin_edit', 257, 258),
(332, 322, NULL, NULL, 'admin_delete', 259, 260),
(333, 192, NULL, NULL, 'Roles', 262, 273),
(334, 333, NULL, NULL, 'index', 263, 264),
(335, 333, NULL, NULL, 'view', 265, 266),
(336, 333, NULL, NULL, 'add', 267, 268),
(337, 333, NULL, NULL, 'edit', 269, 270),
(338, 333, NULL, NULL, 'delete', 271, 272),
(339, 192, NULL, NULL, 'UserIssues', 274, 295),
(340, 339, NULL, NULL, 'index', 275, 276),
(341, 339, NULL, NULL, 'view', 277, 278),
(342, 339, NULL, NULL, 'add', 279, 280),
(343, 339, NULL, NULL, 'edit', 281, 282),
(344, 339, NULL, NULL, 'delete', 283, 284),
(345, 339, NULL, NULL, 'admin_index', 285, 286),
(346, 339, NULL, NULL, 'admin_view', 287, 288),
(347, 339, NULL, NULL, 'admin_add', 289, 290),
(348, 339, NULL, NULL, 'admin_edit', 291, 292),
(349, 339, NULL, NULL, 'admin_delete', 293, 294),
(350, 192, NULL, NULL, 'Users', 296, 333),
(351, 350, NULL, NULL, 'login', 297, 298),
(352, 350, NULL, NULL, 'logout', 299, 300),
(353, 350, NULL, NULL, 'index', 301, 302),
(354, 350, NULL, NULL, 'register', 303, 304),
(355, 350, NULL, NULL, 'dashboard', 305, 306),
(356, 350, NULL, NULL, 'dashboardByIssue', 307, 308),
(357, 350, NULL, NULL, 'leaderboard', 309, 310),
(358, 350, NULL, NULL, 'add_friend', 311, 312),
(359, 350, NULL, NULL, 'remove_friend', 313, 314),
(360, 350, NULL, NULL, 'view', 315, 316),
(361, 350, NULL, NULL, 'add', 317, 318),
(362, 350, NULL, NULL, 'edit', 319, 320),
(363, 350, NULL, NULL, 'delete', 321, 322),
(364, 350, NULL, NULL, 'admin_index', 323, 324),
(365, 350, NULL, NULL, 'admin_view', 325, 326),
(366, 350, NULL, NULL, 'admin_add', 327, 328),
(367, 350, NULL, NULL, 'admin_edit', 329, 330),
(368, 350, NULL, NULL, 'admin_delete', 331, 332),
(369, 192, NULL, NULL, 'Votes', 334, 355),
(370, 369, NULL, NULL, 'index', 335, 336),
(371, 369, NULL, NULL, 'view', 337, 338),
(372, 369, NULL, NULL, 'add', 339, 340),
(373, 369, NULL, NULL, 'edit', 341, 342),
(374, 369, NULL, NULL, 'delete', 343, 344),
(375, 369, NULL, NULL, 'admin_index', 345, 346),
(376, 369, NULL, NULL, 'admin_view', 347, 348),
(377, 369, NULL, NULL, 'admin_add', 349, 350),
(378, 369, NULL, NULL, 'admin_edit', 351, 352),
(379, 369, NULL, NULL, 'admin_delete', 353, 354),
(380, 192, NULL, NULL, 'AclExtras', 356, 357),
(381, 192, NULL, NULL, 'DebugKit', 358, 365),
(382, 381, NULL, NULL, 'ToolbarAccess', 359, 364),
(383, 382, NULL, NULL, 'history_state', 360, 361),
(384, 382, NULL, NULL, 'sql_explain', 362, 363),
(385, 192, NULL, NULL, 'Upload', 366, 367),
(386, NULL, NULL, NULL, 'controllers', 369, 370),
(387, NULL, NULL, NULL, 'controllers', 371, 372),
(388, NULL, NULL, NULL, 'controllers', 373, 444),
(389, 249, NULL, NULL, 'send', 127, 128),
(390, 311, NULL, NULL, 'add_mission', 215, 216),
(391, 311, NULL, NULL, 'edit_mission', 217, 218),
(392, 311, NULL, NULL, 'add_phase', 219, 220),
(393, 311, NULL, NULL, 'add_quest', 221, 222),
(394, 311, NULL, NULL, 'edit_quest', 223, 224),
(395, 311, NULL, NULL, 'delete_quest', 225, 226),
(396, 311, NULL, NULL, 'delete_phase', 227, 228),
(397, 311, NULL, NULL, 'defineCurrentTab', 229, 230),
(398, 311, NULL, NULL, 'add_org', 231, 232),
(399, 311, NULL, NULL, 'add_issue', 233, 234),
(400, 311, NULL, NULL, 'delete_issue', 235, 236),
(401, 311, NULL, NULL, 'add_badge', 237, 238),
(402, 388, NULL, NULL, 'Phases', 374, 395),
(403, 402, NULL, NULL, 'index', 375, 376),
(404, 402, NULL, NULL, 'view', 377, 378),
(405, 402, NULL, NULL, 'add', 379, 380),
(406, 402, NULL, NULL, 'edit', 381, 382),
(407, 402, NULL, NULL, 'delete', 383, 384),
(408, 402, NULL, NULL, 'admin_index', 385, 386),
(409, 402, NULL, NULL, 'admin_view', 387, 388),
(410, 402, NULL, NULL, 'admin_add', 389, 390),
(411, 402, NULL, NULL, 'admin_edit', 391, 392),
(412, 402, NULL, NULL, 'admin_delete', 393, 394),
(414, 388, NULL, NULL, 'GroupRequests', 396, 419),
(415, 414, NULL, NULL, 'index', 397, 398),
(416, 414, NULL, NULL, 'view', 399, 400),
(417, 414, NULL, NULL, 'add', 401, 402),
(418, 414, NULL, NULL, 'edit', 403, 404),
(419, 414, NULL, NULL, 'delete', 405, 406),
(420, 414, NULL, NULL, 'decline', 407, 408),
(421, 414, NULL, NULL, 'admin_index', 409, 410),
(422, 414, NULL, NULL, 'admin_view', 411, 412),
(423, 414, NULL, NULL, 'admin_add', 413, 414),
(424, 414, NULL, NULL, 'admin_edit', 415, 416),
(425, 414, NULL, NULL, 'admin_delete', 417, 418),
(426, 388, NULL, NULL, 'UserMissions', 420, 431),
(427, 426, NULL, NULL, 'index', 421, 422),
(428, 426, NULL, NULL, 'view', 423, 424),
(429, 426, NULL, NULL, 'add', 425, 426),
(430, 426, NULL, NULL, 'edit', 427, 428),
(431, 426, NULL, NULL, 'delete', 429, 430),
(432, 388, NULL, NULL, 'UserOrganizations', 432, 443),
(433, 432, NULL, NULL, 'index', 433, 434),
(434, 432, NULL, NULL, 'view', 435, 436),
(435, 432, NULL, NULL, 'add', 437, 438),
(436, 432, NULL, NULL, 'edit', 439, 440),
(437, 432, NULL, NULL, 'delete', 441, 442);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Role', 1, NULL, 1, 10),
(2, NULL, 'Role', 2, NULL, 11, 16),
(3, NULL, 'Role', 3, NULL, 17, 24),
(7, NULL, 'Role', 4, NULL, 25, 26),
(9, 1, 'User', 5, NULL, 8, 9),
(10, 2, 'User', 6, NULL, 14, 15),
(11, 3, 'User', 7, NULL, 22, 23);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=101 ;

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
(26, 1, 193, '1', '1', '1', '1'),
(27, 2, 311, '1', '1', '1', '1'),
(28, 1, 388, '1', '1', '1', '1'),
(29, 3, 311, '-1', '-1', '-1', '-1'),
(30, 7, 311, '-1', '-1', '-1', '-1'),
(31, 2, 390, '1', '1', '1', '1'),
(32, 2, 391, '1', '1', '1', '1'),
(33, 2, 312, '1', '1', '1', '1'),
(34, 2, 398, '1', '1', '1', '1'),
(35, 2, 392, '1', '1', '1', '1'),
(36, 2, 396, '1', '1', '1', '1'),
(37, 2, 393, '1', '1', '1', '1'),
(38, 2, 394, '1', '1', '1', '1'),
(39, 2, 395, '1', '1', '1', '1'),
(40, 2, 399, '-1', '-1', '-1', '-1'),
(41, 2, 400, '-1', '-1', '-1', '-1'),
(42, 2, 401, '1', '1', '1', '1'),
(43, 3, 193, '-1', '-1', '-1', '-1'),
(44, 3, 195, '1', '1', '1', '1'),
(45, 7, 193, '-1', '-1', '-1', '-1'),
(46, 3, 194, '1', '1', '1', '1'),
(47, 7, 194, '1', '1', '1', '1'),
(48, 7, 195, '1', '1', '1', '1'),
(49, 2, 193, '-1', '-1', '-1', '-1'),
(50, 2, 194, '1', '1', '1', '1'),
(51, 2, 195, '1', '1', '1', '1'),
(52, 2, 197, '1', '1', '1', '1'),
(53, 2, 198, '1', '1', '1', '1'),
(54, 1, 261, '1', '1', '1', '1'),
(55, 1, 265, '1', '1', '1', '1'),
(56, 2, 262, '1', '1', '1', '1'),
(57, 2, 263, '1', '1', '1', '1'),
(58, 3, 263, '1', '1', '1', '1'),
(59, 7, 263, '1', '1', '1', '1'),
(60, 7, 262, '1', '1', '1', '1'),
(61, 3, 262, '1', '1', '1', '1'),
(62, 3, 264, '-1', '-1', '-1', '-1'),
(63, 1, 298, '1', '1', '1', '1'),
(64, 2, 298, '1', '1', '1', '1'),
(65, 3, 300, '1', '1', '1', '1'),
(66, 3, 299, '1', '1', '1', '1'),
(67, 7, 299, '1', '1', '1', '1'),
(68, 7, 300, '1', '1', '1', '1'),
(69, 1, 402, '1', '1', '1', '1'),
(70, 2, 402, '1', '1', '1', '1'),
(71, 3, 403, '1', '1', '1', '1'),
(72, 3, 404, '1', '1', '1', '1'),
(73, 7, 404, '1', '1', '1', '1'),
(74, 7, 403, '1', '1', '1', '1'),
(75, 1, 322, '1', '1', '1', '1'),
(76, 2, 322, '1', '1', '1', '1'),
(77, 3, 323, '1', '1', '1', '1'),
(78, 3, 324, '1', '1', '1', '1'),
(79, 7, 324, '1', '1', '1', '1'),
(80, 7, 323, '1', '1', '1', '1'),
(81, 1, 272, '1', '1', '1', '1'),
(82, 2, 272, '1', '1', '1', '1'),
(83, 3, 273, '1', '1', '1', '1'),
(84, 3, 274, '1', '1', '1', '1'),
(85, 7, 273, '1', '1', '1', '1'),
(86, 7, 274, '1', '1', '1', '1'),
(87, 1, 333, '1', '1', '1', '1'),
(88, 2, 333, '-1', '-1', '-1', '-1'),
(89, 3, 333, '-1', '-1', '-1', '-1'),
(90, 7, 333, '-1', '-1', '-1', '-1'),
(91, 1, 432, '1', '1', '1', '1'),
(92, 2, 432, '1', '1', '1', '1'),
(93, 3, 432, '-1', '-1', '-1', '-1'),
(94, 7, 432, '-1', '-1', '-1', '-1'),
(95, 1, 283, '1', '1', '1', '1'),
(96, 2, 283, '1', '1', '1', '1'),
(97, 3, 284, '1', '1', '1', '1'),
(98, 3, 285, '1', '1', '1', '1'),
(99, 7, 285, '1', '1', '1', '1'),
(100, 7, 284, '1', '1', '1', '1');

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
  `organization_id` int(16) unsigned NOT NULL,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `trigger` varchar(120) NOT NULL,
  `language` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `badges`
--

INSERT INTO `badges` (`id`, `organization_id`, `name`, `description`, `trigger`, `language`) VALUES
(4, 46, 'minha badge de admin', '', '', NULL);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=20 ;

--
-- Extraindo dados da tabela `evokations`
--

INSERT INTO `evokations` (`id`, `group_id`, `gdrive_file_id`, `title`, `abstract`, `language`, `created`, `modified`) VALUES
(18, 3, '0B9uWvehaHYz2aWdjdmRfZWZLR0E', 'tmp_title', 'tmp_abstract', NULL, '2014-02-28 19:36:00', '2014-02-28 19:36:00'),
(19, 3, '0B9uWvehaHYz2NUVrVHNSSUV4WjA', 'tmp_title', 'tmp_abstract', NULL, '2014-02-28 19:47:42', '2014-02-28 19:47:42');

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
  `user_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `group_requests`
--

CREATE TABLE IF NOT EXISTS `group_requests` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `group_id` int(16) unsigned NOT NULL,
  `status` tinyint(3) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `issues`
--

INSERT INTO `issues` (`id`, `parent_id`, `name`, `slug`, `language`, `created`, `modified`) VALUES
(1, NULL, 'Water', 'water', NULL, '2014-03-05 15:38:10', '2014-03-05 15:38:10'),
(2, NULL, 'Economy', 'economy', NULL, '2014-03-05 15:38:28', '2014-03-05 15:38:28'),
(4, NULL, 'Hunger', 'hunger', NULL, '2014-03-10 12:35:09', '2014-03-10 12:35:09');

-- --------------------------------------------------------

--
-- Estrutura da tabela `missions`
--

CREATE TABLE IF NOT EXISTS `missions` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `organization_id` int(16) unsigned NOT NULL,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `image` varchar(120) DEFAULT NULL,
  `language` varchar(120) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=96 ;

--
-- Extraindo dados da tabela `missions`
--

INSERT INTO `missions` (`id`, `organization_id`, `title`, `description`, `image`, `language`, `created`, `modified`) VALUES
(93, 48, 'asda', '', '', NULL, '2014-03-13 18:37:06', '2014-03-13 18:38:12'),
(94, 46, 'aisad', '', '', NULL, '2014-03-13 18:49:30', '2014-03-13 18:49:30'),
(95, 48, 'Mission New deadlines', 'kasksadmka skd a', '', NULL, '2014-03-17 15:48:42', '2014-03-17 15:48:42');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mission_issues`
--

CREATE TABLE IF NOT EXISTS `mission_issues` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `mission_id` int(16) unsigned NOT NULL,
  `issue_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=58 ;

--
-- Extraindo dados da tabela `mission_issues`
--

INSERT INTO `mission_issues` (`id`, `mission_id`, `issue_id`) VALUES
(54, 92, 1),
(55, 93, 1),
(56, 94, 1),
(57, 95, 2);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

--
-- Extraindo dados da tabela `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `birthdate`, `description`, `website`, `facerbook`, `twitter`, `blog`) VALUES
(44, 'nossa org', '2014-03-13', '', '', NULL, '', ''),
(46, 'sódeadmin', '2014-03-13', '', '', NULL, '', ''),
(48, 'mais uma', '2014-03-13', '', '', NULL, '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `phases`
--

INSERT INTO `phases` (`id`, `name`, `description`, `mission_id`, `position`, `type`, `created`, `modified`) VALUES
(3, 'fase batatas', '', 78, 1, 0, '2014-03-10 11:26:33', '2014-03-10 11:26:33'),
(13, 'fase intro', '', 85, 1, 0, '2014-03-10 14:45:29', '2014-03-10 14:45:29'),
(16, 'radioactive', '', 89, 1, 0, '2014-03-10 16:11:52', '2014-03-10 16:11:52'),
(17, 'asd', '', 90, 1, 0, '2014-03-10 16:53:46', '2014-03-10 16:53:46'),
(18, 'aushduasd', '', 89, 2, 0, '2014-03-10 17:22:13', '2014-03-10 17:22:13'),
(21, 'fase1', 'dsa', 91, 1, 0, '2014-03-12 14:39:17', '2014-03-12 14:39:17'),
(22, 'asuid', 'asd', 91, 1, 0, '2014-03-12 14:43:16', '2014-03-12 14:43:16'),
(23, 'fase cebola', '', 78, 2, 0, '2014-03-12 14:49:56', '2014-03-12 14:49:56'),
(24, 'EXPLORE', '', 95, 1, 0, '2014-03-17 15:49:02', '2014-03-17 15:49:02'),
(25, 'IMAGINE', '', 95, 2, 0, '2014-03-17 15:49:27', '2014-03-17 15:49:27'),
(26, 'ACT', '', 95, 3, 0, '2014-03-17 15:49:36', '2014-03-17 15:49:36'),
(27, 'EVOKE', '', 95, 4, 0, '2014-03-17 15:49:44', '2014-03-17 15:49:44');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=25 ;

--
-- Extraindo dados da tabela `quests`
--

INSERT INTO `quests` (`id`, `title`, `description`, `mission_id`, `phase_id`, `created`, `modified`) VALUES
(1, 'primeira quest', 'rookgaard', 82, 9, '2014-03-10 14:23:54', '2014-03-10 14:23:54'),
(2, '1st quest', '', 83, 10, '2014-03-10 14:37:36', '2014-03-10 14:37:36'),
(3, 'quest 4', '', 84, 12, '2014-03-10 14:41:38', '2014-03-10 14:41:38'),
(4, 'quest rook', '', 85, 13, '2014-03-10 14:45:41', '2014-03-10 14:45:41'),
(5, 'quest main', '', 85, 13, '2014-03-10 14:49:58', '2014-03-10 14:49:58'),
(6, 'adsjo', 'asd', 86, 14, '2014-03-10 15:26:10', '2014-03-10 15:26:10'),
(7, 'okaok', 'ads', 86, 14, '2014-03-10 15:32:31', '2014-03-10 15:32:31'),
(9, 'intro', '', 89, 16, '2014-03-10 16:11:59', '2014-03-10 16:11:59'),
(10, 'chorus', '', 89, 16, '2014-03-10 16:12:04', '2014-03-10 16:12:04'),
(11, 'verse', '', 89, 16, '2014-03-10 16:12:11', '2014-03-10 16:12:11'),
(13, 'alguma', '', 90, 17, '2014-03-10 16:56:47', '2014-03-10 16:56:47'),
(15, 'adsadsa2', 'e', 91, 21, '2014-03-12 14:39:30', '2014-03-12 14:39:41'),
(16, 'ad', '21', 91, 21, '2014-03-12 14:43:23', '2014-03-12 14:43:23'),
(17, 'fd', '', 91, 21, '2014-03-12 14:45:49', '2014-03-12 14:45:49'),
(18, 'batata', '', 78, 3, '2014-03-12 14:49:33', '2014-03-12 14:49:33'),
(19, 'queijo', '', 78, 3, '2014-03-12 14:49:41', '2014-03-12 14:49:41'),
(20, 'bacon', '', 78, 3, '2014-03-12 14:49:48', '2014-03-12 14:49:48'),
(22, 'cebola', '', 78, 23, '2014-03-12 14:52:02', '2014-03-12 14:52:02'),
(23, 'molho', '', 78, 23, '2014-03-12 14:52:22', '2014-03-12 14:52:22'),
(24, 'Dragons', '', 95, 25, '2014-03-17 15:49:56', '2014-03-17 15:49:56');

-- --------------------------------------------------------

--
-- Estrutura da tabela `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `roles`
--

INSERT INTO `roles` (`id`, `name`) VALUES
(1, 'Administrator'),
(2, 'Manager'),
(3, 'User'),
(4, 'Mentor');

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
(19, 'google_auth_access_token', '{"access_token":"ya29.1.AADtN_XkZEMDx2JYvC66rskr0z2CuWnv84uZ_w87CJpLWadCJ1m9Zj2H0qCncs5v","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImY2MDNhODlhNzQ0OGEyMjM5MDcxZjI4YTk3MzViNjUwNWM2YWJjYTgifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiY2lkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXpwIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwidG9rZW5faGFzaCI6ImhYZjJzUVV5c1Zma09GbHpIbmtKMkEiLCJhdF9oYXNoIjoiaFhmMnNRVXlzVmZrT0Zsekhua0oyQSIsImlkIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwic3ViIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwiYXVkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJtc29sZWRhZGVAcXVhbnRpLmNhIiwiaGQiOiJxdWFudGkuY2EiLCJ2ZXJpZmllZF9lbWFpbCI6InRydWUiLCJlbWFpbF92ZXJpZmllZCI6InRydWUiLCJpYXQiOjEzOTM1MjQyNTUsImV4cCI6MTM5MzUyODE1NX0.c9WNn8ubqvqkVxJpcpW_Xs9xWhbZ_HHdP6_ROM7uUi81UvQEQXlmckCluf46GR4MLIrMKyejhgoYp5kD0uRo8zel5lFu7ucaZTCAZHT1C5wMniYPzhuVonlWazwX19MefJhDR67pEa6xKUFpA5IhlnvAvTLRT0-_v2aCiODr-CQ","refresh_token":"1\\/hF_NMUf2qVGOip0lzm15Bluw48dK5-7M4Q4TBXMqYnc","created":1393625384}', '2014-02-27 15:08:57', '2014-02-28 19:47:39');

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
  `sex` tinyint(1) NOT NULL,
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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `role_id`, `facebook_id`, `facebook_token`, `name`, `birthdate`, `email`, `sex`, `biography`, `username`, `password`, `facebook`, `twitter`, `instagram`, `website`, `blog`, `created`, `modified`) VALUES
(5, 1, NULL, NULL, 'admin alexandre', '0000-00-00', NULL, 0, '', 'root', '39c3730c51df48f65defc5a94dbd1312df8ebb05', NULL, NULL, NULL, NULL, NULL, '2014-03-07 15:33:33', '2014-03-07 15:33:33'),
(6, 2, NULL, NULL, 'MyManager', '0000-00-00', NULL, 0, '', 'manager', 'cdeeae3ed8f20ad05252bd6dcf6fa20af7d82901', NULL, NULL, NULL, NULL, NULL, '2014-03-12 11:37:29', '2014-03-12 11:37:29'),
(7, 3, '100001280484261', 'CAAJeTV3YsC8BAOMvG1npNZCJnDZAuWoL7Xk1vRXxHZAKrfhiZCTcDbCRrwSiZA3jUgejyiu5h8lorQ0cPhhQwrIkH2kt3Np5fV6SqB3V7P99egQ3km1MX6E4N22TEwuaZAE7rTQhFF2ftno0ZCHKrDo8508dgOHbck4O7XrO3CYckZBtTLJ6U7ZCfssgZCbLC3GiMZD', 'Alexandre Rossi Alvares', '0000-00-00', NULL, 1, '', '', '', 'https://www.facebook.com/alerossialvares', NULL, NULL, NULL, NULL, '2014-03-12 12:04:19', '2014-03-12 12:04:19');

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
-- Estrutura da tabela `user_missions`
--

CREATE TABLE IF NOT EXISTS `user_missions` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `mission_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `user_missions`
--

INSERT INTO `user_missions` (`id`, `user_id`, `mission_id`) VALUES
(1, 7, 93);

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_organizations`
--

CREATE TABLE IF NOT EXISTS `user_organizations` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `organization_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Extraindo dados da tabela `user_organizations`
--

INSERT INTO `user_organizations` (`id`, `user_id`, `organization_id`) VALUES
(10, 5, 44),
(11, 6, 44),
(13, 5, 46),
(15, 6, 48);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
