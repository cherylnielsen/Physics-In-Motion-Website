/* initialize test data for the database */

use physics_in_motion;
/* sections */

insert into notice (notice_id, from_member_id, date_sent, notice_subject, notice_text, sent_high_priority)
values (1, 1, "2019-02-04 14:00:00", "subject 1", "notice text 1 more text and text", false),
(2, 1, "2019-02-04 15:00:00", "subject 2", "notice text 2 more text and text", true),
(3, 2, "2019-02-04 16:00:00", "subject 1", "notice text 3 more text and text", false),
(4, 3, "2019-02-05 14:00:00", "subject 2", "notice text 5 more text and text", true),
(5, 3, "2019-02-05 15:00:00", "subject 3", "notice text 6 more text and text", false);

SELECT * FROM notice;

insert into notice_attachment (notice_attachment_id, notice_id, attachment)
values (1, 1, "notice 1 attachment"), (2, 2, "notice 2 attachment");

SELECT * FROM notice_attachment;

insert into notice_sent_to_member (notice_id, to_member_id, flag_read)
values (1, 2, true), (1, 3, true),
(2, 2, true), (2, 3, true),
(3, 1, true), (3, 3, true),
(4, 1, true), (4, 2, true),
(5, 1, false), (5, 2, false);

SELECT * FROM notice_sent_to_member;

insert into notice_sent_to_section (notice_id, to_section_id)
values (1, 101), (2, 101), (3, 101), (4, 101), (5, 101);

SELECT * FROM notice_sent_to_section;

