/* initialize test data for the database */

use physics_in_motion;

/* assignments */
insert into assignment (assignment_id, section_id, lab_id, tag, date_assigned, date_due, points_possible, notes)
values (1, 101, 101, "Assignment 1", "2019-02-01 10:0:0", "2018-02-04 23:59:0", 20, "notes 1"), 
(2, 101, 102, "Assignment 2", "2019-02-01 10:10:0", "2018-02-04 23:59:0", 20, "notes 1");

insert into assignment (assignment_id, section_id, lab_id, tag, date_assigned, date_due, points_possible)
values (3, 102, 103, "Lab 1", "2019-02-06 10:0:0", "2018-02-11 23:59:0", 20),
(4, 102, 104, "Lab 2", "2019-02-06 10:20:0", "2018-02-11 23:59:0", 20);

select * from assignment;

/* student homework */
insert into homework (assignment_id, user_id, lab_summary, lab_data, graphs, math, hints, chat_session)
values (1, 3, "the summary assignment 1 user 3", "the data", "the graphs", "the math", "the hints", "the chat"),
(2, 3, "the summary assignment 2 user 3", "the data", "the graphs", "the math", "the hints", "the chat"),
(1, 4, "the summary assignment 1 user 4", "the data", "the graphs", "the math", "the hints", "the chat"),
(2, 4, "the summary assignment 2 user 4", "the data", "the graphs", "the math", "the hints", "the chat");

select * from homework;

/* ratings */
insert into lab_rating (lab_id, user_id, date_posted, rating, comments)
values (101, 3, "2018-02-05 12:00:00", 5, "This lab is great!"),
(101, 4, "2018-02-05 12:00:00", 4, " "),
(101, 1, "2018-02-05 14:00:00", 5, "This lab is very good.");

select * from lab_rating;

/* homework submission */
insert into homework_submission (assignment_id, user_id, date_submitted, points_earned, is_graded, total_time)
values (1, 3, "2018-02-04 22:00:00", 20, 1, 3),
(1, 4, "2018-02-04 23:00:00", 15, 1, 2);

select * from homework_submission;

