CREATE TABLE `chat_conversations` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `custom` tinyint(2) NOT NULL DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8