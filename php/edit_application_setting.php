<?php
include_once "connection.php";
$expense_from_date=$_POST['expense_from_date'];
$expense_to_date=$_POST['expense_to_date'];
$custodies_from_date=$_POST['custodies_from_date'];
$custodies_to_date=$_POST['custodies_to_date'];
$payment_from_date=$_POST['payment_from_date'];
$payment_to_date=$_POST['payment_to_date'];

$update_application_setting = mysqli_query($con, "UPDATE `application_setting` SET `expense_from_date` = '$expense_from_date', `expense_to_date` = '$expense_to_date', `custodies_from_date` = '$custodies_from_date', `custodies_to_date` = '$custodies_to_date', `payment_from_date` = '$payment_from_date', `payment_to_date` = '$payment_to_date' WHERE `application_setting`.`id` = 0;
")or die(mysqli_error($con));


$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($update_application_setting) {
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
