/* initialize test data for the database */

use physics_in_motion;

insert into member (member_id, member_type, member_name, member_password, date_registered, first_name, last_name, email)
values (1, 'Professor', 'P1username', '$2y$10$yWJzq7UQkVbqmSKBKI7dbeMdV9H/At4bipJbBqdI9GSM4kD.tHiA.', '2019-02-05 06:17:29', 'P1first', 'P1last', 'p1@p1.p1'),
(2, 'Student', 'S2username', '$2y$10$pl2TnpEJ4zmCeHNYbqgxou.7iPtwkAXbVvkawVbfOSQk8/fjtZYJC', '2019-02-05 06:18:40', 'S2first', 'S2last', 's2@s2.s2'),
(3, 'Student', 'S3username', '$2y$10$Ob1hi3ULjEyxMcIj0Bfqo.6ZhXh4P4uxp2iIpshCNN6SHhGM1WcWG', '2019-02-05 06:19:38', 'S3first', 'S3last', 's3@s3.s3'),
(4, 'Administrator', 'A4username', '$2y$10$yWJzq7UQkVbqmSKBKI7dbeMdV9H/At4bipJbBqdI9GSM4kD.tHiA.', '2019-02-05 06:17:29', 'A4first', 'A4last', 'a4@a4.a4');

insert into professor (member_id, school_name)
values (1, 'P1school');

insert into student (member_id, school_name)
values (2, 'S2school'), (3, 'S3school');
 
insert into administrator (member_id, admin_type)
values (4, 'General');

select * from professor;
select * from professor;
select * from student;
select * from member;
