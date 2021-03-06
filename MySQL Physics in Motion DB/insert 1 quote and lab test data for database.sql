/* initialize test data for the database */

use physics_in_motion;

/* quote of the month */
insert into quote (author, quote_text, month_posted, year_posted)
values ("Les Brown", "Shoot for the Moon. Even if you miss, you'll land among the stars.", "12", "2018"),
("Eleanor Roosevelt", "The future belongs to those who beleive in the beauty of their dreams.", "01", "2019"),
("Vivian Greene", "Life isn't about waiting for the storm to pass. It's about learning how to dance in the rain.", "02", "2019"),
("Anais Nin", "Life shrinks or expands in proportion to one's courage.", "3", "2019"),
("Neale Donald Walsch", "Life begins at the end of your comfort zone.", "4", "2019"),
("Unknown", "Life isn't about finding yourself. Life is about creating yourself.", "5", "2019");

select * from quote;


/* tutorial labs */
insert into tutorial_lab (tutorial_lab_id, tutorial_lab_name, tutorial_lab_web_link, lab_status, filepath)
values 
(101, "Vector Calculus of 3D Volumes and Surfaces", "vector_calc_3d_volumes_surfaces", 
				"New", "tutorial_lab/id_101"),
(102, "Beginning RC Circuits", "begin_rc_circuit", "New", "tutorial_lab/id_102"),
(103, "Linear Motion and Collisions", "linear_motion_collision", "Development", "tutorial_lab/id_103"), 
(104, "The Photoelectric Effect from Quantum Physics", "photoelectric_effect_quantum_physics", 
				"Development", "tutorial_lab/id_104");

update tutorial_lab 
set tutorial_lab_introduction = "Solve and graph equations for 3D volumes and surfaces, in cartesian, polar, 
								or cylindrical coordinates. Topics include gradient, tangent, normal, divergence, 
                                curl, Green’s Theorem, Stokes’ Theorem, and Gauss’ Theorem." 
where tutorial_lab_id = 101;

update tutorial_lab 
set tutorial_lab_introduction = "Experiment with DC circuits using resisters, capacitors, and diodes. Topics include 
									parallel and series resistance and capacitance, Ohm’s law, and Kirchhoff’s law." 
where tutorial_lab_id = 102;

update tutorial_lab 
set tutorial_lab_introduction = "Vary inclines, masses, and friction, while collecting and analyzing data on distance, 
					time, and velocity. Topics include linear motion, collisions, and conservation of linear momentum." 
where tutorial_lab_id = 103;

update tutorial_lab 
set tutorial_lab_introduction = "Light shining on metal causes the release of electrons which are detected as current. 
					But the data broke Classical Physics theory about the behavior of light. The famous experiment that 
                    lead to the Nobel Prize for Einstein." 
where tutorial_lab_id = 104;

/* more tutorial labs */
insert into tutorial_lab (tutorial_lab_id, tutorial_lab_name, tutorial_lab_web_link, lab_status, filepath)
values 
(105, "Discrete Mathematics", "discrete_math", "Development", "tutorial_lab/id_105"),
(106, "Beginning Orbital Trajectories", "begin_oribits", "Development", "tutorial_lab/id_106"),
(107, "2D and 3D Collisions", "2D_3D_collisions", "Development", "tutorial_lab/id_107"), 
(108, "Beginning Springs and Pendulums", "begin_spring_pendulum", "Development", "tutorial_lab/id_108");

update tutorial_lab 
set tutorial_lab_introduction = "Learn Discrete Mathematics." 
where tutorial_lab_id = 105;

update tutorial_lab 
set tutorial_lab_introduction = "Learn Beginning Orbital Trajectories." 
where tutorial_lab_id = 106;

update tutorial_lab 
set tutorial_lab_introduction = "Learn 2D and 3D Collisions." 
where tutorial_lab_id = 107;

update tutorial_lab 
set tutorial_lab_introduction = "Learn Beginning Springs and Pendulums." 
where tutorial_lab_id = 108;

select * from tutorial_lab;

