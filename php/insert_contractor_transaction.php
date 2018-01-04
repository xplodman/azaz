<?php
include_once "connection.php";
session_start();
$user_id=$_SESSION['azaz']['id'];
$contractor_transaction_date=$_POST['contractor_transaction_date'];
$site_id=$_POST['site_id'];
$reason_id=$_POST['reason_id'];
$contractor_transaction_value=$_POST['contractor_transaction_value'];

$result1 = mysqli_query($con, "INSERT INTO `transaction` (`id`, `date_1`, `date_2`, `value`, `status`, `removed`, `flag_id`, `property_id`, `owner_id`, `site_id`, `custoder_id`, `reason_id`, `users_id`, `create_time`, `update_time`) VALUES (NULL, '$contractor_transaction_date', NULL, '$contractor_transaction_value', NULL, '0', '7', NULL, NULL, '$site_id', NULL, '$reason_id', '$user_id', CURRENT_TIMESTAMP, NULL);")or die(mysqli_error($con));



$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($result1) {
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

