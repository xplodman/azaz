<?php
include_once "connection.php";

$site_id=$_POST['site_id'];
$tower_number=$_POST['tower_number'];
$tower_floor=$_POST['tower_floor'];

$query = mysqli_query($con, "INSERT INTO `tower` (`id`, `name`, `layers`, `create_time`, `update_time`, `site_id`) VALUES (NULL, '$tower_number', '$tower_floor', CURRENT_TIMESTAMP, NULL, '$site_id');")or die(mysqli_error($con));

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