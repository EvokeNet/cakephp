
DROP TABLE IF EXISTS `{prefix}settings`;

CREATE TABLE `{prefix}settings` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `key` VARCHAR(50) NOT NULL,
    `value` VARCHAR(100) NOT NULL,
    `created` DATETIME DEFAULT NULL,
    `modified` DATETIME DEFAULT NULL,
    PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COMMENT='Forum settings' AUTO_INCREMENT=1;