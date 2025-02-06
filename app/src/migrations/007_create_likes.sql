CREATE TABLE IF NOT EXISTS `likes` (
    `id_user` INT NOT NULL,
    `id_picture` INT NOT NULL,
    `like_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`),
    FOREIGN KEY (`id_picture`) REFERENCES `pictures`(`id_picture`),
    PRIMARY KEY (`id_user`, `id_picture`)
);