/* initialize test data for the database */

use physics_in_motion;

/* assignments */

insert into assignment (assignment_id, professor_id, student_id, lab_id, date_assigned, date_due, 
date_submitted, total_time, added_instructions)
values (101, 103, 101, 101, "2018-11-26 09:0:0", "2018-11-28 23:0:0", "2018-11-28 20:0:0", 3.50, null), 
(102, 103, 101, 102, "2018-11-30 09:0:0", "2018-12-05 23:0:0", null, null, null), 
(103, 104, 102, 103, "2018-12-07 09:0:0", "2018-12-12 23:0:0", null, null, 
		"Use 3 different friction matterials, in addition to the frictionless air surface.");

select * from assignment;

/* student homework */

insert into homework (homework_id, lab_summary, lab_data, lab_graphs, lab_math, lab_errors, chat_session, lab_report)
values (101, "This is the lab summary.", null, null, null, "no errors", "This is the lab chat session.", "This is the lab report.");

SELECT * FROM homework;

/* ratings */

insert into tutorial_lab_rating (rating_id, lab_id, user_id, date_posted, lab_rating, comments)
values (101, 101, 101, "2018-11-29 12:00:00", 5, "This lab is great!"),
(102, 101, 103, "2018-11-30 19:00:00", 5, "My students think this lab is great!");

select * from tutorial_lab_rating;
