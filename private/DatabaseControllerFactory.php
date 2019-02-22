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
			case "member" :
				$controller = new MemberController();
				break;
			case "full_member" :
				$controller = new Full_MemberController();
				break;
			case "security_question" :
				$controller = new SecurityQuestionController();
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
			case "homework_submission" :
				$controller = new HomeworkSubmissionController();
				break;
			case "full_homework" :
				$controller = new Full_HomeworkController();
				break;
			case "notice" :
				$controller = new NoticeController();
				break;
			case "full_notice" :
				$controller = new Full_NoticeController();
				break;
			case "notice_attachment" :
				$controller = new NoticeAttachmentController();
				break;
			case "notice_sent_to_member" :
				$controller = new NoticeSentToMemberController();
				break;
			case "notice_sent_to_section" :
				$controller = new NoticeSentToSectionController();
				break;
			case "tutorial_lab" :
				$controller  = new TutorialLabController();
				break;
			case "tutorial_lab_rating" :
				$controller = new LabRatingController();
				break;
			case "quote" :
				$controller = new QuoteController();
				break;
			case "section" :
				$controller = new SectionController();
				break;
			case "full_section" :
				$controller = new Full_SectionController();
				break;
			case "section_rating" :
				$controller = new SectionRatingController();
				break;
			case "section_student" :
				$controller = new SectionStudentController();
				break;
		}
		
		if(isset($controller))
		{
			$controller->setTableName($data_type);
			$controller->setPrimaryKeyName($data_type . "_id");
		}
		
		return $controller;
	}
	
}


?>