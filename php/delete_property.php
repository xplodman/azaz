<?php
include_once "connection.php";
$property_id=$_GET['property_id'];

$step_1= mysqli_query($con, "INSERT ignore azaz.owner_has_property_temp
SELECT
  owner_has_property.*
FROM
  property
  INNER JOIN owner_has_property ON owner_has_property.property_id = property.id where property.id = $property_id")or die(mysqli_error($con));

$step_2= mysqli_query($con, "INSERT ignore azaz.transaction_temp  
SELECT
  transaction.*
FROM
  property
  INNER JOIN transaction ON transaction.property_id = property.id where property.id = $property_id")or die(mysqli_error($con));

$step_3= mysqli_query($con, "INSERT ignore azaz.property_temp
SELECT * FROM azaz.property where property.id = $property_id;")or die(mysqli_error($con));

$remove_property = mysqli_query($con, "DELETE FROM `property` WHERE `property`.`id` ='$property_id';")or die(mysqli_error($con));

if ($remove_property & $step_1 & $step_2 & $step_3) {
    mysqli_commit($con);
    header('Location: ../properties.php?backresult=1');
    exit;
}
else {

    header('Location: ../properties.php?backresult=0');
    exit;
}
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

