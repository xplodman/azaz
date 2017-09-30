<?php
include_once "connection.php";
//var_dump(get_defined_vars());

$receiptid=$_GET['receiptid'];

$result=mysqli_query($con, "SELECT * FROM `tickets` where `tiid`=$receiptid");
$receiptresult = mysqli_fetch_assoc($result);

    if ($receiptresult['tireason'] == 'p1') {
        $newbalance= $receiptresult['tiamount']*-1;
        $student=mysqli_query($con, "SELECT * FROM `students` where `stid`=$receiptresult[tidonor]");
        $student = mysqli_fetch_assoc($student);
        $newbalance=$newbalance+$student['stbalance'];

        $result2 = mysqli_query($con, "UPDATE `5inarch`.`students` SET `stbalance` = '$newbalance' WHERE `students`.`stid` = $receiptresult[tidonor];");
        $result3 = mysqli_query($con, "DELETE FROM `tickets` WHERE `tiid`=$receiptid;");
        mysqli_commit($con);
    }

    if ($receiptresult['tireason'] == 'm0') {
        $student=mysqli_query($con, "SELECT * FROM `students` where `stid`=$receiptresult[tirecipient]");
        $student = mysqli_fetch_assoc($student);
        $newbalance= $receiptresult['tiamount'];
        $newbalance=$newbalance+$student['stbalance'];
        $result2 = mysqli_query($con, "UPDATE `5inarch`.`students` SET `stbalance` = '$newbalance' WHERE `students`.`stid` = $receiptresult[tirecipient];");
        $result3 = mysqli_query($con, "DELETE FROM `tickets` WHERE `tiid`=$receiptid;");
        mysqli_commit($con);
    }
$result3 = mysqli_query($con, "DELETE FROM `tickets` WHERE `tiid`=$receiptid;");
mysqli_commit($con);


$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($result2 || $result3) {
    mysqli_commit($con);

    header('Location: ../receipts.php?backresult=1');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}
else {

    header('Location: ../receipts.php?backresult=0');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;}
?>