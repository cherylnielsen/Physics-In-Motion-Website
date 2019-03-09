/* initialize test data for the database */

use physics_in_motion;

/* assignments */
insert into assignment (assignment_id, section_id, tutorial_lab_id, assignment_name, date_due, points_possible, notes)
values (1, 101, 101, "assignment name", "2019-02-01 10:0:0", "2019-02-04 23:59:0", 20, "notes for assignment 1"), 
(2, 101, 102, "assignment name", "2019-02-05 10:10:0", "2019-02-08 23:59:0", 20, "notes for assignment 2");

select * from assignment;

/* student homework */
insert into homework (homework_id, section_id, assignment_id, student_id, lab_summary, lab_data, graphs, math, hints, chat_session)
values (1, 101, 1, 2, "the summary for assignment 1", "the data", "the graphs", "the math", "the hints", "the chat"),
(2, 101, 2, 2, "the summary", "the data", "the graphs", "the math", "the hints", "the chat"),
(3, 101, 1, 3, "the summary", "the data", "the graphs", "the math", "the hints", "the chat"),
(4, 101, 2, 3, "the summary", "the data", "the graphs", "the math", "the hints", "the chat");

select * from homework;

/* homework submission */
update homework 
set date_submitted = "2018-02-03 22:00:00", points_earned = 20, was_graded = true, hours = 3
where homework_id = 1;
update homework 
set date_submitted = "2018-02-04 12:00:00", points_earned = 15, was_graded = true, hours = 2
where homework_id = 3;

select * from homework;

/* ratings */
insert into tutorial_lab_rating (tutorial_lab_id, member_id, date_posted, rating, comments)
values (101, 1, "2018-02-05 12:00:00", 5, "This lab is great!"),
(101, 3, "2018-02-03 14:00:00", 5, "This lab is very good.");

insert into tutorial_lab_rating (tutorial_lab_id, member_id, date_posted, rating)
values (101, 2, "2018-02-05 12:00:00", 4);

select * from tutorial_lab_rating;



