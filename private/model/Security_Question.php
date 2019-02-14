<?php

class Security_Question {
	
	private $member_id;	// key
	private $question;
	private $answer;
	
	public function __construct() {}
	
	public function initialize($member_id, $question, $answer)
	{
		$this->member_id = $member_id;
		$this->question = $question;
		$this->answer = $answer;
	}
	
	public function get_member_id()
	{
		return $this->member_id;
	}

	public function set_member_id($member_id)
	{
		$this->member_id = $member_id;
	}
	
	public function get_question()
	{
		return $this->question;
	}

	public function set_question($question)
	{
		$this->question = $question;
	}
	
	public function get_answer()
	{
		return $this->answer;
	}

	public function set_answer($answer)
	{
		$this->answer = $answer;
	}
	
	
}

?>
