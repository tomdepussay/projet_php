CREATE TABLE IF NOT EXISTS `password_resets` (
    `id_password_reset` INT PRIMARY KEY AUTO_INCREMENT,
    `created_at` TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    `updated_at` TIMESTAMP DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
    `token` VARCHAR(255) NOT NULL UNIQUE,
    `expires_at` TIMESTAMP NOT NULL,
    `id_user` INT NOT NULL,
    FOREIGN KEY (`id_user`) REFERENCES `users`(`id_user`)
);