<?php
include_once "connection.php";
$transaction_id=$_GET['transaction_id'];
$date_1=$_POST['date_1'];
$flag_id=$_POST['flag_id'];
$date_2=$_POST['date_2'];
$value=$_POST['value'];
$owner_id=$_POST['owner_id'];
$owner_name=$_POST['owner_name'];
$owner_number=$_POST['owner_number'];

$update_payment = mysqli_query($con, "UPDATE `transaction` SET `date_1` = '$date_1', `date_2` = '$date_2', `value` = '$value', `flag_id` = '$flag_id', `update_time` = NOW() WHERE `transaction`.`id` = '$transaction_id';")or die(mysqli_error($con));

$update_owner = mysqli_query($con, "UPDATE `owner` SET `name` = '$owner_name' , `mobile` = '$owner_number' WHERE `id` = '$owner_id';")or die(mysqli_error($con));


$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($update_payment & $update_owner) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1&transaction_id='.$transaction_id.'');
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&transaction_id='.$transaction_id.'');
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
