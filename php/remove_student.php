<?php
require 'connection.php';

$absid=$_GET['absid'];

$query = mysqli_query($con, "DELETE FROM absence WHERE absid='$absid';");

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($query) {
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
    exit;
}