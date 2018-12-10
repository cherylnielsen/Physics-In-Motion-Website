-- MySQL Workbench Forward Engineering

SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='ONLY_FULL_GROUP_BY,STRICT_TRANS_TABLES,NO_ZERO_IN_DATE,NO_ZERO_DATE,ERROR_FOR_DIVISION_BY_ZERO,NO_ENGINE_SUBSTITUTION';

-- -----------------------------------------------------
-- Schema physics_in_motion
-- -----------------------------------------------------
-- Graduate Project by Cheryl Nielsen for MS Computer Science at San Francisco State University USA

-- -----------------------------------------------------
-- Schema physics_in_motion
--
-- Graduate Project by Cheryl Nielsen for MS Computer Science at San Francisco State University USA
-- -----------------------------------------------------
CREATE SCHEMA IF NOT EXISTS `physics_in_motion` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin ;
USE `physics_in_motion` ;

-- -----------------------------------------------------
-- Table `physics_in_motion`.`tutorial_lab`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`tutorial_lab` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`tutorial_lab` (
  `lab_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lab_name` VARCHAR(254) NOT NULL,
  `web_link` VARCHAR(254) NOT NULL,
  `lab_status` VARCHAR(254) NOT NULL,
  `short_description` VARCHAR(1000) NOT NULL,
  `prerequisites` VARCHAR(1000) NULL,
  `key_topics` VARCHAR(1000) NULL,
  `key_equations` VARCHAR(1000) NULL,
  `long_description` BLOB NULL,
  `instructions` BLOB NULL,
  PRIMARY KEY (`lab_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `lab_name_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`lab_name` ASC) INVISIBLE;

CREATE UNIQUE INDEX `lab_web_link_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`web_link` ASC) VISIBLE;

CREATE UNIQUE INDEX `lab_id_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`lab_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`users` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`users` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(45) NOT NULL,
  `user_password` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `usser_id_UNIQUE` ON `physics_in_motion`.`users` (`user_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `login_name_UNIQUE` ON `physics_in_motion`.`users` (`user_name` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`student` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`student` (
  `student_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `first_name` VARCHAR(254) NOT NULL,
  `last_name` VARCHAR(254) NOT NULL,
  `school_name` VARCHAR(254) NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`student_id`, `user_id`),
  CONSTRAINT `student_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `physics_in_motion`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `student_id_UNIQUE` ON `physics_in_motion`.`student` (`student_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`student` (`user_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `email_UNIQUE` ON `physics_in_motion`.`student` (`email` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`professor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`professor` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`professor` (
  `professor_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `first_name` VARCHAR(254) NOT NULL,
  `last_name` VARCHAR(254) NOT NULL,
  `school_name` VARCHAR(254) NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`professor_id`, `user_id`),
  CONSTRAINT `professor_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `physics_in_motion`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `professor_id_UNIQUE` ON `physics_in_motion`.`professor` (`professor_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`professor` (`user_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `email_UNIQUE` ON `physics_in_motion`.`professor` (`email` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`assignment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`assignment` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`assignment` (
  `assignment_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `professor_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  `lab_id` INT UNSIGNED NOT NULL,
  `date_assigned` DATETIME NOT NULL,
  `date_due` DATETIME NOT NULL,
  `date_submitted` DATETIME NULL,
  `total_time` INT NULL,
  `added_instructions` BLOB NULL,
  PRIMARY KEY (`assignment_id`, `professor_id`, `student_id`, `lab_id`),
  CONSTRAINT `assignment_professor_id`
    FOREIGN KEY (`professor_id`)
    REFERENCES `physics_in_motion`.`professor` (`professor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `assignment_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `assignment_lab_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `assignment_id_UNIQUE` ON `physics_in_motion`.`assignment` (`assignment_id` ASC) VISIBLE;

CREATE INDEX `assignment_professor_id_idx` ON `physics_in_motion`.`assignment` (`professor_id` ASC) VISIBLE;

CREATE INDEX `assignment_student_id_idx` ON `physics_in_motion`.`assignment` (`student_id` ASC) VISIBLE;

CREATE INDEX `assignment_lab_id_idx` ON `physics_in_motion`.`assignment` (`lab_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`homework`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`homework` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`homework` (
  `homework_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `assignment_id` INT UNSIGNED NOT NULL,
  `lab_summary` BLOB NULL,
  `lab_data` BLOB NULL,
  `lab_graphs` BLOB NULL,
  `lab_math` BLOB NULL,
  `lab_errors` BLOB NULL,
  `chat_session` BLOB NULL,
  `lab_report` BLOB NULL,
  PRIMARY KEY (`homework_id`, `assignment_id`),
  CONSTRAINT `homework_assignment_id`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `physics_in_motion`.`assignment` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `homework_id_UNIQUE` ON `physics_in_motion`.`homework` (`homework_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `assignment_id_UNIQUE` ON `physics_in_motion`.`homework` (`assignment_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`quote`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`quote` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`quote` (
  `quote_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_posted` DATE NOT NULL,
  `author` VARCHAR(254) NOT NULL,
  `quote_text` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`quote_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `quote_id_UNIQUE` ON `physics_in_motion`.`quote` (`quote_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `date_posted_UNIQUE` ON `physics_in_motion`.`quote` (`date_posted` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`notice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`notice` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`notice` (
  `notice_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `assignment_id` INT UNSIGNED NOT NULL,
  `notice_type` VARCHAR(254) NOT NULL,
  `date_sent` TIMESTAMP NOT NULL,
  `notice_text` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`notice_id`, `assignment_id`),
  CONSTRAINT `notice_assignment_id`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `physics_in_motion`.`assignment` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `assignment_id_idx` ON `physics_in_motion`.`notice` (`assignment_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `notice_id_UNIQUE` ON `physics_in_motion`.`notice` (`notice_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`tutorial_lab_rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`tutorial_lab_rating` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`tutorial_lab_rating` (
  `rating_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lab_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `date_posted` TIMESTAMP NOT NULL,
  `lab_rating` INT NOT NULL,
  `comments` VARCHAR(1000) NULL,
  PRIMARY KEY (`rating_id`, `lab_id`, `user_id`),
  CONSTRAINT `rating_lab_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `rating_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `physics_in_motion`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `lab_id_idx` ON `physics_in_motion`.`tutorial_lab_rating` (`lab_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `rating_id_UNIQUE` ON `physics_in_motion`.`tutorial_lab_rating` (`rating_id` ASC) VISIBLE;

CREATE INDEX `rating_user_id_idx` ON `physics_in_motion`.`tutorial_lab_rating` (`user_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`administrator`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`administrator` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`administrator` (
  `admin_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `first_name` VARCHAR(254) NOT NULL,
  `last_name` VARCHAR(254) NOT NULL,
  `admin_type` VARCHAR(254) NOT NULL,
  `email` VARCHAR(254) NOT NULL,
  PRIMARY KEY (`admin_id`, `user_id`),
  CONSTRAINT `administrator_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `physics_in_motion`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `student_id_UNIQUE` ON `physics_in_motion`.`administrator` (`admin_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`administrator` (`user_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `email_UNIQUE` ON `physics_in_motion`.`administrator` (`email` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
