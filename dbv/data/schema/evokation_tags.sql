CREATE TABLE `evokation_tags` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `evokation_id` int(16) unsigned NOT NULL,
  `tag_id` int(16) unsigned NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8