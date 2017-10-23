<?php
include_once "connection.php";

$expenses_date=$_POST['expenses_date'];
$site_id=$_POST['site_id'];
$expenses_subject=$_POST['expenses_subject'];
$expenses_value=$_POST['expenses_value'];

$result1 = mysqli_query($con, "INSERT INTO `expense` (`id`, `date`, `subject`, `value`, `create_time`, `update_time`, `site_id`, `status`) VALUES (NULL, '$expenses_date', '$expenses_subject', '$expenses_value', CURRENT_TIMESTAMP, NULL, '$site_id', '1');");

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($result1) {
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