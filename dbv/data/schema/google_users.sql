CREATE TABLE `google_users` (
  `google_id` decimal(21,0) unsigned NOT NULL DEFAULT '0',
  `google_name` varchar(120) DEFAULT NULL,
  `google_email` varchar(120) DEFAULT NULL,
  `google_link` varchar(120) DEFAULT NULL,
  `google_picture_link` varchar(120) DEFAULT NULL,
  PRIMARY KEY (`google_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8