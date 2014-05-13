ALTER TABLE  `user_phase_checklists` ADD  `mission_id` INT( 16 ) UNSIGNED NOT NULL AFTER  `phase_checklist_id` ,
ADD  `phase_id` INT( 16 ) UNSIGNED NOT NULL AFTER  `mission_id`;