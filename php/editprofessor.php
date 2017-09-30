<meta charset="utf-8">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require 'connection.php';
    $character = array(" ", "	", "(", ")", "-", "/");

    $professorid=$_GET['professorid'];
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

    $query = mysqli_query($con, "UPDATE `5inarch`.`professors` SET `prname` = '$prname', `prmob` = '$prmob', `prtel` = '$prtel', `prparentname` = '$prparentname', `prparentmob` = '$prparentmob', `premail` = '$premail', `prbalance` = '$prbalance', `professorsappid` = '$professorsappid', `professorsapppw` = '$professorsapppw', `professorsrole` = '$professorsrole' WHERE `professors`.`prid` ='$professorid';");

    if (!empty($materials)) {
        $len = count($materials);
        $query3 = mysqli_query($con, "DELETE FROM prmat WHERE professors_prid='$professorid';");
        for($x=0 ; $x < $len ; $x++){
            $query3 = mysqli_query($con, "INSERT INTO `5inarch`.`prmat` (`prmatid`, `professors_prid`, `material_matid`) VALUES (NULL, '$professorid', '$materials[$x]');");
        }
    }else{
        $query2 = mysqli_query($con, "DELETE FROM prmat WHERE professors_prid='$professorid';");
    }
}

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($query) {
    mysqli_commit($con);

    header('Location: '.$uri_parts[0].'?backresult=1&professorid='.$professorid.'');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}
else {

    header('Location: '.$uri_parts[0].'?backresult=0&professorid='.$professorid.'');
    $fh = fopen('/tmp/track.txt','a');
    fwrite($fh, $_SERVER['REMOTE_ADDR'].' '.date('c')."\n");
    fclose($fh);
    exit;
}