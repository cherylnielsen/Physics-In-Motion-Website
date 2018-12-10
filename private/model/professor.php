<?php

class Professor {
	
	private $professor_id;
	private $user_id;
	private $first_name;
	private $last_name;
	private $school_type;
	private $school_name;
	
	public function Professor() {}
	
	public function Professor($professor_id, $user_id, $first_name, $last_name, $school_type, $school_name)
	{
		$this->professor_id = $professor_id
		$this->user_id = $user_id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->school_type = $school_type;
		$this->school_name = $school_name;
	}

	public function initialize($professor_id, $user_id, $first_name, $last_name, $school_type, $school_name)
	{
		$this->professor_id = $professor_id
		$this->user_id = $user_id;
		$this->first_name = $first_name;
		$this->last_name = $last_name;
		$this->school_type = $school_type;
		$this->school_name = $school_name;
	}
	
	public function get_professor_id()
	{
		return $this->professor_id;
	}

	public function set_professor_id($professor_id)
	{
		$this->professor_id = $professor_id;
	}
	
	public function get_user_id()
	{
		return $this->user_id;
	}

	public function set_user_id($user_id)
	{
		$this->user_id = $user_id;
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
	
	public function get_school_type()
	{
		return $this->school_type;
	}

	public function set_school_type($school_type)
	{
		$this->school_type = $school_type;
	}
	
	public function get_school_name()
	{
		return $this->school_name;
	}

	public function set_school_name($school_name)
	{
		$this->school_name = $school_name;
	}
	
	
}

?>