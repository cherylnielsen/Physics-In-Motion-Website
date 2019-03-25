
<!-- Professor links and related actions -->

<?php 
$page = $_SERVER['REQUEST_URI'];
$pageOK = strpos($page, "professor");

if(isset($_SESSION["professor_id"]) && isset($_SESSION["member_type"]))
{
	if(($_SESSION["member_type"] === "professor") && ($pageOK !== false))
	{		
	?>	
		<nav class='second-navigation'>	
			<h2 class='navigation'>Current Sections</h2>	
			
	<?php
	
		$section_list = array();
		$section_list = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
		$short_list = $sectionDisplay->getSectionShortList($section_list, $mdb_control, "professor");
		$num_sections = count($short_list);
	
		if($num_sections == 0)
		{
			echo "<p class='navigation'>No current sections</p>";
		}	
		
		for($i = 0; $i < $num_sections; $i++)
		{		
			$section_id = $short_list[$i]['id'];
			$section_name = $short_list[$i]['name'];
			
			echo "<a href='professor-home-page.php?section_id=$section_id' 
					class='navigation'>Section $section_id&nbsp:&nbsp$section_name </a>";
		}
	
		if(!isset($_GET["form_type"]))
		{
			if(isset($_GET["section_id"]))
			{
			?>	
				<h2 class='navigation'>Show / Hide</h2>
				<button class='navigation' onclick='showStudentList();'>Student List</button>			
				<button class='navigation' onclick='showAssignmentList();'>Assignment List</button>			
				<button class='navigation' onclick='showHomeworkList();'>Homework List</button>
			<?php
			}
			
			if(isset($_GET["notices"]))
			{
			?>
				<h2 class='navigation'>Show / Hide</h2>
				<button class='navigation' onclick='showSectionNotices();'>Section Notices</button>			
				<button class='navigation' onclick='showMemberInBoxNotices();'>Member In Box</button>			
				<button class='navigation' onclick='showMemberSentNotices();'>Member Sent</button>
			<?php
			}
		}	
?>	
		<h2 class='navigation'>Actions</h2>
		<a href="professor-home-page.php?notices=page" class="navigation">View Notices</a>
		<a href="professor-form-page.php?form_type=write_notice" class="navigation">Write Notice</a>
		<a href="professor-form-page.php?form_type=add_assignment" class="navigation">Add Assignment</a>
		
</nav>
<!-- end SESSION if blocks -->
<?php 	}	} 	?>


