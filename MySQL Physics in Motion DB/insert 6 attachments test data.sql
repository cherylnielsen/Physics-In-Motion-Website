/* initialize test data for the database */

use physics_in_motion;

insert into assignment_attachment (assignment_attachment_id, assignment_id, filename, filepath)
values (1, 1, "first_attachment.txt", "attachments/assignment/2019/id_1"), 
(2, 1, "second_attachment.txt", "attachments/assignment/2019/id_1"), 
(3, 2, "the_attachment.txt", "attachments/assignment/2019/id_2");

SELECT * FROM assignment_attachment;

insert into notice_attachment (notice_attachment_id, notice_id, filename, filepath)
values (1, 1, "notice_1_attachment.txt", "attachments/notice/2019/id_1"), 
(2, 2, "notice_2_attachment.txt", "attachments/notice/2019/id_2"), 
(3, 5, "notice_5_attachment.txt", "attachments/notice/2019/id_5");

SELECT * FROM notice_attachment;