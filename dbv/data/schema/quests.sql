CREATE TABLE `quests` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `mission_id` int(16) unsigned NOT NULL,
  `phase_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1