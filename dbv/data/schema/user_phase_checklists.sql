CREATE TABLE `user_phase_checklists` (
  `id` int(16) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(16) unsigned NOT NULL,
  `phase_checklist_id` int(16) unsigned NOT NULL,
  `created` datetime NOT NULL,
  `modified` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8