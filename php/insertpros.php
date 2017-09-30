<?php
include_once "connection.php";

$prosecutionname=$_POST['prosecutionname'];

$maxprosecutionid = mysqli_query($con, "Select Max(`prosecution`.`prosecutionid`) From `prosecution`");
$maxprosecutionid = mysqli_fetch_row($maxprosecutionid);
$maxprosecutionid = implode("", $maxprosecutionid);
$maxprosecutionid =$maxprosecutionid+1;

$query = mysqli_query($con, "INSERT INTO `prosecution`(`prosecutionid`, `prosecutionname`, `createddate`, `updatedate`) VALUES ('$maxprosecutionid','$prosecutionname',NOW(),NULL);")or die(mysqli_error($con));

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