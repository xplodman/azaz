<meta charset="utf-8">

<?php
include_once "connection.php";
session_start();
$user_id=$_SESSION['azaz']['id'];
$date_1=$_POST['date_1'];
$owner_id=$_POST['owner_id'];
$owner_has_property_id=$_POST['owner_has_property_id'];
$property_done_price=$_POST['property_done_price'];
$property_id=$_GET['property_id'];

$step_1= mysqli_query($con, "SELECT
  property.name AS property_name,
  tower.name AS tower_name,
  site.name AS site_name,
  owner.name AS owner_name
FROM
  `azaz`.property
  INNER JOIN `azaz`.property_type ON `azaz`.property.property_type_id = `azaz`.property_type.id
  INNER JOIN `azaz`.tower ON `azaz`.property.tower_id = `azaz`.tower.id
  INNER JOIN `azaz`.site ON `azaz`.tower.site_id = `azaz`.site.id
  INNER JOIN `azaz`.owner_has_property ON `azaz`.owner_has_property.property_id = `azaz`.property.id
  INNER JOIN owner ON `azaz`.owner_has_property.owner_id = `azaz`.owner.id
WHERE
  owner_has_property.status = 1 AND
  property.id = '$property_id'")or die(mysqli_error($con));
$step_1 = mysqli_fetch_assoc($step_1);
$comment_info=" شقة ".$step_1['property_name']." برج ".$step_1['tower_name'].$step_1['site_name']." لصاحبها ".$step_1['owner_name'];
$remove_contract = mysqli_query($con, "UPDATE `azaz`.`owner_has_property` SET `status` = '0', `update_time` = NOW() WHERE `owner_has_property`.`id` = '$owner_has_property_id';")or die(mysqli_error($con));

$change_payments_to_recevied = mysqli_query($con, "UPDATE `azaz`.`transaction` SET `update_time` = NOW(), `flag_id` = '10', `property_id` = NULL, `comment` = '$comment_info', `owner_id` = NULL WHERE `transaction`.`owner_id` = '$owner_id' AND `transaction`.`status` = '1';")or die(mysqli_error($con));

$insert_spent_property_done_price = mysqli_query($con, "INSERT INTO `azaz`.`transaction` (`id`, `date_1`, `date_2`, `value`, `status`, `removed`, `flag_id`, `property_id`, `owner_id`, `site_id`, `custoder_id`, `reason_id`, `users_id`, `create_time`, `update_time`, `comment`, `number`) VALUES (NULL, '$date_1', NULL, '-$property_done_price', NULL, '0', '11', NULL, NULL, NULL, NULL, NULL, '$user_id', CURRENT_TIMESTAMP, NULL, '$comment_info', NULL);")or die(mysqli_error($con));

$remove_payments = mysqli_query($con, "delete from `azaz`.`transaction` WHERE `transaction`.`owner_id` = '$owner_id';")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($remove_contract & $change_payments_to_recevied & $insert_spent_property_done_price & $remove_payments) {
    mysqli_commit($con);
    header('Location: ../property.php?property_id='.$property_id.'&backresult=1');
    exit;
}
else {

    header('Location: ../property.php?property_id='.$property_id.'&backresult=0');
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
//    };
//    foreach ($_GET as $key => $value) {
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

