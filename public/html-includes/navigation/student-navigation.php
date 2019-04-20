
<!-- Student links and related actions -->

<?php

if(isset($_SESSION["student_id"]) && isset($_SESSION["member_type"]))
{
	if(($_SESSION["member_type"] === "student"))
	{

		echo "<nav class='second-navigation'>	
				<h2 class='navigation'>Current Sections</h2>"; 					
	
		$student_id = $_SESSION["student_id"];
		$section_list = array();
		$sections = array();
		$section_list = $sectionTables->getSectionList_ByStudent($student_id, $mdb_control);
		$short_list = $sectionTables->getSectionShortList($section_list, $mdb_control, "student");
		$sections = $short_list['current'];
		$num_sections = count($sections);
		
		if($num_sections == 0)
		{
			echo "<p class='navigation'>No current sections</p>";
		}	
		
		for($i = 0; $i < $num_sections; $i++)
		{		
			$section_id = $sections[$i]['id'];
			$section_name = $sections[$i]['name'];
			
			echo "<a href='student-home-page.php?section_id=$section_id' 
					class='navigation'>Section $section_id&nbsp;:&nbsp;$section_name </a>";
		}	
		
		$sections = array();
		$sections = $short_list['future'];
		$num_sections = count($sections);
		
		if($num_sections > 0)
		{
			echo "<h2 class='navigation'>Future Sections</h2>";
			
			for($i = 0; $i < $num_sections; $i++)
			{		
				$section_id = $sections[$i]['id'];
				$section_name = $sections[$i]['name'];
				
				echo "<a href='student-home-page.php?section_id=$section_id' 
						class='navigation'>Section $section_id&nbsp;:&nbsp;$section_name </a>";
			}	
		}
		
		if(!isset($_GET["form_type"]))
		{
			if(isset($_GET["section_id"]))
			{
			?>	
				<h2 class='navigation'>Show/Hide Tables</h2>
				
				<button class='navigation' 
					onclick='showTable("assignmentDiv");'>Assignment List</button>
				<button class='navigation' 
					onclick='showTable("homeworkDiv");'>Homework List</button>					
			<?php
			}
			
			if(isset($_GET["notices"]))
			{
			?>
				<h2 class='navigation'>Show/Hide Tables</h2>
				
				<button class='navigation' 
					onclick='showTable("sectionNoticeDiv");'>Section Notices</button>
				<button class='navigation' 
					onclick='showTable("memberInBoxNoticeDiv");'>Member In Box</button>
				<button class='navigation' 
					onclick='showTable("memberSentNoticeDiv");'>Member Sent</button>
			<?php
			}
		}	
?>
		<h2 class='navigation'>Actions</h2>
		
		<a href="student-home-page.php?notices=page" 
			class="navigation">View Notices</a>
		<a href="student-form-page.php?form_type=write_notice" 
			class="navigation">Write a Notice</a>
		<a href="student-form-page.php?form_type=section_rating" 
			class="navigation">Rate Section</a>
		<a href="student-form-page.php?form_type=tutorial_lab_rating" 
			class="navigation">Rate Tutorial Lab</a>
		<a href="login-register-page.php?form_type=changelogin" 
			class="navigation">Change Password</a>	
			
</nav>
<!-- end SESSION if blocks -->
<?php 	}	} 	?>


