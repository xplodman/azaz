<?php
include_once "connection.php";
$character = array(" ", "	", "(", ")", "-", "/");

$materials=$_POST['materials'];
$prname=$_POST['prname'];
$prmob =$_POST['prmob'];
$prmob = str_replace($character, "", $prmob);
$prtel =$_POST['prtel'];
$prtel = str_replace($character, "", $prtel);
$prparentname =$_POST['prparentname'];
$prparentmob =$_POST['prparentmob'];
$prparentmob = str_replace($character, "", $prparentmob);
$premail =$_POST['premail'];
$prbalance =$_POST['prbalance'];
$professorsappid =$_POST['professorsappid'];
$professorsapppw =$_POST['professorsapppw'];
$professorsrole =$_POST['professorsrole'];

$maxprid = mysqli_query($con, "Select Max(`professors`.`prid`) From `professors`");
$maxprid = mysqli_fetch_row($maxprid);
$maxprid = implode("", $maxprid);
$maxprid =$maxprid+1;

$query = mysqli_query($con, "INSERT INTO `professors`(`prid`, `prname`, `prmob`, `prtel`, `prparentname`, `prparentmob`, `premail`, `prbalance`, `professorsappid`, `professorsapppw`, `professorsrole`) VALUES ('$maxprid','$prname','$prmob','$prtel','$prparentname','$prparentmob','$premail','$prbalance','$professorsappid','$professorsapppw','$professorsrole');")or die(mysqli_error($con));


if (!empty($materials)) {
    $len = count($materials);
    $maxprmatid = mysqli_query($con, "Select Max(`prmat`.`prmatid`) From `prmat`");
    $maxprmatid = mysqli_fetch_row($maxprmatid);
    $maxprmatid = implode("", $maxprmatid);
    $maxprmatid =$maxprmatid+1;
    for($x=0 ; $x < $len ; $x++){
        $query2 = mysqli_query($con, "INSERT INTO `5inarch`.`prmat` (`prmatid`, `professors_prid`, `material_matid`) VALUES ('$maxprmatid', '$maxprid', '$materials[$x]');");
        $maxprmatid =$maxprmatid+1;
    }
}else{
}

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($query & $query2) {
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