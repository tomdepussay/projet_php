CREATE TABLE IF NOT EXISTS `pictures` (
    `id_picture` INT PRIMARY KEY AUTO_INCREMENT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `description` TEXT NOT NULL,
    `url` VARCHAR(255) NOT NULL UNIQUE,
    `public_access` BOOLEAN NOT NULL DEFAULT FALSE,
    `public_link` VARCHAR(255) NOT NULL UNIQUE,
    `id_user` INT NOT NULL,
    `id_group` INT NOT NULL,
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`),
    FOREIGN KEY (`id_group`) REFERENCES `groups`(`id_group`)
);