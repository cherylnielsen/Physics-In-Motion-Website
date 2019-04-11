<?php

class StudentGradeTables
{
	private $assignmentTables;
		
	public function __construct() 
	{
		$this->assignmentTables = new AssignmentTables();
	}

	
	public function displayStudentGrades($section_id, $mdb_control)
	{
		echo "<table class='summary students'>
				<tr><th colspan='15'><h2>Section $section_id Student Grades</h2></th></tr>";
		
		$student_list = array();
		$student_list = $this->getStudentList($section_id, $mdb_control);
		$num_students = count($student_list);
		$header = "";
		$rows = array();
		
		if($num_students > 0)
		{				
			for($i = 0; $i < $num_students; $i++)
			{			
				$studentRow = array();				
				$student_id = $student_list[$i]->get_student_id();
				$studentRow = $this->makeStudentRow($student_list[$i]);
				$grades = array();
				$grades = $this->getStudentGradeRows($section_id, $student_id, $mdb_control);
				
				if($i === 0) 
				{ 
					echo "<tr>" . $studentRow['header'] . "<th colspan='10' class='center'>
							Grades</th></tr>"; 
				}
				
				echo "<tr>" . $studentRow['data'] ;
				
				if(isset($grades))
				{
					echo "<td><table class='grades' >";
					
					for($j = 0; $j < count($grades); $j++)
					{
						echo "<tr>" . $grades[$j] . "</tr>";
					}				
					
					echo "</table></td></tr>";	
				}
				else
				{
					echo "<td>No grades yet.</td></tr>";
				}
			}
		}
		else
		{
			echo "<tr><td colspan='5'>No students currently in this section.</td></tr>";
		}

		echo "</table>";
	}
	
	
	public function displayStudents($section_id, $mdb_control)
	{
		echo "<table class='summary students'>
				<tr><th colspan='15'><h2>Section $section_id Student Members</h2></th></tr>";
		
		$student_list = array();
		$student_list = $this->getStudentList($section_id, $mdb_control);
		$num_students = count($student_list);
		$header = "";
		$rows = array();
		
		if($num_students > 0)
		{				
			for($i = 0; $i < $num_students; $i++)
			{			
				$studentRow = array();				
				$student_id = $student_list[$i]->get_student_id();
				$studentRow = $this->makeStudentRow($student_list[$i]);
				
				if($i === 0) 
				{ 
					echo "<tr>" . $studentRow['header'] . "</tr>"; 
				}
				
				echo "<tr>" . $studentRow['data'] . "</tr>";
				
			}
		}
		else
		{
			echo "<tr><td colspan='5'>No students currently in this section.</td></tr>";
		}

		echo "</table>";
	}
	
	
	// Gets the list of all students in this section.
	public function getStudentList($section_id, $mdb_control)
	{
		$student_list = array();
		$controller = $mdb_control->getController("section_students_view");
		$student_list = $controller->getByAttribute("section_id", $section_id);
		
		return $student_list;
	}
	
	
	public function makeStudentRow($section_students_view)
	{
		$section_id = $section_students_view->get_section_id();
		$section_name = $section_students_view->get_section_name();
		$student_id = $section_students_view->get_student_id();
		$student_first_name = $section_students_view->get_student_first_name();
		$student_last_name = $section_students_view->get_student_last_name();
		$school_name = $section_students_view->get_school_name();
		$dropped_section = $section_students_view->get_dropped_section();
		$dropped = $dropped_section ? "Dropped" : "Enrolled";
		
		$row['header'] = "<th>Student ID</th>
							<th>Student Name</th>
							<th>School</th>
							<th>Status</th>";
		
		$row['data'] = "<td class='center'>$student_id</td>
							<td>$student_first_name&nbsp;&nbsp;$student_last_name</td>
							<td>$school_name</td>
							<td>$dropped</td>";

		return $row;
	}
	
	
	public function getStudentGradeRows($section_id, $student_id, $mdb_control)
	{
		$gradeSet = array();		
		$gradeSet = $this->getStudentGradeSet($student_id, $section_id, $mdb_control);
		$gradeRows = array();
		
		if((isset($gradeSet)) && (count($gradeSet) > 0))
		{
			$row1 = "<th>Assignment</th>";
			$row2 = "<th>Points Possible</th>";
			$row3 = "<th>Points Earned</th>";
			$row4 = "<th>Percent</th>";
		
			$num = count($gradeSet) - 1;
			
			for( $i = 0; $i < $num; $i++ )
			{
				$assignment_id	= $gradeSet[$i]['assignment_id'];
				$was_graded	= $gradeSet[$i]['was_graded'];
				$points_earned	= $gradeSet[$i]['earned'];
				$points_possible = $gradeSet[$i]['possible'];
				$percent;
				
				if($was_graded && ($points_possible > 0))
				{
					$percent = ($points_earned * 100.0)/ $points_possible;
				}
				else
				{ 
					$points_earned = " - "; 
					$percent = " - "; 
				}
				
				$row1 .= "<td>$assignment_id</td>";
				$row2 .= "<td>$points_possible</td>";
				$row3 .= "<td>$points_earned</td>";
				$row4 .= "<td>$percent</td>";	
			}		
			
			$totalEarned = $gradeSet['total']['earned'];
			$totalPossible = $gradeSet['total']['possible'];		
			$percent = $gradeSet['total']['percent'];
			if(is_numeric($percent)) { $percent = number_format($percent, 2); }
			
			$row1 .= "<th colspan='2'> Totals </th>";
			$row2 .= "<th>Total Possible</th><td>$totalPossible</td>";
			$row3 .= "<th>Total Earned</th><td>$totalEarned</td>";
			$row4 .= "<th>Total Percent</th><td>$percent</td>";	
			
			$gradeRows[0] = $row1;
			$gradeRows[1] = $row2;
			$gradeRows[2] = $row3;
			$gradeRows[3] = $row4;		
		}
		else
		{
			$gradeRows = null;
		}
				
		return $gradeRows;
	}	
	
	
	public function getStudentGradeSet($student_id, $section_id, $mdb_control)
	{
		$gradeSet = array();
		$totalPointsEarned = 0;
		$totalPointsPossible = 0;
		$percent = 0;
		
		$assignment_list = array();
		$assignment_list = $this->assignmentTables->getSectionAssignments($section_id, $mdb_control);
		$num_assignments = count($assignment_list);
		$num_gradeSets = 0;
		
		if($num_assignments > 0)
		{
			for($i = 0; $i < $num_assignments; $i++)
			{
				$assignment_id = $assignment_list[$i]->get_assignment_id();
				$points_possible = $assignment_list[$i]->get_points_possible();
				$homework = new Homework_View();
				$homework = $this->assignmentTables->getOneHomework(
							$section_id, $assignment_id, $student_id, $mdb_control);
					
				if(isset($homework))
				{
					$was_graded = $homework->get_was_graded();
					$points_earned = $homework->get_points_earned();
					
					if($was_graded) 
					{ 
						$totalPointsEarned += $points_earned; 
						$totalPointsPossible += $points_possible;				
					}
				
					$gradeSet[$i]['assignment_id'] = $assignment_id;
					$gradeSet[$i]['was_graded'] = $was_graded;
					$gradeSet[$i]['earned'] = $points_earned;
					$gradeSet[$i]['possible'] = $points_possible;
				}
			}
			
			$num_gradeSets = count($gradeSet);
			
			if(($totalPointsPossible > 0) && ($num_gradeSets > 0))
			{
				$percent = (100 * $totalPointsEarned) / $totalPointsPossible;
			}
			else
			{
				$percent = " "; 
			}
			
			$gradeSet['total']['earned'] = $totalPointsEarned;
			$gradeSet['total']['possible'] = $totalPointsPossible;		
			$gradeSet['total']['percent'] = $percent;
		}
		
		if(($num_assignments == 0) || ($num_gradeSets == 0))
		{
			$gradeSet = null;
		}
		
		return $gradeSet;		
	}
	
	
	
	
	
}

?>