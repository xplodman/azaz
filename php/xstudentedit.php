<meta charset="utf-8">

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST'){
    require 'connection.php';
    $errors=0;
    $students=$_POST['students'];
    $len = count($students);

    for($z=0 ; $z < $len ; $z++){

        if (isset($_POST['materials_check'])) {
            $query = mysqli_query($con, "UPDATE `5inarch`.`stmat` SET `status` = '0' WHERE `students_stid` = '$students[$z]';");
            if (!$query){
                $errors.=1;
            }
            if (isset($_POST['materials'])){
                $materials=$_POST['materials'];
                $len2 = count($materials);

                for($y=0 ; $y < $len2 ; $y++){
                    $query2 = mysqli_query($con, "INSERT INTO `5inarch`.`stmat` (`stmatid`, `material_matid`, `students_stid`, `status`) VALUES (NULL, '$materials[$y]', '$students[$z]','1');");
                    if (!$query2){
                        $errors.=1;
                    }
                };
            }
        }
        if (isset($_POST['year_check'])) {
            $year =$_POST['year'];
            $query3 = mysqli_query($con, "UPDATE `5inarch`.`students` SET `styear` = $year WHERE `students`.`stid` = '$students[$z]';");
            if (!$query3){
                $errors.=1;
            }
        }
        if (isset($_POST['term_check'])) {
            $term =$_POST['term'];
            $query4 = mysqli_query($con, "UPDATE `5inarch`.`students` SET `stterm` = $term WHERE `students`.`stid` = '$students[$z]';");
            if (!$query4){
                $errors.=1;
            }
        }
        if (isset($_POST['type_check'])) {
            $type =$_POST['type'];
            $query5 = mysqli_query($con, "UPDATE `5inarch`.`students` SET `sttype2` = '$type' WHERE `students`.`stid` = '$students[$z]';");
            if (!$query5){
                $errors.=1;
            }
        }
        if (isset($_POST['nature_check'])) {
            $nature =$_POST['nature'];
            $query5 = mysqli_query($con, "UPDATE `5inarch`.`students` SET `sttype` = '$nature' WHERE `students`.`stid` = '$students[$z]';");
            if (!$query5){
                $errors.=1;
            }
        }
        if (isset($_POST['balance_check'])) {
            $balance =$_POST['balance'];
            $query6 = mysqli_query($con, "UPDATE `5inarch`.`students` SET `stbalance` = `stbalance`+$balance WHERE `students`.`stid` = '$students[$z]';");
            if (!$query6){
                $errors.=1;
            }
        }
    };
}

$uri_parts = explode('?', $_SERVER['HTTP_REFERER'], 2);
if ($errors == 0) {
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