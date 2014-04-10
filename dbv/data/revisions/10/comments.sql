ALTER TABLE  `comments` CHANGE  `id`  `id` INT( 16 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE  `evidence_id`  `evidence_id` INT( 16 ) UNSIGNED NULL ,
CHANGE  `evokation_id`  `evokation_id` INT( 16 ) UNSIGNED NULL ,
CHANGE  `user_id`  `user_id` INT( 16 ) UNSIGNED NOT NULL ,
CHANGE  `content`  `content` TEXT CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
CHANGE  `created`  `created` DATETIME NULL DEFAULT NULL ,
CHANGE  `modified`  `modified` DATETIME NULL DEFAULT NULL;