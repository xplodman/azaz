<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include_once "connection.php";
if (!empty($_POST["filename"])) {
    $filename = $_POST["filename"];
    exec('mysqldump -e -uroot -proot -hlocalhost azaz > "backup/'.$filename.'.sql ');
}
