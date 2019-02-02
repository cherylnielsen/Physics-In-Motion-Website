/* initialize test data for the database */

use physics_in_motion;
/* sections */

insert into sections (section_id, section_name, start_date, end_date)
values (101, "section name 1", "2018-12-01", "2019-02-01"),
(102, "section name 2", "2018-12-01", "2019-02-01");

insert into section_students (section_id, student_id)
values (101, 101), (101, 102),
(102, 101), (102, 102);

insert into section_professors (section_id, professor_id)
values (101, 101), (102, 102);

SELECT * FROM sections;
SELECT * FROM section_students;
SELECT * FROM section_professors;

/* assignments */
insert into assignment (assignment_id, section_id, lab_id, tag, date_assigned, date_due, points_possible, notes)
values (101, 101, 101, "tag 1", "2018-10-01 10:0:0", "2018-10-15 20:0:0", 20, "notes 1"), 
(102, 101, 102, "tag 2", "2018-10-15 10:0:0", "2018-11-01 20:0:0", 20, "notes 2");

select * from assignment;

/* student homework */
insert into homework (assignment_id, student_id, lab_summary, lab_data, graphs, math, hints, chat_session)
values (101, 101, "This is student 1 lab summary.", "the data 1", "the graphs 1", "the math 1", "the hints 1", "the chat 1"),
(101, 102, "This is the student 2 lab summary.", "the data 2", "the graphs 2", "the math 2 ", "the hints 2", "the chat 2");

select * from homework;

/* ratings */
insert into lab_rating (rating_id, lab_id, user_id, date_posted, lab_rating, comments)
values (101, 101, 103, "2018-11-20 12:00:00", 5, "This lab is great!"),
(102, 101, 105, "2018-12-01 14:00:00", 5, "My students think this lab is great!");

select * from lab_rating;

/* homework submission */
insert into homework_submission (assignment_id, student_id, date_submitted, points_earned, was_graded, total_time)
values (101, 101, "2018-10-15 12:00:00", 20, 1, 5),
(101, 102, "2018-10-10 14:00:00", 15, 1, 3);

select * from homework_submission;

