<?php
include_once "connection.php";
$custody_id=$_GET['custody_id'];


$remove_custodies = mysqli_query($con, "UPDATE `custoder_accounting` SET `status` = '1' , `update_time` = NOW() WHERE `custoder_accounting`.`id` = '$custody_id';")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($remove_custodies) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}
else {
    header('Location: '.$uri_parts[0].'?backresult=0');
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

