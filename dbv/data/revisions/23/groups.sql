
ALTER TABLE  `groups` ADD  `photo_dir` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER  `max_global`;

ALTER TABLE  `groups` ADD  `photo_attachment` VARCHAR( 255 ) CHARACTER SET latin1 COLLATE latin1_swedish_ci NULL DEFAULT NULL AFTER  `photo_dir`;