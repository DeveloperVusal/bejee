CREATE TABLE IF NOT EXISTS `tasks` (
    `id` BIGINT AUTO_INCREMENT,
    `edit_user_id` BIGINT,
    `name` VARCHAR(64) NOT NULL,
    `email` VARCHAR(64) NOT NULL,
    `text` TINYTEXT NOT NULL,
    `is_done` TINYINT(1) DEFAULT 0,
    `updated_at` DATETIME DEFAULT NULL,
    `created_at` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP(),
    PRIMARY KEY(`id`),
    FOREIGN KEY(`edit_user_id`) REFERENCES `users`(`id`),
    INDEX (`name`),
    INDEX (`email`)
);