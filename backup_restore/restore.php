<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include_once "../php/connection.php";
if (!empty($_GET["restore_file_path"])) {
    $filename = $_GET["restore_file_path"];
    exec('mysql -u root -proot -h localhost azaz < '.$filename.'.sql');
}
