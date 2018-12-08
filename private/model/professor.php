<?php

class professor {
	
	private $professor_id;
	private $first_name;
	private $last_name;
	private $school;
	private $user_name;
	private $password;
	private $email;
	
	public function professor() {}
	
	public function professor($professor_id, $first_name, $last_name, $school, $user_name, $password, $email)
	{
		$this->professor_id = $professor_id
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->school = $school;
		$this->user_name = $user_name;
		$this->password = $password;
		$this->email = $email;
	}

	public function initialize($professor_id, $first_name, $last_name, $school, $user_name, $password, $email)
	{
		$this->professor_id = $professor_id
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->school = $school;
		$this->user_name = $user_name;
		$this->password = $password;
		$this->email = $email;
	}
	
	public function get_professor_id()
	{
		return $this->professor_id;
	}

	public function set_professor_id($professor_id)
	{
		$this->professor_id = $professor_id;
	}
	
	public function get_first_name()
	{
		return $this->first_name;
	}

	public function set_first_name($first_name)
	{
		$this->first_name = $first_name;
	}
	
	public function get_last_name()
	{
		return $this->last_name;
	}

	public function set_last_name($last_name)
	{
		$this->last_name = $last_name;
	}
	
	public function get_school()
	{
		return $this->school;
	}

	public function set_school($school)
	{
		$this->school = $school;
	}
	
	public function get_user_name()
	{
		return $this->user_name;
	}

	public function set_user_name($user_name)
	{
		$this->user_name = $user_name;
	}
	
	public function get_password()
	{
		return $this->password;
	}

	public function set_password($password)
	{
		$this->password = $password;
	}
	
	public function get_email()
	{
		return $this->email;
	}

	public function set_email($email)
	{
		$this->email = $email;
	}
	
	
}

?>