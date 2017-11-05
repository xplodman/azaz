<?php
include_once "connection.php";
$custoder_id=$_GET['custoder_id'];
$name=$_POST['name'];
$mobile=$_POST['mobile'];
$notes=$_POST['notes'];

$update_custoder = mysqli_query($con, "UPDATE `custoder` SET `name` = '$name', `mobile` = '$mobile', `notes` = '$notes', `update_time` = NOW() WHERE `custoder`.`id` = '$custoder_id';")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($update_custoder) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1&custoder_id='.$custoder_id.'');
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&custoder_id='.$custoder_id.'');
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
