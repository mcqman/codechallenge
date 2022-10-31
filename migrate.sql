CREATE DATABASE IF NOT EXISTS `demoapp`;
CREATE TABLE IF NOT EXISTS `demoapp`.`employee` 
(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(60) NOT NULL,
    `age` INT(3) NOT NULL,
    `employer_id` INT(11) NOT NULL,
    INDEX(`employer_id`),
    PRIMARY KEY(`id`)
);
CREATE TABLE IF NOT EXISTS `demoapp`.`employer` 
(
    `id` INT(11) NOT NULL AUTO_INCREMENT,
    `name` VARCHAR(60) NOT NULL,
    `address` VARCHAR(80) NOT NULL,
    `email` VARCHAR(80) NOT NULL,
    `phone` VARCHAR(80) NOT NULL,
    PRIMARY KEY(`id`)
);
