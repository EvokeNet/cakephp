CREATE TABLE `badge_power_points` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `badge_id` int(16) unsigned NOT NULL,
  `power_points_id` int(16) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8