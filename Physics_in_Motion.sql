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
  `lab_id` INT NOT NULL,
  `lab_name` VARCHAR(254) NOT NULL,
  `lab_short_description` VARCHAR(1000) NOT NULL,
  `lab_prerequisites` VARCHAR(1000) NOT NULL,
  `lab_key_topics` BLOB NOT NULL,
  `lab_key_equations` BLOB NOT NULL,
  `lab_long_description` BLOB NOT NULL,
  PRIMARY KEY (`lab_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `lab_name_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`lab_name` ASC) INVISIBLE;

CREATE INDEX `lab_idx` ON `physics_in_motion`.`tutorial_lab` (`lab_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`tutorial_lab_links`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`tutorial_lab_links` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`tutorial_lab_links` (
  `lab_id` INT NOT NULL,
  `lab_web_link` VARCHAR(254) NOT NULL,
  `lab_page_status` VARCHAR(254) NOT NULL,
  `lab_tutorial_status` VARCHAR(245) NOT NULL,
  PRIMARY KEY (`lab_id`),
  CONSTRAINT `lab_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `lab_web_link_UNIQUE` ON `physics_in_motion`.`tutorial_lab_links` (`lab_web_link` ASC) INVISIBLE;

CREATE INDEX `lab_link_idx` ON `physics_in_motion`.`tutorial_lab_links` (`lab_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`student` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`student` (
  `student_id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `school` VARCHAR(45) NOT NULL,
  `user_name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL DEFAULT 'no email',
  PRIMARY KEY (`student_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_name_UNIQUE` ON `physics_in_motion`.`student` (`user_name` ASC) VISIBLE;

CREATE INDEX `student_idx` ON `physics_in_motion`.`student` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`student_lab_ratings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`student_lab_ratings` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`student_lab_ratings` (
  `lab_id` INT NOT NULL,
  `student_id` INT NOT NULL,
  `lab_rating` INT NOT NULL,
  `lab_comments` VARCHAR(1000) NULL,
  PRIMARY KEY (`lab_id`, `student_id`),
  CONSTRAINT `student_rating_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lab_student_rating_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `student_rating_idx` ON `physics_in_motion`.`student_lab_ratings` (`student_id` ASC) VISIBLE;

CREATE INDEX `lab_student_rating_idx` ON `physics_in_motion`.`student_lab_ratings` (`lab_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`professor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`professor` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`professor` (
  `professor_id` INT NOT NULL AUTO_INCREMENT,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `school` VARCHAR(45) NOT NULL,
  `user_name` VARCHAR(45) NOT NULL,
  `password` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL DEFAULT 'no email',
  PRIMARY KEY (`professor_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_name_UNIQUE` ON `physics_in_motion`.`professor` (`user_name` ASC) VISIBLE;

CREATE INDEX `professor_idx` ON `physics_in_motion`.`professor` (`professor_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`tutorial_lab_assignments`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`tutorial_lab_assignments` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`tutorial_lab_assignments` (
  `student_id` INT NOT NULL,
  `lab_id` INT NOT NULL,
  `professor_id` INT NOT NULL,
  `lab_status` VARCHAR(45) NOT NULL,
  `lab_points` INT NULL,
  `lab_grade` VARCHAR(3) NULL,
  PRIMARY KEY (`student_id`, `lab_id`, `professor_id`),
  CONSTRAINT `student_assignment_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `professor_assignment_id`
    FOREIGN KEY (`professor_id`)
    REFERENCES `physics_in_motion`.`professor` (`professor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lab_assignment_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `professor_assignment_idx` ON `physics_in_motion`.`tutorial_lab_assignments` (`professor_id` ASC) INVISIBLE;

CREATE INDEX `lab_assignment_idx` ON `physics_in_motion`.`tutorial_lab_assignments` (`lab_id` ASC) INVISIBLE;

CREATE INDEX `student_assignment_idx` ON `physics_in_motion`.`tutorial_lab_assignments` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`student_lab_records`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`student_lab_records` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`student_lab_records` (
  `student_id` INT NOT NULL,
  `lab_id` INT NOT NULL,
  `time_to_completion` DOUBLE NULL,
  `date_time_start` DATETIME NULL,
  `date_time_end` DATETIME NULL,
  `lab_summary` BLOB NULL,
  `lab_data` BLOB NULL,
  `lab_graphs` BLOB NULL,
  `lab_report` BLOB NULL,
  `lab_errors` BLOB NULL,
  `lab_math` BLOB NULL,
  PRIMARY KEY (`student_id`, `lab_id`),
  CONSTRAINT `student_records_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lab_records_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `lab_records_idx` ON `physics_in_motion`.`student_lab_records` (`lab_id` ASC) VISIBLE;

CREATE INDEX `student_records_idx` ON `physics_in_motion`.`student_lab_records` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`professor_lab_ratings`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`professor_lab_ratings` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`professor_lab_ratings` (
  `lab_id` INT NOT NULL,
  `professor_id` INT NOT NULL,
  `lab_rating` INT NOT NULL,
  `lab_comments` VARCHAR(1000) NULL,
  PRIMARY KEY (`lab_id`, `professor_id`),
  CONSTRAINT `lab_professor_rating_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `professor_rating_id`
    FOREIGN KEY (`professor_id`)
    REFERENCES `physics_in_motion`.`professor` (`professor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `professor_rating_idx` ON `physics_in_motion`.`professor_lab_ratings` (`professor_id` ASC) INVISIBLE;

CREATE INDEX `lab_professor_rating_idx` ON `physics_in_motion`.`professor_lab_ratings` (`lab_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`quote_of_the_month`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`quote_of_the_month` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`quote_of_the_month` (
  `quote_id` INT NOT NULL,
  `date_posted` DATE NOT NULL,
  `author` VARCHAR(254) NOT NULL,
  `quote` VARCHAR(1000) NOT NULL,
  `thoughts` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`quote_id`))
ENGINE = InnoDB;

CREATE INDEX `date_quote_posted` ON `physics_in_motion`.`quote_of_the_month` (`date_posted` ASC) INVISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
