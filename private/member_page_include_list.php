<?php

// helper classes for the display and action classes
include('../private/action/user-pages/DisplayUtility.php'); 
include('../private/action/user-pages/ActionUtility.php'); 
// display classes for the main database models used
include('../private/action/user-pages/SectionDisplay.php'); 
include('../private/action/user-pages/NoticeDisplay.php'); 
include('../private/action/user-pages/AssignmentDisplay.php');
// actions for the forms used by members
include('../private/action/user-pages/SectionAction.php'); 
include('../private/action/user-pages/NoticeAction.php'); 
include('../private/action/user-pages/AssignmentAction.php');
	
	
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