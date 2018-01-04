<?php
include_once "connection.php";
$reason_id=$_GET['reason_id'];
$name=$_POST['name'];

$update_reason = mysqli_query($con, "UPDATE `reason` SET `name` = '$name', `update_time` = NOW() WHERE `reason`.`id` = '$reason_id';")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($update_reason) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1&reason_id='.$reason_id.'');
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&reason_id='.$reason_id.'');
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
<!---->
