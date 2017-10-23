<?php
include_once "connection.php";
if (!empty($_POST["site"])) {
    $site = $_POST["site"];
    $query="
Select tower.name,
  tower.id
From site
  Inner Join tower On tower.site_id = site.id
Where tower.site_id = $site";
    $results = mysqli_query($con, $query);

    foreach ($results as $tower){
        ?>
        <option value="<?php echo $tower["id"];?>"><?php echo $tower["name"];?></option>
        <?php
    }

}
?>