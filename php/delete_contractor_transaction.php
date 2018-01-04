<?php
include_once "connection.php";
$expense_id=$_GET['expense_id'];


$remove_expense = mysqli_query($con, "UPDATE `transaction` SET `removed` = '1', `update_time` = NOW() WHERE `transaction`.`id` = '$expense_id';")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($remove_expense) {
    mysqli_commit($con);
    header('Location: ../contractors.php?backresult=1');
    exit;
}
else {
    header('Location: ../contractors.php?backresult=0');
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

