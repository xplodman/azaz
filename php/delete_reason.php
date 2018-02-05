<?php
include_once "connection.php";
$reason_id=$_GET['reason_id'];

$remove_reason = mysqli_query($con, "DELETE FROM `reason` WHERE `reason`.`id` ='$reason_id';")or die(mysqli_error($con));

if ($remove_reason) {
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

