/* initialize test data for the database */

use physics_in_motion;
/* sections */

insert into sections (section_id, section_name, start_date, end_date)
values (101, "section 101", "2019-02-01", "2019-05-01"),
(102, "section 102", "2019-02-01", "2019-05-01"),
(103, "section 103", "2019-02-01", "2019-05-01");

SELECT * FROM sections;

insert into section_professors (section_id, user_id)
values (101, 1), (102, 1), (103, 2);

SELECT * FROM section_professors;

insert into section_students (section_id, user_id)
values (101, 3), (102, 3), 
(103, 3), (101, 4),
(102, 4), (103, 4),
(102, 5), (103, 5);

SELECT * FROM section_students;
