<?php

// The models for each of the database tables
require_once('model/Administrator.php');
require_once('model/Assignment.php');
require_once('model/Homework.php');
require_once('model/Homework_Submission.php');
require_once('model/Lab_Rating.php');
require_once('model/Notice.php');
require_once('model/Notice_Attachment.php');
require_once('model/Professor.php');
require_once('model/Quote.php');
require_once('model/Section.php');
require_once('model/Section_Student.php');
require_once('model/Student.php');
require_once('model/Tutorial_Lab.php');
require_once('model/Member.php');


// The controllers for each of the database tables
require_once('controller/DatabaseController.php');
require_once('controller/AdministratorController.php');
require_once('controller/AssignmentController.php');
require_once('controller/HomeworkController.php');
require_once('controller/HomeworkSubmissionController.php');
require_once('controller/LabRatingController.php');
require_once('controller/NoticeController.php');
require_once('controller/NoticeAttachmentController.php');
require_once('controller/ProfessorController.php');
require_once('controller/QuoteController.php');
require_once('controller/SectionController.php');
require_once('controller/SectionStudentController.php');
require_once('controller/StudentController.php');
require_once('controller/TutorialLabController.php');
require_once('controller/MemberController.php');


/***
Creates the desired type of database controller
***/
class DatabaseControllerFactory
{
	
	public function __construct() {}
	
	/***
	Creates the desired type of database controller
	Input: $data_type = the name of the type of database controller that is needed,
						and this is the same as the name of the database table to be accessed
	Output: $controller = the new database controller
	***/
	public function getController($data_type)
	{
		$controller = null;
		$data_type = trim($data_type);
		$data_type = strtolower($data_type);
		
		switch($data_type)
		{
			case "member" :
				$controller = new MemberController();
				break;
			case "student" :
				$controller = new StudentController();
				break;
			case "professor" :
				$controller = new ProfessorController();
				break;
			case "administrator" :
				$controller = new AdministratorController();
				break;
			case "assignment" :
				$controller = new AssignmentController();
				break;
			case "homework" :
				$controller = new HomeworkController();
				break;
			case "notice" :
				$controller = new NoticeController();
				break;
			case "notice_attachment" :
				$controller = new NoticeAttachmentController();
				break;
			case "tutorial_lab" :
				$controller  = new TutorialLabController();
				break;
			case "lab_rating" :
				$controller = new LabRatingController();
				break;
			case "quote" :
				$controller = new QuoteController();
				break;
			case "homework_submission" :
				$controller = new HomeworkSubmissionController();
				break;
			case "section" :
				$controller = new SectionController();
				break;
			case "section_student" :
				$controller = new SectionStudentController();
				break;
		}
		
		if(isset($controller))
		{
			$controller->setTableName($data_type);
		}
		
		return $controller;
	}
	
}


?>