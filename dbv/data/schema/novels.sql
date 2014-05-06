CREATE TABLE `novels` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `mission_id` int(16) unsigned NOT NULL,
  `page` int(16) unsigned NOT NULL,
  `page_dir` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `page_attachment` varchar(255) CHARACTER SET latin1 DEFAULT NULL,
  `language` varchar(120) NOT NULL DEFAULT 'en',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8