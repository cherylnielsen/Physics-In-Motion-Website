<?php

class Member_Administrator extends Member_Wrapper {
	
	// the database administrator associated with the member_id
	private $administrator;
	
	public function get_administrator()
	{
		return $this->administrator;
	}

	public function set_administrator($administrator)
	{
		$this->administrator = $administrator;
	}
	
	
}

?>