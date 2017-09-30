<?php
include_once "connection.php";

$owncategoryname=$_POST['owncategoryname'];

$maxowncategoryid = mysqli_query($con, "Select Max(`owncategory`.`owncategoryid`) From `owncategory`");
$maxowncategoryid = mysqli_fetch_row($maxowncategoryid);
$maxowncategoryid = implode("", $maxowncategoryid);
$maxowncategoryid =$maxowncategoryid+1;

$query = mysqli_query($con, "INSERT INTO `owncategory`(`owncategoryid`, `owncategoryname`, `createddate`, `updatedate`) VALUES ('$maxowncategoryid','$owncategoryname',NOW(),NULL);")or die(mysqli_error($con));

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