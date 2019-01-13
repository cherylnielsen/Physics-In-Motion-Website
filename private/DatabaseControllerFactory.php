<?php

// The controllers for each data_type of the database tables
require_once('controller/UsersController.php');
require_once('controller/StudentController.php');
require_once('controller/ProfessorController.php');
require_once('controller/AdministratorController.php');
require_once('controller/AssignmentController.php');
require_once('controller/HomeworkController.php');
require_once('controller/NoticeController.php');
require_once('controller/TutorialLabController.php');
require_once('controller/LabRatingController.php');
require_once('controller/QuoteController.php');


// these controllers still have to be made
// The models for each data_type of the database tables where new controllers are required
require_once('model/Homework_Submission.php');
require_once('controller/DatabaseController.php');
require_once('controller/HomeworkSubmissionController.php');

require_once('model/Section.php');
require_once('controller/DatabaseController.php');
require_once('controller/SectionController.php');

require_once('model/Section_Professors.php');
require_once('controller/DatabaseController.php');
require_once('controller/SectionProfessorsController.php');

require_once('model/Section_Students.php');
require_once('controller/DatabaseController.php');
require_once('controller/SectionStudentsController.php');




class DatabaseControllerFactory
{
	
	public function __construct() {}
	
	
	public function getController($data_type)
	{
		$controller;
		$data_type = trim($data_type);
		$data_type = strtolower($data_type);
		
		switch($data_type)
		{
			case "users" :
				$controller = new UsersController();
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
			case "section_professors" :
				$controller = new SectionProfessorsController();
				break;
			case "section_students" :
				$controller = new SectionStudentsController();
				break;
		}
		
		$controller->initialize();
		
		return $controller;
	}
	
}


?>