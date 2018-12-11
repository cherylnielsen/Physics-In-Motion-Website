<?php


require_once('controller/DatabaseController.php');

// The models for each data_type of the database tables
require_once('model/Users.php');
require_once('model/Student.php');
require_once('model/Professor.php');
require_once('model/Administrator.php');
require_once('model/Assignment.php');
require_once('model/Homework.php');
require_once('model/Notice.php');
require_once('model/Tutorial_lab.php');
require_once('model/Tutorial_lab_rating.php');
require_once('model/Quote.php');


// The controllers for each data_type of the database tables
require_once('controller/Users_controller.php');
require_once('controller/Student_controller.php');
require_once('controller/Professor_controller.php');
require_once('controller/Administrator_controller.php');
require_once('controller/Assignment_controller.php');
require_once('controller/Homework_controller.php');
require_once('controller/Notice_controller.php');
require_once('controller/Tutorial_lab_controller.php');
require_once('controller/Tutorial_lab_rating_controller.php');
require_once('controller/Quote_controller.php');


class MasterDatabaseController
{
	
	public function __construct() {}
	
	public function getController($data_type)
	{
		$data_type = strtolower(trim($data_type));
		$control;
		
		switch($data_type)
		{
			case "users" :
				$control = new Users_controller();
				break;
			case "student" :
				$control = new Student_controller();
				break;
			case "professor" :
				$control = new Professor_controller();
				break;
			case "administrator" :
				$control = new Administrator_controller();
				break;
			case "assignment" :
				$control = new Assignment_controller();
				break;
			case "homework" :
				$control = new Homework_controller();
				break;
			case "notice" :
				$control = new Notice_controller();
				break;
			case "tutorial_lab" :
				$control  = new Tutorial_lab_controller();
				break;
			case "tutorial_lab_rating" :
				$control = new Tutorial_lab_rating_controller();
				break;
			case "quote" :
				$control = new Quote_controller();
				break;
		}
		
		return $control;
		
	}
	
	
	public function get_by_id($id_number, $id_type, $data_type)
	{
		$attribute = strtolower(trim($attribute));
		$attribute_type = strtolower(trim($attribute_type));
		$data_type = strtolower(trim($data_type));
		
		$group_array = array();		
		$group_array[] = get_by_attribute($id_number, $id_type, $data_type);
		return $group_array;
	}
	
	
	public function get_by_attribute($attribute, $attribute_type, $data_type)
	{
		$attribute = strtolower(trim($attribute));
		$attribute_type = strtolower(trim($attribute_type));
		$data_type = strtolower(trim($data_type));
		
		$group_array = array();
		$control = getController($data_type);
		
		if(!is_null($control))
		{
			$group_array[] = control.get_group_by_attribute($id_number, $id_type, $data_type);
		}
		
		return $group_array;
	}
	
	
	public function get_all($data_type)
	{
		$data_type = strtolower(trim($data_type));
		$group_array = array();
		$control = getController($data_type);
		
		if(!is_null($control))
		{
			$group_array[] = control.get_all($data_type);
		}
		
		return $group_array;		
	}
	
	
	public function update($data_type)
	{
		$data_type = strtolower(trim($data_type));
		$control = getController($data_type);
		$status;
		
		if(!is_null($control))
		{
			$status = control.update($data_type);
		}
		
		return $status;		
	}
	
	
	public function save_new($data_type)
	{
		$data_type = strtolower(trim($data_type));
		$control = getController($data_type);
		$status;
		
		if(!is_null($control))
		{
			$status = control.save_new($data_type);
		}
		
		return $status;	
	}
	
	
	public function get_by_login($user_name, $user_password)
	{
		$user_name = strtolower(trim($user_name));
		$user_password = strtolower(trim($user_password));
		
		$user;
		$control = new Users_controller();
		$user = $control->get_by_login($user_name, $user_password);
				
		return $user;
	}
	
	
	public function get_quote_of_the_month()
	{
		$quote;
		$control = new Quote_controller();
		$quote = $control->get_quote_of_the_month();
		
		echo '<p>' . $quote->get_author() . '</p>';
		
		return $quote;
	}
	
	
}

?>