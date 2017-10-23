<?php
include_once "connection.php";
$query = "SELECT * FROM `application_setting`";
$results=mysqli_query($con, $query);

$application_setting = mysqli_fetch_assoc($results);
