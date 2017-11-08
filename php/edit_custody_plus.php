<?php
include_once "connection.php";
$transaction_id=$_GET['transaction_id'];
session_start();
$user_id=$_SESSION['azaz']['id'];
$date_1=$_POST['date_1'];
$value=$_POST['value'];
$custoder_id=$_POST['custoder_id'];
if ($value > 0)
{
    $value=$value*-1;
}
$update_custoder = mysqli_query($con, "UPDATE `transaction` SET `date_1` = '$date_1', `value` = '$value', `custoder_id` = '$custoder_id', `users_id` = '$user_id', `update_time` = NOW() WHERE `transaction`.`id` = '$transaction_id';")or die(mysqli_error($con));


$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($update_custoder) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1&transaction_id='.$transaction_id.'');
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&transaction_id='.$transaction_id.'');
    exit;}


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
