-- phpMyAdmin SQL Dump
-- version 3.4.10.1deb1
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tempo de Geração: 24/03/2014 às 19h04min
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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=782 ;

--
-- Extraindo dados da tabela `acos`
--

INSERT INTO `acos` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(192, NULL, NULL, NULL, 'controllers', 1, 542),
(193, 192, NULL, NULL, 'Badges', 2, 31),
(194, 193, NULL, NULL, 'index', 3, 4),
(195, 193, NULL, NULL, 'view', 5, 6),
(196, 193, NULL, NULL, 'add', 7, 8),
(197, 193, NULL, NULL, 'edit', 9, 10),
(198, 193, NULL, NULL, 'delete', 11, 12),
(204, 192, NULL, NULL, 'Comments', 32, 63),
(205, 204, NULL, NULL, 'index', 33, 34),
(206, 204, NULL, NULL, 'view', 35, 36),
(207, 204, NULL, NULL, 'add', 37, 38),
(208, 204, NULL, NULL, 'edit', 39, 40),
(209, 204, NULL, NULL, 'delete', 41, 42),
(210, 204, NULL, NULL, 'getUserById', 43, 44),
(211, 204, NULL, NULL, 'admin_index', 45, 46),
(212, 204, NULL, NULL, 'admin_view', 47, 48),
(213, 204, NULL, NULL, 'admin_add', 49, 50),
(214, 204, NULL, NULL, 'admin_edit', 51, 52),
(215, 204, NULL, NULL, 'admin_delete', 53, 54),
(216, 192, NULL, NULL, 'Evidences', 64, 93),
(217, 216, NULL, NULL, 'index', 65, 66),
(218, 216, NULL, NULL, 'view', 67, 68),
(219, 216, NULL, NULL, 'add', 69, 70),
(220, 216, NULL, NULL, 'edit', 71, 72),
(221, 216, NULL, NULL, 'delete', 73, 74),
(222, 216, NULL, NULL, 'admin_index', 75, 76),
(223, 216, NULL, NULL, 'admin_view', 77, 78),
(224, 216, NULL, NULL, 'admin_add', 79, 80),
(225, 216, NULL, NULL, 'admin_edit', 81, 82),
(226, 216, NULL, NULL, 'admin_delete', 83, 84),
(227, 192, NULL, NULL, 'Evokations', 94, 125),
(228, 227, NULL, NULL, 'index', 95, 96),
(229, 227, NULL, NULL, 'view', 97, 98),
(230, 227, NULL, NULL, 'add', 99, 100),
(231, 227, NULL, NULL, 'edit', 101, 102),
(232, 227, NULL, NULL, 'delete', 103, 104),
(233, 227, NULL, NULL, 'admin_index', 105, 106),
(234, 227, NULL, NULL, 'admin_view', 107, 108),
(235, 227, NULL, NULL, 'admin_add', 109, 110),
(236, 227, NULL, NULL, 'admin_edit', 111, 112),
(237, 227, NULL, NULL, 'admin_delete', 113, 114),
(238, 192, NULL, NULL, 'Groups', 126, 159),
(239, 238, NULL, NULL, 'index', 127, 128),
(240, 238, NULL, NULL, 'view', 129, 130),
(241, 238, NULL, NULL, 'add', 131, 132),
(242, 238, NULL, NULL, 'edit', 133, 134),
(243, 238, NULL, NULL, 'delete', 135, 136),
(244, 238, NULL, NULL, 'admin_index', 137, 138),
(245, 238, NULL, NULL, 'admin_view', 139, 140),
(246, 238, NULL, NULL, 'admin_add', 141, 142),
(247, 238, NULL, NULL, 'admin_edit', 143, 144),
(248, 238, NULL, NULL, 'admin_delete', 145, 146),
(249, 192, NULL, NULL, 'GroupsUsers', 160, 199),
(250, 249, NULL, NULL, 'index', 161, 162),
(251, 249, NULL, NULL, 'view', 163, 164),
(252, 249, NULL, NULL, 'storeFileInfo', 165, 166),
(253, 249, NULL, NULL, 'add', 167, 168),
(254, 249, NULL, NULL, 'edit', 169, 170),
(255, 249, NULL, NULL, 'delete', 171, 172),
(256, 249, NULL, NULL, 'admin_index', 173, 174),
(257, 249, NULL, NULL, 'admin_view', 175, 176),
(258, 249, NULL, NULL, 'admin_add', 177, 178),
(259, 249, NULL, NULL, 'admin_edit', 179, 180),
(260, 249, NULL, NULL, 'admin_delete', 181, 182),
(261, 192, NULL, NULL, 'Issues', 200, 229),
(262, 261, NULL, NULL, 'index', 201, 202),
(263, 261, NULL, NULL, 'view', 203, 204),
(264, 261, NULL, NULL, 'add', 205, 206),
(265, 261, NULL, NULL, 'edit', 207, 208),
(266, 261, NULL, NULL, 'delete', 209, 210),
(267, 261, NULL, NULL, 'admin_index', 211, 212),
(268, 261, NULL, NULL, 'admin_view', 213, 214),
(269, 261, NULL, NULL, 'admin_add', 215, 216),
(270, 261, NULL, NULL, 'admin_edit', 217, 218),
(271, 261, NULL, NULL, 'admin_delete', 219, 220),
(272, 192, NULL, NULL, 'MissionIssues', 230, 261),
(273, 272, NULL, NULL, 'index', 231, 232),
(274, 272, NULL, NULL, 'view', 233, 234),
(275, 272, NULL, NULL, 'add', 235, 236),
(276, 272, NULL, NULL, 'edit', 237, 238),
(277, 272, NULL, NULL, 'delete', 239, 240),
(278, 272, NULL, NULL, 'admin_index', 241, 242),
(279, 272, NULL, NULL, 'admin_view', 243, 244),
(280, 272, NULL, NULL, 'admin_add', 245, 246),
(281, 272, NULL, NULL, 'admin_edit', 247, 248),
(282, 272, NULL, NULL, 'admin_delete', 249, 250),
(283, 192, NULL, NULL, 'Missions', 262, 291),
(284, 283, NULL, NULL, 'index', 263, 264),
(285, 283, NULL, NULL, 'view', 265, 266),
(286, 283, NULL, NULL, 'add', 267, 268),
(291, 283, NULL, NULL, 'edit', 269, 270),
(292, 283, NULL, NULL, 'delete', 271, 272),
(293, 283, NULL, NULL, 'admin_index', 273, 274),
(294, 283, NULL, NULL, 'admin_view', 275, 276),
(295, 283, NULL, NULL, 'admin_add', 277, 278),
(296, 283, NULL, NULL, 'admin_edit', 279, 280),
(297, 283, NULL, NULL, 'admin_delete', 281, 282),
(298, 192, NULL, NULL, 'Organizations', 292, 311),
(299, 298, NULL, NULL, 'index', 293, 294),
(300, 298, NULL, NULL, 'view', 295, 296),
(301, 298, NULL, NULL, 'add', 297, 298),
(302, 298, NULL, NULL, 'edit', 299, 300),
(303, 298, NULL, NULL, 'delete', 301, 302),
(309, 192, NULL, NULL, 'Pages', 312, 323),
(310, 309, NULL, NULL, 'display', 313, 314),
(311, 192, NULL, NULL, 'Panels', 324, 365),
(312, 311, NULL, NULL, 'index', 325, 326),
(322, 192, NULL, NULL, 'Quests', 366, 395),
(323, 322, NULL, NULL, 'index', 367, 368),
(324, 322, NULL, NULL, 'view', 369, 370),
(325, 322, NULL, NULL, 'add', 371, 372),
(326, 322, NULL, NULL, 'edit', 373, 374),
(327, 322, NULL, NULL, 'delete', 375, 376),
(328, 322, NULL, NULL, 'admin_index', 377, 378),
(329, 322, NULL, NULL, 'admin_view', 379, 380),
(330, 322, NULL, NULL, 'admin_add', 381, 382),
(331, 322, NULL, NULL, 'admin_edit', 383, 384),
(332, 322, NULL, NULL, 'admin_delete', 385, 386),
(333, 192, NULL, NULL, 'Roles', 396, 415),
(334, 333, NULL, NULL, 'index', 397, 398),
(335, 333, NULL, NULL, 'view', 399, 400),
(336, 333, NULL, NULL, 'add', 401, 402),
(337, 333, NULL, NULL, 'edit', 403, 404),
(338, 333, NULL, NULL, 'delete', 405, 406),
(339, 192, NULL, NULL, 'UserIssues', 416, 445),
(340, 339, NULL, NULL, 'index', 417, 418),
(341, 339, NULL, NULL, 'view', 419, 420),
(342, 339, NULL, NULL, 'add', 421, 422),
(343, 339, NULL, NULL, 'edit', 423, 424),
(344, 339, NULL, NULL, 'delete', 425, 426),
(345, 339, NULL, NULL, 'admin_index', 427, 428),
(346, 339, NULL, NULL, 'admin_view', 429, 430),
(347, 339, NULL, NULL, 'admin_add', 431, 432),
(348, 339, NULL, NULL, 'admin_edit', 433, 434),
(349, 339, NULL, NULL, 'admin_delete', 435, 436),
(350, 192, NULL, NULL, 'Users', 446, 491),
(351, 350, NULL, NULL, 'login', 447, 448),
(352, 350, NULL, NULL, 'logout', 449, 450),
(353, 350, NULL, NULL, 'index', 451, 452),
(354, 350, NULL, NULL, 'register', 453, 454),
(355, 350, NULL, NULL, 'dashboard', 455, 456),
(356, 350, NULL, NULL, 'dashboardByIssue', 457, 458),
(357, 350, NULL, NULL, 'leaderboard', 459, 460),
(358, 350, NULL, NULL, 'add_friend', 461, 462),
(359, 350, NULL, NULL, 'remove_friend', 463, 464),
(360, 350, NULL, NULL, 'view', 465, 466),
(361, 350, NULL, NULL, 'add', 467, 468),
(362, 350, NULL, NULL, 'edit', 469, 470),
(363, 350, NULL, NULL, 'delete', 471, 472),
(364, 350, NULL, NULL, 'admin_index', 473, 474),
(365, 350, NULL, NULL, 'admin_view', 475, 476),
(366, 350, NULL, NULL, 'admin_add', 477, 478),
(367, 350, NULL, NULL, 'admin_edit', 479, 480),
(368, 350, NULL, NULL, 'admin_delete', 481, 482),
(369, 192, NULL, NULL, 'Votes', 492, 521),
(370, 369, NULL, NULL, 'index', 493, 494),
(371, 369, NULL, NULL, 'view', 495, 496),
(372, 369, NULL, NULL, 'add', 497, 498),
(373, 369, NULL, NULL, 'edit', 499, 500),
(374, 369, NULL, NULL, 'delete', 501, 502),
(375, 369, NULL, NULL, 'admin_index', 503, 504),
(376, 369, NULL, NULL, 'admin_view', 505, 506),
(377, 369, NULL, NULL, 'admin_add', 507, 508),
(378, 369, NULL, NULL, 'admin_edit', 509, 510),
(379, 369, NULL, NULL, 'admin_delete', 511, 512),
(380, 192, NULL, NULL, 'AclExtras', 522, 523),
(381, 192, NULL, NULL, 'DebugKit', 524, 539),
(382, 381, NULL, NULL, 'ToolbarAccess', 525, 538),
(383, 382, NULL, NULL, 'history_state', 526, 527),
(384, 382, NULL, NULL, 'sql_explain', 528, 529),
(385, 192, NULL, NULL, 'Upload', 540, 541),
(386, NULL, NULL, NULL, 'controllers', 543, 544),
(387, NULL, NULL, NULL, 'controllers', 545, 546),
(388, NULL, NULL, NULL, 'controllers', 547, 1132),
(389, 249, NULL, NULL, 'send', 183, 184),
(390, 311, NULL, NULL, 'add_mission', 327, 328),
(391, 311, NULL, NULL, 'edit_mission', 329, 330),
(392, 311, NULL, NULL, 'add_phase', 331, 332),
(393, 311, NULL, NULL, 'add_quest', 333, 334),
(394, 311, NULL, NULL, 'edit_quest', 335, 336),
(395, 311, NULL, NULL, 'delete_quest', 337, 338),
(396, 311, NULL, NULL, 'delete_phase', 339, 340),
(397, 311, NULL, NULL, 'defineCurrentTab', 341, 342),
(398, 311, NULL, NULL, 'add_org', 343, 344),
(399, 311, NULL, NULL, 'add_issue', 345, 346),
(400, 311, NULL, NULL, 'delete_issue', 347, 348),
(401, 311, NULL, NULL, 'add_badge', 349, 350),
(402, 388, NULL, NULL, 'Phases', 548, 577),
(403, 402, NULL, NULL, 'index', 549, 550),
(404, 402, NULL, NULL, 'view', 551, 552),
(405, 402, NULL, NULL, 'add', 553, 554),
(406, 402, NULL, NULL, 'edit', 555, 556),
(407, 402, NULL, NULL, 'delete', 557, 558),
(408, 402, NULL, NULL, 'admin_index', 559, 560),
(409, 402, NULL, NULL, 'admin_view', 561, 562),
(410, 402, NULL, NULL, 'admin_add', 563, 564),
(411, 402, NULL, NULL, 'admin_edit', 565, 566),
(412, 402, NULL, NULL, 'admin_delete', 567, 568),
(414, 388, NULL, NULL, 'GroupRequests', 578, 609),
(415, 414, NULL, NULL, 'index', 579, 580),
(416, 414, NULL, NULL, 'view', 581, 582),
(417, 414, NULL, NULL, 'add', 583, 584),
(418, 414, NULL, NULL, 'edit', 585, 586),
(419, 414, NULL, NULL, 'delete', 587, 588),
(420, 414, NULL, NULL, 'decline', 589, 590),
(421, 414, NULL, NULL, 'admin_index', 591, 592),
(422, 414, NULL, NULL, 'admin_view', 593, 594),
(423, 414, NULL, NULL, 'admin_add', 595, 596),
(424, 414, NULL, NULL, 'admin_edit', 597, 598),
(425, 414, NULL, NULL, 'admin_delete', 599, 600),
(426, 388, NULL, NULL, 'UserMissions', 610, 639),
(427, 426, NULL, NULL, 'index', 611, 612),
(428, 426, NULL, NULL, 'view', 613, 614),
(429, 426, NULL, NULL, 'add', 615, 616),
(430, 426, NULL, NULL, 'edit', 617, 618),
(431, 426, NULL, NULL, 'delete', 619, 620),
(432, 388, NULL, NULL, 'UserOrganizations', 640, 659),
(433, 432, NULL, NULL, 'index', 641, 642),
(434, 432, NULL, NULL, 'view', 643, 644),
(435, 432, NULL, NULL, 'add', 645, 646),
(436, 432, NULL, NULL, 'edit', 647, 648),
(437, 432, NULL, NULL, 'delete', 649, 650),
(438, 193, NULL, NULL, 'admin_index', 13, 14),
(439, 193, NULL, NULL, 'admin_view', 15, 16),
(440, 193, NULL, NULL, 'admin_add', 17, 18),
(441, 193, NULL, NULL, 'admin_edit', 19, 20),
(442, 193, NULL, NULL, 'admin_delete', 21, 22),
(443, 193, NULL, NULL, 'getUserId', 23, 24),
(444, 193, NULL, NULL, 'getUserName', 25, 26),
(445, 193, NULL, NULL, 'getUserRole', 27, 28),
(446, 193, NULL, NULL, 'canUploadMedias', 29, 30),
(447, 388, NULL, NULL, 'ChosenApp', 660, 669),
(448, 447, NULL, NULL, 'getUserId', 661, 662),
(449, 447, NULL, NULL, 'getUserName', 663, 664),
(450, 447, NULL, NULL, 'getUserRole', 665, 666),
(451, 447, NULL, NULL, 'canUploadMedias', 667, 668),
(452, 388, NULL, NULL, 'ChosenAppModel', 670, 773),
(453, 452, NULL, NULL, 'bindModel', 671, 672),
(454, 452, NULL, NULL, 'unbindModel', 673, 674),
(455, 452, NULL, NULL, 'setSource', 675, 676),
(456, 452, NULL, NULL, 'deconstruct', 677, 678),
(457, 452, NULL, NULL, 'schema', 679, 680),
(458, 452, NULL, NULL, 'getColumnTypes', 681, 682),
(459, 452, NULL, NULL, 'getColumnType', 683, 684),
(460, 452, NULL, NULL, 'hasField', 685, 686),
(461, 452, NULL, NULL, 'hasMethod', 687, 688),
(462, 452, NULL, NULL, 'isVirtualField', 689, 690),
(463, 452, NULL, NULL, 'getVirtualField', 691, 692),
(464, 452, NULL, NULL, 'create', 693, 694),
(465, 452, NULL, NULL, 'clear', 695, 696),
(466, 452, NULL, NULL, 'read', 697, 698),
(467, 452, NULL, NULL, 'field', 699, 700),
(468, 452, NULL, NULL, 'saveField', 701, 702),
(469, 452, NULL, NULL, 'save', 703, 704),
(470, 452, NULL, NULL, 'updateCounterCache', 705, 706),
(471, 452, NULL, NULL, 'saveAll', 707, 708),
(472, 452, NULL, NULL, 'saveMany', 709, 710),
(473, 452, NULL, NULL, 'validateMany', 711, 712),
(474, 452, NULL, NULL, 'saveAssociated', 713, 714),
(475, 452, NULL, NULL, 'validateAssociated', 715, 716),
(476, 452, NULL, NULL, 'updateAll', 717, 718),
(477, 452, NULL, NULL, 'delete', 719, 720),
(478, 452, NULL, NULL, 'deleteAll', 721, 722),
(479, 452, NULL, NULL, 'exists', 723, 724),
(480, 452, NULL, NULL, 'hasAny', 725, 726),
(481, 452, NULL, NULL, 'find', 727, 728),
(482, 452, NULL, NULL, 'buildQuery', 729, 730),
(483, 452, NULL, NULL, 'resetAssociations', 731, 732),
(484, 452, NULL, NULL, 'isUnique', 733, 734),
(485, 452, NULL, NULL, 'query', 735, 736),
(486, 452, NULL, NULL, 'validates', 737, 738),
(487, 452, NULL, NULL, 'invalidFields', 739, 740),
(488, 452, NULL, NULL, 'invalidate', 741, 742),
(489, 452, NULL, NULL, 'isForeignKey', 743, 744),
(490, 452, NULL, NULL, 'escapeField', 745, 746),
(491, 452, NULL, NULL, 'getID', 747, 748),
(492, 452, NULL, NULL, 'getLastInsertID', 749, 750),
(493, 452, NULL, NULL, 'getInsertID', 751, 752),
(494, 452, NULL, NULL, 'setInsertID', 753, 754),
(495, 452, NULL, NULL, 'getNumRows', 755, 756),
(496, 452, NULL, NULL, 'getAffectedRows', 757, 758),
(497, 452, NULL, NULL, 'setDataSource', 759, 760),
(498, 452, NULL, NULL, 'getDataSource', 761, 762),
(499, 452, NULL, NULL, 'associations', 763, 764),
(500, 452, NULL, NULL, 'getAssociated', 765, 766),
(501, 452, NULL, NULL, 'joinModel', 767, 768),
(502, 452, NULL, NULL, 'onError', 769, 770),
(503, 452, NULL, NULL, 'validator', 771, 772),
(504, 204, NULL, NULL, 'getUserId', 55, 56),
(505, 204, NULL, NULL, 'getUserName', 57, 58),
(506, 204, NULL, NULL, 'getUserRole', 59, 60),
(507, 204, NULL, NULL, 'canUploadMedias', 61, 62),
(508, 388, NULL, NULL, 'EvidenceTags', 774, 803),
(509, 508, NULL, NULL, 'index', 775, 776),
(510, 508, NULL, NULL, 'view', 777, 778),
(511, 508, NULL, NULL, 'add', 779, 780),
(512, 508, NULL, NULL, 'edit', 781, 782),
(513, 508, NULL, NULL, 'delete', 783, 784),
(514, 508, NULL, NULL, 'admin_index', 785, 786),
(515, 508, NULL, NULL, 'admin_view', 787, 788),
(516, 508, NULL, NULL, 'admin_add', 789, 790),
(517, 508, NULL, NULL, 'admin_edit', 791, 792),
(518, 508, NULL, NULL, 'admin_delete', 793, 794),
(519, 508, NULL, NULL, 'getUserId', 795, 796),
(520, 508, NULL, NULL, 'getUserName', 797, 798),
(521, 508, NULL, NULL, 'getUserRole', 799, 800),
(522, 508, NULL, NULL, 'canUploadMedias', 801, 802),
(523, 216, NULL, NULL, 'getUserId', 85, 86),
(524, 216, NULL, NULL, 'getUserName', 87, 88),
(525, 216, NULL, NULL, 'getUserRole', 89, 90),
(526, 216, NULL, NULL, 'canUploadMedias', 91, 92),
(527, 388, NULL, NULL, 'EvokationFollowers', 804, 833),
(528, 527, NULL, NULL, 'index', 805, 806),
(529, 527, NULL, NULL, 'view', 807, 808),
(530, 527, NULL, NULL, 'add', 809, 810),
(531, 527, NULL, NULL, 'edit', 811, 812),
(532, 527, NULL, NULL, 'delete', 813, 814),
(533, 527, NULL, NULL, 'admin_index', 815, 816),
(534, 527, NULL, NULL, 'admin_view', 817, 818),
(535, 527, NULL, NULL, 'admin_add', 819, 820),
(536, 527, NULL, NULL, 'admin_edit', 821, 822),
(537, 527, NULL, NULL, 'admin_delete', 823, 824),
(538, 527, NULL, NULL, 'getUserId', 825, 826),
(539, 527, NULL, NULL, 'getUserName', 827, 828),
(540, 527, NULL, NULL, 'getUserRole', 829, 830),
(541, 527, NULL, NULL, 'canUploadMedias', 831, 832),
(542, 388, NULL, NULL, 'EvokationTags', 834, 863),
(543, 542, NULL, NULL, 'index', 835, 836),
(544, 542, NULL, NULL, 'view', 837, 838),
(545, 542, NULL, NULL, 'add', 839, 840),
(546, 542, NULL, NULL, 'edit', 841, 842),
(547, 542, NULL, NULL, 'delete', 843, 844),
(548, 542, NULL, NULL, 'admin_index', 845, 846),
(549, 542, NULL, NULL, 'admin_view', 847, 848),
(550, 542, NULL, NULL, 'admin_add', 849, 850),
(551, 542, NULL, NULL, 'admin_edit', 851, 852),
(552, 542, NULL, NULL, 'admin_delete', 853, 854),
(553, 542, NULL, NULL, 'getUserId', 855, 856),
(554, 542, NULL, NULL, 'getUserName', 857, 858),
(555, 542, NULL, NULL, 'getUserRole', 859, 860),
(556, 542, NULL, NULL, 'canUploadMedias', 861, 862),
(557, 227, NULL, NULL, 'viewDraft', 115, 116),
(558, 227, NULL, NULL, 'getUserId', 117, 118),
(559, 227, NULL, NULL, 'getUserName', 119, 120),
(560, 227, NULL, NULL, 'getUserRole', 121, 122),
(561, 227, NULL, NULL, 'canUploadMedias', 123, 124),
(562, 414, NULL, NULL, 'getUserId', 601, 602),
(563, 414, NULL, NULL, 'getUserName', 603, 604),
(564, 414, NULL, NULL, 'getUserRole', 605, 606),
(565, 414, NULL, NULL, 'canUploadMedias', 607, 608),
(566, 238, NULL, NULL, 'isMember', 147, 148),
(567, 238, NULL, NULL, 'isOwner', 149, 150),
(568, 238, NULL, NULL, 'getUserId', 151, 152),
(569, 238, NULL, NULL, 'getUserName', 153, 154),
(570, 238, NULL, NULL, 'getUserRole', 155, 156),
(571, 238, NULL, NULL, 'canUploadMedias', 157, 158),
(572, 249, NULL, NULL, 'store_image', 185, 186),
(573, 249, NULL, NULL, 'isMember', 187, 188),
(574, 249, NULL, NULL, 'isOwner', 189, 190),
(575, 249, NULL, NULL, 'getUserId', 191, 192),
(576, 249, NULL, NULL, 'getUserName', 193, 194),
(577, 249, NULL, NULL, 'getUserRole', 195, 196),
(578, 249, NULL, NULL, 'canUploadMedias', 197, 198),
(579, 261, NULL, NULL, 'getUserId', 221, 222),
(580, 261, NULL, NULL, 'getUserName', 223, 224),
(581, 261, NULL, NULL, 'getUserRole', 225, 226),
(582, 261, NULL, NULL, 'canUploadMedias', 227, 228),
(583, 272, NULL, NULL, 'getUserId', 0, 0),
(584, 272, NULL, NULL, 'getUserId', 253, 254),
(585, 272, NULL, NULL, 'getUserName', 255, 256),
(586, 272, NULL, NULL, 'getUserRole', 257, 258),
(587, 272, NULL, NULL, 'canUploadMedias', 259, 260),
(588, 283, NULL, NULL, 'getUserId', 283, 284),
(589, 283, NULL, NULL, 'getUserName', 285, 286),
(590, 283, NULL, NULL, 'getUserRole', 287, 288),
(591, 283, NULL, NULL, 'canUploadMedias', 289, 290),
(592, 298, NULL, NULL, 'getUserId', 303, 304),
(593, 298, NULL, NULL, 'getUserName', 305, 306),
(594, 298, NULL, NULL, 'getUserRole', 307, 308),
(595, 298, NULL, NULL, 'canUploadMedias', 309, 310),
(596, 309, NULL, NULL, 'getUserId', 315, 316),
(597, 309, NULL, NULL, 'getUserName', 317, 318),
(598, 309, NULL, NULL, 'getUserRole', 319, 320),
(599, 309, NULL, NULL, 'canUploadMedias', 321, 322),
(600, 311, NULL, NULL, 'edit_user_role', 351, 352),
(601, 311, NULL, NULL, 'getUserId', 353, 354),
(602, 311, NULL, NULL, 'getUserName', 355, 356),
(603, 311, NULL, NULL, 'getUserRole', 357, 358),
(604, 311, NULL, NULL, 'canUploadMedias', 359, 360),
(605, 402, NULL, NULL, 'getUserId', 569, 570),
(606, 402, NULL, NULL, 'getUserName', 571, 572),
(607, 402, NULL, NULL, 'getUserRole', 573, 574),
(608, 402, NULL, NULL, 'canUploadMedias', 575, 576),
(609, 322, NULL, NULL, 'getUserId', 387, 388),
(610, 322, NULL, NULL, 'getUserName', 389, 390),
(611, 322, NULL, NULL, 'getUserRole', 391, 392),
(612, 322, NULL, NULL, 'canUploadMedias', 393, 394),
(613, 333, NULL, NULL, 'getUserId', 407, 408),
(614, 333, NULL, NULL, 'getUserName', 409, 410),
(615, 333, NULL, NULL, 'getUserRole', 411, 412),
(616, 333, NULL, NULL, 'canUploadMedias', 413, 414),
(617, 388, NULL, NULL, 'Tags', 864, 893),
(618, 617, NULL, NULL, 'index', 865, 866),
(619, 617, NULL, NULL, 'view', 867, 868),
(620, 617, NULL, NULL, 'add', 869, 870),
(621, 617, NULL, NULL, 'edit', 871, 872),
(622, 617, NULL, NULL, 'delete', 873, 874),
(623, 617, NULL, NULL, 'admin_index', 875, 876),
(624, 617, NULL, NULL, 'admin_view', 877, 878),
(625, 617, NULL, NULL, 'admin_add', 879, 880),
(626, 617, NULL, NULL, 'admin_edit', 881, 882),
(627, 617, NULL, NULL, 'admin_delete', 883, 884),
(628, 617, NULL, NULL, 'getUserId', 885, 886),
(629, 617, NULL, NULL, 'getUserName', 887, 888),
(630, 617, NULL, NULL, 'getUserRole', 889, 890),
(631, 617, NULL, NULL, 'canUploadMedias', 891, 892),
(632, 388, NULL, NULL, 'UserFriends', 894, 923),
(633, 632, NULL, NULL, 'index', 895, 896),
(634, 632, NULL, NULL, 'view', 897, 898),
(635, 632, NULL, NULL, 'add', 899, 900),
(636, 632, NULL, NULL, 'edit', 901, 902),
(637, 632, NULL, NULL, 'delete', 903, 904),
(638, 632, NULL, NULL, 'admin_index', 905, 906),
(639, 632, NULL, NULL, 'admin_view', 907, 908),
(640, 632, NULL, NULL, 'admin_add', 909, 910),
(641, 632, NULL, NULL, 'admin_edit', 911, 912),
(642, 632, NULL, NULL, 'admin_delete', 913, 914),
(643, 632, NULL, NULL, 'getUserId', 915, 916),
(644, 632, NULL, NULL, 'getUserName', 917, 918),
(645, 632, NULL, NULL, 'getUserRole', 919, 920),
(646, 632, NULL, NULL, 'canUploadMedias', 921, 922),
(647, 339, NULL, NULL, 'getUserId', 437, 438),
(648, 339, NULL, NULL, 'getUserName', 439, 440),
(649, 339, NULL, NULL, 'getUserRole', 441, 442),
(650, 339, NULL, NULL, 'canUploadMedias', 443, 444),
(651, 426, NULL, NULL, 'admin_index', 621, 622),
(652, 426, NULL, NULL, 'admin_view', 623, 624),
(653, 426, NULL, NULL, 'admin_add', 625, 626),
(654, 426, NULL, NULL, 'admin_edit', 627, 628),
(655, 426, NULL, NULL, 'admin_delete', 629, 630),
(656, 426, NULL, NULL, 'getUserId', 631, 632),
(657, 426, NULL, NULL, 'getUserName', 633, 634),
(658, 426, NULL, NULL, 'getUserRole', 635, 636),
(659, 426, NULL, NULL, 'canUploadMedias', 637, 638),
(660, 432, NULL, NULL, 'getUserId', 651, 652),
(661, 432, NULL, NULL, 'getUserName', 653, 654),
(662, 432, NULL, NULL, 'getUserRole', 655, 656),
(663, 432, NULL, NULL, 'canUploadMedias', 657, 658),
(664, 350, NULL, NULL, 'getUserId', 483, 484),
(665, 350, NULL, NULL, 'getUserName', 485, 486),
(666, 350, NULL, NULL, 'getUserRole', 487, 488),
(667, 350, NULL, NULL, 'canUploadMedias', 489, 490),
(668, 369, NULL, NULL, 'getUserId', 513, 514),
(669, 369, NULL, NULL, 'getUserName', 515, 516),
(670, 369, NULL, NULL, 'getUserRole', 517, 518),
(671, 369, NULL, NULL, 'canUploadMedias', 519, 520),
(672, 388, NULL, NULL, 'Chosen', 924, 1029),
(673, 672, NULL, NULL, 'ChosenAppModel', 925, 1028),
(674, 673, NULL, NULL, 'bindModel', 926, 927),
(675, 673, NULL, NULL, 'unbindModel', 928, 929),
(676, 673, NULL, NULL, 'setSource', 930, 931),
(677, 673, NULL, NULL, 'deconstruct', 932, 933),
(678, 673, NULL, NULL, 'schema', 934, 935),
(679, 673, NULL, NULL, 'getColumnTypes', 936, 937),
(680, 673, NULL, NULL, 'getColumnType', 938, 939),
(681, 673, NULL, NULL, 'hasField', 940, 941),
(682, 673, NULL, NULL, 'hasMethod', 942, 943),
(683, 673, NULL, NULL, 'isVirtualField', 944, 945),
(684, 673, NULL, NULL, 'getVirtualField', 946, 947),
(685, 673, NULL, NULL, 'create', 948, 949),
(686, 673, NULL, NULL, 'clear', 950, 951),
(687, 673, NULL, NULL, 'read', 952, 953),
(688, 673, NULL, NULL, 'field', 954, 955),
(689, 673, NULL, NULL, 'saveField', 956, 957),
(690, 673, NULL, NULL, 'save', 958, 959),
(691, 673, NULL, NULL, 'updateCounterCache', 960, 961),
(692, 673, NULL, NULL, 'saveAll', 962, 963),
(693, 673, NULL, NULL, 'saveMany', 964, 965),
(694, 673, NULL, NULL, 'validateMany', 966, 967),
(695, 673, NULL, NULL, 'saveAssociated', 968, 969),
(696, 673, NULL, NULL, 'validateAssociated', 970, 971),
(697, 673, NULL, NULL, 'updateAll', 972, 973),
(698, 673, NULL, NULL, 'delete', 974, 975),
(699, 673, NULL, NULL, 'deleteAll', 976, 977),
(700, 673, NULL, NULL, 'exists', 978, 979),
(701, 673, NULL, NULL, 'hasAny', 980, 981),
(702, 673, NULL, NULL, 'find', 982, 983),
(703, 673, NULL, NULL, 'buildQuery', 984, 985),
(704, 673, NULL, NULL, 'resetAssociations', 986, 987),
(705, 673, NULL, NULL, 'isUnique', 988, 989),
(706, 673, NULL, NULL, 'query', 990, 991),
(707, 673, NULL, NULL, 'validates', 992, 993),
(708, 673, NULL, NULL, 'invalidFields', 994, 995),
(709, 673, NULL, NULL, 'invalidate', 996, 997),
(710, 673, NULL, NULL, 'isForeignKey', 998, 999),
(711, 673, NULL, NULL, 'escapeField', 1000, 1001),
(712, 673, NULL, NULL, 'getID', 1002, 1003),
(713, 673, NULL, NULL, 'getLastInsertID', 1004, 1005),
(714, 673, NULL, NULL, 'getInsertID', 1006, 1007),
(715, 673, NULL, NULL, 'setInsertID', 1008, 1009),
(716, 673, NULL, NULL, 'getNumRows', 1010, 1011),
(717, 673, NULL, NULL, 'getAffectedRows', 1012, 1013),
(718, 673, NULL, NULL, 'setDataSource', 1014, 1015),
(719, 673, NULL, NULL, 'getDataSource', 1016, 1017),
(720, 673, NULL, NULL, 'associations', 1018, 1019),
(721, 673, NULL, NULL, 'getAssociated', 1020, 1021),
(722, 673, NULL, NULL, 'joinModel', 1022, 1023),
(723, 673, NULL, NULL, 'onError', 1024, 1025),
(724, 673, NULL, NULL, 'validator', 1026, 1027),
(725, 382, NULL, NULL, 'getUserId', 530, 531),
(726, 382, NULL, NULL, 'getUserName', 532, 533),
(727, 382, NULL, NULL, 'getUserRole', 534, 535),
(728, 382, NULL, NULL, 'canUploadMedias', 536, 537),
(729, 388, NULL, NULL, 'Media', 1030, 1051),
(730, 729, NULL, NULL, 'Medias', 1031, 1050),
(731, 730, NULL, NULL, 'canUploadMedias', 1032, 1033),
(732, 730, NULL, NULL, 'index', 1034, 1035),
(733, 730, NULL, NULL, 'upload', 1036, 1037),
(734, 730, NULL, NULL, 'delete', 1038, 1039),
(735, 730, NULL, NULL, 'thumb', 1040, 1041),
(736, 730, NULL, NULL, 'order', 1042, 1043),
(737, 730, NULL, NULL, 'getUserId', 1044, 1045),
(738, 730, NULL, NULL, 'getUserName', 1046, 1047),
(739, 730, NULL, NULL, 'getUserRole', 1048, 1049),
(740, 388, NULL, NULL, 'Answers', 1052, 1071),
(741, 740, NULL, NULL, 'index', 1053, 1054),
(742, 740, NULL, NULL, 'view', 1055, 1056),
(743, 740, NULL, NULL, 'add', 1057, 1058),
(744, 740, NULL, NULL, 'edit', 1059, 1060),
(745, 740, NULL, NULL, 'delete', 1061, 1062),
(746, 740, NULL, NULL, 'getUserId', 1063, 1064),
(747, 740, NULL, NULL, 'getUserName', 1065, 1066),
(748, 740, NULL, NULL, 'getUserRole', 1067, 1068),
(749, 740, NULL, NULL, 'canUploadMedias', 1069, 1070),
(750, 311, NULL, NULL, 'destroyQuestionnaire', 361, 362),
(751, 311, NULL, NULL, 'quest', 363, 364),
(752, 388, NULL, NULL, 'Questionnaires', 1072, 1091),
(753, 752, NULL, NULL, 'index', 1073, 1074),
(754, 752, NULL, NULL, 'view', 1075, 1076),
(755, 752, NULL, NULL, 'add', 1077, 1078),
(756, 752, NULL, NULL, 'edit', 1079, 1080),
(757, 752, NULL, NULL, 'delete', 1081, 1082),
(758, 752, NULL, NULL, 'getUserId', 1083, 1084),
(759, 752, NULL, NULL, 'getUserName', 1085, 1086),
(760, 752, NULL, NULL, 'getUserRole', 1087, 1088),
(761, 752, NULL, NULL, 'canUploadMedias', 1089, 1090),
(762, 388, NULL, NULL, 'Questions', 1092, 1111),
(763, 762, NULL, NULL, 'index', 1093, 1094),
(764, 762, NULL, NULL, 'view', 1095, 1096),
(765, 762, NULL, NULL, 'add', 1097, 1098),
(766, 762, NULL, NULL, 'edit', 1099, 1100),
(767, 762, NULL, NULL, 'delete', 1101, 1102),
(768, 762, NULL, NULL, 'getUserId', 1103, 1104),
(769, 762, NULL, NULL, 'getUserName', 1105, 1106),
(770, 762, NULL, NULL, 'getUserRole', 1107, 1108),
(771, 762, NULL, NULL, 'canUploadMedias', 1109, 1110),
(772, 388, NULL, NULL, 'UserAnswers', 1112, 1131),
(773, 772, NULL, NULL, 'index', 1113, 1114),
(774, 772, NULL, NULL, 'view', 1115, 1116),
(775, 772, NULL, NULL, 'add', 1117, 1118),
(776, 772, NULL, NULL, 'edit', 1119, 1120),
(777, 772, NULL, NULL, 'delete', 1121, 1122),
(778, 772, NULL, NULL, 'getUserId', 1123, 1124),
(779, 772, NULL, NULL, 'getUserName', 1125, 1126),
(780, 772, NULL, NULL, 'getUserRole', 1127, 1128),
(781, 772, NULL, NULL, 'canUploadMedias', 1129, 1130);

-- --------------------------------------------------------

--
-- Estrutura da tabela `answers`
--

CREATE TABLE IF NOT EXISTS `answers` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `question_id` int(16) unsigned NOT NULL,
  `description` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=36 ;

--
-- Extraindo dados da tabela `answers`
--

INSERT INTO `answers` (`id`, `question_id`, `description`, `created`, `modified`) VALUES
(30, 30, 'kkk', '2014-03-24 18:30:12', '2014-03-24 18:30:12'),
(31, 30, 'hahaha', '2014-03-24 18:30:12', '2014-03-24 18:30:12'),
(32, 30, 'huehue', '2014-03-24 18:30:12', '2014-03-24 18:30:12'),
(33, 31, 'multi1', '2014-03-24 18:30:12', '2014-03-24 18:30:12'),
(34, 31, 'multi2', '2014-03-24 18:30:12', '2014-03-24 18:30:12'),
(35, 31, 'multi3', '2014-03-24 18:30:12', '2014-03-24 18:30:12');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=39 ;

--
-- Extraindo dados da tabela `aros`
--

INSERT INTO `aros` (`id`, `parent_id`, `model`, `foreign_key`, `alias`, `lft`, `rght`) VALUES
(1, NULL, 'Role', 1, NULL, 1, 32),
(2, NULL, 'Role', 2, NULL, 33, 38),
(3, NULL, 'Role', 3, NULL, 39, 56),
(7, NULL, 'Role', 4, NULL, 57, 58),
(9, 1, 'User', 5, NULL, 8, 9),
(10, 2, 'User', 6, NULL, 36, 37),
(11, NULL, 'User', 7, NULL, 67, 68),
(12, NULL, 'User', 8, NULL, 59, 60),
(13, NULL, 'User', 9, NULL, 61, 62),
(14, NULL, 'User', 10, NULL, 63, 64),
(15, 3, 'User', 11, NULL, 44, 45),
(22, 1, 'User', 18, NULL, 10, 11),
(23, 3, 'User', 19, NULL, 46, 47),
(24, 3, 'User', 20, NULL, 48, 49),
(25, 3, 'User', 21, NULL, 50, 51),
(26, 1, 'User', 22, NULL, 12, 13),
(27, 1, 'User', 23, NULL, 14, 15),
(28, 1, 'User', 24, NULL, 16, 17),
(29, 1, 'User', 25, NULL, 18, 19),
(30, 1, 'User', 26, NULL, 20, 21),
(31, NULL, 'User', 27, NULL, 69, 70),
(32, 1, 'User', 28, NULL, 22, 23),
(33, 1, 'User', 29, NULL, 24, 25),
(34, 1, 'User', 30, NULL, 26, 27),
(35, 1, 'User', 31, NULL, 28, 29),
(36, 3, 'User', 32, NULL, 52, 53),
(37, 1, 'User', 33, NULL, 30, 31),
(38, 3, 'User', 34, NULL, 54, 55);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=21 ;

--
-- Extraindo dados da tabela `evokations`
--

INSERT INTO `evokations` (`id`, `group_id`, `gdrive_file_id`, `title`, `abstract`, `language`, `created`, `modified`) VALUES
(18, 3, '0B9uWvehaHYz2aWdjdmRfZWZLR0E', 'tmp_title', 'tmp_abstract', NULL, '2014-02-28 19:36:00', '2014-02-28 19:36:00'),
(19, 3, '0B9uWvehaHYz2NUVrVHNSSUV4WjA', 'tmp_title', 'tmp_abstract', NULL, '2014-02-28 19:47:42', '2014-02-28 19:47:42'),
(20, 1, '0B9uWvehaHYz2bUJVdllvZVlFVXc', 'tmp_title', 'tmp_abstract', NULL, '2014-03-19 17:08:58', '2014-03-19 17:08:58');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `title`, `user_id`, `created`, `modified`) VALUES
(1, 'meu group', 5, '2014-03-19 16:24:23', '2014-03-19 16:24:23');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `groups_users`
--

INSERT INTO `groups_users` (`id`, `user_id`, `group_id`, `created`, `modified`) VALUES
(1, 27, 1, '2014-03-19 16:43:33', '2014-03-19 16:43:33');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `group_requests`
--

INSERT INTO `group_requests` (`id`, `user_id`, `group_id`, `status`, `created`, `modified`) VALUES
(1, 27, 1, 1, '2014-03-19 16:41:12', '2014-03-19 16:43:33');

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
  `organization_id` int(16) unsigned NOT NULL,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `image` varchar(120) DEFAULT NULL,
  `language` varchar(120) DEFAULT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=104 ;

--
-- Extraindo dados da tabela `missions`
--

INSERT INTO `missions` (`id`, `organization_id`, `title`, `description`, `image`, `language`, `created`, `modified`) VALUES
(93, 48, 'asda', '', '', NULL, '2014-03-13 18:37:06', '2014-03-13 18:38:12'),
(94, 46, 'aisad', '', '', NULL, '2014-03-13 18:49:30', '2014-03-13 18:49:30'),
(95, 48, 'Mission New deadlines', 'kasksadmka skd a', '', NULL, '2014-03-17 15:48:42', '2014-03-17 15:48:42'),
(100, 49, 'olá', 'asdddssa', '', NULL, '2014-03-24 11:39:38', '2014-03-24 11:39:38'),
(101, 49, 'missao nova', 'asjidaads', '', NULL, '2014-03-24 13:26:37', '2014-03-24 13:26:37'),
(102, 49, 'asasdasasdadasd', 'asdassad', '', NULL, '2014-03-24 13:36:15', '2014-03-24 13:36:15'),
(103, 49, 'missao leo', 'asijdasd', '', NULL, '2014-03-24 13:43:55', '2014-03-24 13:43:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `mission_issues`
--

CREATE TABLE IF NOT EXISTS `mission_issues` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `mission_id` int(16) unsigned NOT NULL,
  `issue_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=66 ;

--
-- Extraindo dados da tabela `mission_issues`
--

INSERT INTO `mission_issues` (`id`, `mission_id`, `issue_id`) VALUES
(54, 92, 1),
(55, 93, 1),
(56, 94, 1),
(57, 95, 2),
(62, 100, 1),
(63, 101, 1),
(64, 102, 1),
(65, 103, 1);

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=50 ;

--
-- Extraindo dados da tabela `organizations`
--

INSERT INTO `organizations` (`id`, `name`, `birthdate`, `description`, `website`, `facerbook`, `twitter`, `blog`) VALUES
(44, 'nossa org', '2014-03-13', '', '', NULL, '', ''),
(46, 'sódeadmin', '2014-03-13', '', '', NULL, '', ''),
(48, 'mais uma', '2014-03-13', '', '', NULL, '', ''),
(49, 'auth', '2014-03-18', '', '', NULL, '', '');

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=34 ;

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
(27, 'EVOKE', '', 95, 4, 0, '2014-03-17 15:49:44', '2014-03-17 15:49:44'),
(28, 'EXPLORE', '', 96, 1, 0, '2014-03-20 16:26:31', '2014-03-20 16:26:31'),
(29, 'EXPLORE', 'a', 97, 1, 0, '2014-03-21 14:35:17', '2014-03-21 14:35:17'),
(30, 'EXPLORE', 'awsd', 100, 1, 0, '2014-03-24 11:39:49', '2014-03-24 11:39:49'),
(31, 'EXPLORE', 'ujhj', 101, 1, 0, '2014-03-24 13:26:45', '2014-03-24 13:26:45'),
(32, 'EXPLORE', 'as', 102, 1, 0, '2014-03-24 13:36:22', '2014-03-24 13:36:22'),
(33, 'EXPLORE', 'adsasdasda', 103, 1, 0, '2014-03-24 13:44:02', '2014-03-24 13:44:02');

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
-- Estrutura da tabela `questionnaires`
--

CREATE TABLE IF NOT EXISTS `questionnaires` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `quest_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `questionnaires`
--

INSERT INTO `questionnaires` (`id`, `quest_id`, `created`, `modified`) VALUES
(14, 37, '2014-03-24 17:19:25', '2014-03-24 17:19:25'),
(16, 38, '2014-03-24 18:30:12', '2014-03-24 18:30:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `questions`
--

CREATE TABLE IF NOT EXISTS `questions` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int(16) unsigned NOT NULL,
  `description` text NOT NULL,
  `type` varchar(120) NOT NULL COMMENT 'Defines the type of question: essay, multiple-choice, single-choice',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=32 ;

--
-- Extraindo dados da tabela `questions`
--

INSERT INTO `questions` (`id`, `questionnaire_id`, `description`, `type`, `created`, `modified`) VALUES
(26, 14, 'Calma', 'essay', '2014-03-24 17:19:25', '2014-03-24 17:19:25'),
(29, 16, 'ufa', 'essay', '2014-03-24 18:30:12', '2014-03-24 18:30:12'),
(30, 16, 'melhor risada é?', 'single-choice', '2014-03-24 18:30:12', '2014-03-24 18:30:12'),
(31, 16, 'essa é multi choice', 'multiple-choice', '2014-03-24 18:30:12', '2014-03-24 18:30:12');

-- --------------------------------------------------------

--
-- Estrutura da tabela `quests`
--

CREATE TABLE IF NOT EXISTS `quests` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `type` tinyint(3) unsigned NOT NULL,
  `mission_id` int(16) unsigned NOT NULL,
  `phase_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=39 ;

--
-- Extraindo dados da tabela `quests`
--

INSERT INTO `quests` (`id`, `title`, `description`, `type`, `mission_id`, `phase_id`, `created`, `modified`) VALUES
(1, 'primeira quest', 'rookgaard', 0, 82, 9, '2014-03-10 14:23:54', '2014-03-10 14:23:54'),
(2, '1st quest', '', 0, 83, 10, '2014-03-10 14:37:36', '2014-03-10 14:37:36'),
(3, 'quest 4', '', 0, 84, 12, '2014-03-10 14:41:38', '2014-03-10 14:41:38'),
(4, 'quest rook', '', 0, 85, 13, '2014-03-10 14:45:41', '2014-03-10 14:45:41'),
(5, 'quest main', '', 0, 85, 13, '2014-03-10 14:49:58', '2014-03-10 14:49:58'),
(6, 'adsjo', 'asd', 0, 86, 14, '2014-03-10 15:26:10', '2014-03-10 15:26:10'),
(7, 'okaok', 'ads', 0, 86, 14, '2014-03-10 15:32:31', '2014-03-10 15:32:31'),
(9, 'intro', '', 0, 89, 16, '2014-03-10 16:11:59', '2014-03-10 16:11:59'),
(10, 'chorus', '', 0, 89, 16, '2014-03-10 16:12:04', '2014-03-10 16:12:04'),
(11, 'verse', '', 0, 89, 16, '2014-03-10 16:12:11', '2014-03-10 16:12:11'),
(13, 'alguma', '', 0, 90, 17, '2014-03-10 16:56:47', '2014-03-10 16:56:47'),
(15, 'adsadsa2', 'e', 0, 91, 21, '2014-03-12 14:39:30', '2014-03-12 14:39:41'),
(16, 'ad', '21', 0, 91, 21, '2014-03-12 14:43:23', '2014-03-12 14:43:23'),
(17, 'fd', '', 0, 91, 21, '2014-03-12 14:45:49', '2014-03-12 14:45:49'),
(18, 'batata', '', 0, 78, 3, '2014-03-12 14:49:33', '2014-03-12 14:49:33'),
(19, 'queijo', '', 0, 78, 3, '2014-03-12 14:49:41', '2014-03-12 14:49:41'),
(20, 'bacon', '', 0, 78, 3, '2014-03-12 14:49:48', '2014-03-12 14:49:48'),
(22, 'cebola', '', 0, 78, 23, '2014-03-12 14:52:02', '2014-03-12 14:52:02'),
(23, 'molho', '', 0, 78, 23, '2014-03-12 14:52:22', '2014-03-12 14:52:22'),
(24, 'Dragons', '', 0, 95, 25, '2014-03-17 15:49:56', '2014-03-17 15:49:56'),
(27, 'Questionario maluco2', 'adasda', 1, 100, 30, '2014-03-24 12:14:30', '2014-03-24 12:14:30'),
(28, 'Questionario maluco2', 'adasda', 1, 100, 30, '2014-03-24 12:19:33', '2014-03-24 12:19:33'),
(29, 'Questionario maluco2', 'adasda', 1, 100, 30, '2014-03-24 12:21:12', '2014-03-24 12:21:12'),
(30, 'Questionario maluco2', 'adasda', 1, 100, 30, '2014-03-24 12:24:19', '2014-03-24 12:24:19'),
(31, 'Questionario maluco2', 'adasda', 1, 100, 30, '2014-03-24 12:30:46', '2014-03-24 12:30:46'),
(32, 'Questionario maluco2', 'adasda', 1, 100, 30, '2014-03-24 12:31:43', '2014-03-24 12:31:43'),
(33, 'Questionario maluco3', 'adasd', 1, 101, 31, '2014-03-24 13:32:04', '2014-03-24 13:32:04'),
(34, 'ai', 'asios', 1, 102, 32, '2014-03-24 13:36:46', '2014-03-24 13:36:46'),
(35, 'questionario leo', 'asdaqsd', 1, 103, 33, '2014-03-24 13:44:29', '2014-03-24 13:44:29'),
(36, 'outra', 'asijas', 1, 103, 33, '2014-03-24 14:03:34', '2014-03-24 14:03:34'),
(37, 'minha nova quest', 'aokdoasla', 1, 103, 33, '2014-03-24 15:07:55', '2014-03-24 17:19:25'),
(38, 'só pra ter certeza ', 'aisjiadj', 1, 103, 33, '2014-03-24 17:22:56', '2014-03-24 18:30:12');

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
(19, 'google_auth_access_token', '{"access_token":"ya29.1.AADtN_UziiXN4PCiQXVGw8NgAS3U0CiUa5IRHZAOa_irC0VprbH0Quo4HoWutrf7","token_type":"Bearer","expires_in":3600,"id_token":"eyJhbGciOiJSUzI1NiIsImtpZCI6ImY2MDNhODlhNzQ0OGEyMjM5MDcxZjI4YTk3MzViNjUwNWM2YWJjYTgifQ.eyJpc3MiOiJhY2NvdW50cy5nb29nbGUuY29tIiwiY2lkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiYXpwIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwidG9rZW5faGFzaCI6ImhYZjJzUVV5c1Zma09GbHpIbmtKMkEiLCJhdF9oYXNoIjoiaFhmMnNRVXlzVmZrT0Zsekhua0oyQSIsImlkIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwic3ViIjoiMTAzMDM3NDEwNzcwNjc5MjMzNTYzIiwiYXVkIjoiMjY1MDUyODEyNTA2LWtsMTVlaTZidjg0OTNlNHNiN3V1MzFua3N1b3I5cjEwLmFwcHMuZ29vZ2xldXNlcmNvbnRlbnQuY29tIiwiZW1haWwiOiJtc29sZWRhZGVAcXVhbnRpLmNhIiwiaGQiOiJxdWFudGkuY2EiLCJ2ZXJpZmllZF9lbWFpbCI6InRydWUiLCJlbWFpbF92ZXJpZmllZCI6InRydWUiLCJpYXQiOjEzOTM1MjQyNTUsImV4cCI6MTM5MzUyODE1NX0.c9WNn8ubqvqkVxJpcpW_Xs9xWhbZ_HHdP6_ROM7uUi81UvQEQXlmckCluf46GR4MLIrMKyejhgoYp5kD0uRo8zel5lFu7ucaZTCAZHT1C5wMniYPzhuVonlWazwX19MefJhDR67pEa6xKUFpA5IhlnvAvTLRT0-_v2aCiODr-CQ","refresh_token":"1\\/hF_NMUf2qVGOip0lzm15Bluw48dK5-7M4Q4TBXMqYnc","created":1395263333}', '2014-02-27 15:08:57', '2014-03-19 21:27:00');

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=35 ;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `role_id`, `facebook_id`, `facebook_token`, `name`, `birthdate`, `email`, `sex`, `biography`, `username`, `password`, `facebook`, `twitter`, `instagram`, `website`, `blog`, `created`, `modified`) VALUES
(5, 1, NULL, NULL, 'admin alexandre', '0000-00-00', NULL, 0, '', 'root', '39c3730c51df48f65defc5a94dbd1312df8ebb05', NULL, NULL, NULL, NULL, NULL, '2014-03-07 15:33:33', '2014-03-07 15:33:33'),
(6, 2, NULL, NULL, 'MyManager', '2034-01-01', 'alerossialvares@gmail.com', 0, 'asd', 'manager', 'cdeeae3ed8f20ad05252bd6dcf6fa20af7d82901', '', '', '', '', '', '2014-03-12 11:37:29', '2014-03-19 16:43:09'),
(27, 3, '100001280484261', 'CAAJeTV3YsC8BAGLeCnCqIvMi6yirSLPZAJZBlkxbdZBufvveZBPqXs0fNmaEHNr5RR5LeTQvBOQoMRksPlZAZBtfNJ49zZBrBtEnu6denH1TCFiiZBlY2dZCggvsYZBZA2SMuQxPoKi0PD1ZCeZCAHN46EU4KlaxJEcNptXnvmgs22JzZCXyZArp8RVylaZCc1k5ezG56IAZD', 'Alexandre Rossi Alvares', '0000-00-00', NULL, 1, '', '', '', 'https://www.facebook.com/alerossialvares', NULL, NULL, NULL, NULL, '2014-03-18 16:41:58', '2014-03-19 18:12:30'),
(28, 1, NULL, NULL, 'ola', '2034-01-01', 'ola@as.com', 0, 'ds', 'ola', '357e3dd459a5cfec0262ec840d6b4f549afc3461', '', '', '', '', '', '2014-03-18 17:25:31', '2014-03-18 17:27:24'),
(29, 1, NULL, NULL, 'john', '2034-01-01', 'asdasd@sadasd.com', 0, 'd', 'john', '09b71a7733dd98d62510a8a8ef6cfc4bc6333c2b', '', '', '', '', '', '2014-03-18 17:28:44', '2014-03-18 17:30:28'),
(30, 1, NULL, NULL, 'j', '2034-01-01', 'asdasd@sadasd.com', 0, 'hj', 'j', '88f030e67f1e389ac747448032d8eeec1f28e3f9', '', '', '', '', '', '2014-03-18 17:32:21', '2014-03-18 17:32:30'),
(31, 1, NULL, NULL, 'lol', '2034-01-01', 'asdasd@sadasd.com', 0, 'sdsdsd', 'lol', '8424bddb4335c790d65178eb7c89d9b7c9e078f2', '', '', '', '', '', '2014-03-18 17:34:27', '2014-03-18 17:34:35'),
(32, 3, NULL, NULL, 'b', '2034-01-01', 'ola@as.com', 0, 'ds', 'b', '58d20b861f7cd5fa8c1290db8d9f0a8244169ba5', 'ds', '', '', '', '', '2014-03-18 17:37:08', '2014-03-20 15:43:17'),
(33, 1, NULL, NULL, 'uju', '2034-01-01', 'ola@as.com', 0, 'adsad', 'u', 'a1d4c0fd7d1cc0372d5f5ea0b2b5a3b832d64a74', '', '', '', '', '', '2014-03-18 17:45:37', '2014-03-18 17:48:02'),
(34, 3, NULL, NULL, 'cat', '2034-01-01', 'cat@gmail.com', 0, 'asdad', 'cat', 'affba5ae05ea1b1e953b88e538004d874a21821b', '', '', '', '', '', '2014-03-20 15:43:54', '2014-03-20 15:44:40');

-- --------------------------------------------------------

--
-- Estrutura da tabela `user_answers`
--

CREATE TABLE IF NOT EXISTS `user_answers` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `question_id` int(16) unsigned NOT NULL,
  `answer_id` int(16) unsigned NOT NULL,
  `description` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=17 ;

--
-- Extraindo dados da tabela `user_organizations`
--

INSERT INTO `user_organizations` (`id`, `user_id`, `organization_id`) VALUES
(10, 5, 44),
(11, 6, 44),
(13, 5, 46),
(15, 6, 48),
(16, 6, 49);

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
