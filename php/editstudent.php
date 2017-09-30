<?php
//var_dump(get_defined_vars());

include_once "connection.php";


$character = array(" ", "	", "(", ")", "-", "/");

$student_id=$_GET['student_id'];
$stname=$_POST['stname'];
$stcode=$_POST['stcode'];
$stmob=$_POST['stmob'];
$sttel=$_POST['sttel'];
$stparenttype=$_POST['stparenttype'];
$stparentname=$_POST['stparentname'];
$stparentmob=$_POST['stparentmob'];
$stemail=$_POST['stemail'];
$staddress=$_POST['staddress'];
$stnationalid=$_POST['stnationalid'];
$sttype=$_POST['sttype'];
$styear=$_POST['styear'];
$stterm=$_POST['stterm'];
$stgroup=$_POST['stgroup'];
$sttype2=$_POST['sttype2'];
$materials=$_POST['materials'];
$materialscount=count($materials);



$result1 = mysqli_query($con, "UPDATE `5inarch`.`students` SET `stname` = '$stname',`stcode` = '$stcode', `stmob` = '$stmob', `sttel` = '$sttel', `stparenttype` = '$stparenttype', `stparentname` = '$stparentname', `stparentmob` = '$stparentmob', `stemail` = '$stemail', `staddress` = '$staddress', `stnationalid` = '$stnationalid', `sttype` = '$sttype',`sttype2` = '$sttype2', `styear` = '$styear', `stterm` = '$stterm', `stgroup` = '$stgroup' WHERE `students`.`stid` = $student_id;");

$result2 = mysqli_query($con, "UPDATE `5inarch`.`stmat` SET `status` = '0' WHERE `students_stid` = $student_id;");

$len = count($materials);
    for($x=0 ; $x < $len ; $x++){
        $result3 = mysqli_query($con, "INSERT INTO `5inarch`.`stmat` (`stmatid`, `students_stid`, `material_matid`, `status`) VALUES (NULL, '$student_id', '$materials[$x]', '1');");
    }



$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($result1 || $result2 || $result3) {
mysqli_commit($con);

    header('Location: '.$uri_parts[0].'?backresult=1&student_id='.$student_id);
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&student_id='.$student_id);
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;}
