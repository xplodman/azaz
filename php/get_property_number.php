<?php

include_once "connection.php";
if (!empty($_POST["site_id"])) {
    $site_id = $_POST["site_id"];
    $towerlist = $_POST["towerlist"];
    $property_type = $_POST["property_type"];
    $query="
Select property.name,
  property.area,
  property.price,
  property.id 
From property
  Inner Join tower On tower.id = property.tower_id
  Inner Join site On site.id = tower.site_id
  Inner Join property_type On property_type.id = property.property_type_id
  LEFT JOIN owner_has_property ON property.id = owner_has_property.property_id
Where tower.id = $towerlist And site.id = $site_id And property_type.id = $property_type AND ( owner_has_property.property_id IS NULL OR property_id not in 
(Select property.id
From owner_has_property
  Inner Join property On property.id = owner_has_property.property_id
  Inner Join property_type On property_type.id = property.property_type_id
  Inner Join tower On tower.id = property.tower_id
  Inner Join site On site.id = tower.site_id
Where owner_has_property.status = 1  )
)
 Group By property.id";
    $results = mysqli_query($con, $query);

    foreach ($results as $property_name){
        ?>
        <option value="<?php echo $property_name["id"];?>"><?php echo $property_name["name"];?></option>
        <?php
    }

}
?>