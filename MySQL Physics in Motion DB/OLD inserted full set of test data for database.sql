/* initialize test data for the database */

use physics_in_motion;

/* quote of the month */

insert into quote_of_the_month (quote_id, date_posted, author, quote)
values (101, "2018-12-01", "Les Brown", "Shoot for the Moon. Even if you miss, you'll land among the stars.");

select * from quote_of_the_month;

/* students and professors */

insert into student (student_id, first_name, last_name, school, user_name, user_password, email, date_joined)
values (101, "s1first", "s1last", "s1school", "s1user", "s1password", "s1email", "2018-09-01 12:0:0");

insert into student (first_name, last_name, school, user_name, user_password, email, date_joined)
values ("s2first", "s2last", "s2school", "s2user", "s2password", "s2email", "2018-09-01 12:0:0"), 
("s3first", "s3last", "s3school", "s3user", "s3password", "s3email", "2018-09-01 12:0:0");

insert into professor (professor_id, first_name, last_name, school, user_name, user_password, email, date_joined)
values (101, "p1first", "p1last", "p1school", "p1user", "p1password", "p1email", "2018-09-01 9:0:0");

insert into professor (first_name, last_name, school, user_name, user_password, email, date_joined)
values ("p2first", "p2last", "p2school", "p2user", "p2password", "p2email", "2018-09-01 9:0:0");

select * from student;
select * from professor;

/* tutorial labs */

insert into tutorial_lab (lab_id, lab_name, web_link, lab_status, short_description)
values (101, "Vector Calculus of 3D Volumes and Surfaces", "vector_calc_3d_volumes_surfaces", "In Development", "Solve and graph equations for 3D volumes and surfaces, in Cartesian, Polar, or Cylindrical coordinates. This will include the topics of gradient, tangent, normal, divergence, curl, Green’s Theorem, Stokes’ Theorem, and Gauss’ Theorem. In this lab, the graphs and equations can be varied to see the effects that they have on each other.");

insert into tutorial_lab (lab_name, web_link, lab_status, short_description)
values ("Beginning RC Circuits", "begin_rc_circuit", "In Development", "Experiments with basic DC powered circuits made from resisters, capacitors, etc.  This includes activities and calculations to understand parallel and series resisters and capacitors, Ohm’s law, and Kirchhoff’s law.");

insert into tutorial_lab (lab_name, web_link, lab_status, short_description)
values ("Linear Motion and Collisions", "linear_motion_collision", "In Development", "Linear motion and conservation of linear momentum as demonstrated by collisions. Vary inclines, masses of carts, and friction materials, while collecting and analyzing data on distance, time, and velocity.");

insert into tutorial_lab (lab_name, web_link, lab_status, short_description)
values ("The Photoelectric Effect from Quantum Physics", "photoelectric_effect_quantum_physics", "In Development", "This is one of the famous experiments that lead to the discovery of Quantum Physics. Light shining on metal causes the release of electrons which are detected as current. The problem was the data did not make sense based on what Classical Physics theory said about the behavior of light waves. This led to a new interpretation of the data by Einstein that light was also made of particles called photons. This also confirmed the quantization of energy. This new interpretation of the experimental data earned the Nobel Prize for Einstein.");

select * from tutorial_lab;

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

/* ratings */

insert into student_lab_rating (rating_id, lab_id, student_id, date_posted, lab_rating, comments)
values (101, 101, 101, "2018-11-29 12:00:00", 5, "This lab is great!");

insert into professor_lab_rating (rating_id, lab_id, professor_id, date_posted, lab_rating, comments)
values (101, 101, 101, "2018-11-30 19:00:00", 5, "My students think this lab is great!");

select * from student_lab_rating;
select * from professor_lab_rating;

