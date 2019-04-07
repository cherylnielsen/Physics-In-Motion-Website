/* initialize test data for the database */

use physics_in_motion;

/* ratings */
insert into tutorial_lab_rating (tutorial_lab_id, member_id, date_posted, rating, comments)
values 
(101, 1, "2018-02-05 12:00:00", 5, "This lab is great!"),
(101, 3, "2018-02-03 14:00:00", 5, "This lab is very good.");

insert into tutorial_lab_rating (tutorial_lab_id, member_id, date_posted, rating)
values (101, 2, "2018-02-05 12:00:00", 4);

select * from tutorial_lab_rating;

/* more ratings */
insert into tutorial_lab_rating (tutorial_lab_id, member_id, date_posted, rating, comments)
values 
(101, 5, "2018-02-05 12:00:00", 3, "It was ok.");

insert into tutorial_lab_rating (tutorial_lab_id, member_id, date_posted, rating)
values (102, 2, "2018-02-05 12:00:00", 4),
(102, 3, "2018-02-05 12:00:00", 3),
(102, 5, "2018-02-05 12:00:00", 4),
(102, 6, "2018-02-05 12:00:00", 5),
(105, 2, "2018-02-05 12:00:00", 2),
(105, 3, "2018-02-05 12:00:00", 4),
(105, 1, "2018-02-05 12:00:00", 5),
(106, 1, "2018-02-05 12:00:00", 5),
(106, 5, "2018-02-05 12:00:00", 3),
(106, 6, "2018-02-05 12:00:00", 4);

select * from tutorial_lab_rating;
