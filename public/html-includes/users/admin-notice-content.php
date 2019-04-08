<?php

echo "<div id='memberInBoxNoticeDiv' class='overflow'>";

	// List of member notices received & sent with links to view
	$member_notice_list = array();
	$member_notice_list = $noticeTables->getMemberInBoxNotices($administrator_id, $mdb_control);
	$noticeTables->displayMemberInBoxNoticeTable($member_notice_list, $mdb_control);

echo "</div>";
echo "<div id='memberSentNoticeDiv' class='overflow'>";

	$member_notice_list = array();
	$member_notice_list = $noticeTables->getMemberSentNotices($administrator_id, $mdb_control);
	$noticeTables->displayMemberSentNoticeTable($member_notice_list, $mdb_control);

echo "</div>";
echo "<a id='bottom' href='#top'>return to top</a>";

?>
