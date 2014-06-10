CREATE TABLE `members` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `chat_conversation_id` int(16) unsigned NOT NULL,
  `user_id` int(16) unsigned NOT NULL,
  `last_activity` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8