/* initialize test data for the database */

use physics_in_motion;

/* notices */

insert into notice (notice_id, assignment_id, notice_type, date_sent, notice_text)
values (101, 101, "assignment", "2018-11-26 09:0:0", "You have an assignment due ...");

insert into notice (assignment_id, notice_type, date_sent, notice_text)
values (101, "reminder", "2018-11-27 11:0:0", "Assignment ... is due tomorrow."), 
(101, "completed", "2018-11-28 20:0:0", "S1 has completed tutorial lab ...");

insert into notice (assignment_id, notice_type, date_sent, notice_text)
values (102, "assignment", "2018-11-30 09:0:0", "You have an assignment due ..."),
(102, "reminder", "2018-12-04 11:0:0", "Assignment ... is due tomorrow."), 
(102, "overdue", "2018-12-06 01:0:0", "Assignment ... is late.");

insert into notice (assignment_id, notice_type, date_sent, notice_text)
values (103, "assignment", "2018-12-07 09:0:0", "You have an assignment due ...");

SELECT * FROM notice;