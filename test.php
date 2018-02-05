<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include_once "connection.php";
if (!empty($_POST["restore_file_path"])) {
    $restore_file_path = $_POST["restore_file_path"];
    exec('mysqldump -e -uroot -proot -hlocalhost azaz > "backup/'.$filename.'.sql ');
}
