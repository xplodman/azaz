<?php
include_once "connection.php";

$fromname=$_POST['fromname'];

$maxfromid = mysqli_query($con, "Select Max(`from`.`fromid`) From `from`");
$maxfromid = mysqli_fetch_row($maxfromid);
$maxfromid = implode("", $maxfromid);
$maxfromid =$maxfromid+1;

$query = mysqli_query($con, "INSERT INTO `from`(`fromid`, `fromname`, `createddate`, `updatedate`) VALUES ('$maxfromid','$fromname',NOW(),NULL);")or die(mysqli_error($con));

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