/* initialize test data for the database */

use physics_in_motion;

/* admins */

insert into users (user_id, user_name, user_password, user_type)
values (105, "a1name", "a1password", "administrator");

insert into administrator (admin_id, first_name, last_name, admin_type, email)
values (105, "a1first", "a1last", "a1type", "a1email");


SELECT * FROM users;
SELECT * FROM administrator;