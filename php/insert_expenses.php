<?php
include_once "connection.php";
session_start();
$user_id=$_SESSION['azaz']['id'];
$expenses_date=$_POST['expenses_date'];
$site_id=$_POST['site_id'];
$reason_id=$_POST['reason_id'];
$expenses_value=$_POST['expenses_value']*-1;

$result1 = mysqli_query($con, "INSERT INTO `transaction` (`id`, `date_1`, `date_2`, `value`, `status`, `removed`, `flag_id`, `property_id`, `owner_id`, `site_id`, `custoder_id`, `reason_id`, `users_id`, `create_time`, `update_time`) VALUES (NULL, '$expenses_date', NULL, '$expenses_value', NULL, '0', '4', NULL, NULL, '$site_id', NULL, '$reason_id', '$user_id', CURRENT_TIMESTAMP, NULL);")or die(mysqli_error($con));



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