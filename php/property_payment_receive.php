<?php
include_once "connection.php";

$payment_date=$_POST['payment_date'];
$payment_id=$_POST['payment_id'];


$result1 = mysqli_query($con, "UPDATE `transaction` SET `date_2` = '$payment_date', `status` = '1', `update_time` = NOW() WHERE `transaction`.`id` = $payment_id;")or die(mysqli_error($con));


$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($result1) {
mysqli_commit($con);
    if (isset($_POST['back_path'])){
        header('Location: '.$uri_parts[0].'?backresult=1&transaction_id='.$payment_id.'');
    }else{
        header('Location: '.$uri_parts[0].'?backresult=1');
    }
$fh = fopen('/tmp/track.txt','a');
fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
fclose($fh);
exit;
}
else {
    if (isset($_POST['back_path'])){
        header('Location: '.$uri_parts[0].'?backresult=0&transaction_id='.$payment_id.'');
    }else{
        header('Location: '.$uri_parts[0].'?backresult=0');
    }
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
