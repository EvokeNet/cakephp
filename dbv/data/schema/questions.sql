CREATE TABLE `questions` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `questionnaire_id` int(16) unsigned NOT NULL,
  `description` text NOT NULL,
  `type` varchar(120) NOT NULL COMMENT 'Defines the type of question: essay, multiple-choice, single-choice',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8