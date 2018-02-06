<?php
include_once "connection.php";
$tower_id=$_GET['tower_id'];

$step_1= mysqli_query($con, "INSERT ignore azaz.property_temp  
SELECT
  property.*
FROM
  tower
  INNER JOIN property ON property.tower_id = tower.id
WHERE
  property.tower_id = $tower_id")or die(mysqli_error($con));

$step_2= mysqli_query($con, "INSERT ignore azaz.owner_has_property_temp  
SELECT
  owner_has_property.*
FROM
  tower
  INNER JOIN property ON property.tower_id = tower.id
  INNER JOIN owner_has_property ON owner_has_property.property_id = property.id
WHERE
  property.tower_id = $tower_id")or die(mysqli_error($con));

$step_3= mysqli_query($con, "INSERT ignore azaz.transaction_temp  
SELECT
  transaction.*
FROM
  tower
  INNER JOIN property ON property.tower_id = tower.id
  INNER JOIN transaction ON transaction.property_id = property.id
WHERE
  property.tower_id = $tower_id")or die(mysqli_error($con));

$step_4= mysqli_query($con, "INSERT ignore azaz.tower_temp  
SELECT
  tower.*
FROM
  tower
WHERE
  tower.id = $tower_id")or die(mysqli_error($con));

$remove_tower = mysqli_query($con, "DELETE FROM `tower` WHERE `tower`.`id` ='$tower_id';")or die(mysqli_error($con));

if ($remove_tower & $step_1 & $step_2 & $step_3 & $step_4) {
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

