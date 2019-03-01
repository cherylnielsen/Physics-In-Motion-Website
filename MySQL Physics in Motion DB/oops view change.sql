CREATE 
    ALGORITHM = UNDEFINED 
    DEFINER = `root`@`localhost` 
    SQL SECURITY DEFINER
VIEW `physics_in_motion`.`student_member_view` AS
    SELECT 
        `physics_in_motion`.`student`.`student_id` AS `student_id`,
        `physics_in_motion`.`member`.`email` AS `email`,
        `physics_in_motion`.`student`.`school_name` AS `school_name`,
        `physics_in_motion`.`member`.`first_name` AS `first_name`,
		`physics_in_motion`.`member`.`last_name` AS `last_name`
    FROM
        (`physics_in_motion`.`student`
        JOIN `physics_in_motion`.`member`)
    WHERE
        (`physics_in_motion`.`student`.`student_id` = `physics_in_motion`.`member`.`member_id`)
    ORDER BY `physics_in_motion`.`student`.`student_id`