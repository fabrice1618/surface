-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema surface
-- -----------------------------------------------------

CREATE SCHEMA IF NOT EXISTS `surface` DEFAULT CHARACTER SET utf8mb4 ;
USE surface;

-- -----------------------------------------------------
-- Table `ville`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ville` (
  `vil_id` INT NOT NULL AUTO_INCREMENT,
  `vil_desc` VARCHAR(250) NULL,
  PRIMARY KEY (`vil_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `surface`.`type_logement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `surface`.`type_logement` (
  `typ_id` INT(11) NOT NULL AUTO_INCREMENT,
  `typ_desc` VARCHAR(250) NOT NULL,
  PRIMARY KEY (`typ_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 3
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `surface`.`user`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `surface`.`user` (
  `usr_id` INT(11) NOT NULL AUTO_INCREMENT,
  `usr_email` VARCHAR(250) NOT NULL,
  `usr_password` VARCHAR(250) NOT NULL,
  `usr_date_connexion` VARCHAR(8) NOT NULL,
  PRIMARY KEY (`usr_id`),
  UNIQUE INDEX `usr_email` (`usr_email` ASC) )
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `surface`.`logement`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `surface`.`logement` (
  `log_id` INT(11) NOT NULL AUTO_INCREMENT,
  `usr_id` INT(11) NOT NULL,
  `log_nom` VARCHAR(250) NOT NULL,
  `log_adresse` VARCHAR(250) NOT NULL,
  `log_cp` VARCHAR(5) NOT NULL,
  `vil_id` INT NOT NULL,
  `typ_id` INT(11) NOT NULL,
  PRIMARY KEY (`log_id`),
  INDEX `fk_usr_id` (`usr_id` ASC),
  INDEX `fk_typ_id` (`typ_id` ASC),
  INDEX `fk_logement_ville1_idx` (`vil_id` ASC),
  CONSTRAINT `fk_typ_id`
    FOREIGN KEY (`typ_id`)
    REFERENCES `surface`.`type_logement` (`typ_id`),
  CONSTRAINT `fk_usr_id`
    FOREIGN KEY (`usr_id`)
    REFERENCES `surface`.`user` (`usr_id`),
  CONSTRAINT `fk_logement_ville1`
    FOREIGN KEY (`vil_id`)
    REFERENCES `surface`.`ville` (`vil_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB
AUTO_INCREMENT = 5
DEFAULT CHARACTER SET = utf8mb4;


-- -----------------------------------------------------
-- Table `surface`.`piece`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `surface`.`piece` (
  `pce_id` INT(11) NOT NULL AUTO_INCREMENT,
  `log_id` INT(11) NOT NULL,
  `pce_nom` VARCHAR(250) NOT NULL,
  `pce_long` DECIMAL(4,2) NOT NULL,
  `pce_larg` DECIMAL(4,2) NOT NULL,
  PRIMARY KEY (`pce_id`),
  INDEX `fk_log_id` (`log_id` ASC),
  CONSTRAINT `fk_log_id`
    FOREIGN KEY (`log_id`)
    REFERENCES `surface`.`logement` (`log_id`))
ENGINE = InnoDB
AUTO_INCREMENT = 4
DEFAULT CHARACTER SET = utf8mb4;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
