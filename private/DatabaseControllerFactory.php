<?php

// The functions and classes needed to interact with the database
require_once('database_include_list.php');


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
			case "administrator" :
				$controller = new AdministratorController();
				break;
			case "administrator_member_view" :
				$controller = new Administrator_Member_View_Controller();
				break;	
			case "assignment" :
				$controller = new AssignmentController();
				break;	
			case "assignment_attachment":
				$controller = new AssignmentAttachmentController();
				break;
			case "assignment_view" :
				$controller = new Assignment_View_Controller();
				break;					
			case "homework" :
				$controller = new HomeworkController();
				break;
			case "homework_view" :
				$controller = new Homework_View_Controller();
				break;	
			case "member" :
				$controller = new MemberController();
				break;				
			case "notice" :
				$controller = new NoticeController();
				break;
			case "notice_attachment" :
				$controller = new NoticeAttachmentController();
				break;
			case "notice_to_member" :
				$controller = new NoticeToMemberController();
				break;
			case "notice_to_section" :
				$controller = new NoticeToSectionController();
				break;
			case "notice_view" :
				$controller = new Notice_View_Controller();
				break;			
			case "professor" :
				$controller = new ProfessorController();
				break;
			case "professor_member_view" :
				$controller = new Professor_Member_View_Controller();
				break;
			case "quote" :
				$controller = new QuoteController();
				break;					
			case "section" :
				$controller = new SectionController();
				break;
			case "section_rating" :
				$controller = new SectionRatingController();
				break;	
			case "section_student" :
				$controller = new SectionStudentController();
				break;	
			case "section_students_view" :
				$controller = new Section_Students_View_Controller();
				break;	
			case "section_rating_view" :
				$controller = new Section_Rating_View_Controller();
				break;
			case "section_view" :
				$controller = new Section_View_Controller();
				break;				
			case "security_question" :
				$controller = new SecurityQuestionController();
				break;
			case "student" :
				$controller = new StudentController();
				break;			
			case "student_member_view" :
				$controller = new Student_Member_View_Controller();
				break;					
			case "tutorial_lab" :
				$controller  = new TutorialLabController();
				break;
			case "tutorial_lab_rating" :
				$controller = new TutorialLabRatingController();
				break;
			case "tutorial_lab_rating_view" :
				$controller = new Tutorial_Lab_Rating_View_Controller();
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