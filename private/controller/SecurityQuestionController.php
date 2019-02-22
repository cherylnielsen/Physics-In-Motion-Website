<?php



class SecurityQuestionController extends DatabaseController {

	
	public function __construct() {}
	//($security_question_id, $member_id, $question, $answer)
	
	
	protected function getData($db_result, $db_connection)
	{
		$dataArray = array();
		
		if($db_result)
		{
			while ($row = mysqli_fetch_array($db_result, MYSQLI_ASSOC))
			{
				$security_question = new Security_Question();
				$security_question->initialize($row['security_question_id'], $row['member_id'], $row['question'], $row['answer']);
				// pushes each object onto the end of the array
				$dataArray[] = $security_question;
			}
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}		
		
		return $dataArray;
	}


	// The id for security_question is auto-generated.
	public function saveNew(&$security_question)
	{
		$sucess = true;
		$db_connection = get_db_connection();
		$member_id = $security_question->get_member_id();
		$question = $security_question->get_question();
		$answer = $security_question->get_answer();
		$table = $this->getTableName();
		
		$query = "insert into $table (member_id, question, answer) 
				values('$member_id', '$question', '$answer')";
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		else
		{
			// get the newly generated member_id
			$security_question_id = mysqli_insert_id($db_connection);
			$security_question->set_security_question_id($security_question_id);
		}
		
		mysqli_free_result($result);	
		mysqli_close($db_connection);
		return $sucess;
	}
	
	
	// updates the given key with the new value in the database
	//($security_question_id, $member_id, $question, $answer)
	public function updateAttribute($security_question, $key)
	{
		$db_connection = get_db_connection();
		$success = true;
		$security_question_id = $security_question->get_security_question_id();	
		$query = null;
		$table = $this->getTableName();
		
		switch ($key)
		{
			case 'security_question_id':
				return false;
				break;
			case 'member_id':
				$value = $security_question->get_member_id();	
				$query = "update $table set member_id = '$value' where security_question_id = '$security_question_id'";
				break;
			case 'question':
				$value = $security_question->get_question();	
				$query = "update $table set question = '$value' where security_question_id = '$security_question_id'";
				break;
			case 'answer':
				$value = $security_question->get_answer();	
				$query = "update $table set answer = '$value' where security_question_id = '$security_question_id'";
				break;
		}
		
		$result = mysqli_query($db_connection, $query);

		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}

		mysqli_close($db_connection);
		return $success;		
	}


	public function deleteFromDatabase($security_question)
	{
		$db_connection = get_db_connection();
		$success = true;
		$security_question_id = $security_question->get_security_question_id();
		$member_id = $security_question->get_member_id();
		$question = $security_question->get_question();
		$answer = $security_question->get_answer();
		$table = $this->getTableName();
		
		$query = "delete from $table where security_question_id = $security_question_id";
		
		if(!$result)
		{
			$success = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
		}
		
		mysqli_close($db_connection);
		return $success;
	}
	

}

?>