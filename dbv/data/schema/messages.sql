CREATE TABLE `messages` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `chat_conversation_id` int(16) unsigned NOT NULL,
  `member_id` int(16) unsigned NOT NULL,
  `author` varchar(120) NOT NULL,
  `content` text NOT NULL,
  `created` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8