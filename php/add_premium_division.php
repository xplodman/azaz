<?php
include_once "connection.php";
session_start();
$user_id=$_SESSION['azaz']['id'];
$date_1=$_POST['date_1'];
$value=$_POST['value'];
$transaction_id=$_GET['transaction_id'];

$parent_transaction = mysqli_query($con, "SELECT
  transaction.id,
  transaction.number,
  transaction.property_id,
  transaction.flag_id,
  transaction.date_1,
  transaction.date_2,
  transaction.value,
  transaction.status,
  transaction.removed,
  transaction.owner_id,
  transaction.site_id,
  transaction.custoder_id,
  transaction.reason_id,
  transaction.users_id,
  transaction.create_time,
  transaction.update_time,
  transaction.comment
FROM
  transaction
WHERE
  transaction.id = '$transaction_id'");
$parent_transaction = mysqli_fetch_assoc($parent_transaction);

$update_parent_transaction = mysqli_query($con, "UPDATE `transaction` SET `date_1` = '$date_1', `value` = value-'$value', `update_time` = NOW() WHERE `transaction`.`id` = '$transaction_id';")or die(mysqli_error($con));

$child_transaction_number=$parent_transaction['number']+0.1;


$insert_payment = mysqli_query($con, "INSERT INTO `transaction` (`id`, `date_1`, `date_2`, `value`, `status`, `removed`, `flag_id`, `property_id`, `owner_id`, `site_id`, `custoder_id`, `reason_id`, `users_id`, `create_time`, `update_time`, `number`) VALUES (NULL, '$date_1', NULL, '$value', '0', '0', '2', '$parent_transaction[property_id]', '$parent_transaction[owner_id]', NULL, NULL, NULL, '$user_id', CURRENT_TIMESTAMP, NULL, '$child_transaction_number');")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($insert_payment) {
    mysqli_commit($con);
    header('Location: ../payment.php?transaction_id='.$transaction_id.'&backresult=1');
    exit;
}
else {

    header('Location: ../payment.php?transaction_id='.$transaction_id.'&backresult=0');
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
//    };
//    foreach ($_GET as $key => $value) {
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

