<?php
include_once "connection.php";

$type=$_POST['type'];
$subject=$_POST['subject'];
$value=$_POST['value'];
$custody_date=$_POST['custody_date'];
$site_id=$_POST['site_id'];
$custoder_id=$_POST['custoder_id'];

$query = mysqli_query($con, "INSERT INTO `custoder_accounting` (`id`, `type`, `date`, `subject`, `value`, `create_time`, `update_time`, `site_id`, `status`, `custoder_id`) VALUES (NULL, '$type', '$custody_date', '$subject', '$value', CURRENT_TIMESTAMP, NULL, '$site_id', '1', '$custoder_id');")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($query) {
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
<!---->
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

