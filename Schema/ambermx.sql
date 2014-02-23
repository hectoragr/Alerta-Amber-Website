SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';

CREATE SCHEMA IF NOT EXISTS `ambermx` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci ;
USE `ambermx` ;

-- -----------------------------------------------------
-- Table `ambermx`.`Status`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ambermx`.`Status` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ambermx`.`Entidad_Federativa`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ambermx`.`Entidad_Federativa` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(100) NOT NULL,
  `clave` CHAR(2) NOT NULL,
  PRIMARY KEY (`id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ambermx`.`Alerta`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ambermx`.`Alerta` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `homoclave` VARCHAR(45) NOT NULL,
  `nombre` VARCHAR(45) NOT NULL,
  `apellidos` VARCHAR(45) NOT NULL,
  `genero` ENUM('M','F') NOT NULL,
  `estatura` INT UNSIGNED NOT NULL,
  `peso` INT UNSIGNED NOT NULL,
  `fecha_nacimiento` DATE NOT NULL,
  `ropa` TEXT NULL,
  `complexion` VARCHAR(45) NULL,
  `ojos` VARCHAR(45) NULL,
  `cabello` VARCHAR(45) NULL,
  `piel` VARCHAR(45) NULL,
  `cicatrices` VARCHAR(45) NULL,
  `marcas` TEXT NULL,
  `fecha_suceso` DATETIME NOT NULL,
  `lugar` VARCHAR(255) NOT NULL,
  `latitud` DOUBLE NULL,
  `longitud` DOUBLE NULL,
  `involucrados` TEXT NULL,
  `vehiculo` BINARY NULL DEFAULT 0,
  `fotografia` VARCHAR(100) NULL,
  `fecha_resuelta` DATETIME NULL,
  `Status_id` INT UNSIGNED NOT NULL,
  `Entidad_Federativa_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Alerta_Status_idx` (`Status_id` ASC),
  INDEX `fk_Alerta_Entidad_Federativa1_idx` (`Entidad_Federativa_id` ASC),
  CONSTRAINT `fk_Alerta_Status`
    FOREIGN KEY (`Status_id`)
    REFERENCES `ambermx`.`Status` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `fk_Alerta_Entidad_Federativa1`
    FOREIGN KEY (`Entidad_Federativa_id`)
    REFERENCES `ambermx`.`Entidad_Federativa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ambermx`.`Usuarios`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ambermx`.`Usuarios` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `nombre` VARCHAR(45) NOT NULL,
  `login` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `Entidad_Federativa_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Usuarios_Entidad_Federativa1_idx` (`Entidad_Federativa_id` ASC),
  CONSTRAINT `fk_Usuarios_Entidad_Federativa1`
    FOREIGN KEY (`Entidad_Federativa_id`)
    REFERENCES `ambermx`.`Entidad_Federativa` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `ambermx`.`Avistamientos`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `ambermx`.`Avistamientos` (
  `id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `fecha` DATETIME NOT NULL,
  `lugar` VARCHAR(255) NULL,
  `latitud` DOUBLE NULL,
  `longitud` DOUBLE NULL,
  `Alerta_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  INDEX `fk_Avistamientos_Alerta1_idx` (`Alerta_id` ASC),
  CONSTRAINT `fk_Avistamientos_Alerta1`
    FOREIGN KEY (`Alerta_id`)
    REFERENCES `ambermx`.`Alerta` (`id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
