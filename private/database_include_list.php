<?php

// The functions and classes needed to interact with the database

// The function needed to connect to the database
require_once('db_access.php');

// The model classes for each of the database tables
require_once('db_model/Administrator.php');
require_once('db_model/Assignment.php');
require_once('db_model/Homework.php');
require_once('db_model/Assignment_Attachment.php');
require_once('db_model/Member.php');
require_once('db_model/Notice.php');
require_once('db_model/NoticeToMember.php');
require_once('db_model/NoticeToSection.php');
require_once('db_model/Notice_Attachment.php');
require_once('db_model/Professor.php');
require_once('db_model/Quote.php');
require_once('db_model/Section.php');
require_once('db_model/Section_Rating.php');
require_once('db_model/Section_Student.php');
require_once('db_model/Security_Question.php');
require_once('db_model/Student.php');
require_once('db_model/Tutorial_Lab.php');
require_once('db_model/Tutorial_Lab_Rating.php');

// The parent controller class for the database tables and views
require_once('DatabaseController.php');

// The controller classes for each of the database tables
require_once('db_controller/AdministratorController.php');
require_once('db_controller/AssignmentController.php');
require_once('db_controller/AssignmentAttachmentController.php');
require_once('db_controller/HomeworkController.php');
require_once('db_controller/MemberController.php');
require_once('db_controller/NoticeController.php');
require_once('db_controller/NoticeAttachmentController.php');
require_once('db_controller/NoticeToMemberController.php');
require_once('db_controller/NoticeToSectionController.php');
require_once('db_controller/ProfessorController.php');
require_once('db_controller/QuoteController.php');
require_once('db_controller/SectionController.php');
require_once('db_controller/SectionStudentController.php');
require_once('db_controller/SectionRatingController.php');
require_once('db_controller/SecurityQuestionController.php');
require_once('db_controller/StudentController.php');
require_once('db_controller/TutorialLabController.php');
require_once('db_controller/TutorialLabRatingController.php');


// The model classes for each of the database views
require_once('db_model/Administrator_Member_View.php');
require_once('db_model/Assignment_View.php');
require_once('db_model/Homework_View.php');
require_once('db_model/Notice_View.php');
require_once('db_model/Professor_Member_View.php');
require_once('db_model/Section_Students_View.php');
require_once('db_model/Section_View.php');
require_once('db_model/Section_Rating_View.php');
require_once('db_model/Student_Member_View.php');
require_once('db_model/Tutorial_Lab_Rating_View.php');


// The controller classes for each of the database views
require_once('db_controller/Administrator_Member_View_Controller.php');
require_once('db_controller/Assignment_View_Controller.php');
require_once('db_controller/Homework_View_Controller.php');
require_once('db_controller/Notice_View_Controller.php');
require_once('db_controller/Professor_Member_View_Controller.php');
require_once('db_controller/Section_Students_View_Controller.php');
require_once('db_controller/Section_Rating_View_Controller.php');
require_once('db_controller/Section_View_Controller.php');
require_once('db_controller/Student_Member_View_Controller.php');
require_once('db_controller/Tutorial_Lab_Rating_View_Controller.php');


?>
