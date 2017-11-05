<?php
include_once "connection.php";
session_start();
$user_id=$_SESSION['azaz']['id'];
$date_1=$_POST['date_1'];
$value=$_POST['value'];
$custoder_id=$_POST['custoder_id'];
if ($value > 0)
{
    $value=$value*-1;
}

$query = mysqli_query($con, "INSERT INTO `transaction` (`id`, `date_1`, `date_2`, `value`, `status`, `removed`, `flag_id`, `property_id`, `owner_id`, `site_id`, `custoder_id`, `reason_id`, `users_id`, `create_time`, `update_time`) VALUES (NULL, '$date_1', NULL, '$value', NULL, '0', '6', NULL, NULL, NULL, '$custoder_id', NULL, '$user_id', CURRENT_TIMESTAMP, NULL);")or die(mysqli_error($con));



$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($query) {
mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1&custoder_id='.$custoder_id.'');
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&custoder_id='.$custoder_id.'');
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

