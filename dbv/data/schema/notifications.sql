CREATE TABLE `notifications` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `origin` varchar(120) NOT NULL,
  `origin_id` int(16) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8