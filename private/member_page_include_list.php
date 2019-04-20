<?php

// display and action classes for the forms used by members
require_once('../private/user_action/FileAction.php'); 
require_once('../private/user_display/SectionTables.php'); 
require_once('../private/user_display/NoticeTables.php'); 
require_once('../private/user_display/AssignmentTables.php');
require_once('../private/user_display/RatingTables.php'); 
require_once('../private/user_action/SectionAction.php');
require_once('../private/user_action/NoticeAction.php'); 
require_once('../private/user_action/AssignmentAction.php');
require_once('../private/user_action/RatingAction.php');	
require_once('../private/user_display/StudentGradeTables.php'); 	
require_once('../private/user_display/DataUtility.php'); 

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
$dataUtility = new DataUtility();

// AJAX helper for the display and action classes
//include('../private/user_action/ActionUtility.php'); 

?>