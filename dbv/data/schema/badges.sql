CREATE TABLE `badges` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `organization_id` int(16) unsigned NOT NULL,
  `name` varchar(120) CHARACTER SET utf8 NOT NULL,
  `description` text CHARACTER SET utf8 NOT NULL,
  `trigger` varchar(120) NOT NULL,
  `language` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1