<?php
include_once "connection.php";

$site_id=$_POST['site_id'];
$tower_number=$_POST['tower_number'];
$property_type=$_POST['property_type'];
$property_number=$_POST['property_number'];
$property_area=$_POST['property_area'];
$property_price=$_POST['property_price'];

$query = mysqli_query($con, "INSERT INTO `property` (`id`, `name`, `area`, `price`, `create_time`, `update_time`, `tower_id`, `property_type_id`) VALUES (NULL, '$property_number', '$property_area', '$property_price', CURRENT_TIMESTAMP, NULL, '$tower_number', '$property_type');")or die(mysqli_error($con));

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