DROP TABLE IF EXISTS `answers`;
DROP TABLE IF EXISTS `games`;

CREATE TABLE `games` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `phone_number` VARCHAR(30) NOT NULL,
    `is_finished` TINYINT(1) NOT NULL DEFAULT 0,
    `quest` VARCHAR(4) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `phone_status` (`is_finished`, `phone_number`),
    INDEX `phone_number` (`phone_number`)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;

CREATE TABLE `answers` (
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `game_id` INT(11) NOT NULL,
    `answer_time` TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    `answer` VARCHAR(4) NOT NULL,
    PRIMARY KEY (`id`),
    INDEX `answer_time` (`answer_time`),
    CONSTRAINT `game_fk` FOREIGN KEY (`game_id`) REFERENCES `games` (`id`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;
