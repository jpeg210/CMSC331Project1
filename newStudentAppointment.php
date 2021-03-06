<?php

/*****************************************
 ** File:    newStudentAppointment.php
 ** Project: CMSC 331 Project 1, Fall 2016
 ** Date:    10/28/16
 ** 
 ** Sets up the student's appointment if avalible
 **
 **
 **
 **
 ***********************************************/

  //saves info from html
$AppTime = (int)$_POST['appointmentTime'];
$AppDay = (int)$_POST['appointmentDay'];
$AppType = (int)$_POST['appointmentType'];

include('CommonMethods.php');

$debug = false;
//sets up the three common vars
$COMMON = new Common($debug);
$COMMON2 = new Common($debug);
$COMMON3 = new Common($debug);

session_start();
$studentEmail = (string)$_SESSION['Student_Email'];

//saves code for mysql
$sql = "SELECT * FROM `Inactive Appointments` WHERE `Time` = '$AppTime' && `Day` = '$AppDay' && `Type` = '$AppType'";

$rs = $COMMON->executeQuery($sql, $_SERVER['SCRIPT_NAME']);

//checks to see if a match
if (mysql_num_rows($rs) == 0)
  header('Location: error_newStudentAppointment.html');


else{

  //adds the time to the advisor's table and deletes it from the open list of times
$row = (mysql_fetch_assoc($rs));

$Advisor_Email = (string)$row['Advisor_Email'];

$sql2 = "INSERT INTO `Active Appointments`(`Time`, `Day`, `Type`, `Advisor_Email`, `Student_Email`) VALUES ('$AppTime','$AppDay','$AppType','$Advisor_Email','$studentEmail')";
$rs2 = $COMMON2->executeQuery($sql2, $_SERVER['SCRIPT_NAME']);

$Code = (int)$row['Code'];

$sql3 = "DELETE FROM `Inactive Appointments` WHERE `Code` = '$Code'";
$rs3 = $COMMON3->executeQuery($sql3, $_SERVER['SCRIPT_NAME']);

header("Location: returningStudent.php");
}
?>
