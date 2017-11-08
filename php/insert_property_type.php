<?php
include_once "connection.php";

$property_type_name=$_POST['property_type_name'];

$query = mysqli_query($con, "INSERT INTO `property_type` (`id`, `name`) VALUES (NULL, '$property_type_name');")or die(mysqli_error($con));

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