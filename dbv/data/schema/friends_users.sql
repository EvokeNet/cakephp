CREATE TABLE `friends_users` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_from` int(16) unsigned NOT NULL,
  `user_to` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_from` (`user_from`),
  UNIQUE KEY `user_to` (`user_to`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1