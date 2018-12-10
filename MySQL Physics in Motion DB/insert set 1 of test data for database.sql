/* initialize test data for the database */

use physics_in_motion;

/* quote of the month */

insert into quote (quote_id, date_posted, author, quote_text)
values (101, "2018-12-01", "Les Brown", "Shoot for the Moon. Even if you miss, you'll land among the stars.");

select * from quote;

/*  users  */

insert into users (user_id, user_name, user_password, user_email, date_joined)
values (101, "s1name", "s1password", "s1email", "2018-09-01 12:0:0"), 
(102, "s2name", "s2password", "s2email", "2018-09-01 12:0:0"), 
(103, "p1name", "p1password", "p1email", "2018-09-01 12:0:0"), 
(104, "p2name", "p2password", "p2email", "2018-09-01 12:0:0");

select * from users;

/* students and professors */

insert into student (student_id, user_id, first_name, last_name, school_type, school_name)
values (101, 101, "s1first", "s1last", "s1school_type", "s1school_name"), 
(102, 102, "s2first", "s2last", "s2school_type", "s2school_name");

insert into professor (professor_id, user_id, first_name, last_name, school_type, school_name)
values (101, 103, "p1first", "p1last", "p1school_type", "p1school_name"), 
(102, 104, "p2first", "p2last", "p2school_type", "p2school_name");

select * from student;
select * from professor;

/* tutorial labs */

insert into tutorial_lab (lab_id, lab_name, web_link, lab_status, introduction)
values (101, "Vector Calculus of 3D Volumes and Surfaces", "vector_calc_3d_volumes_surfaces", "In Development", "Solve and graph equations for 3D volumes and surfaces, in Cartesian, Polar, or Cylindrical coordinates. This will include the topics of gradient, tangent, normal, divergence, curl, Green’s Theorem, Stokes’ Theorem, and Gauss’ Theorem. In this lab, the graphs and equations can be varied to see the effects that they have on each other."),
(102, "Beginning RC Circuits", "begin_rc_circuit", "In Development", "Experiments with basic DC powered circuits made from resisters, capacitors, etc.  This includes activities and calculations to understand parallel and series resisters and capacitors, Ohm’s law, and Kirchhoff’s law."),
(103, "Linear Motion and Collisions", "linear_motion_collision", "In Development", "Linear motion and conservation of linear momentum as demonstrated by collisions. Vary inclines, masses of carts, and friction materials, while collecting and analyzing data on distance, time, and velocity."), 
(104, "The Photoelectric Effect from Quantum Physics", "photoelectric_effect_quantum_physics", "In Development", "This is one of the famous experiments that lead to the discovery of Quantum Physics. Light shining on metal causes the release of electrons which are detected as current. The problem was the data did not make sense based on what Classical Physics theory said about the behavior of light waves. This led to a new interpretation of the data by Einstein that light was also made of particles called photons. This also confirmed the quantization of energy. This new interpretation of the experimental data earned the Nobel Prize for Einstein.");

select * from tutorial_lab;



