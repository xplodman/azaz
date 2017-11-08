<?php
include_once "connection.php";
$user_id=$_GET['user_id'];
$nickname=$_POST['nickname'];
$username=$_POST['username'];
$password=$_POST['password'];
$role=$_POST['role'];

$update_custoder = mysqli_query($con, "UPDATE `users` SET `username` = '$username', `password` = '$password', `nickname` = '$nickname', `role` = '$role', `update_time` = NOW() WHERE `users`.`id` = '$user_id';")or die(mysqli_error($con));


$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);

if ($update_custoder) {
    mysqli_commit($con);
    header('Location: '.$uri_parts[0].'?backresult=1&user_id='.$user_id.'');
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&user_id='.$user_id.'');
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
<!---->
