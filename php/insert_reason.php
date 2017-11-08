<?php
include_once "connection.php";

$reason_name=$_POST['reason_name'];

$query = mysqli_query($con, "INSERT INTO `reason` (`id`, `name`, `create_time`, `update_time`) VALUES (NULL, '$reason_name', CURRENT_TIMESTAMP, NULL);")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($query) {
mysqli_commit($con);

    header('Location: '.$uri_parts[0].'?backresult=1');
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0');
    exit;}
?>