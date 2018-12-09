<?php

require_once('../database-access.php');
require_once('../model/homework.php');

class homework_controller {

	public function homework_controller() {}
	//($homework_id, $lab_summary, $lab_data, $lab_graphs, $lab_math, $lab_errors, $chat_session, $lab_report, $date_time_started, $date_time_paused, $date_time_submited, $total_time)


	public function get_homework_by_id($homework_id)
	{
		$homework = new homework();
		$query = 'select * from homework where lab_id = $lab_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$homework->initialize($row['homework_id'], $row['lab_summary'], $row['lab_data'], $row['lab_graphs'], 
				$row['lab_math'], $row['lab_errors'], $row['chat_session'], $row['lab_report'], 
				$row['date_time_started'], $row['date_time_paused'], $row['date_time_submited'], $row['total_time']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			$homework = null;
		}

		mysqli_close($db_connection);
		return homework;

	}
	
	
	public function get_homework_by_assignment_id($assignment_id)
	{
		$homework = new homework();
		$query = 'select * from homework where lab_id = $lab_id';
		$query = 'select * from homework where homework_id in 
					(select homework_id from assignment where assignment_id = $assignment_id);';
		
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			while ($row = mysqli_fetch_array($result, MYSQLI_ASSOC))
			{
				$homework->initialize($row['homework_id'], $row['lab_summary'], $row['lab_data'], $row['lab_graphs'], 
				$row['lab_math'], $row['lab_errors'], $row['chat_session'], $row['lab_report'], 
				$row['date_time_started'], $row['date_time_paused'], $row['date_time_submited'], $row['total_time']);
			}
			mysqli_free_result($result);		
		}
		else
		{
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			$homework = null;
		}

		mysqli_close($db_connection);
		return homework;

	}
	

	public function update_homework_times($date_time_started, $date_time_paused, $date_time_submited, $total_time)
	{
		$sucess = true;
		
		$query = 'update homework set date_time_started = $date_time_started, date_time_paused = $date_time_paused, date_time_submited = $date_time_submited, total_time = $total_time
					where homework_id = $homework_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The homework could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}


	public function update_homework_work($lab_data, $lab_graphs, $lab_math, $lab_errors, $chat_session,)
	{
		$sucess = true;
		
		$query = 'update homework set lab_data = $lab_data, lab_graphs = $lab_graphs, lab_math = $lab_math, 
					lab_errors = $lab_errors, chat_session = $chat_session
					where homework_id = $homework_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The homework could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}
	
	
	public function update_homework_reports($lab_summary, $lab_report)
	{
		$sucess = true;
		// The lab_id should not be changed.
		$query = 'update homework set lab_summary = $lab_summary, lab_report = $lab_report
					where homework_id = $homework_id';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{ 
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>The homework could not be updated.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;

	}
	
	
	public function save_new_homework_long($homework_id, $lab_summary, $lab_data, $lab_graphs, $lab_math, $lab_errors, $chat_session, $lab_report, $date_time_started, $date_time_paused, $date_time_submited, $total_time)
	{
		$sucess = true;
		// The lab_id is not included, because it is set automatically by the database.
		$query = 'insert into homework (homework_id, lab_summary, lab_data, lab_graphs, lab_math, lab_errors, chat_session, lab_report, date_time_started, date_time_paused, date_time_submited, total_time) 
		values ($homework_id, $lab_summary, $lab_data, $lab_graphs, $lab_math, $lab_errors, $chat_session, $lab_report, $date_time_started, $date_time_paused, $date_time_submited, $total_time)';
		$result = mysqli_query($db_connection, $query);

		if($result)
		{
			mysqli_free_result($result);		
		}
		else
		{
			$sucess = false;
			echo '<p>' . mysqli_error($db_connection) . '</p>';
			echo '<p>New homework could not be saved.</p>';
		}

		mysqli_close($db_connection);
		return $sucess;
		
	}
	

}

?>