-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 24/02/2014 às 01h12min
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=33 ;

--
-- Extraindo dados da tabela `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Role', 1, NULL, 1, 32),
(2, NULL, 'Role', 2, NULL, 33, 38),
(3, NULL, 'Role', 3, NULL, 39, 44),
(7, NULL, 'Role', 4, NULL, 45, 46),
(9, 1, 'User', 5, NULL, 8, 9),
(10, 2, 'User', 6, NULL, 36, 37),
(11, NULL, 'User', 7, NULL, 49, 50),
(12, NULL, 'User', 8, NULL, 47, 48),
(13, 1, 'User', 9, NULL, 12, 13),
(14, 1, 'User', 10, NULL, 16, 17),
(15, NULL, 'User', 11, NULL, 51, 52),
(16, 1, 'User', 12, NULL, 22, 23),
(17, NULL, 'User', 13, NULL, 53, 54),
(18, NULL, 'User', 14, NULL, 55, 56),
(19, 1, 'User', 9, NULL, 10, 11),
(20, 1, 'User', 10, NULL, 14, 15),
(21, 1, 'User', 11, NULL, 18, 19),
(22, 1, 'User', 12, NULL, 20, 21),
(23, 1, 'User', 13, NULL, 24, 25),
(24, 1, 'User', 14, NULL, 26, 27),
(25, NULL, 'User', 15, NULL, 57, 58),
(26, NULL, 'User', 16, NULL, 59, 60),
(27, NULL, 'User', 17, NULL, 61, 62),
(28, NULL, 'User', 18, NULL, 63, 64),
(29, NULL, 'User', 19, NULL, 65, 66),
(30, NULL, 'User', 20, NULL, 67, 68),
(31, 1, 'User', 21, NULL, 28, 29),
(32, 1, 'User', 22, NULL, 30, 31);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `comments`
--

INSERT INTO `comments` (`id`, `evidence_id`, `user_id`, `content`, `created`, `modified`) VALUES
(1, 1, 6, 'dew', '2014-02-22 03:08:34', '2014-02-22 03:08:34');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=27 ;

--
-- Extraindo dados da tabela `evidences`
--

INSERT INTO `evidences` (`id`, `title`, `content`, `user_id`, `quest_id`, `mission_id`, `phase_id`, `created`, `modified`) VALUES
(1, 'New Evidence', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Sed lobortis luctus metus et dapibus. Suspendisse faucibus interdum viverra. Aliquam purus est, accumsan vel eros quis, ultricies fringilla nunc. Fusce id leo adipiscing nisi semper ullamcorper. Aliquam iaculis dolor in risus commodo, sit amet dictum magna venenatis. Ut tristique sed diam eu dapibus. Vestibulum lorem magna, ultricies nec cursus eget, ornare id purus.', 3, NULL, 1, 1, '2014-02-21 01:53:33', '2014-02-21 07:06:07'),
(25, 'Desert', '<p><a href="/evoke/img/uploads/2014/02/H264_test1_Talkinghead_mp4_480x360-1.mp4" title="H264_test1_Talkinghead_mp4_480x360-1.mp4">H264_test1_Talkinghead_mp4_480x360-1.mp4</a></p>\r\n\r\n<p><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11px; line-height: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent dolor felis, ornare non vehicula in, rutrum eu leo. Maecenas lobortis dolor quis aliquam ullamcorper. In lectus lectus, semper quis luctus ac, interdum vitae sapien. Nullam at magna imperdiet, vestibulum orci sed, dictum neque. In ornare adipiscing elit eget rutrum. Curabitur vestibulum nunc pretium dignissim lacinia. Etiam vitae enim nec tellus egestas consectetur nec at arcu. Maecenas auctor elementum mi, vel accumsan ipsum semper tristique.</span></p>\r\n\r\n<p><a href="/evoke/img/uploads/2014/02/Desert.jpg" title="Desert.jpg"><img class="alignleft" src="/evoke/img/uploads/2014/02/Desert.jpg" style="height: 375px; width: 500px;" /></a></p>\r\n\r\n<p><span style="color: rgb(0, 0, 0); font-family: Arial, Helvetica, sans; font-size: 11.111111640930176px; line-height: 14px; text-align: justify;">Lorem ipsum dolor sit amet, consectetur adipiscing elit. Praesent dolor felis, ornare non vehicula in, rutrum eu leo. Maecenas lobortis dolor quis aliquam ullamcorper. In lectus lectus, semper quis luctus ac, interdum vitae sapien. Nullam at magna imperdiet, vestibulum orci sed, dictum neque. In ornare adipiscing elit eget rutrum. Curabitur vestibulum nunc pretium dignissim lacinia. Etiam vitae enim nec tellus egestas consectetur nec at arcu. Maecenas auctor elementum mi, vel accumsan ipsum semper tristique.</span></p>\r\n', 6, NULL, 1, 1, '2014-02-22 21:51:43', '2014-02-23 08:37:29');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=28 ;

--
-- Extraindo dados da tabela `evokations`
--

INSERT INTO `evokations` (`id`, `group_id`, `gdrive_file_id`, `title`, `abstract`, `language`, `created`, `modified`) VALUES
(24, 6, NULL, 'Pawnee Evokation', 'Pawnee Evokation is the greatest', NULL, NULL, NULL),
(25, 7, NULL, 'Evokation', '', NULL, NULL, NULL),
(26, 6, NULL, 'tmp_title', 'tmp_abstract', NULL, '2014-02-23 12:59:53', '2014-02-23 12:59:53'),
(27, 6, NULL, 'tmp_title', 'tmp_abstract', NULL, '2014-02-23 13:00:11', '2014-02-23 13:00:11');

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
-- Estrutura da tabela `groups`
--

CREATE TABLE IF NOT EXISTS `groups` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `title`, `user_id`, `created`, `modified`) VALUES
(6, 'Pawnee', 3, '2014-02-21 10:39:03', '2014-02-21 10:39:03'),
(7, 'Eagleton', 1, '2014-03-11 00:00:00', '2014-03-11 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

--
-- Extraindo dados da tabela `groups_users`
--

INSERT INTO `groups_users` (`id`, `user_id`, `group_id`, `created`, `modified`) VALUES
(13, 3, 6, '2014-02-21 20:00:24', '2014-02-21 20:00:24'),
(14, 1, 6, '2014-03-11 00:00:00', '2014-03-11 00:00:00'),
(18, 6, 6, '2014-02-21 23:45:49', '2014-02-21 23:45:49');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=7 ;

--
-- Extraindo dados da tabela `group_requests`
--

INSERT INTO `group_requests` (`id`, `user_id`, `group_id`, `status`, `created`, `modified`) VALUES
(1, 6, 6, 1, '2014-02-21 22:57:28', '2014-02-21 23:45:49'),
(6, 8, 6, 2, '2014-02-22 05:03:17', '2014-02-22 05:03:54');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Extraindo dados da tabela `issues`
--

INSERT INTO `issues` (`id`, `parent_id`, `name`, `slug`, `language`, `created`, `modified`) VALUES
(1, NULL, 'Water', 'water', NULL, '2014-03-05 15:38:10', '2014-03-05 15:38:10'),
(2, NULL, 'Economy', 'economy', NULL, '2014-03-05 15:38:28', '2014-03-05 15:38:28'),
(3, NULL, 'Health', 'health', NULL, '2014-03-05 15:38:40', '2014-03-05 15:38:40'),
(7, NULL, 'fre', '', NULL, '2014-02-23 23:57:52', '2014-02-23 23:57:52');

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
(19, 'google_auth_access_token', '{"access_token":"ya29.1.AADtN_XkZEMDx2JYvC66rskr0z2CuWnv84uZ_w87CJpLWadCJ1m9Zj2H0qCncs5v","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImY2MDNhODlhNzQ0OGEyMjM5MDcxZjI4YTk3MzViNjUwNWM2YWJjYTgifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiY2lkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXpwIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwidG9rZW5faGFzaCI6ImhYZjJzUVV5c1Zma09GbHpIbmtKMkEiLCJhdF9oYXNoIjoiaFhmMnNRVXlzVmZrT0Zsekhua0oyQSIsImlkIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwic3ViIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwiYXVkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJtc29sZWRhZGVAcXVhbnRpLmNhIiwiaGQiOiJxdWFudGkuY2EiLCJ2ZXJpZmllZF9lbWFpbCI6InRydWUiLCJlbWFpbF92ZXJpZmllZCI6InRydWUiLCJpYXQiOjEzOTM1MjQyNTUsImV4cCI6MTM5MzUyODE1NX0.c9WNn8ubqvqkVxJpcpW_Xs9xWhbZ_HHdP6_ROM7uUi81UvQEQXlmckCluf46GR4MLIrMKyejhgoYp5kD0uRo8zel5lFu7ucaZTCAZHT1C5wMniYPzhuVonlWazwX19MefJhDR67pEa6xKUFpA5IhlnvAvTLRT0-_v2aCiODr-CQ","refresh_token":"1\\/hF_NMUf2qVGOip0lzm15Bluw48dK5-7M4Q4TBXMqYnc","created":1393625384}', '2014-02-27 15:08:57', '2014-02-23 16:00:08');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=23 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `role_id`, `facebook_id`, `facebook_token`, `name`, `birthdate`, `email`, `sex`, `biography`, `username`, `password`, `facebook`, `twitter`, `instagram`, `website`, `blog`, `created`, `modified`) VALUES
(1, 3, '100001280484261', 'CAAJeTV3YsC8BANSI4W7xYD35n5mG3DZBvZB0H4PofqOauOyZBAJYNBzByRxnHsU5HozaYOGF0YJy5iNTLY04T6cD96dH7TfKCszKvDjlNDxhLJxgWzqW7BPCQCauBimWJQIZAE2dAGvdOyG4IkmDwoS8JAlyMSof5HqxcHfZBFOjZBBA0FpWyLtqktpozw2vcZD', 'Alexandre Rossi Alvares', '0000-00-00', NULL, 1, '', '', '', 'https://www.facebook.com/alerossialvares', NULL, NULL, NULL, NULL, '2014-03-06 12:46:26', '2014-03-06 15:21:17'),
(2, 1, NULL, NULL, 'Ale Admin', '0000-00-00', NULL, 0, '', 'root', '39c3730c51df48f65defc5a94dbd1312df8ebb05', NULL, NULL, NULL, NULL, NULL, '2014-03-06 12:47:22', '2014-03-06 12:47:22'),
(3, 3, '100002031279809', 'CAAJeTV3YsC8BAKmHJwzTfCiRoATKriJPZBkz38gf5kRLXAZAvuFndk94snnka2jNWxZBiCux7qZB9CWDPv3tKV4yrkPigdT73DdZAUv3i4rO8m6BYhGvayULaHWVM10q60MBeqroRvKc80BLc5hriDRZCVnjfkZBKlRfSZADXuAzC42cFGIyULrsObvK9k2pRm0ZD', 'Renata Japur', '2034-01-01', 'rejapur@gmail.com', 1, 'Praesent porttitor tellus ut lobortis pulvinar. Fusce euismod nec ipsum a volutpat. Cras scelerisque imperdiet sem, non sagittis sem. Etiam lacinia turpis nec dictum aliquam. Praesent varius luctus mi pharetra sodales. Mauris mollis, enim sed venenatis rhoncus, purus augue auctor justo, sit amet luctus nibh nunc vel tellus. Etiam ornare nec lectus eu mattis. Quisque sed bibendum lectus. Pellentesque ac elit a sapien feugiat tristique dignissim vel metus. Vestibulum in velit ut metus sodales pulvinar faucibus vitae lacus. Nullam vulputate in risus non dictum. Sed at arcu diam. Nullam vitae odio nec felis varius vestibulum id ut urna. Curabitur eget vestibulum ipsum. Praesent sed velit id tellus imperdiet tempor. Vivamus ante nisl, condimentum ut elit eu, tincidunt mattis tellus.', 'rjapur', '28fc81c281fc91ded27f310e4adcd2e7c584ca11', 'https://www.facebook.com/renata.japur', '', '', '', '', '2014-02-20 20:54:19', '2014-02-21 20:05:03'),
(5, 1, NULL, NULL, 'Re Japur', '2034-01-01', 'rjapur@quanti.ca', 0, 'oi', 'rjapur', '62484e8cb37e84ce630b9f6cd1a17cc181e9172a', '', '', '', '', '', '2014-02-21 16:04:17', '2014-02-21 16:04:33'),
(6, 1, NULL, NULL, 'Leslie Knope', '2034-01-01', 'rjapur@quanti.ca', 0, 'lorem ipsum amet', 'leslie.knope', '85938a39a9df6ecb59b8725d78912135a624befc', '', '', '', '', '', '2014-02-21 21:25:35', '2014-02-21 21:26:04'),
(7, 1, NULL, NULL, 'Tom Haverford', '2034-01-01', 'rjapur@quanti.ca', 0, 'oi', 'tom.haverford', 'd630ba60d332de9cae9e5169e6e36a57a5520d07', '', '', '', '', '', '2014-02-21 23:30:21', '2014-02-21 23:30:39'),
(8, 1, NULL, NULL, 'Ron Swanson', '2034-01-01', 'japur.renata@gmail.com', 0, 'ron swanson', 'ron.swanson', 'd2284a7e09d3721c6ac391a43bccdcf86d4a27d5', '', '', '', '', '', '2014-02-22 00:45:17', '2014-02-22 04:16:55'),
(19, 1, NULL, NULL, 'ops', '2034-01-01', 'ops@ops.com', 0, 'de', 'ops', '0001d5bd567fcbf6b0cdf76575c60db257a85883', '', '', '', '', '', '2014-02-23 05:44:11', '2014-02-23 05:44:24'),
(20, 1, NULL, NULL, 'lucky', '2034-01-01', 'l@l.com', 0, 'de', 'lucky', '17d4fd565188fd583c727b4e12952cda9e72d55c', '', '', '', '', '', '2014-02-23 05:49:03', '2014-02-23 05:49:16'),
(21, 1, NULL, NULL, 'April Ludgate', '0000-00-00', NULL, 0, '', 'april.ludgate', 'df35d2ecb0d3e000405b3dbb52982254d7dad72d', NULL, NULL, NULL, NULL, NULL, '2014-02-23 06:48:25', '2014-02-23 06:48:25'),
(22, 1, NULL, NULL, 'k', '2034-01-01', 'k@k.com', 0, 'rew', 'k', '5570da2ccc8bdaf5bf07b637deb6e5048b227a04', '', '', '', '', '', '2014-02-23 08:05:22', '2014-02-23 08:05:33');

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
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `user_missions`
--

INSERT INTO `user_missions` (`id`, `user_id`, `mission_id`, `created`, `modified`) VALUES
(1, 7, 93, '0000-00-00 00:00:00', '0000-00-00 00:00:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `votes`
--

INSERT INTO `votes` (`id`, `evidence_id`, `user_id`, `value`, `created`, `modified`) VALUES
(1, 1, 3, 4, '2014-02-21 08:36:38', '2014-02-21 08:36:38'),
(2, 1, 6, 2, '2014-02-22 03:08:26', '2014-02-22 03:08:26');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
