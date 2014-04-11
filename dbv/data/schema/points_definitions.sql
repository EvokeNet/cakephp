CREATE TABLE `points_definitions` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(120) NOT NULL,
  `points` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8