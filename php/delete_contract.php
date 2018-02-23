<?php
include_once "connection.php";
$contract_id=$_GET['contract_id'];
$property_id=$_GET['property_id'];

$result=mysqli_query($con, "Select owner.id From owner_has_property Inner Join owner On owner.id = owner_has_property.owner_id Where owner_has_property.id = $contract_id");
$owner_info = mysqli_fetch_assoc($result);

$remove_contract = mysqli_query($con, "delete from `owner_has_property` WHERE `owner_has_property`.`id` = '$contract_id';")or die(mysqli_error($con));

$remove_payments = mysqli_query($con, "delete from `transaction` WHERE `transaction`.`owner_id` = '$owner_info[id]';")or die(mysqli_error($con));


$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($remove_contract & $remove_payments) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1&property_id='.$property_id.'');
    exit;
}
else {
    header('Location: '.$uri_parts[0].'?backresult=0&property_id='.$property_id.'');
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

