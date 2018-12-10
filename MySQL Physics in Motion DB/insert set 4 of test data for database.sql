/* initialize test data for the database */

use physics_in_motion;

/* admins */

insert into users (user_id, user_name, user_password, user_email, date_joined)
values (105, "a1name", "a1password", "a1email", "2018-09-01 12:0:0");

insert into administrator (admin_id, user_id, first_name, last_name, admin_type)
values (101, 105, "a1first", "a1last", "testing");


SELECT * FROM users;
SELECT * FROM administrator;