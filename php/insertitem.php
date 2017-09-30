<?php
include_once "connection.php";

$hardwarename=$_POST['hardwarename'];
$hardwaresn=$_POST['hardwaresn'];
$hardwareip=$_POST['hardwareip'];
$categoryname=$_POST['categoryname'];
$prosecution=$_POST['prosecution'];

$maxhardwareid = mysqli_query($con, "Select Max(`hardware`.`hardwareid`) From `hardware`");
$maxhardwareid = mysqli_fetch_row($maxhardwareid);
$maxhardwareid = implode("", $maxhardwareid);
$maxhardwareid=$maxhardwareid+1;

$query = mysqli_query($con, "INSERT INTO `hardware`(`hardwareid`, `hardwarename`, `hardwaresn`, `hardwareip`, `createddate`, `updatedate`, `categoryid`, `prosecutionid`) VALUES ('$maxhardwareid','$hardwarename','$hardwaresn','$hardwareip',NOW(),NULL,'$categoryname','$prosecution');")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($query) {
mysqli_commit($con);

    header('Location: '.$uri_parts[0].'?backresult=1');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;}
?>