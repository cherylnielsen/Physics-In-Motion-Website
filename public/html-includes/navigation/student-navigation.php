
<!-- Student links and related actions -->

<?php

$page = $_SERVER['REQUEST_URI'];
$pageOK = strpos($page, "student");

if(isset($_SESSION["student_id"]) && isset($_SESSION["member_type"]))
{
	if(($_SESSION["member_type"] === "student") && ($pageOK !== false))
	{
	?>	
		<nav class='second-navigation'>	
			<h2 class='navigation'>Current Sections</h2>						
	<?php
	
		$section_list = array();
		$section_list = $sectionTables->getSectionList_ByStudent($student_id, $mdb_control);
		$short_list = $sectionTables->getSectionShortList($section_list, $mdb_control, "student");
		$num_sections = count($short_list);
		
		if($num_sections == 0)
		{
			echo "<p class='navigation'>No current sections</p>";
		}	
		
		for($i = 0; $i < $num_sections; $i++)
		{		
			$section_id = $short_list[$i]['id'];
			$section_name = $short_list[$i]['name'];
			
			echo "<a href='student-home-page.php?section_id=$section_id' 
					class='navigation'>Section $section_id&nbsp;:&nbsp;$section_name </a>";
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
		<a href="login-register-page.php?form_type=changelogin" 
			class="navigation">Change Password</a>
		<a href="student-home-page.php?notices=page" 
			class="navigation">View Notices</a>
		<a href="student-form-page.php?form_type=write_notice" 
			class="navigation">Write Notice</a>
		<a href="student-form-page.php?form_type=section_rating" 
			class="navigation">Section Rating</a>
		<a href="student-form-page.php?form_type=tutorial_lab_rating" 
			class="navigation">Tutorial Lab Rating</a>
				
</nav>
<!-- end SESSION if blocks -->
<?php 	}	} 	?>


