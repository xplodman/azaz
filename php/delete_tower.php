<?php
include_once "connection.php";
$tower_id=$_GET['tower_id'];

$remove_tower = mysqli_query($con, "DELETE FROM `tower` WHERE `tower`.`id` ='$tower_id';")or die(mysqli_error($con));

if ($remove_tower) {
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

