<?php

class Member_Professor extends Member_Wrapper {
	
	// the database professor associated with the member_id
	private $professor;
	
	public function get_professor()
	{
		return $this->professor;
	}

	public function set_professor($professor)
	{
		$this->professor = $professor;
	}
	
	
}

?>