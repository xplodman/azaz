<?php
include_once "connection.php";

$servername=$_POST['servername'];
$serverip=$_POST['serverip'];
$servermonitortype=$_POST['servermonitortype'];
$serverport=$_POST['serverport'];

$maxserverid = mysqli_query($con, "Select Max(`server`.`serverid`) From `server`");
$maxserverid = mysqli_fetch_row($maxserverid);
$maxserverid = implode("", $maxserverid);
$maxserverid =$maxserverid+1;

$query = mysqli_query($con, "INSERT INTO `server`(`serverid`, `servername`, `serverip`, `servermonitortype`, `serverport`) VALUES ('$maxserverid','$servername','$serverip','$servermonitortype','$serverport');")or die(mysqli_error($con));

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