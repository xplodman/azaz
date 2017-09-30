<?php
include_once "connection.php";

$categoryname=$_POST['categoryname'];

$maxcategoryid = mysqli_query($con, "Select Max(`category`.`categoryid`) From `category`");
$maxcategoryid = mysqli_fetch_row($maxcategoryid);
$maxcategoryid = implode("", $maxcategoryid);
$maxcategoryid =$maxcategoryid+1;

$query = mysqli_query($con, "INSERT INTO `category`(`categoryid`, `categoryname`, `createddate`, `updatedate`) VALUES ('$maxcategoryid','$categoryname',NOW(),NULL);")or die(mysqli_error($con));

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