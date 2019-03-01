/* initialize test data for the database */

use physics_in_motion;
/* sections */

insert into notice (notice_id, from_member_id, response_to_notice_id, date_sent, notice_subject, notice_text)
values (1, 1, null, "2019-02-04 14:00:00", "subject 1", "notice text 1 more text and text"),
(2, 1, null, "2019-02-04 15:00:00", "subject 2", "notice text 2 more text and text"),
(3, 2, 1, "2019-02-04 16:00:00", "subject 1", "notice text 3 more text and text"),
(4, 3, 2, "2019-02-05 14:00:00", "subject 2", "notice text 5 more text and text"),
(5, 1, null, "2019-02-05 15:00:00", "subject 3", "notice text 6 more text and text"),
(6, 4, 5, "2019-02-05 15:00:00", "subject 3", "notice text 6 more text and text");

SELECT * FROM notice;

insert into notice_attachment (notice_attachment_id, notice_id, attachment)
values (1, 1, "notice 1 attachment"), (2, 2, "notice 2 attachment"), (3, 5, "notice 5 attachment");

SELECT * FROM notice_attachment;

insert into notice_to_member (notice_id, to_member_id)
values (5, 4), (6, 1);

SELECT * FROM notice_to_member;

insert into notice_to_section (notice_id, to_section_id)
values (1, 101), (2, 101), (3, 101), (4, 101);

SELECT * FROM notice_to_section;

