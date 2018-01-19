<?php
	// Set timezone

	// Start date
	$date = '2018-01-01';
	// End date
	$end_date = '2018-01-01';
	$query = "select ca.nickname";
		while (strtotime($date) <= strtotime($end_date)) {
			$query .= ", max(case when ca.db_date = '$date' then coalesce(p.checkintime , 'غياب') end) `$date`";
			$date = date("Y-m-d", strtotime("+1 day", strtotime($date)));
		}
	$query .= "
	from
	(
	  select c.db_date, a.nickname, a.idusers
	  from time_dimension c
	  cross join users a
	) ca
	left join attendance p
	  on ca.idusers = p.idusers
	  and ca.db_date = p.checkindate
	group by ca.idusers, ca.nickname
	order by ca.idusers;";
	echo $query;
?>

