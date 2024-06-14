DROP DATABASE IF EXISTS stageopdracht;
CREATE DATABASE stageopdracht;
USE stageopdracht;

CREATE TABLE IF NOT EXISTS `form` (
    `user_id` INT AUTO_INCREMENT PRIMARY KEY,
    `username` VARCHAR(255) NOT NULL,
    `age` INT NOT NULL,
    `gender` VARCHAR(20) NOT NULL,
    `lang` VARCHAR(20) NOT NULL,
    `comment` VARCHAR(255)
);

