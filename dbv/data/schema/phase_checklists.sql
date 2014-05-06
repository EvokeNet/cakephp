CREATE TABLE `phase_checklists` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `item` text NOT NULL,
  `mission_id` int(16) unsigned DEFAULT NULL,
  `phase_id` int(16) unsigned NOT NULL,
  `language` varchar(120) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8