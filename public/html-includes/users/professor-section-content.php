<?php

/**
 - List of assigned labs with Professor & due date
 - List of completed labs
 - Links to data download, math, graphs, screen shots, etc. from completed labs.
 - Links to download lab summaries with recommendations for problems encountered, time taken to complete the lab, etc.
 - Links to send a Notice of Lab Completion to a Professor that assigned a lab.
 - Links to rate completed labs.
**/


// Welcome headings
echo "<div>";
echo "<h2 class=welcome>Welcome $first_name $last_name!</h2>";
$sectionDisplay->displaySectionWelcome($section_id, $mdb_control);		
echo "</div>";

// List of students that are members of this section
echo "<div id='studentListDiv'>";
$sectionDisplay->displaySectionStudentList($section_id, $mdb_control);
echo "</div>";

// List of assignments for this section
echo "<div id='assignmentListDiv'>";
$assignmentDisplay->displaySectionAssignments($section_id, $mdb_control);
echo "</div>";

// List of homework submitted for this section with links to view or download
echo "<div id='homeworkListDiv'> soon to show homework list";

echo "</div>";

// List of notices for this section with links to view
echo "<div id='sectionNoticeDiv'> soon to show section notices";

echo "</div>";

// List of member notices received & sent with links to view
echo "<div id='memberNoticeDiv'> soon to show member notices";

echo "</div>";


/*
$noticeDisplay->displaySectionNoticeTable($section_list, $mdb_control);
echo "<br>";

$member_notice_list = array();
$member_notice_list = $noticeDisplay->getMemberInBoxNotices($professor_id, $mdb_control);
$noticeDisplay->displayMemberInBoxNoticeTable($member_notice_list, $mdb_control);
echo "<br>";

$member_notice_list = array();
$member_notice_list = $noticeDisplay->getMemberSentNotices($professor_id, $mdb_control);
$noticeDisplay->displayMemberSentNoticeTable($member_notice_list, $mdb_control);
echo "<br>";
*/

echo '<br><a id="bottom" href="#top">return to top</a>';


?>