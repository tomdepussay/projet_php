CREATE TABLE IF NOT EXISTS `comments` (
    `id_comment` INT PRIMARY KEY AUTO_INCREMENT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `content` TEXT NOT NULL,
    `id_user` INT NOT NULL,
    `id_picture` INT NOT NULL,
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`),
    FOREIGN KEY (`id_picture`) REFERENCES `pictures`(`id_picture`)
);