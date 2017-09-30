<?php
include_once "connection.php";
if (!empty($_POST["prosecution"])) {
    $prosecution = $_POST["prosecution"];
    $query="
Select hardware.hardwareid,
  hardware.hardwarename,
  hardware.hardwaresn,
  category.categoryname
From hardware
  Inner Join prosecution On prosecution.prosecutionid = hardware.prosecutionid
  Inner Join category On category.categoryid = hardware.categoryid
  Left Join user_has_hardware On user_has_hardware.hardwareid =
    hardware.hardwareid  
WHERE ( user_has_hardware.hardwareid IS NULL or user_has_hardware.hardwareid = 0) AND prosecution.prosecutionid = $prosecution";
    $results = mysqli_query($con, $query);

    foreach ($results as $hardware){
        ?>
        <option value="<?php echo $hardware["hardwareid"];?>"><?php echo $hardware["categoryname"]." - ".$hardware["hardwaresn"];?>
        </option>
        <?php
    }

}
?>