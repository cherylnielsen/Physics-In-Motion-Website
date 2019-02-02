/* initialize test data for the database */

use physics_in_motion;

/* quote of the month */
insert into quote (quote_id, author, quote_text, month_posted, year_posted)
values (101, "Les Brown", "Shoot for the Moon. Even if you miss, you'll land among the stars.", "12", "2018"),
(102, "Eleanor Roosevelt", "The future belongs to those who beleive in the beauty of their dreams.", "01", "2019"),
(103, "Vivian Greene", "Life isn't about waiting for the storm to pass. It's about learning how to dance in the rain.", "02", "2019");
select * from quote;

/* tutorial labs */
insert into tutorial_lab (lab_id, lab_name, web_link, lab_status)
values (101, "Vector Calculus of 3D Volumes and Surfaces", "vector_calc_3d_volumes_surfaces", "New"),
(102, "Beginning RC Circuits", "begin_rc_circuit", "New"),
(103, "Linear Motion and Collisions", "linear_motion_collision", "Development"), 
(104, "The Photoelectric Effect from Quantum Physics", "photoelectric_effect_quantum_physics", "Development");

update tutorial_lab set introduction = "Solve and graph equations for 3D volumes and surfaces, in cartesian, polar, or cylindrical coordinates. Topics include gradient, tangent, normal, divergence, curl, Green’s Theorem, Stokes’ Theorem, and Gauss’ Theorem." where lab_id = 101;
update tutorial_lab set introduction = "Experiment with DC circuits using resisters, capacitors, and diodes. Topics include parallel and series resistance and capacitance, Ohm’s law, and Kirchhoff’s law." where lab_id = 102;
update tutorial_lab set introduction = "Vary inclines, masses, and friction, while collecting and analyzing data on distance, time, and velocity. Topics include linear motion, collisions, and conservation of linear momentum." where lab_id = 103;
update tutorial_lab set introduction = "Light shining on metal causes the release of electrons which are detected as current. But the data broke Classical Physics theory about the behavior of light. The famous experiment that lead to the Nobel Prize for Einstein." where lab_id = 104;

select * from tutorial_lab;

