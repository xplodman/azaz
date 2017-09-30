<?php
include_once "connection.php";
$query = "SELECT * FROM job";
$results=mysqli_query($con, $query);
//loop
foreach ($results as $job){
    ?>
    <option value="<?php echo $job["jobid"];?>"><?php echo $job["jobname"];?></option>
    <?php
}
?>
