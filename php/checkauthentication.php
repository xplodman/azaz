<meta http-equiv="refresh" content="600;url=login.php" />

<?php
session_start();
if (!isset($_SESSION['5inarch']['authenticate']) or $_SESSION['5inarch']['authenticate']!="true")
{
    header('Location: login.php');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
}
/**
 * check user is authenticated
 */
if (($_SESSION['5inarch']['authenticate']))
{
    if(time() - $_SESSION['5inarch']['timestamp'] > 600) { //subtract new timestamp from the old one
        header('Location: php/logout.php');
    } else {
        $_SESSION['5inarch']['timestamp'] = time(); //set new timestamp
    }
}

$admin_security = array("reports.php", "professor.php", "receipt.php");
$power_security = array("stprofile.php", "receipts.php");

// Validate user is authorize to access this page
if (in_array(basename($_SERVER['PHP_SELF']), $admin_security)) {
    if ($_SESSION['5inarch']['role'] > 1){
        header("location:javascript://history.go(-1)");
        exit;
    }
}

if (in_array(basename($_SERVER['PHP_SELF']), $power_security)) {
    if ($_SESSION['5inarch']['role'] > 2){
        header("location:javascript://history.go(-1)");
        exit;
    }
}
