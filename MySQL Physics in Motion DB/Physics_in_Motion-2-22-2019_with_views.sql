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
  `tutorial_lab_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tutorial_lab_name` VARCHAR(256) NOT NULL,
  `tutorial_lab_web_link` VARCHAR(256) NOT NULL,
  `lab_status` SET('New', 'Updated', 'Available', 'Development', 'Discontinued') NOT NULL DEFAULT 'Development',
  `tutorial_lab_introduction` VARCHAR(1000) NULL,
  `prerequisites` VARCHAR(1000) NULL,
  `key_topics` VARCHAR(1000) NULL,
  `key_equations` VARCHAR(1000) NULL,
  `description` VARCHAR(256) NULL,
  `instructions` VARCHAR(256) NULL,
  `date_first_available` DATETIME NULL,
  PRIMARY KEY (`tutorial_lab_id`))
ENGINE = InnoDB;

CREATE UNIQUE INDEX `lab_name_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`tutorial_lab_name` ASC) VISIBLE;

CREATE UNIQUE INDEX `web_link_UNIQUE` ON `physics_in_motion`.`tutorial_lab` (`tutorial_lab_web_link` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`member`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`member` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`member` (
  `member_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `member_type` SET('student', 'professor', 'administrator', 'blocked') NOT NULL,
  `member_name` VARCHAR(45) NOT NULL,
  `member_password` VARCHAR(256) NOT NULL,
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
  `student_id` INT UNSIGNED NOT NULL,
  `school_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`student_id`),
  CONSTRAINT `student_user_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`student` (`student_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`professor`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`professor` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`professor` (
  `professor_id` INT UNSIGNED NOT NULL,
  `school_name` VARCHAR(45) NOT NULL,
  PRIMARY KEY (`professor_id`),
  CONSTRAINT `professor_user_id`
    FOREIGN KEY (`professor_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`professor` (`professor_id` ASC) VISIBLE;


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
    REFERENCES `physics_in_motion`.`professor` (`professor_id`)
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
  `tutorial_lab_id` INT UNSIGNED NOT NULL,
  `assignment_name` VARCHAR(256) NULL,
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
    FOREIGN KEY (`tutorial_lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`tutorial_lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `assignment_section_id_idx` ON `physics_in_motion`.`assignment` (`section_id` ASC) VISIBLE;

CREATE INDEX `assignment_lab_id_idx` ON `physics_in_motion`.`assignment` (`tutorial_lab_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`homework`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`homework` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`homework` (
  `homework_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id` INT UNSIGNED NOT NULL,
  `assignment_id` INT UNSIGNED NOT NULL,
  `student_id` INT UNSIGNED NOT NULL,
  `lab_summary` VARCHAR(256) NULL DEFAULT NULL,
  `lab_data` VARCHAR(256) NULL DEFAULT NULL,
  `graphs` VARCHAR(256) NULL DEFAULT NULL,
  `math` VARCHAR(256) NULL DEFAULT NULL,
  `hints` VARCHAR(256) NULL DEFAULT NULL,
  `chat_session` VARCHAR(256) NULL DEFAULT NULL,
  `date_submitted` DATETIME NULL DEFAULT NULL,
  `points_earned` INT UNSIGNED NOT NULL DEFAULT 0,
  `was_graded` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `hours` DOUBLE NOT NULL DEFAULT 0.0,
  PRIMARY KEY (`homework_id`),
  CONSTRAINT `hmwk_assignment_id`
    FOREIGN KEY (`assignment_id`)
    REFERENCES `physics_in_motion`.`assignment` (`assignment_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `hmwk_student_id`
    FOREIGN KEY (`student_id`)
    REFERENCES `physics_in_motion`.`student` (`student_id`)
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
  `response_to_notice_id` INT UNSIGNED NULL DEFAULT NULL,
  `date_sent` DATETIME NOT NULL,
  `notice_subject` VARCHAR(256) NOT NULL,
  `notice_text` VARCHAR(1000) NOT NULL,
  `sent_high_priority` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `flag_for_review` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`notice_id`),
  CONSTRAINT `notice_from_member_id`
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
  `tutorial_lab_rating_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `tutorial_lab_id` INT UNSIGNED NOT NULL,
  `member_id` INT UNSIGNED NOT NULL,
  `date_posted` DATETIME NOT NULL,
  `rating` INT NOT NULL,
  `comments` VARCHAR(1000) NULL,
  `flag_for_review` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`tutorial_lab_rating_id`),
  CONSTRAINT `lab_rating_lab_id`
    FOREIGN KEY (`tutorial_lab_id`)
    REFERENCES `physics_in_motion`.`tutorial_lab` (`tutorial_lab_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `lab_rating_user_id`
    FOREIGN KEY (`member_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `lab_rating_lab_id_idx` ON `physics_in_motion`.`tutorial_lab_rating` (`tutorial_lab_id` ASC) VISIBLE;

CREATE INDEX `lab_rating_user_id_idx` ON `physics_in_motion`.`tutorial_lab_rating` (`member_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`administrator`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`administrator` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`administrator` (
  `administrator_id` INT UNSIGNED NOT NULL,
  `admin_type` SET('general') NOT NULL DEFAULT 'general',
  PRIMARY KEY (`administrator_id`),
  CONSTRAINT `admin_user_id`
    FOREIGN KEY (`administrator_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE UNIQUE INDEX `user_id_UNIQUE` ON `physics_in_motion`.`administrator` (`administrator_id` ASC) VISIBLE;


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
    REFERENCES `physics_in_motion`.`student` (`student_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `section_student_id_idx` ON `physics_in_motion`.`section_student` (`student_id` ASC) VISIBLE;


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
-- Table `physics_in_motion`.`notice_to_member`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`notice_to_member` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`notice_to_member` (
  `notice_id` INT UNSIGNED NOT NULL,
  `to_member_id` INT UNSIGNED NOT NULL,
  `flag_read` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  `flag_important` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`notice_id`, `to_member_id`),
  CONSTRAINT `sent_to_member_notice_id`
    FOREIGN KEY (`notice_id`)
    REFERENCES `physics_in_motion`.`notice` (`notice_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `sent_to_member_member_id`
    FOREIGN KEY (`to_member_id`)
    REFERENCES `physics_in_motion`.`member` (`member_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `received_member_id_idx` ON `physics_in_motion`.`notice_to_member` (`to_member_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`security_question`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`security_question` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`security_question` (
  `security_question_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `member_id` INT UNSIGNED NOT NULL,
  `question` VARCHAR(256) NOT NULL,
  `answer` VARCHAR(256) NOT NULL,
  PRIMARY KEY (`security_question_id`),
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
  `section_rating_id` INT UNSIGNED NOT NULL AUTO_INCREMENT,
  `section_id` INT UNSIGNED NOT NULL,
  `date_posted` DATETIME NOT NULL,
  `rating` INT NOT NULL,
  `comments` VARCHAR(1000) NULL,
  `flag_for_review` TINYINT UNSIGNED NOT NULL DEFAULT 0,
  PRIMARY KEY (`section_rating_id`),
  CONSTRAINT `lab_rating_section_id`
    FOREIGN KEY (`section_id`)
    REFERENCES `physics_in_motion`.`section` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `lab_rating_section_id_idx` ON `physics_in_motion`.`section_rating` (`section_id` ASC) VISIBLE;


-- -----------------------------------------------------
-- Table `physics_in_motion`.`notice_to_section`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`notice_to_section` ;

CREATE TABLE IF NOT EXISTS `physics_in_motion`.`notice_to_section` (
  `notice_id` INT UNSIGNED NOT NULL,
  `to_section_id` INT UNSIGNED NOT NULL,
  PRIMARY KEY (`notice_id`, `to_section_id`),
  CONSTRAINT `notice_to_section_notice_id`
    FOREIGN KEY (`notice_id`)
    REFERENCES `physics_in_motion`.`notice` (`notice_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION,
  CONSTRAINT `notice_to_section_section_id`
    FOREIGN KEY (`to_section_id`)
    REFERENCES `physics_in_motion`.`section` (`section_id`)
    ON DELETE NO ACTION
    ON UPDATE NO ACTION)
ENGINE = InnoDB;

CREATE INDEX `notice_to_section_section_id_idx` ON `physics_in_motion`.`notice_to_section` (`to_section_id` ASC) VISIBLE;

USE `physics_in_motion` ;

-- -----------------------------------------------------
-- Placeholder table for view `physics_in_motion`.`student_member_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `physics_in_motion`.`student_member_view` (`student_id` INT, `email` INT, `school_name` INT, `student_name` INT);

-- -----------------------------------------------------
-- Placeholder table for view `physics_in_motion`.`professor_member_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `physics_in_motion`.`professor_member_view` (`professor_id` INT, `email` INT, `school_name` INT, `professor_name` INT);

-- -----------------------------------------------------
-- Placeholder table for view `physics_in_motion`.`administrator_member_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `physics_in_motion`.`administrator_member_view` (`administrator_id` INT, `email` INT, `admin_type` INT, `administrator_name` INT);

-- -----------------------------------------------------
-- Placeholder table for view `physics_in_motion`.`section_student_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `physics_in_motion`.`section_student_view` (`section_id` INT, `section_name` INT, `start_date` INT, `end_date` INT, `student_id` INT, `first_name` INT, `last_name` INT, `school_name` INT);

-- -----------------------------------------------------
-- Placeholder table for view `physics_in_motion`.`assignment_full_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `physics_in_motion`.`assignment_full_view` (`section_name` INT, `professor_id` INT, `professor_name` INT, `school_name` INT, `tutorial_lab_name` INT, `tutorial_lab_introduction` INT, `tutorial_lab_web_link` INT, `assignment_id` INT, `section_id` INT, `tutorial_lab_id` INT, `assignment_name` INT, `date_assigned` INT, `date_due` INT, `points_possible` INT, `notes` INT);

-- -----------------------------------------------------
-- Placeholder table for view `physics_in_motion`.`section_professor_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `physics_in_motion`.`section_professor_view` (`section_id` INT, `section_name` INT, `start_date` INT, `end_date` INT, `professor_id` INT, `professor_name` INT, `school_name` INT);

-- -----------------------------------------------------
-- Placeholder table for view `physics_in_motion`.`tutorial_lab_rating_full_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `physics_in_motion`.`tutorial_lab_rating_full_view` (`member_name` INT, `tutorial_lab_name` INT, `tutorial_lab_rating_id` INT, `tutorial_lab_id` INT, `member_id` INT, `date_posted` INT, `rating` INT, `comments` INT, `flag_for_review` INT);

-- -----------------------------------------------------
-- Placeholder table for view `physics_in_motion`.`notice_full_view`
-- -----------------------------------------------------
CREATE TABLE IF NOT EXISTS `physics_in_motion`.`notice_full_view` (`to_section_id` INT, `to_member_id` INT, `notice_id` INT, `from_member_id` INT, `response_to_notice_id` INT, `date_sent` INT, `notice_subject` INT, `notice_text` INT, `sent_high_priority` INT, `flag_for_review` INT, `flag_read` INT, `flag_important` INT, `from_member_name` INT);

-- -----------------------------------------------------
-- View `physics_in_motion`.`student_member_view`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`student_member_view`;
DROP VIEW IF EXISTS `physics_in_motion`.`student_member_view` ;
USE `physics_in_motion`;
CREATE  OR REPLACE VIEW `student_member_view` AS
    SELECT 
        student_id,
        email,
        school_name,
        CONCAT(first_name, ' ', last_name) AS student_name
    FROM
        student,
        member
    WHERE
        student.student_id = member.member_id
	ORDER BY
		student_id;

-- -----------------------------------------------------
-- View `physics_in_motion`.`professor_member_view`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`professor_member_view`;
DROP VIEW IF EXISTS `physics_in_motion`.`professor_member_view` ;
USE `physics_in_motion`;
CREATE  OR REPLACE VIEW `professor_member_view` AS
    SELECT 
        professor_id, email, school_name,
        concat(first_name, ' ', last_name) AS professor_name
    FROM
        professor, member
    WHERE
        professor.professor_id = member.member_id
	ORDER BY
		professor_id;

-- -----------------------------------------------------
-- View `physics_in_motion`.`administrator_member_view`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`administrator_member_view`;
DROP VIEW IF EXISTS `physics_in_motion`.`administrator_member_view` ;
USE `physics_in_motion`;
CREATE  OR REPLACE VIEW `administrator_member_view` AS
    SELECT 
        administrator_id, email, admin_type,
        concat(first_name, ' ', last_name) AS administrator_name
    FROM
        administrator, member
    WHERE
        administrator.administrator_id = member.member_id
	ORDER BY
		administrator_id;

-- -----------------------------------------------------
-- View `physics_in_motion`.`section_student_view`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`section_student_view`;
DROP VIEW IF EXISTS `physics_in_motion`.`section_student_view` ;
USE `physics_in_motion`;
CREATE  OR REPLACE VIEW `section_student_view` AS
    SELECT 
        section.section_id, section_name, start_date, end_date, 
        student.student_id, first_name, last_name, school_name
    FROM
        section_student, section, student, member
    WHERE
        student.student_id = section_student.student_id
        AND section.section_id = section_student.section_id
        AND student.student_id = member.member_id
	ORDER BY 
		start_date, section_id, last_name, first_name, student.student_id;

-- -----------------------------------------------------
-- View `physics_in_motion`.`assignment_full_view`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`assignment_full_view`;
DROP VIEW IF EXISTS `physics_in_motion`.`assignment_full_view` ;
USE `physics_in_motion`;
CREATE  OR REPLACE VIEW `assignment_full_view` AS
    SELECT 
        section_name,
        professor.professor_id,
        concat(first_name, ' ', last_name) AS professor_name,
        school_name,
        tutorial_lab_name,
        tutorial_lab_introduction,
        tutorial_lab_web_link,
        assignment.*
    FROM
        section,
        assignment,
        tutorial_lab,
        professor,
        member
    WHERE
        assignment.section_id = section.section_id
            AND assignment.tutorial_lab_id = tutorial_lab.tutorial_lab_id
            AND section.professor_id = professor.professor_id
            AND professor.professor_id = member.member_id
    ORDER BY section_id , date_due, assignment_id;

-- -----------------------------------------------------
-- View `physics_in_motion`.`section_professor_view`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`section_professor_view`;
DROP VIEW IF EXISTS `physics_in_motion`.`section_professor_view` ;
USE `physics_in_motion`;
CREATE  OR REPLACE VIEW `section_professor_view` AS
    SELECT 
        section.section_id,
        section_name,
        start_date,
        end_date,
        professor.professor_id,
        concat(first_name, ' ', last_name) AS professor_name,
        school_name
    FROM
        section,
        professor,
        member
    WHERE
        section.professor_id = professor.professor_id
            AND professor.professor_id = member.member_id
	ORDER BY 
		start_date, section.section_id;

-- -----------------------------------------------------
-- View `physics_in_motion`.`tutorial_lab_rating_full_view`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`tutorial_lab_rating_full_view`;
DROP VIEW IF EXISTS `physics_in_motion`.`tutorial_lab_rating_full_view` ;
USE `physics_in_motion`;
CREATE  OR REPLACE VIEW `tutorial_lab_rating_full_view` AS
    SELECT 
        concat(first_name, ' ', last_name) AS member_name,
        tutorial_lab_name,
        tutorial_lab_rating.*
    FROM
        member,
        tutorial_lab_rating,
        tutorial_lab
    WHERE
        tutorial_lab_rating.member_id = member.member_id
            AND tutorial_lab_rating.tutorial_lab_id = tutorial_lab.tutorial_lab_id
    ORDER BY 
		tutorial_lab.tutorial_lab_id, date_posted;

-- -----------------------------------------------------
-- View `physics_in_motion`.`notice_full_view`
-- -----------------------------------------------------
DROP TABLE IF EXISTS `physics_in_motion`.`notice_full_view`;
DROP VIEW IF EXISTS `physics_in_motion`.`notice_full_view` ;
USE `physics_in_motion`;
CREATE  OR REPLACE VIEW `notice_full_view` AS
    SELECT 
        to_section_id,
        to_member_id,
        notice.*,
        flag_read,
        flag_important,
        concat(first_name, ' ', last_name) AS from_member_name
    FROM
        notice 
            JOIN
		notice_to_member ON (notice.notice_id = notice_to_member.notice_id)
            JOIN
        member ON (notice.from_member_id = member.member_id)
            LEFT OUTER JOIN
        notice_to_section ON (notice.notice_id = notice_to_section.notice_id)
    ORDER BY to_member_id , to_section_id , date_sent;

SET SQL_MODE=@OLD_SQL_MODE;
SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;
