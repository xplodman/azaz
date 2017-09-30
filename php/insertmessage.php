<?php
include_once "connection.php";
session_start();
$messagedata=$_POST['usermsg'];
$administratorid=$_SESSION['administratorid'];

$maxmessageid = mysqli_query($con, "Select Max(`message`.`messageid`) From `message`");
$maxmessageid = mysqli_fetch_row($maxmessageid);
$maxmessageid = implode("", $maxmessageid);
$maxmessageid=$maxmessageid+1;

$query = mysqli_query($con, "INSERT INTO `message`(`messageid`, `messagedata`, `administratorid`, `createddate`) VALUES ('$maxmessageid','$messagedata',$administratorid,NOW());")or die(mysqli_error($con));

mysqli_commit($con);

?>