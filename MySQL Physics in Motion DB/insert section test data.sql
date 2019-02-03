/* initialize test data for the database */

use physics_in_motion;
/* sections */

insert into sections (section_id, section_name, start_date, end_date)
values (101, "section 101", "2019-02-01", "2019-05-01"),
(102, "section 102", "2019-02-01", "2019-05-01"),
(103, "section 103", "2019-02-01", "2019-05-01"),
(104, "section 104", "2019-02-01", "2019-05-01");

insert into section_students (section_id, student_id)
values (101, 1), (101, 2),
(102, 2), (102, 3),
(103, 1), (103, 2),
(104, 2), (104, 3);

insert into section_professors (section_id, professor_id)
values (101, 2), (102, 2), (103, 3), (104, 3);

SELECT * FROM sections;
SELECT * FROM section_students;
SELECT * FROM section_professors;


