/* initialize test data for the database */

use physics_in_motion;

/* assignment & notice attachments */
update assignment_attachment set filepath = "attachments/assignment/2019/id_1" where assignment_attachment_id = 1;
update assignment_attachment set filepath = "attachments/assignment/2019/id_1" where assignment_attachment_id = 2;
update assignment_attachment set filepath = "attachments/assignment/2019/id_2" where assignment_attachment_id = 3;
update assignment_attachment set filepath = "attachments/assignment/2019/id_7" where assignment_attachment_id = 5;
update assignment_attachment set filepath = "attachments/assignment/2019/id_8" where assignment_attachment_id = 6;
update assignment_attachment set filepath = "attachments/assignment/2019/id_11" where assignment_attachment_id = 7;

select * from assignment_attachment;

update notice_attachment set filepath = "attachments/notice/2019/id_1" where notice_attachment_id = 1;
update notice_attachment set filepath = "attachments/notice/2019/id_2" where notice_attachment_id = 2;
update notice_attachment set filepath = "attachments/notice/2019/id_5" where notice_attachment_id = 3;

select * from notice_attachment;
