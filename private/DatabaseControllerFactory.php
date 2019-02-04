<?php

// The models for each of the database tables
require_once('model/Administrator.php');
require_once('model/Assignment.php');
require_once('model/Homework.php');
require_once('model/Homework_Submission.php');
require_once('model/Lab_Rating.php');
require_once('model/Notice.php');
require_once('model/Professor.php');
require_once('model/Quote.php');
require_once('model/Sections.php');
require_once('model/Section_Students.php');
require_once('model/Section_Professors.php');
require_once('model/Student.php');
require_once('model/Tutorial_Lab.php');
require_once('model/Users.php');


// The controllers for each of the database tables
require_once('controller/DatabaseController.php');
require_once('controller/AdministratorController.php');
require_once('controller/AssignmentController.php');
require_once('controller/HomeworkController.php');
require_once('controller/HomeworkSubmissionController.php');
require_once('controller/LabRatingController.php');
require_once('controller/NoticeController.php');
require_once('controller/ProfessorController.php');
require_once('controller/QuoteController.php');
require_once('controller/SectionsController.php');
require_once('controller/SectionStudentsController.php');
require_once('controller/SectionProfessorsController.php');
require_once('controller/StudentController.php');
require_once('controller/TutorialLabController.php');
require_once('controller/UsersController.php');


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
			case "sections" :
				$controller = new SectionsController();
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