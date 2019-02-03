/* initialize test data for the database */

use physics_in_motion;

/* ratings */
insert into lab_rating (rating_id, lab_id, user_id, date_posted, rating, comments)
values (1, 101, 5, "2018-02-05 12:00:00", 5, "This lab is great!"),
(2, 101, 4, "2018-02-05 14:00:00", 5, "My students and I think this lab is great!");

select * from lab_rating;

/* homework submission */
insert into homework_submission (assignment_id, student_id, date_submitted, points_earned, is_graded, total_time)
values (1, 1, "2018-02-04 22:00:00", 20, 1, 4),
(1, 2, "2018-02-04 23:00:00", 10, 1, 2);

select * from homework_submission;

