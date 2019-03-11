<?php

// helper classes for the display and action classes
include('../private/user_display/DisplayUtility.php'); 
include('../private/user_action/ActionUtility.php'); 
// display classes for the main database models used
include('../private/user_display/SectionDisplay.php'); 
include('../private/user_display/NoticeDisplay.php'); 
include('../private/user_display/AssignmentDisplay.php');
// actions for the forms used by members
include('../private/user_action/SectionAction.php'); 
include('../private/user_action/NoticeAction.php'); 
include('../private/user_action/AssignmentAction.php');
	
	
// set of helper classes for the display and action classes
$displayUtility = new DisplayUtility();
$actionUtility = new ActionUtility();
// display classes for the main database models used
$sectionDisplay = new SectionDisplay();
$noticeDisplay = new NoticeDisplay();
$assignmentDisplay = new AssignmentDisplay();
// actions for the forms used by members
$SectionAction = new SectionAction();
$NoticeAction = new NoticeAction();
$AssignmentAction = new AssignmentAction();

?>