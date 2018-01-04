<?php
include_once "connection.php";
$property_id=$_GET['property_id'];

$remove_property = mysqli_query($con, "DELETE FROM `property` WHERE `property`.`id` ='$property_id';")or die(mysqli_error($con));

if ($remove_property) {
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

