<?php
include_once "connection.php";

$nickname=$_POST['nickname'];
$username=$_POST['username'];
$password=$_POST['password'];
$role=$_POST['role'];

$query = mysqli_query($con, "INSERT INTO `users` (`id`, `username`, `password`, `nickname`, `role`, `create_time`, `update_time`) VALUES (NULL, '$username', '$password', '$nickname', '$password', CURRENT_TIMESTAMP, NULL);")or die(mysqli_error($con));

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($query) {
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
<!---->
