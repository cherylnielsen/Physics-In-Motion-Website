<?php

echo "<div id='noticeSummaryDiv' class='overflow'>";

	// just a bullet list, not a full table??
	$noticeTables->displayNoticeSummary($administrator_id, null, $mdb_control);

echo "</div>";
echo "<div id='sectionSummaryDiv' class='overflow'>";

	// just a bullet list, not a table
	// # add or edit new section requests waiting
	// # add prof or student to section waiting
	// # drop prof or student from section waiting
	
	// just a bullet list of how many, not a table
	// # professors and administrators needing registration waiting
	// # school confirmations waiting 

echo "</div>";
echo "<a id='bottom' href='#top'>return to top</a>";

?>

