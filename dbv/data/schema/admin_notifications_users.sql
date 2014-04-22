CREATE TABLE `admin_notifications_users` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `admin_notification_id` int(16) unsigned NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8