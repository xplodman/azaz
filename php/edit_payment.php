<?php
include_once "connection.php";
$payment_id=$_GET['payment_id'];
$owner_id=$_POST['owner_id'];
$due_date=$_POST['due_date'];
$payment_date=$_POST['payment_date'];
$payment_value=$_POST['payment_value'];
$owner_id=$_POST['owner_id'];
$owner_name=$_POST['owner_name'];
$owner_number=$_POST['owner_number'];

$update_payment = mysqli_query($con, "UPDATE `payment` SET `payment_date` = '$payment_date' , `value` = '$payment_value' , `due_date` = '$due_date' , `update_time` = CURDATE() WHERE `payment`.`id` = '$payment_id';")or die(mysqli_error($con));

$update_owner = mysqli_query($con, "UPDATE `owner` SET `name` = '$owner_name' , `mobile` = '$owner_number' WHERE `id` = '$owner_id';")or die(mysqli_error($con));


$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($update_payment & $update_owner) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1&payment_id='.$payment_id.'');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&payment_id='.$payment_id.'');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
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
