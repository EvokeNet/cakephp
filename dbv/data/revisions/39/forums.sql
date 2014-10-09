ALTER TABLE  `forums` CHANGE  `forum_topic_id`  `lastTopic_id` INT( 16 ) NOT NULL ,
CHANGE  `forum_post_id`  `lastPost_id` INT( 16 ) NOT NULL;