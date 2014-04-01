CREATE TABLE `questions` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int(16) unsigned NOT NULL,
  `type` varchar(120) DEFAULT NULL,
  `description` text NOT NULL,
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8