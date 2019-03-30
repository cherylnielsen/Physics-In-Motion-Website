/* initialize test data for the database */

use physics_in_motion;

/* assignments */
insert into assignment (assignment_id, section_id, tutorial_lab_id, assignment_name, 
			date_assigned, date_due, points_possible)
values 
(6, 101, 106, "assignment name", "2019-04-01 10:0:0", "2019-04-05 23:59:0", 20), 
(7, 101, 105, "assignment name", "2019-04-05 10:10:0", "2019-04-10 23:59:0", 20),
(8, 101, 103, "assignment name", "2019-03-01 10:0:0", "2019-03-05 23:59:0", 20), 
(9, 101, 104, "assignment name", "2019-03-05 10:10:0", "2019-03-10 23:59:0", 20),
(10, 101, 105, "assignment name", "2019-03-10 10:0:0", "2019-03-15 23:59:0", 20), 
(11, 101, 106, "assignment name", "2019-03-15 10:10:0", "2019-03-20 23:59:0", 20);
select * from assignment;

/* student homework */
insert into homework (homework_id, section_id, assignment_id, student_id, lab_summary, 
			lab_data, graphs, math, hints, chat_session, filepath)
values 
(5, 101, 8, 2, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_5"),
(6, 101, 9, 2, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_6"),
(7, 101, 8, 3, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_7"),
(8, 101, 9, 3, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_8");

select * from homework;

/* homework submission */
update homework 
set date_submitted = "2018-02-03 22:00:00", points_earned = 20, was_graded = true, hours = 3
where homework_id = 1;
update homework 
set date_submitted = "2018-02-04 12:00:00", points_earned = 0, was_graded = false, hours = 2
where homework_id = 3;

select * from homework;

/* ratings */
insert into tutorial_lab_rating (tutorial_lab_id, member_id, date_posted, rating, comments)
values 
(101, 1, "2018-02-05 12:00:00", 5, "This lab is great!"),
(101, 3, "2018-02-03 14:00:00", 5, "This lab is outstanding!"),
(101, 2, "2018-02-05 12:00:00", 4, "This lab is very good.");

insert into tutorial_lab_rating (tutorial_lab_id, member_id, date_posted, rating)
values (101, 2, "2018-02-05 12:00:00", 4);

select * from tutorial_lab_rating;

insert into homework (homework_id, section_id, assignment_id, student_id, lab_summary, 
			lab_data, graphs, math, hints, chat_session, filepath)
values 
(9, 101, 1, 5, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_9"),
(10, 101, 1, 6, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_10"),
(11, 101, 1, 7, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_11"),
(12, 101, 2, 5, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_12"),
(13, 101, 2, 6, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_13"),
(14, 101, 2, 7, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_14");

select * from homework;

insert into homework (homework_id, section_id, assignment_id, student_id, lab_summary, 
			lab_data, graphs, math, hints, chat_session, filepath)
values 
(15, 101, 3, 5, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_9"),
(16, 101, 3, 6, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_10"),
(17, 101, 3, 7, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_11"),
(18, 101, 4, 5, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_12"),
(19, 101, 4, 6, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_13"),
(20, 101, 4, 7, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_14");

select * from homework;
