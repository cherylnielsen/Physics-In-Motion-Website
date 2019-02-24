<?php

// The functions and classes needed to interact with the database

// The function needed to connect to the database
require_once('db_access.php');

// The model classes for each of the database tables
require_once('model/Security_Question.php');
require_once('model/Member.php');
require_once('model/Administrator.php');
require_once('model/Professor.php');
require_once('model/Student.php');
require_once('model/Assignment.php');
require_once('model/Homework_Submission.php');
require_once('model/Homework.php');
require_once('model/NoticeToMember.php');
require_once('model/NoticeToSection.php');
require_once('model/Notice_Attachment.php');
require_once('model/Notice.php');
require_once('model/Quote.php');
require_once('model/Section_Student.php');
require_once('model/Section.php');
require_once('model/Section_Rating.php');
require_once('model/Tutorial_Lab.php');
require_once('model/Tutorial_Lab_Rating.php');


// The controller classes for each of the database tables
require_once('controller/DatabaseController.php');
require_once('controller/SecurityQuestionController.php');
require_once('controller/MemberController.php');
require_once('controller/AdministratorController.php');
require_once('controller/ProfessorController.php');
require_once('controller/StudentController.php');
require_once('controller/AssignmentController.php');
require_once('controller/HomeworkSubmissionController.php');
require_once('controller/HomeworkController.php');
require_once('controller/NoticeToMemberController.php');
require_once('controller/NoticeToSectionController.php');
require_once('controller/NoticeAttachmentController.php');
require_once('controller/NoticeController.php');
require_once('controller/QuoteController.php');
require_once('controller/SectionStudentController.php');
require_once('controller/SectionController.php');
require_once('controller/SectionRatingController.php');
require_once('controller/TutorialLabController.php');
require_once('controller/TutorialLabRatingController.php');


// The model classes for each of the database views
require_once('model/Tutorial_Lab_Rating_View.php');
require_once('model/Assignment_Full_View.php');
require_once('model/Notice_Full_View.php');
require_once('model/Section_Student_View.php');
require_once('model/Section_Professor_View.php');
require_once('model/Professor_Member_View.php');
require_once('model/Student_Member_View.php');
require_once('model/Administrator_Member_View.php');


// The controller classes for each of the database views
require_once('controller/Tutorial_Lab_Rating_View_Controller.php');
require_once('controller/Assignment_Full_View_Controller.php');
require_once('controller/Notice_Full_View_Controller.php');
require_once('controller/Section_Student_View_Controller.php');
require_once('controller/Section_Professor_View_Controller.php');
require_once('controller/Professor_Member_View_Controller.php');
require_once('controller/Student_Member_View_Controller.php');
require_once('controller/Administrator_Member_View_Controller.php');


?>
