ALTER TABLE  `attachments` CHANGE  `id`  `id` INT( 16 ) UNSIGNED NOT NULL AUTO_INCREMENT ,
CHANGE  `model`  `model` VARCHAR( 20 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL ,
CHANGE  `foreign_key`  `foreign_key` INT( 16 ) NULL ,
CHANGE  `name`  `name` VARCHAR( 32 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
CHANGE  `attachment`  `attachment` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL ,
CHANGE  `dir`  `dir` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
CHANGE  `type`  `type` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL ,
CHANGE  `size`  `size` INT( 11 ) NULL DEFAULT  '0',
CHANGE  `active`  `active` TINYINT( 1 ) NULL DEFAULT  '1'