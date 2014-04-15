CREATE TABLE `levels` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `level` int(11) NOT NULL,
  `points` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8