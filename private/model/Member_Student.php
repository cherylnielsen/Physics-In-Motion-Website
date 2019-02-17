<?php

class Member_Student extends Member_Wrapper {
	
	// the database student associated with the member_id
	private $student;
	
	public function get_student()
	{
		return $this->student;
	}

	public function set_student($student)
	{
		$this->student = $student;
	}
	
	
}

?>