<?php
include_once "connection.php";
if (!empty($_POST["property_number"])) {
$property_number=$_POST['property_number'];
    $query="
Select property.price
From property
Where property.id = $property_number";
    $results = mysqli_query($con, $query);
    $property_price = mysqli_fetch_assoc($results);
echo $property_price['price'];

}