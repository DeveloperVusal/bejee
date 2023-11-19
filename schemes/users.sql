CREATE TABLE IF NOT EXISTS `users` (
    `id` BIGINT AUTO_INCREMENT,
    `login` VARCHAR(50) NOT NULL,
    `password` VARCHAR(255) NOT NULL,
    `is_admin` TINYINT(1) DEFAULT 0,
    PRIMARY KEY(`id`),
    UNIQUE (`login`),
    INDEX (`password`)
);
-- MD5 for test
INSERT INTO `users` (`login`, `password`, `is_admin`) VALUES ('admin', MD5('123'), 1);