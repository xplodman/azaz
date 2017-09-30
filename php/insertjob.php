<?php
include_once "connection.php";

$jobname=$_POST['jobname'];

$maxjobid = mysqli_query($con, "Select Max(`job`.`jobid`) From `job`");
$maxjobid = mysqli_fetch_row($maxjobid);
$maxjobid = implode("", $maxjobid);
$maxjobid =$maxjobid+1;

$query = mysqli_query($con, "INSERT INTO `job`(`jobid`, `jobname`, `createddate`, `updatedate`) VALUES ('$maxjobid','$jobname',NOW(),NULL);")or die(mysqli_error($con));

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