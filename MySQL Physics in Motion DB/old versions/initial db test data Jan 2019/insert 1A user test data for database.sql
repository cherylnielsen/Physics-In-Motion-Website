/* initialize test data for the database */

use physics_in_motion;

insert into member (member_id, member_type, member_name, member_password, date_registered)
values (1, 'professor', 'P1username', '$2y$10$yWJzq7UQkVbqmSKBKI7dbeMdV9H/At4bipJbBqdI9GSM4kD.tHiA.', '2019-02-05 06:17:29'),
(2, 'student', 'S2username', '$2y$10$pl2TnpEJ4zmCeHNYbqgxou.7iPtwkAXbVvkawVbfOSQk8/fjtZYJC', '2019-02-05 06:18:40'),
(3, 'student', 'S3username', '$2y$10$Ob1hi3ULjEyxMcIj0Bfqo.6ZhXh4P4uxp2iIpshCNN6SHhGM1WcWG', '2019-02-05 06:19:38');

insert into professor (member_id, first_name, last_name, school_name, email)
values (1, 'P1first', 'P1last', 'P1school', 'p1@p1.p1');

insert into student (member_id, first_name, last_name, school_name, email)
values (2, 'S2first', 'S2last', 'S2school', 's2@s2.s2'), 
(3, 'S3first', 'S3last', 'S3school', 's3@s3.s3');
 

select * from professor;
select * from student;
select * from member;
