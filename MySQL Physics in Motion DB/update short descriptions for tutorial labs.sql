use physics_in_motion;

/* tutorial labs */

update tutorial_lab set short_description = "Solve and graph equations for 3D volumes and surfaces, in cartesian, polar, or cylindrical coordinates. Topics include gradient, tangent, normal, divergence, curl, Green’s Theorem, Stokes’ Theorem, and Gauss’ Theorem." where lab_id = 101;

update tutorial_lab set short_description = "Experiment with DC circuits using resisters, capacitors, and diodes. Topics include parallel and series resistance and capacitance, Ohm’s law, and Kirchhoff’s law." where lab_id = 102;

update tutorial_lab set short_description = "Vary inclines, masses, and friction, while collecting and analyzing data on distance, time, and velocity. Topics include linear motion, collisions, and conservation of linear momentum." where lab_id = 103;

update tutorial_lab set short_description = "Light shining on metal causes the release of electrons which are detected as current. But the data broke Classical Physics theory about the behavior of light. The famous experiment that lead to the Nobel Prize for Einstein and the discovery of Quantum Physics." where lab_id = 104;

select * from tutorial_lab;