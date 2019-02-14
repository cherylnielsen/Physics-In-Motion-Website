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
  `introduction` VARCHAR(1000) NULL,
  `prerequisites` VARCHAR(1000) NULL,
  `key_topics` VARCHAR(1000) NULL,
  `key_equations` VARCHAR(1000) NULL,
  `description` VARCHAR(256) NULL,
  `instructions` VARCHAR(256) NULL,
  `date_first_available` DATETIME NULL,
  PRIMARY KEY (`lab_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `lab_name_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`lab_name` ASC) VISIBLE;

CREATE UNIQUE INDEX `web_link_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`web_link` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`member`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`member` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`member` (
  `member_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `member_type` SET('Student', 'Professor', 'Administrator', 'Blocked') NOT NULL,
  `member_name` VARCHAR(45) NOT NULL,
  `member_password` VARCHAR(45) NOT NULL,
  `date_registered` DATETIME NOT NULL,
  `last_login` DATETIME NULL,
  `last_logoff` DATETIME NULL,
  `registration_complete` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `first_name` VARCHAR(45) NOT NULL,
  `last_name` VARCHAR(45) NOT NULL,
  `email` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`member_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_name_UNIQUE` ON `physics_in_motion`.`member` (`member_name` ASC) VISIBLE;

CREATE UNIQUE INDEX `email_UNIQUE` ON `physics_in_motion`.`member` (`email` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`student` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`student` (
  `member_id` INT UNSIGNED NOT NULL,
  `school_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`member_id`),
  CONSTRAINT `student_user_id`
    FOREIGN KEY (`member_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`student` (`member_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`professor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`professor` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`professor` (
  `member_id` INT UNSIGNED NOT NULL,
  `school_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`member_id`),
  CONSTRAINT `professor_user_id`
    FOREIGN KEY (`member_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`professor` (`member_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`section`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`section` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`section` (
  `section_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `professor_id` INT UNSIGNED NOT NULL,
  `section_name` VARCHAR(256) NOT NULL,
  `start_date` DATE NOT NULL,
  `end_date` DATE NOT NULL,
  PRIMARY KEY (`section_id`),
  CONSTRAINT `section_professor_id`
    FOREIGN KEY (`professor_id`)
    REFERENCES `physics_in_motion`.`professor` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `section_professor_id_idx` ON `physics_in_motion`.`section` (`professor_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`assignment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`assignment` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`assignment` (
  `assignment_id` INT UNSIGNED NOT NULL,
  `section_id` INT UNSIGNED NOT NULL,
  `lab_id` INT UNSIGNED NOT NULL,
  `date_assigned` DATETIME NOT NULL,
  `date_due` DATETIME NOT NULL,
  `points_possible` INT UNSIGNED NOT NULL DEFAULT 0,
  `notes` VARCHAR(256) NULL,
  PRIMARY KEY (`assignment_id`, `section_id`),
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
  `homework_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `assignment_id` INT UNSIGNED NOT NULL,
  `section_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  `lab_summary` VARCHAR(256) NULL DEFAULT NULL,
  `lab_data` VARCHAR(256) NULL DEFAULT NULL,
  `graphs` VARCHAR(256) NULL DEFAULT NULL,
  `math` VARCHAR(256) NULL DEFAULT NULL,
  `hints` VARCHAR(256) NULL DEFAULT NULL,
  `chat_session` VARCHAR(256) NULL DEFAULT NULL,
  PRIMARY KEY (`homework_id`),
  CONSTRAINT `hmwk_assignment_id`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `physics_in_motion`.`assignment` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `hmwk_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `hmwk_section_id`
    FOREIGN KEY (`section_id`)
    REFERENCES `physics_in_motion`.`section` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `hmwk_student_id_idx` ON `physics_in_motion`.`homework` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`quote`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`quote` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`quote` (
  `quote_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `author` VARCHAR(256) NOT NULL,
  `quote_text` VARCHAR(1000) NOT NULL,
  `month_posted` INT NOT NULL,
  `year_posted` INT NOT NULL,
  PRIMARY KEY (`quote_id`))
ENGINE = InnoDB;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`notice`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`notice` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`notice` (
  `notice_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `from_member_id` INT UNSIGNED NOT NULL,
  `date_sent` DATETIME NOT NULL,
  `notice_subject` VARCHAR(256) NOT NULL,
  `notice_text` VARCHAR(1000) NOT NULL,
  `sent_high_priority` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `flag_for_review` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`notice_id`),
  CONSTRAINT `notice_from_user_id`
    FOREIGN KEY (`from_member_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `notice_from_user_id_idx` ON `physics_in_motion`.`notice` (`from_member_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`tutorial_lab_rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`tutorial_lab_rating` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`tutorial_lab_rating` (
  `rating_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `lab_id` INT UNSIGNED NOT NULL,
  `member_id` INT UNSIGNED NOT NULL,
  `date_posted` DATETIME NOT NULL,
  `rating` INT NOT NULL,
  `comments` VARCHAR(1000) NULL,
  `flag_for_review` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`rating_id`),
  CONSTRAINT `lab_rating_lab_id`
    FOREIGN KEY (`lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lab_rating_user_id`
    FOREIGN KEY (`member_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `lab_rating_lab_id_idx` ON `physics_in_motion`.`tutorial_lab_rating` (`lab_id` ASC) VISIBLE;

CREATE INDEX `lab_rating_user_id_idx` ON `physics_in_motion`.`tutorial_lab_rating` (`member_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`administrator`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`administrator` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`administrator` (
  `member_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `admin_type` SET('General') NOT NULL DEFAULT 'General',
  PRIMARY KEY (`member_id`),
  CONSTRAINT `admin_user_id`
    FOREIGN KEY (`member_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`administrator` (`member_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`section_student`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`section_student` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`section_student` (
  `section_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  `dropped_section` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `reviewed_section` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`section_id`, `student_id`),
  CONSTRAINT `section_section_id`
    FOREIGN KEY (`section_id`)
    REFERENCES `physics_in_motion`.`section` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `section_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `section_student_id_idx` ON `physics_in_motion`.`section_student` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`homework_submission`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`homework_submission` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`homework_submission` (
  `submission_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `homework_id` INT UNSIGNED NOT NULL,
  `date_submitted` DATETIME NOT NULL,
  `points_earned` INT UNSIGNED NOT NULL DEFAULT 0,
  `was_graded` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `hours` DOUBLE NULL,
  PRIMARY KEY (`submission_id`),
  CONSTRAINT `submission_hmwk_id`
    FOREIGN KEY (`homework_id`)
    REFERENCES `physics_in_motion`.`homework` (`homework_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `submission_hmwk_id_idx` ON `physics_in_motion`.`homework_submission` (`homework_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`notice_attachment`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`notice_attachment` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`notice_attachment` (
  `notice_attachment_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `notice_id` INT UNSIGNED NOT NULL,
  `attachment` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`notice_attachment_id`),
  CONSTRAINT `attachment_notice_id`
    FOREIGN KEY (`notice_id`)
    REFERENCES `physics_in_motion`.`notice` (`notice_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `attachment_notice_id_idx` ON `physics_in_motion`.`notice_attachment` (`notice_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`notice_received`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`notice_received` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`notice_received` (
  `notice_id` INT UNSIGNED NOT NULL,
  `to_member_id` INT UNSIGNED NOT NULL,
  `flag_read` TINYINT NOT NULL DEFAULT 0,
  `flag_important` TINYINT NOT NULL DEFAULT 0,
  PRIMARY KEY (`notice_id`, `to_member_id`),
  CONSTRAINT `received_notice_id`
    FOREIGN KEY (`notice_id`)
    REFERENCES `physics_in_motion`.`notice` (`notice_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `received_member_id`
    FOREIGN KEY (`to_member_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `received_member_id_idx` ON `physics_in_motion`.`notice_received` (`to_member_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`security_question`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`security_question` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`security_question` (
  `member_id` INT UNSIGNED NOT NULL,
  `question` VARCHAR(256) NOT NULL,
  `answer` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`member_id`),
  CONSTRAINT `security_question_member_id`
    FOREIGN KEY (`member_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `member_id_UNIQUE` ON `physics_in_motion`.`security_question` (`member_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`section_rating`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`section_rating` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`section_rating` (
  `rating_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id` INT UNSIGNED NOT NULL,
  `date_posted` DATETIME NOT NULL,
  `rating` INT NOT NULL,
  `comments` VARCHAR(1000) NULL,
  `flag_for_review` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`rating_id`),
  CONSTRAINT `lab_rating_section_id`
    FOREIGN KEY (`section_id`)
    REFERENCES `physics_in_motion`.`section` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `lab_rating_section_id_idx` ON `physics_in_motion`.`section_rating` (`section_id` ASC) VISIBLE;


SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
