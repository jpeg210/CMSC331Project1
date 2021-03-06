<?php

/*****************************************
 ** File:    newAdvisor.php
 ** Project: CMSC 331 Project 1, Fall 2016
 ** Date:    10/28/16
 ** 
 ** sends the data the advisor entered to the 
 ** database tables
 **
 **
 **
 ***********************************************/

include('CommonMethods.php');

$debug = false;
$COMMON = new Common($debug);

//check for all info
if ($_POST['Name'] == '' || $_POST['Adviser_Email'] == '' || $_POST['Password'] == '' || ($_POST['IndMeeting'] == '' && $_POST['GroMeeting'])) {
  header('Location: newAdvisor_error.html');
}

else {
session_start();
$_SESSION['Advisor_Email'] = $_POST['Adviser_Email'];

//save info from html
$newAdvisorName = ($_POST['Name']);
$newAdvisorCollege = ($_POST['College']);
$newAdvisorOffice = ($_POST['Office']);
$newAdvisorEmail = ($_POST['Adviser_Email']);
$newAdvisorPhone = ($_POST['Phone_Number']);
$newAdvisorPassword = ($_POST['Password']);
$newIndMeeting = ($_POST['IndMeeting']);
$newGroupMeeting = ($_POST['GroMeeting']);

//saves to database
$sql = "INSERT INTO `Adviser_Info`(`Adviser Email`, `Name`, `College`, `Office`, `Group Location`, `Individual Location`,`Password`, `Phone Number`) VALUES ('$newAdvisorEmail','$newAdvisorName','$newAdvisorCollege','$newAdvisorOffice','$newGroupMeeting','$newIndMeeting','$newAdvisorPassword','$newAdvisorPhone')";

$rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);

header('Location: advisorMeetingSchedule.html');
}
?>
