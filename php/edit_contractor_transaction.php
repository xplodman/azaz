<?php
include_once "connection.php";
$transaction_id=$_GET['transaction_id'];
$expenses_date=$_POST['expenses_date'];
$reason_id=$_POST['reason_id'];
$expenses_value=$_POST['expenses_value'];
$site_id=$_POST['site_id'];


$update_expense = mysqli_query($con, "UPDATE `transaction` SET `date_1` = '$expenses_date', `value` = '$expenses_value', `site_id` = '$site_id', `reason_id` = '$reason_id', `update_time` = NOW() WHERE `transaction`.`id` = '$transaction_id';")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($update_expense) {
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
