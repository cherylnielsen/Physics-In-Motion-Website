/* initialize test data for the database */

use physics_in_motion;

insert into member (member_id, member_type, member_name, member_password, date_registered, first_name, last_name, email, registration_complete)
values (1, 'professor', 'P1username', '$2y$10$yWJzq7UQkVbqmSKBKI7dbeMdV9H/At4bipJbBqdI9GSM4kD.tHiA.', '2019-02-05 06:17:29', 'P1first', 'P1last', 'p1@p1.p1', true),
(2, 'student', 'S2username', '$2y$10$pl2TnpEJ4zmCeHNYbqgxou.7iPtwkAXbVvkawVbfOSQk8/fjtZYJC', '2019-02-05 06:18:40', 'S2first', 'S2last', 's2@s2.s2', true),
(3, 'student', 'S3username', '$2y$10$Ob1hi3ULjEyxMcIj0Bfqo.6ZhXh4P4uxp2iIpshCNN6SHhGM1WcWG', '2019-02-05 06:19:38', 'S3first', 'S3last', 's3@s3.s3', true),
(4, 'administrator', 'A1username', '$2y$10$Ye/XesPzLc3Ul4vBd5NwYepSgcUBpDR8J52YBok.G7MkyaFVfHuBe', '2019-02-05 06:17:29', 'A1first', 'A1last', 'a1@a1.a1', true);

insert into professor (professor_id, school_name)
values (1, 'P1school');

insert into student (student_id, school_name)
values (2, 'S2school'), (3, 'S3school');
 
insert into administrator (administrator_id, admin_type)
values (4, 'general');

select * from professor;
select * from professor;
select * from student;
select * from member;
