<?php

// helper class for the display and action classes
include('../private/user_display/DisplayUtility.php'); 
// display and action classes for the forms used by members
include('../private/user_action/FileAction.php'); 
include('../private/user_display/SectionDisplay.php'); 
include('../private/user_display/NoticeDisplay.php'); 
include('../private/user_display/AssignmentDisplay.php');
include('../private/user_action/SectionAction.php'); 
include('../private/user_action/NoticeAction.php'); 
include('../private/user_action/AssignmentAction.php');
include('../private/user_action/RatingAction.php');	
include('../private/user_display/StudentGradeTables.php'); 	

// helper class for the display and action classes
$displayUtility = new DisplayUtility();
// display and action classes for the forms used by members
$fileAction = new FileAction();
$sectionDisplay = new SectionDisplay();
$noticeDisplay = new NoticeDisplay();
$assignmentDisplay = new AssignmentDisplay();
$sectionAction = new SectionAction();
$noticeAction = new NoticeAction();
$assignmentAction = new AssignmentAction();
$ratingAction = new RatingAction();
$studentTables = new StudentGradeTables();

?>