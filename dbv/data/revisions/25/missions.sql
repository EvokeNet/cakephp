ALTER TABLE  `missions` CHANGE  `image`  `image_dir` VARCHAR( 120 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL;
ALTER TABLE  `missions` ADD  `image_attachment` VARCHAR( 120 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER  `image_dir`;
ALTER TABLE  `missions` ADD  `cover_dir` VARCHAR( 120 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER  `image_attachment`;
ALTER TABLE  `missions` ADD  `cover_attachment` VARCHAR( 120 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER  `cover_dir`;