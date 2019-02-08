/* initialize test data for the database */

use physics_in_motion;

/* assignments */
insert into assignment (assignment_id, section_id, lab_id, date_assigned, date_due, points_possible, notes)
values (1, 101, 101, "2019-02-01 10:0:0", "2018-02-04 23:59:0", 20, "notes for assignment 1"), 
(2, 101, 102, "2019-02-01 10:10:0", "2018-02-04 23:59:0", 20, "notes for assignment 2");

select * from assignment;

/* student homework */
insert into homework (assignment_id, student_id, lab_summary, lab_data, graphs, math, hints, chat_session)
values (1, 2, "the summary for assignment 1", "the data", "the graphs", "the math", "the hints", "the chat"),
(2, 2, "the summary for assignment 2", "the data", "the graphs", "the math", "the hints", "the chat"),
(1, 3, "the summary for assignment 1", "the data", "the graphs", "the math", "the hints", "the chat"),
(2, 3, "the summary for assignment 2", "the data", "the graphs", "the math", "the hints", "the chat");

select * from homework;

/* ratings */
insert into lab_rating (lab_id, member_id, date_posted, rating, comments)
values (101, 1, "2018-02-05 12:00:00", 5, "This lab is great!"),
(101, 3, "2018-02-03 14:00:00", 5, "This lab is very good.");

insert into lab_rating (lab_id, member_id, date_posted, rating)
values (101, 2, "2018-02-05 12:00:00", 4);

select * from lab_rating;

/* homework submission */
insert into homework_submission (assignment_id, student_id, date_submitted, points_earned, was_graded, total_time)
values (1, 2, "2018-02-03 22:00:00", 20, 1, 3),
(1, 3, "2018-02-04 12:00:00", 15, 1, 2);

select * from homework_submission;

