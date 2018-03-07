<?php
include_once "connection.php";
session_start();
$user_id=$_SESSION['azaz']['id'];
$property_number=$_POST['property_number'];
$owner_name=$_POST['owner_name'];
$owner_number=$_POST['owner_number'];
$owner_number_2=$_POST['owner_number_2'];
$property_price_2=$_POST['property_price_2'];
$property_price=$_POST['property_price'];
$first_date=$_POST['first_date'];
$first_date=date("Y-m-d", strtotime($first_date) );
$first_price=$_POST['first_price'];
$price=$_POST['price'];
$date=$_POST['date'];
$last_date=$_POST['last_date'];
$last_date=date("Y-m-d", strtotime($last_date) );
$last_price=$_POST['last_price'];
$contract_date=$_POST['contract_date'];
$contract_date=date("Y-m-d", strtotime($contract_date) );
$basics_cost=$_POST['basics_cost'];

$len_date = count($date);
$len_price = count($price);

$insert_owner = mysqli_query($con, "INSERT INTO `owner` (`id`, `name`, `mobile`,`mobile_2`, `create_time`, `update_time`) VALUES (NULL, '$owner_name', '$owner_number','$owner_number_2', CURRENT_TIMESTAMP, NULL);")or die(mysqli_error($con));

$maxownerid = mysqli_query($con, "SELECT MAX(id) FROM owner");
$maxownerid = mysqli_fetch_row($maxownerid);
$maxownerid = implode("", $maxownerid);

$insert_owner_has_property = mysqli_query($con, "INSERT INTO `owner_has_property` (`id`, `owner_id`, `property_id`, `create_time`, `update_time`, `status`, `contract_date`, `users_id`) VALUES (NULL, '$maxownerid', '$property_number', CURRENT_TIMESTAMP, NULL, '1', '$contract_date', '$user_id');")or die(mysqli_error($con));

$insert_first_payment = mysqli_query($con, "INSERT INTO `transaction` (`id`, `date_1`, `date_2`, `value`, `status`, `removed`, `flag_id`, `property_id`, `owner_id`, `site_id`, `custoder_id`, `reason_id`, `users_id`, `create_time`, `update_time`, `number`) VALUES (NULL, '$first_date', '$first_date', '$first_price', '1', '0', '1', '$property_number', '$maxownerid', NULL, NULL, NULL, '$user_id', CURRENT_TIMESTAMP, NULL, '0');")or die(mysqli_error($con));

$transaction_number=1;

if ($len_date == $len_price) {
    for($y=0 ; $y < $len_date ; $y++)
    {
        $date[$y]=date("Y-m-d", strtotime($date[$y]) );
        $insert_payment = mysqli_query($con, "INSERT INTO `transaction` (`id`, `date_1`, `date_2`, `value`, `status`, `removed`, `flag_id`, `property_id`, `owner_id`, `site_id`, `custoder_id`, `reason_id`, `users_id`, `create_time`, `update_time`, `number`) VALUES (NULL, '$date[$y]', NULL, '$price[$y]', '0', '0', '2', '$property_number', '$maxownerid', NULL, NULL, NULL, '$user_id', CURRENT_TIMESTAMP, NULL, '$transaction_number');")or die(mysqli_error($con));
        $transaction_number++;
    }
}

$insert_last_payment = mysqli_query($con, "INSERT INTO `transaction` (`id`, `date_1`, `date_2`, `value`, `status`, `removed`, `flag_id`, `property_id`, `owner_id`, `site_id`, `custoder_id`, `reason_id`, `users_id`, `create_time`, `update_time`, `number`) VALUES (NULL, '$last_date', NULL, '$last_price', '0', '0', '3', '$property_number', '$maxownerid', NULL, NULL, NULL, '$user_id', CURRENT_TIMESTAMP, NULL, '999');")or die(mysqli_error($con));


//$insert_basics_cost = mysqli_query($con, "INSERT INTO `transaction` (`id`, `date_1`, `date_2`, `value`, `status`, `removed`, `flag_id`, `property_id`, `owner_id`, `site_id`, `custoder_id`, `reason_id`, `users_id`, `create_time`, `update_time`, `number`) VALUES (NULL, '$last_date', NULL, '$basics_cost', '0', '0', '9', '$property_number', '$maxownerid', NULL, NULL, NULL, '$user_id', CURRENT_TIMESTAMP, NULL,'1000');")or die(mysqli_error($con));



$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($insert_owner & $insert_owner_has_property & $insert_first_payment & $insert_payment & $insert_last_payment) {
    mysqli_commit($con);

    header('Location: '.$uri_parts[0].'?backresult=1');
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0');
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

