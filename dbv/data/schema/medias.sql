CREATE TABLE `medias` (
  `id` int(16) NOT NULL AUTO_INCREMENT,
  `ref` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `ref_id` int(16) DEFAULT NULL,
  `file` varchar(120) CHARACTER SET utf8 DEFAULT NULL,
  `position` int(16) DEFAULT '0',
  `created` datetime DEFAULT NULL,
  `modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `ref` (`ref`),
  KEY `ref_id` (`ref_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1