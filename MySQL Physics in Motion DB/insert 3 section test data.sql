/* initialize test data for the database */

use physics_in_motion;
/* sections */

insert into section (section_id, professor_id, section_name, start_date, end_date)
values (101, 1, "section 101 name", "2019-02-01", "2019-05-01"),
(102, 1, "section 102 name", "2019-02-01", "2019-05-01");

SELECT * FROM section;

insert into section_student (section_id, student_id)
values (101, 2), (102, 2), 
(101, 3), (102, 3);

SELECT * FROM section_student;
