ALTER TABLE  `points` ADD `origin` VARCHAR( 120 ) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL AFTER  `user_id` ,
ADD  `origin_id` INT( 16 ) UNSIGNED NOT NULL AFTER  `origin` , 
ADD `created` DATETIME NOT NULL AFTER  `origin` ,
ADD  `modified` DATETIME NULL AFTER  `created`;