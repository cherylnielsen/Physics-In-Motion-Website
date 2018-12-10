<?php

require_once('../controller/Administrator_controller.php');
require_once('../controller/Assignment_controller.php');
require_once('../controller/Homework_controller.php');
require_once('../controller/Notice_controller.php');
require_once('../controller/Professor_controller.php');
require_once('../controller/Quote_controller.php');
require_once('../controller/Student_controller.php');
require_once('../controller/Tutorial_lab_controller.php');
require_once('../controller/Tutorial_lab_rating_controller.php');
require_once('../controller/Users_controller.php');


class DatabaseController
{
	Administrator_controller 	adminControl;
	Assignment_controller 		assignmentControl;
	Homework_controller 		homeworkControl;
	Notice_controller			noticeControl;
	Professor_controller 		professorControl;
	Quote_controller 			quoteControl;
	Student_controller			studentControl;
	Tutorial_lab_controller  	labControl;
	Tutorial_lab_rating_controller	ratingControl;
	Users_controller			userControl;
	
	
	function DatabaseController() 
	{
		adminControl = new Administrator_controller();
		assignmentControl  = new Assignment_controller();
		homeworkControl  = new Homework_controller();
		noticeControl  = new Notice_controller();
		professorControl  = new Professor_controller();
		quoteControl  = new Quote_controller();
		studentControl  = new Student_controller();
		labControl  = new Tutorial_lab_controller();
		ratingControl  = new Tutorial_lab_rating_controller();
		userControl  = new Users_controller();
	}
	
	
	
	
	
}

?>