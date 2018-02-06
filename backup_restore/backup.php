<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<?php
include_once "../php/connection.php";
if (!empty($_GET["filename"])) {
    $filename = $_GET["filename"];
    exec('mysqldump -e -uroot -proot -hlocalhost azaz > "'.$filename.'.sql ');
}
