<?php
include_once "php/connection.php";
include_once "php/checkauthentication.php";


$month = date('m');
$count_payment_query = mysqli_query($con,"
                                                        select Coalesce(Sum(transaction.value), 0) As Count_value
From transaction
  Inner Join property On property.id = transaction.property_id
  Inner Join tower On property.tower_id = tower.id
  Inner Join site On tower.site_id = site.id
Where Month(transaction.date_2) = $month And transaction.status = 1 And
  transaction.removed = 0 And transaction.flag_id In (1, 2, 3) And site.id = $site_info[id]") or die(mysqli_error($con));
$count_payment_info = mysqli_fetch_assoc($count_payment_query);
?>
<h2 class="font-bold"><?php echo $count_payment_info['Count_value']?></h2>