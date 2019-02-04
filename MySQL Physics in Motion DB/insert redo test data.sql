/* initialize test data for the database */

use physics_in_motion;

/* quote of the month */
insert into quote (author, quote_text, month_posted, year_posted)
values 
("Anais Nin", "Life shrinks or expands in proportion to one's courage.", "3", "2019"),
("Neale Donald Walsch", "Life begins at the end of your comfort zone.", "4", "2019"),
("Unknown", "Life isn't about finding yourself. Life is about creating yourself.", "5", "2019");

select * from quote;


