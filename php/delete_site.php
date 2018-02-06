<?php
include_once "connection.php";
$site_id=$_GET['site_id'];

$step_1= mysqli_query($con, "INSERT ignore azaz.tower_temp  
SELECT
  tower.*
FROM
  site
  INNER JOIN tower ON tower.site_id = site.id
WHERE
  tower.site_id = $site_id")or die(mysqli_error($con));

$step_2= mysqli_query($con, "INSERT ignore azaz.property_temp  
SELECT
  property.*
FROM
  site
  INNER JOIN tower ON tower.site_id = site.id
  INNER JOIN property ON property.tower_id = tower.id
WHERE
  tower.site_id = $site_id")or die(mysqli_error($con));

$step_3= mysqli_query($con, "INSERT ignore azaz.transaction_temp  
SELECT
  transaction.*
FROM
  site
  INNER JOIN tower ON tower.site_id = site.id
  INNER JOIN property ON property.tower_id = tower.id
  INNER JOIN transaction ON transaction.property_id = property.id
WHERE
  site.id = $site_id")or die(mysqli_error($con));

$step_4= mysqli_query($con, "INSERT ignore azaz.transaction_temp  
SELECT
  transaction.*
FROM
  site
  INNER JOIN transaction ON transaction.site_id = site.id
WHERE
  site.id = $site_id ")or die(mysqli_error($con));

$step_5= mysqli_query($con, "INSERT ignore azaz.owner_has_property_temp  
SELECT
  owner_has_property.*
FROM
  site
  INNER JOIN tower ON tower.site_id = site.id
  INNER JOIN property ON property.tower_id = tower.id
  INNER JOIN owner_has_property ON owner_has_property.property_id = property.id
WHERE
  site.id = $site_id")or die(mysqli_error($con));

$step_6= mysqli_query($con, "INSERT ignore azaz.site_temp  
SELECT
  site.*
FROM
  site
WHERE
  site.id = $site_id")or die(mysqli_error($con));

$remove_site = mysqli_query($con, "DELETE FROM `site` WHERE `site`.`id` ='$site_id';")or die(mysqli_error($con));

if ($remove_site & $step_1 & $step_2 & $step_3 & $step_4 & $step_5 & $step_6) {
    mysqli_commit($con);
    header('Location: ../index.php?backresult=1');
    exit;
}
else {

    header('Location: ../index.php?backresult=0');
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

