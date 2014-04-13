CREATE TABLE `user_power_points` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `power_points_id` int(16) unsigned NOT NULL,
  `quest_id` int(16) unsigned NOT NULL,
  `model` varchar(120) NOT NULL,
  `foreign_key` int(16) unsigned NOT NULL,
  `quantity` int(11) NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8