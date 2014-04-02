CREATE TABLE `points` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `value` double NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1