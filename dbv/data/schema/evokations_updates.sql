CREATE TABLE `evokations_updates` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `evokation_id` int(16) unsigned NOT NULL,
  `description` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8