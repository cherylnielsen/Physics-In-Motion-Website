<?php

// display and action classes for the forms used by members
include('../private/user_action/FileAction.php'); 
include('../private/user_display/SectionTables.php'); 
include('../private/user_display/NoticeTables.php'); 
include('../private/user_display/AssignmentTables.php');
include('../private/user_display/RatingTables.php'); 
include('../private/user_action/SectionAction.php');
include('../private/user_action/NoticeAction.php'); 
include('../private/user_action/AssignmentAction.php');
include('../private/user_action/RatingAction.php');	
include('../private/user_display/StudentGradeTables.php'); 	

// display and action classes for the forms used by members
$fileAction = new FileAction();
$sectionTables = new SectionTables();
$noticeTables = new NoticeTables();
$assignmentTables = new AssignmentTables();
$sectionAction = new SectionAction();
$noticeAction = new NoticeAction();
$assignmentAction = new AssignmentAction();
$ratingAction = new RatingAction();
$ratingTables = new RatingTables();
$studentTables = new StudentGradeTables();

// AJAX helper for the display and action classes
//include('../private/user_action/ActionUtility.php'); 

?>