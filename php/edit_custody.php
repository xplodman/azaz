<?php
include_once "connection.php";
$custody_id=$_GET['custody_id'];
$custody_date=$_POST['custody_date'];
$custody_subject=$_POST['custody_subject'];
$custody_value=$_POST['custody_value'];
$type=$_POST['type'];
$custoder_id=$_POST['custoder_id'];
$site_id=$_POST['site_id'];

$update_custoder = mysqli_query($con, "UPDATE `custoder_accounting` SET `type` = '$type', `custoder_id` = '$custoder_id', `date` = '$custody_date', `subject` = '$custody_subject', `value` = '$custody_value', `update_time` = CURRENT_TIMESTAMP , `site_id` = '$site_id' WHERE `custoder_accounting`.`id` = '$custody_id';")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($update_custoder) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1&custody_id='.$custody_id.'');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&custody_id='.$custody_id.'');
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
