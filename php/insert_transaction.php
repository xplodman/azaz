<?php
include_once "connection.php";
$property_number=$_POST['property_number'];
$owner_name=$_POST['owner_name'];
$owner_number=$_POST['owner_number'];
$property_price_2=$_POST['property_price_2'];
$property_price=$_POST['property_price'];
$first_date=$_POST['first_date'];
$first_price=$_POST['first_price'];
$price=$_POST['price'];
$date=$_POST['date'];
$last_date=$_POST['last_date'];
$last_price=$_POST['last_price'];
$contract_date=$_POST['contract_date'];

$len_date = count($date);
$len_price = count($price);

$insert_owner = mysqli_query($con, "INSERT INTO `owner` (`id`, `name`, `mobile`, `create_time`, `update_time`) VALUES (NULL, '$owner_name', '$owner_number', CURRENT_TIMESTAMP, NULL);")or die(mysqli_error($con));

$maxownerid = mysqli_query($con, "SELECT MAX(id) FROM owner");
$maxownerid = mysqli_fetch_row($maxownerid);
$maxownerid = implode("", $maxownerid);

$insert_owner_has_property = mysqli_query($con, "INSERT INTO `owner_has_property` (`id`, `owner_id`, `property_id`, `create_time`, `update_time`, `status`, `contract_date`) VALUES (NULL, '$maxownerid', '$property_number', CURRENT_TIMESTAMP, NULL, '1', '$contract_date');")or die(mysqli_error($con));

$insert_first_payment = mysqli_query($con, "INSERT INTO `payment` (`id`, `due_date`, `payment_date`, `value`, `create_time`, `update_time`, `property_id`, `owner_id`, `status`, `type`, `removed`) VALUES (NULL, '$first_date', '$first_date', '$first_price', CURRENT_TIMESTAMP, NULL, '$property_number', '$maxownerid', '1', '1', '0');")or die(mysqli_error($con));

if ($len_date == $len_price) {
    for($y=0 ; $y < $len_date ; $y++)
    {
        $insert_payment = mysqli_query($con, "INSERT INTO `payment` (`id`, `due_date`, `payment_date`, `value`, `create_time`, `update_time`, `property_id`, `owner_id`, `status`, `type`, `removed`) VALUES (NULL, '$date[$y]', NULL, '$price[$y]', CURRENT_TIMESTAMP, NULL, '$property_number', '$maxownerid', '0', '2', '0');")or die(mysqli_error($con));
    }
}

$insert_last_payment = mysqli_query($con, "INSERT INTO `payment` (`id`, `due_date`, `payment_date`, `value`, `create_time`, `update_time`, `property_id`, `owner_id`, `status`, `type`, `removed`) VALUES (NULL, '$last_date', NULL, '$last_price', CURRENT_TIMESTAMP, NULL, '$property_number', '$maxownerid', '0', '3', '0');")or die(mysqli_error($con));



$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($insert_owner & $insert_owner_has_property & $insert_first_payment & $insert_payment & $insert_last_payment) {
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
