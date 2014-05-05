CREATE TABLE `dossier_videos` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `video_link` varchar(120) NOT NULL,
  `mission_id` int(16) unsigned NOT NULL,
  `language` varchar(120) NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8