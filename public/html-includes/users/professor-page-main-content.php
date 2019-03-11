<?php

echo "<h1 class=welcome>Welcome $first_name $last_name!</h1>";

$section_list = array();
$section_list = $sectionDisplay->getSectionList_ByProfessor($professor_id, $mdb_control);
$sectionDisplay->displaySectionMembershipTable($section_list, $mdb_control, "professor");

?>

<div id='sectionNoticeDiv' class='overflow'>
<?php
	// List of notices for this section with links to view
	$noticeDisplay->displaySectionNoticeTable($section_list, $mdb_control);
?>
</div>

<div id='memberInBoxNoticeDiv' class='overflow'>
<?php
	// List of member notices received & sent with links to view
	$member_notice_list = array();
	$member_notice_list = $noticeDisplay->getMemberInBoxNotices($professor_id, $mdb_control);
	$noticeDisplay->displayMemberInBoxNoticeTable($member_notice_list, $mdb_control);
?>
</div>

<div id='memberSentNoticeDiv' class='overflow'>
<?php
	$member_notice_list = array();
	$member_notice_list = $noticeDisplay->getMemberSentNotices($professor_id, $mdb_control);
	$noticeDisplay->displayMemberSentNoticeTable($member_notice_list, $mdb_control);
?>
</div>


<a id="bottom" href="#top">return to top</a>


