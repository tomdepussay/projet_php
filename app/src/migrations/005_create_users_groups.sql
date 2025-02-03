CREATE TABLE IF NOT EXISTS `users_groups` (
    `id_user_group` INT PRIMARY KEY AUTO_INCREMENT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `id_user` INT NOT NULL,
    `id_group` INT NOT NULL,
    `id_status` INT NOT NULL,
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`),
    FOREIGN KEY (`id_group`) REFERENCES `groups`(`id_group`),
    FOREIGN KEY (`id_status`) REFERENCES `status`(`id_status`)
);