CREATE TABLE `tags` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `instances` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8