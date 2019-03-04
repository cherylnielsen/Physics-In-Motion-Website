<?php

class Security_Question {
	
	private $security_question_id;	
	private $member_id;	
	private $question;
	private $answer;
	
	public function __construct() {}
	
	public function initialize($security_question_id, $member_id, $question, $answer)
	{
		$this->security_question_id = $security_question_id;
		$this->member_id = $member_id;
		$this->question = $question;
		$this->answer = $answer;
	}
	
	
	public function get_security_question_id()
	{
		return $this->security_question_id;
	}

	public function set_security_question_id($security_question_id)
	{
		$this->security_question_id = $security_question_id;
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
