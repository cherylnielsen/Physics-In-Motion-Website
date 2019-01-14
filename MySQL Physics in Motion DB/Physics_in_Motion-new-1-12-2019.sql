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
  `lab_name` VARCHAR(256) NOT NULL,
  `web_link` VARCHAR(256) NOT NULL,
  `lab_status` SET('New', 'Updated', 'Available', 'Development', 'Discontinued') NOT NULL DEFAULT 'Development',
  `introduction` VARCHAR(1000) NULL DEFAULT NULL,
  `prerequisites` VARCHAR(1000) NULL DEFAULT NULL,
  `key_topics` VARCHAR(1000) NULL DEFAULT NULL,
  `key_equations` VARCHAR(1000) NULL DEFAULT NULL,
  `description` VARCHAR(256) NULL DEFAULT NULL,
  `instructions` VARCHAR(256) NULL DEFAULT NULL,
  `date_first_available` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`lab_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `web_link_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`web_link` ASC) VISIBLE;

CREATE UNIQUE INDEX `lab_name_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`lab_name` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`users`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`users` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`users` (
  `user_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_name` VARCHAR(256) NOT NULL,
  `user_password` VARCHAR(256) NOT NULL,
  `date_registered` DATETIME NOT NULL,
  `last_login` DATETIME NULL DEFAULT NULL,
  PRIMARY KEY (`user_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_name_UNIQUE` ON `physics_in_motion`.`users` (`user_name` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`student` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`student` (
  `student_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `school_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`student_id`),
  CONSTRAINT `student_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `physics_in_motion`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `email_UNIQUE` ON `physics_in_motion`.`student` (`email` ASC) VISIBLE;

CREATE INDEX `student_user_id_idx` ON `physics_in_motion`.`student` (`user_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`student` (`user_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`professor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`professor` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`professor` (
  `professor_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `school_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`professor_id`),
  CONSTRAINT `professor_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `physics_in_motion`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `email_UNIQUE` ON `physics_in_motion`.`professor` (`email` ASC) VISIBLE;

CREATE INDEX `professor_user_id_idx` ON `physics_in_motion`.`professor` (`user_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`professor` (`user_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`section`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`section` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`section` (
  `section_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_name` VARCHAR(256) NULL,
  `start_date` DATE NULL,
  `end_date` DATE NULL,
  PRIMARY KEY (`section_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`assignment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`assignment` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`assignment` (
  `assignment_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id` INT UNSIGNED NOT NULL,
  `lab_id` INT UNSIGNED NOT NULL,
  `tag` VARCHAR(45) NULL DEFAULT NULL,
  `date_assigned` DATETIME NOT NULL,
  `date_due` DATETIME NOT NULL,
  `points_possible` INT UNSIGNED NOT NULL DEFAULT 0,
  `notes` VARCHAR(256) NULL DEFAULT NULL,
  PRIMARY KEY (`assignment_id`),
  CONSTRAINT `assignment_section_id`
    FOREIGN KEY (`section_id`)
    REFERENCES `physics_in_motion`.`section` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `assignment_lab_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `assignment_section_id_idx` ON `physics_in_motion`.`assignment` (`section_id` ASC) VISIBLE;

CREATE INDEX `assignment_lab_id_idx` ON `physics_in_motion`.`assignment` (`lab_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`homework`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`homework` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`homework` (
  `assignment_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  `lab_summary` VARCHAR(256) NULL DEFAULT NULL,
  `data` VARCHAR(256) NULL DEFAULT NULL,
  `graphs` VARCHAR(256) NULL DEFAULT NULL,
  `math` VARCHAR(256) NULL DEFAULT NULL,
  `hints` VARCHAR(256) NULL DEFAULT NULL,
  `chat_session` VARCHAR(256) NULL DEFAULT NULL,
  PRIMARY KEY (`assignment_id`, `student_id`),
  CONSTRAINT `hmwk_assignment_id`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `physics_in_motion`.`assignment` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `hmwk_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `hmwk_assignment_id_idx` ON `physics_in_motion`.`homework` (`assignment_id` ASC) VISIBLE;

CREATE INDEX `hmwk_student_id_idx` ON `physics_in_motion`.`homework` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`quote`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`quote` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`quote` (
  `quote_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` VARCHAR(256) NOT NULL,
  `quote_text` VARCHAR(1000) NOT NULL,
  `month` INT NOT NULL,
  `year` INT NOT NULL,
  PRIMARY KEY (`quote_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`notice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`notice` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`notice` (
  `notice_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `to_user_id` INT UNSIGNED NOT NULL,
  `from_user_id` INT UNSIGNED NOT NULL,
  `date_sent` DATETIME NOT NULL,
  `subject` VARCHAR(100) NOT NULL,
  `notice_text` VARCHAR(1000) NOT NULL,
  PRIMARY KEY (`notice_id`),
  CONSTRAINT `notice_to_user_id`
    FOREIGN KEY (`to_user_id`)
    REFERENCES `physics_in_motion`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `notice_from_user_id`
    FOREIGN KEY (`from_user_id`)
    REFERENCES `physics_in_motion`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `notice_to_user_id_idx` ON `physics_in_motion`.`notice` (`to_user_id` ASC) VISIBLE;

CREATE INDEX `notice_from_user_id_idx` ON `physics_in_motion`.`notice` (`from_user_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`lab_rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`lab_rating` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`lab_rating` (
  `rating_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lab_id` INT UNSIGNED NOT NULL,
  `user_id` INT UNSIGNED NOT NULL,
  `date_posted` DATETIME NOT NULL,
  `lab_rating` INT NOT NULL,
  `comments` VARCHAR(1000) NULL DEFAULT NULL,
  PRIMARY KEY (`rating_id`),
  CONSTRAINT `lab_rating_lab_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lab_rating_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `physics_in_motion`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `lab_rating_lab_id_idx` ON `physics_in_motion`.`lab_rating` (`lab_id` ASC) VISIBLE;

CREATE INDEX `lab_rating_user_id_idx` ON `physics_in_motion`.`lab_rating` (`user_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`administrator`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`administrator` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`administrator` (
  `admin_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` INT UNSIGNED NOT NULL,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `admin_type` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`admin_id`),
  CONSTRAINT `admin_user_id`
    FOREIGN KEY (`user_id`)
    REFERENCES `physics_in_motion`.`users` (`user_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `email_UNIQUE` ON `physics_in_motion`.`administrator` (`email` ASC) VISIBLE;

CREATE INDEX `admin_user_id_idx` ON `physics_in_motion`.`administrator` (`user_id` ASC) VISIBLE;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`administrator` (`user_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`section_students`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`section_students` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`section_students` (
  `section_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`section_id`, `student_id`),
  CONSTRAINT `std_section_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `std_section_section_id`
    FOREIGN KEY (`section_id`)
    REFERENCES `physics_in_motion`.`section` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `section_student_id_idx` ON `physics_in_motion`.`section_students` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`homework_submission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`homework_submission` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`homework_submission` (
  `assignment_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  `date_submitted` DATETIME NOT NULL,
  `points_earned` INT UNSIGNED NOT NULL DEFAULT 0,
  `was_graded` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `total_time` DOUBLE NULL DEFAULT NULL,
  PRIMARY KEY (`assignment_id`, `student_id`),
  CONSTRAINT `submission_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `submission_assignment_id`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `physics_in_motion`.`assignment` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `submission_student_id_idx` ON `physics_in_motion`.`homework_submission` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`section_professors`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`section_professors` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`section_professors` (
  `section_id` INT UNSIGNED NOT NULL,
  `professor_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`section_id`, `professor_id`),
  CONSTRAINT `pro_section_professor_id`
    FOREIGN KEY (`professor_id`)
    REFERENCES `physics_in_motion`.`professor` (`professor_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `pro_section_section_id`
    FOREIGN KEY (`section_id`)
    REFERENCES `physics_in_motion`.`section` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `professor_id_idx` ON `physics_in_motion`.`section_professors` (`professor_id` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
