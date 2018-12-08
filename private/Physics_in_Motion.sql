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
  `lab_status` VARCHAR(45) NOT NULL,
  `short_description` VARCHAR(1000) NOT NULL,
  `long_description` BLOB NULL,
  `prerequisites` VARCHAR(1000) NULL,
  `key_topics` VARCHAR(1000) NULL,
  `key_equations` BLOB NULL,
  `instructions` BLOB NULL,
  PRIMARY KEY (`lab_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `lab_name_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`lab_name` ASC) INVISIBLE;

CREATE UNIQUE INDEX `lab_web_link_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`web_link` ASC) VISIBLE;

CREATE UNIQUE INDEX `lab_id_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`lab_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`student` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`student` (
  `student_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `school` VARCHAR(45) NOT NULL,
  `user_name` VARCHAR(45) NOT NULL,
  `user_password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`student_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_name_UNIQUE` ON `physics_in_motion`.`student` (`user_name` ASC) VISIBLE;

CREATE UNIQUE INDEX `email_UNIQUE` ON `physics_in_motion`.`student` (`email` ASC) VISIBLE;

CREATE UNIQUE INDEX `student_id_UNIQUE` ON `physics_in_motion`.`student` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`professor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`professor` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`professor` (
  `professor_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `school` VARCHAR(45) NOT NULL,
  `user_name` VARCHAR(45) NOT NULL,
  `user_password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`professor_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_name_UNIQUE` ON `physics_in_motion`.`professor` (`user_name` ASC) VISIBLE;

CREATE UNIQUE INDEX `email_UNIQUE` ON `physics_in_motion`.`professor` (`email` ASC) VISIBLE;

CREATE UNIQUE INDEX `professor_id_UNIQUE` ON `physics_in_motion`.`professor` (`professor_id` ASC) VISIBLE;


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
  `lab_points` INT NOT NULL,
  `added_instructions` MEDIUMTEXT NULL,
  PRIMARY KEY (`assignment_id`, `professor_id`, `student_id`, `lab_id`),
  CONSTRAINT `assignment_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `assignment_professor_id`
    FOREIGN KEY (`professor_id`)
    REFERENCES `physics_in_motion`.`professor` (`professor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `assignment_lab_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `student_id_idx` ON `physics_in_motion`.`assignment` (`student_id` ASC) VISIBLE;

CREATE INDEX `professor_id_idx` ON `physics_in_motion`.`assignment` (`professor_id` ASC) VISIBLE;

CREATE INDEX `lab_id_idx` ON `physics_in_motion`.`assignment` (`lab_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `assignment_id_UNIQUE` ON `physics_in_motion`.`assignment` (`assignment_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`student_homework`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`student_homework` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`student_homework` (
  `assignment_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `student_id` INT UNSIGNED NOT NULL,
  `lab_summary` MEDIUMTEXT NULL,
  `lab_data` MEDIUMTEXT NULL,
  `lab_graphs` BLOB NULL,
  `lab_math` BLOB NULL,
  `lab_errors` MEDIUMTEXT NULL,
  `chat_session` MEDIUMTEXT NULL,
  `lab_report` BLOB NULL,
  `date_started` DATETIME NULL,
  `date_submitted` DATETIME NULL,
  `total_time` DOUBLE NULL,
  PRIMARY KEY (`assignment_id`, `student_id`),
  CONSTRAINT `homework_assignment_id`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `physics_in_motion`.`assignment` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `homework_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `assignment_id_UNIQUE` ON `physics_in_motion`.`student_homework` (`assignment_id` ASC) VISIBLE;

CREATE INDEX `homework_student_id_idx` ON `physics_in_motion`.`student_homework` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`quote_of_the_month`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`quote_of_the_month` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`quote_of_the_month` (
  `quote_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `date_posted` DATE NOT NULL,
  `author` VARCHAR(45) NOT NULL,
  `quote` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`quote_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `quote_id_UNIQUE` ON `physics_in_motion`.`quote_of_the_month` (`quote_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`notice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`notice` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`notice` (
  `notice_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `assignment_id` INT UNSIGNED NOT NULL,
  `notice_type` VARCHAR(45) NOT NULL,
  `date_sent` DATETIME NOT NULL,
  `notice_text` VARCHAR(1000) NULL,
  PRIMARY KEY (`notice_id`, `assignment_id`),
  CONSTRAINT `notice_assignment_id`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `physics_in_motion`.`assignment` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `notice_id_UNIQUE` ON `physics_in_motion`.`notice` (`notice_id` ASC) VISIBLE;

CREATE INDEX `assignment_id_idx` ON `physics_in_motion`.`notice` (`assignment_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`student_lab_rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`student_lab_rating` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`student_lab_rating` (
  `rating_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lab_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  `date_posted` DATETIME NOT NULL,
  `lab_rating` INT NOT NULL,
  `comments` VARCHAR(1000) NULL,
  PRIMARY KEY (`rating_id`, `lab_id`, `student_id`),
  CONSTRAINT `rating_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `rating_lab_id_std`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `student_id_idx` ON `physics_in_motion`.`student_lab_rating` (`student_id` ASC) VISIBLE;

CREATE INDEX `lab_id_idx` ON `physics_in_motion`.`student_lab_rating` (`lab_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `rating_id_UNIQUE` ON `physics_in_motion`.`student_lab_rating` (`rating_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`professor_lab_rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`professor_lab_rating` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`professor_lab_rating` (
  `rating_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lab_id` INT UNSIGNED NOT NULL,
  `professor_id` INT UNSIGNED NOT NULL,
  `date_posted` DATETIME NOT NULL,
  `lab_rating` INT NOT NULL,
  `comments` VARCHAR(1000) NULL,
  PRIMARY KEY (`rating_id`, `lab_id`, `professor_id`),
  CONSTRAINT `rating_professor_id`
    FOREIGN KEY (`professor_id`)
    REFERENCES `physics_in_motion`.`professor` (`professor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `rating_lab_id_pf`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `professor_id_idx` ON `physics_in_motion`.`professor_lab_rating` (`professor_id` ASC) VISIBLE;

CREATE INDEX `lab_id_idx` ON `physics_in_motion`.`professor_lab_rating` (`lab_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `rating_id_UNIQUE` ON `physics_in_motion`.`professor_lab_rating` (`rating_id` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
