<?php
include_once "connection.php";
session_start();
$user_id=$_SESSION['azaz']['id'];
$partner_income_date=$_POST['partner_income_date'];
$partner_name=$_POST['partner_name'];
$site_id=$_POST['site_id'];
$partner_income_value=$_POST['partner_income_value'];

$result1 = mysqli_query($con, "INSERT INTO `transaction` (`id`, `date_1`, `date_2`, `value`, `status`, `removed`, `flag_id`, `property_id`, `owner_id`, `site_id`, `custoder_id`, `reason_id`, `users_id`, `create_time`, `update_time`, `comment`) VALUES (NULL, '$partner_income_date', NULL, '$partner_income_value', '1', '0', '8', NULL, NULL, '$site_id', NULL, NULL, '$user_id', CURRENT_TIMESTAMP, NULL, '$partner_name');")or die(mysqli_error($con));



$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($result1) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1');
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0');
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

