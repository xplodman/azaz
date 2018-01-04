<?php
include_once "connection.php";
$tower_id=$_GET['tower_id'];
$site_id=$_POST['site_id'];
$tower_name=$_POST['tower_name'];
$layers=$_POST['layers'];

$update_tower = mysqli_query($con, "UPDATE `tower` SET `site_id` = '$site_id' ,`name` = '$tower_name', `layers` = '$layers', `update_time` = NOW() WHERE `tower`.`id` = '$tower_id';")or die(mysqli_error($con));

if ($update_tower) {
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

