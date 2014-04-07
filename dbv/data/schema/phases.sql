CREATE TABLE `phases` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(120) NOT NULL,
  `description` text NOT NULL,
  `mission_id` int(16) unsigned NOT NULL,
  `position` int(16) unsigned NOT NULL,
  `type` tinyint(2) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8