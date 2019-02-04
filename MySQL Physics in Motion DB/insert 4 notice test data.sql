/* initialize test data for the database */

use physics_in_motion;
/* sections */

insert into notice (to_user_id, from_user_id, date_sent, notice_subject, notice_text)
values ( 1, 3, "2019-02-04", "subject 1", "notice text 1 from p to s"),
(1, 4, "2019-02-04", "subject 2", "notice text 2 from p to s"),
(1, 3, "2019-02-04", "subject 3", "notice text 3 from p to s"),
(3, 4, "2019-02-04", "subject 4", "notice text 4 from s to s"),
(4, 1, "2019-02-04", "subject 5", "notice text 5 from s to p"),
(3, 1, "2019-02-04", "subject 6", "notice text 6 from s to p"),
(2, 1, "2019-02-04", "subject 7", "notice text 7 from p to p");

SELECT * FROM notice;
