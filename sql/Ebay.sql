-- MySQL Script generated by MySQL Workbench
-- Sun Jan 22 14:01:51 2017
-- Model: New Model    Version: 1.0
-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

-- -----------------------------------------------------
-- Schema mydb
-- -----------------------------------------------------
-- -----------------------------------------------------
-- Schema ep
-- -----------------------------------------------------
DROP SCHEMA IF EXISTS `ep` ;

-- -----------------------------------------------------
-- Schema ep
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `ep` DEFAULT CHARACTER SET utf8 ;
USE `ep` ;

-- -----------------------------------------------------
-- Table `ep`.`groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ep`.`groups` ;

CREATE TABLE IF NOT EXISTS `ep`.`groups` (
  `id` MEDIUMINT(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(20) NOT NULL,
  `description` VARCHAR(100) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ep`.`login_attempts`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ep`.`login_attempts` ;

CREATE TABLE IF NOT EXISTS `ep`.`login_attempts` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(15) NOT NULL,
  `login` VARCHAR(100) NOT NULL,
  `time` INT(11) UNSIGNED NULL DEFAULT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ep`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ep`.`users` ;

CREATE TABLE IF NOT EXISTS `ep`.`users` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` VARCHAR(45) NOT NULL,
  `username` VARCHAR(100) NULL DEFAULT NULL,
  `password` VARCHAR(255) NOT NULL,
  `salt` VARCHAR(255) NULL DEFAULT NULL,
  `email` VARCHAR(100) NOT NULL,
  `activation_code` VARCHAR(40) NULL DEFAULT NULL,
  `forgotten_password_code` VARCHAR(40) NULL DEFAULT NULL,
  `forgotten_password_time` INT(11) UNSIGNED NULL DEFAULT NULL,
  `remember_code` VARCHAR(40) NULL DEFAULT NULL,
  `created_on` INT(11) UNSIGNED NOT NULL,
  `last_login` INT(11) UNSIGNED NULL DEFAULT NULL,
  `active` TINYINT(1) UNSIGNED NULL DEFAULT NULL,
  `first_name` VARCHAR(50) NULL DEFAULT NULL,
  `last_name` VARCHAR(50) NULL DEFAULT NULL,
  `phone` VARCHAR(20) NULL DEFAULT NULL,
  `street` VARCHAR(45) NULL COMMENT '	',
  `street_number` VARCHAR(45) NULL,
  `city` VARCHAR(45) NULL,
  `postcode` INT(11) NULL,
  `country` VARCHAR(45) NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB
AUTO_INCREMENT = 2
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ep`.`products`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ep`.`products` ;

CREATE TABLE IF NOT EXISTS `ep`.`products` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `name` VARCHAR(45) NOT NULL,
  `description` TEXT NOT NULL,
  `date` DATE NOT NULL,
  `price` FLOAT NOT NULL,
  `rating` FLOAT NULL DEFAULT 0,
  `image` VARCHAR(45) NOT NULL,
  `active` TINYINT(1) NOT NULL DEFAULT 1,
  `users_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_products_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_products_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `ep`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ep`.`orders`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ep`.`orders` ;

CREATE TABLE IF NOT EXISTS `ep`.`orders` (
  `id` INT(11) NOT NULL AUTO_INCREMENT,
  `date` DATE NOT NULL,
  `status` INT(11) NULL DEFAULT NULL,
  `products_id` INT(11) NOT NULL,
  `users_id` INT(11) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`, `products_id`),
  INDEX `fk_Orders_Products1_idx` (`products_id` ASC),
  INDEX `fk_orders_users1_idx` (`users_id` ASC),
  CONSTRAINT `fk_Orders_Products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `ep`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_orders_users1`
    FOREIGN KEY (`users_id`)
    REFERENCES `ep`.`users` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ep`.`users_groups`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ep`.`users_groups` ;

CREATE TABLE IF NOT EXISTS `ep`.`users_groups` (
  `id` INT(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT(11) UNSIGNED NOT NULL,
  `group_id` MEDIUMINT(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE INDEX `uc_users_groups` (`user_id` ASC, `group_id` ASC),
  INDEX `fk_users_groups_users1_idx` (`user_id` ASC),
  INDEX `fk_users_groups_groups1_idx` (`group_id` ASC),
  CONSTRAINT `fk_users_groups_groups1`
    FOREIGN KEY (`group_id`)
    REFERENCES `ep`.`groups` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_users_groups_users1`
    FOREIGN KEY (`user_id`)
    REFERENCES `ep`.`users` (`id`)
    ON DELETE CASCADE
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8;


-- -----------------------------------------------------
-- Table `ep`.`product_gallery`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `ep`.`product_gallery` ;

CREATE TABLE IF NOT EXISTS `ep`.`product_gallery` (
  `id` INT NOT NULL AUTO_INCREMENT,
  `filename` VARCHAR(100) NULL,
  `products_id` INT(11) NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_gallery_products1_idx` (`products_id` ASC),
  CONSTRAINT `fk_gallery_products1`
    FOREIGN KEY (`products_id`)
    REFERENCES `ep`.`products` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

-- -----------------------------------------------------
-- Data for table `ep`.`groups`
-- -----------------------------------------------------
START TRANSACTION;
USE `ep`;
INSERT INTO `ep`.`groups` (`id`, `name`, `description`) VALUES (1, 'administrator', 'Administrator');
INSERT INTO `ep`.`groups` (`id`, `name`, `description`) VALUES (2, 'prodajalec', 'Prodajalci');
INSERT INTO `ep`.`groups` (`id`, `name`, `description`) VALUES (3, 'stranka', 'Stranke');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ep`.`users`
-- -----------------------------------------------------
START TRANSACTION;
USE `ep`;
INSERT INTO `ep`.`users` (`id`, `ip_address`, `username`, `password`, `salt`, `email`, `activation_code`, `forgotten_password_code`, `forgotten_password_time`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `phone`, `street`, `street_number`, `city`, `postcode`, `country`) VALUES (1, '127.0.0.1', 'administrator', '$2a$07$SeBknntpZror9uyftVopmu61qg0ms8Qv1yV6FG.kQOSM.9QhmTo36', ' ', 'admin@admin.com', ' ', NULL, NULL, NULL, 1268889823, 1268889823, 1, 'Administrator', ' ', '0', 'Večna pot', '113', 'Ljubljana', 1000, 'Slovenija');

COMMIT;


-- -----------------------------------------------------
-- Data for table `ep`.`users_groups`
-- -----------------------------------------------------
START TRANSACTION;
USE `ep`;
INSERT INTO `ep`.`users_groups` (`id`, `user_id`, `group_id`) VALUES (1, 1, 1);

COMMIT;

