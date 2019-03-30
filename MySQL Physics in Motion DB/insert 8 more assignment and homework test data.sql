/* initialize test data for the database */

use physics_in_motion;

/* student homework */
insert into homework (homework_id, section_id, assignment_id, student_id, lab_summary, 
			lab_data, graphs, math, hints, chat_session, filepath)
values 
(14, 101, 6, 2, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_5"),
(15, 101, 6, 3, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_6"),
(16, 101, 6, 5, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_7"),
(17, 101, 6, 6, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_8");

select * from homework;

insert into homework (homework_id, section_id, assignment_id, student_id, lab_summary, 
			lab_data, graphs, math, hints, chat_session, filepath)
values 
(18, 101, 7, 2, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_9"),
(19, 101, 7, 3, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_10"),
(20, 101, 7, 5, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_11"),
(21, 101, 7, 6, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_12"),
(22, 101, 8, 2, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_13"),
(23, 101, 8, 3, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_14");

select * from homework;

insert into homework (homework_id, section_id, assignment_id, student_id, lab_summary, 
			lab_data, graphs, math, hints, chat_session, filepath)
values 
(24, 101, 8, 5, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_9"),
(25, 101, 8, 6, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_10"),
(26, 101, 9, 2, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_11"),
(27, 101, 9, 3, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_12"),
(28, 101, 9, 5, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_13"),
(29, 101, 9, 6, "the summary", "the data", "the graphs", "the math", "the hints", "the chat",
"homework/id_14");

select * from homework;
