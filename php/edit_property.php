<?php
include_once "connection.php";
$property_id=$_GET['property_id'];
$tower_number=$_POST['tower_number'];
$property_type=$_POST['property_type'];
$property_number=$_POST['property_number'];
$property_area=$_POST['property_area'];
$property_price=$_POST['property_price'];
$property_status=$_POST['property_status'];
$owner_id=$_POST['owner_id'];
$owner_name=$_POST['owner_name'];
$owner_mobile=$_POST['owner_mobile'];
$owner_mobile_2=$_POST['owner_mobile_2'];
$owner_has_property_id=$_POST['owner_has_property_id'];
$contract_date=$_POST['contract_date'];

$update_property = mysqli_query($con, "UPDATE `property` SET `name` = '$property_number', `area` = '$property_area', `price` = '$property_price', `update_time` = CURRENT_TIMESTAMP ,`tower_id` = '$tower_number',`property_type_id` = '$property_type' WHERE `property`.`id` = '$property_id';")or die(mysqli_error($con));

    $update_owner = mysqli_query($con, "UPDATE `owner` SET `name` = '$owner_name', `mobile` = '$owner_mobile', `update_time` = CURDATE() WHERE `owner`.`id` = '$owner_id';")or die(mysqli_error($con));

    $update_contract_date = mysqli_query($con, "UPDATE `owner_has_property` SET `update_time` = curdate(), `contract_date` = '$contract_date' WHERE `owner_has_property`.`id` = '$owner_has_property_id';")or die(mysqli_error($con));

if ($update_property) {
    mysqli_commit($con);
    header('Location: ../properties.php?backresult=1');
    exit;
}
else {

    header('Location: ../properties.php?backresult=0');
    exit;}


?>
<!--<table>-->
<!--    --><?php
//    foreach ($_POST as $key => $value) {
//        echo "<tr>";
//        echo "<td>";
//        echo $key;
//        echo "</td>";
//        echo "<td>";
//        if (is_array($value)){
//            print_r($value);
//        }else{
//            echo $value;
//        }
//        echo "</td>";
//        echo "</tr>";
//    }
//    ?>
<!--</table>-->

