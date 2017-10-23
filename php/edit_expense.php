<?php
include_once "connection.php";
$expense_id=$_GET['expense_id'];
$expenses_date=$_POST['expenses_date'];
$expenses_subject=$_POST['expenses_subject'];
$expenses_value=$_POST['expenses_value'];
$site_id=$_POST['site_id'];

$update_expense = mysqli_query($con, "UPDATE `expense` SET `date` = '$expenses_date', `subject` = '$expenses_subject', `value` = '$expenses_value', `site_id` = '$site_id', `update_time` = NOW() WHERE `expense`.`id` = '$expense_id';")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($update_expense) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1&expense_id='.$expense_id.'');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&expense_id='.$expense_id.'');
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
