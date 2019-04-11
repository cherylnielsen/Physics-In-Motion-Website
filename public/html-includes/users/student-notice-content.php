<?php

echo "<div id='sectionNoticeDiv' class='overflow'>";

	// List of notices for sections
	$section_list = array();
	$section_list = $sectionTables->getSectionList_ByStudent($student_id, $mdb_control);
	$noticeTables->displaySectionNoticeTable($section_list, $mdb_control);

echo "</div>";
echo "<div id='memberInBoxNoticeDiv' class='overflow'>";

	// List of member notices received 
	$member_notice_list = array();
	$member_notice_list = $noticeTables->getMemberInBoxNotices($student_id, $mdb_control);
	$noticeTables->displayMemberInBoxNoticeTable($member_notice_list, $mdb_control);

echo "</div>";
echo "<div id='memberSentNoticeDiv' class='overflow'>";

	// List of member notices sent 
	$member_notice_list = array();
	$member_notice_list = $noticeTables->getMemberSentNotices($student_id, $mdb_control);
	$noticeTables->displayMemberSentNoticeTable($member_notice_list, $mdb_control);

echo "</div>";
echo "<a id='bottom' href='#top'>return to top</a>";

?>