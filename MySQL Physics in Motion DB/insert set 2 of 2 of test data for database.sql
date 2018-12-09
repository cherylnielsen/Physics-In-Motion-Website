/* initialize test data for the database */

use physics_in_motion;

/* assignments */

insert into assignment (assignment_id, professor_id, student_id, lab_id, 
date_assigned, date_due, lab_points)
values (101, 101, 101, 101, "2018-11-26 09:0:0", "2018-11-28 23:0:0", 100);

insert into assignment (assignment_id, professor_id, student_id, lab_id, 
date_assigned, date_due, lab_points)
values (102, 101, 101, 102, "2018-11-30 09:0:0", "2018-12-05 23:0:0", 200);

insert into assignment (assignment_id, professor_id, student_id, lab_id, 
date_assigned, date_due, lab_points, added_instructions)
values (103, 102, 102, 103, "2018-12-07 09:0:0", "2018-12-12 23:0:0", 50, "Use 3 different friction matterials, in addition to the frictionless air surface.");

select * from assignment;

/* student homework */

insert into student_homework (assignment_id, student_id, lab_summary, lab_data, lab_errors, lab_report, chat_session, date_time_started, date_time_submitted, total_time)
values (101, 101, "This is the lab summary.", "This is the lab data.", "none", "This is the lab report.", "This is the lab chat session.", "2018-11-28 15:0:0", "2018-11-28 20:0:0", 3.50);

SELECT * FROM student_homework;

/* notices */

insert into notice (notice_id, assignment_id, notice_type, date_sent)
values (101, 101, "assignment", "2018-11-26 09:0:0");

insert into notice (assignment_id, notice_type, date_sent)
values (101, "reminder", "2018-11-27 11:0:0");

insert into notice (assignment_id, notice_type, date_sent)
values (101, "completed", "2018-11-28 20:0:0");

insert into notice (assignment_id, notice_type, date_sent)
values (102, "assignment", "2018-11-30 09:0:0");

insert into notice (assignment_id, notice_type, date_sent)
values (102, "reminder", "2018-12-04 11:0:0");

insert into notice (assignment_id, notice_type, date_sent)
values (102, "overdue", "2018-12-06 01:0:0");

insert into notice (assignment_id, notice_type, date_sent)
values (103, "assignment", "2018-12-07 09:0:0");

SELECT * FROM notice;


