CREATE TABLE `user_friends` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `friend_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8