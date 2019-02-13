/* initialize test data for the database */

use physics_in_motion;
/* sections */

insert into notice (notice_id, from_member_id, date_sent, notice_subject, notice_text, sent_high_priority)
values (1, 1, "2019-02-04 14:00:00", "subject 1", "notice text 1 more notice text 1 and then text", false),
(2, 1, "2019-02-04 15:00:00", "subject 2", "notice text 2 more notice text 2 and then text", true),
(3, 2, "2019-02-04 16:00:00", "subject 1", "notice text 3 more notice text 3 and then text", false),
(4, 2, "2019-02-04 17:00:00", "subject 2", "notice text 4 more notice text 4 and then text", false),
(5, 3, "2019-02-05 14:00:00", "subject 2", "notice text 5 more notice text 5 and then text", true),
(6, 3, "2019-02-05 15:00:00", "subject 3", "notice text 6 more notice text 6 and then text", false),
(7, 1, "2019-02-05 16:00:00", "subject 3", "notice text 7 more notice text 7 and then text", false);

SELECT * FROM notice;

insert into notice_attachment (notice_attachment_id, notice_id, attachment)
values (1, 1, "notice 1 attachment"),
(2, 1, "notice 1 attachment"),
(3, 2, "notice 2 attachment");

SELECT * FROM notice_attachment;

insert into notice_received (notice_id, to_member_id)
values (1, 2), (1, 3),
(2, 2), (2, 3),
(3, 1), (3, 3),
(4, 1), (4, 3),
(5, 1), (5, 2),
(6, 1), (6, 2),
(7, 2), (7, 3);

SELECT * FROM notice_received;
