<?php
include_once "connection.php";

$students_stid=$_POST['students_stid'];
$material_matid=$_POST['material_matid'];
$date=$_POST['date'];


$len = count($students_stid);
for($x=0 ; $x < $len ; $x++){
    $result1 = mysqli_query($con, "INSERT INTO `5inarch`.`absence` (`absid`, `date`, `students_stid`, `material_matid`) VALUES (NULL, '$date', '$students_stid[$x]', '$material_matid');");
}


$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($result1) {
mysqli_commit($con);

    header('Location: '.$uri_parts[0].'?backresult=1');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;}
?>