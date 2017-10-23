<?php
include_once "connection.php";
if (!empty($_POST["tower_number"])) {
    $tower_number = $_POST["tower_number"];
    $query="
Select property_type.name,
  property_type.id
From tower
  Inner Join property On property.tower_id = tower.id
  Inner Join property_type On property_type.id = property.property_type_id
Where property.tower_id = $tower_number
Group By property_type.id";
    $results = mysqli_query($con, $query);

    foreach ($results as $property_type){
        ?>
        <option value="<?php echo $property_type["id"];?>"><?php echo $property_type["name"];?></option>
        <?php
    }

}
?>