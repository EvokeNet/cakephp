CREATE TABLE `forums` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `title` varchar(120) NOT NULL,
  `slug` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `topic_count` int(16) NOT NULL,
  `post_count` int(16) NOT NULL,
  `lastTopic_id` int(16) NOT NULL,
  `lastPost_id` int(16) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8