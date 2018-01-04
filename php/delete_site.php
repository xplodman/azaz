<?php
include_once "connection.php";
$site_id=$_GET['site_id'];

$remove_site = mysqli_query($con, "DELETE FROM `site` WHERE `site`.`id` ='$site_id';")or die(mysqli_error($con));

if ($remove_site) {
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

