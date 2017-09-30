<?php
include_once "connection.php";


$prosecutionid=$_GET['prosecutionid'];
$file_tmp =$_FILES['file']['tmp_name'];
$imgData =addslashes (file_get_contents($file_tmp));

$maxprosimageid = mysqli_query($con, "Select Max(`prosimage`.`prosimageid`) From `prosimage`");
$maxprosimageid = mysqli_fetch_row($maxprosimageid);
$maxprosimageid = implode("", $maxprosimageid);
$maxprosimageid = $maxprosimageid + 1;

$query = mysqli_query($con, "INSERT INTO `prosimage`(`prosimageid`, `prosimagedata`, `createddate`, `updatedate`, `prosecutionid`) VALUES ($maxprosimageid,'{$imgData}',NOW(),'',$prosecutionid);") or die(mysqli_error($con));
mysqli_commit($con);


?>