<?php
function student_count($styear) {
    include "php/connection.php";
    $result = mysqli_query($con,"Select Count(students.stid) As student_count From students Where students.sttype2 != 'E' AND students.styear = $styear");
    $row = mysqli_fetch_assoc($result);
    $sum = $row['student_count'];
    echo $sum;
}

function student_summary($styear , $clause , $condition) {
    include "php/connection.php";
    $result = mysqli_query($con,"Select Count(students.stid) As student_count From students Where $clause = '$condition' And students.styear = $styear");
    $row = mysqli_fetch_assoc($result);
    $sum = $row['student_count'];
    echo $sum;
}

function student_summary_detail($styear , $clause , $condition) {
    include "php/connection.php";
    $result = mysqli_query($con,"Select Count(students.stid) As student_count From students Where $clause = '$condition' And students.styear = $styear");
    $row = mysqli_fetch_assoc($result);
    $sum = $row['student_count'];
    return $sum;
}

function material_summary_detail($id , $clause , $condition) {
    include "php/connection.php";
    $result = mysqli_query($con,"Select Count(students.stid) As student_count,
  material.matname
From students
  Inner Join stmat On stmat.students_stid = students.stid
  Inner Join material On material.matid = stmat.material_matid
Where material.matid = '$id' And $clause = '$condition' And stmat.status = '1'");
    $row = mysqli_fetch_assoc($result);
    $student_count = $row['student_count'];
    return $student_count;

}

function summary_all_in($id , $year) {
    include "php/connection.php";
    $result = mysqli_query($con,"SELECT 
CASE 
    WHEN tickets.tireason = 'p1' then 'كورس'
    WHEN tickets.tireason = 'p2' then 'مذكرات'
    WHEN tickets.tireason = 'p3' then 'مراجعة نهائية' 
    WHEN tickets.tireason = 'p4' then 'آخري'   
    ELSE 'Maybe'                                 
END AS reason ,    
  Sum(tickets.tiamount)  AS amount                 
From tickets
  Inner Join students On students.stid = tickets.tidonor
Where tickets.titype in ('$id') And students.styear = '$year' 
Group By tickets.titype,
  tickets.tireason,
  students.styear");
    return $result;
}

function summary_all_out($id) {
    include "php/connection.php";
    $result = mysqli_query($con,"SELECT 
CASE 
    WHEN tickets.tireason = 'm1' then 'سلفة'
    WHEN tickets.tireason = 'm2' then 'محمول'
    WHEN tickets.tireason = 'm3' then 'راتب'
    WHEN tickets.tireason = 'm4' then 'تصوير'
    WHEN tickets.tireason = 'm5' then 'طباعة'
    WHEN tickets.tireason = 'm6' then 'مواصلات'
    WHEN tickets.tireason = 'm7' then 'دعاية'
    WHEN tickets.tireason = 'm8' then 'مكافأة'
    WHEN tickets.tireason = 'm9' then 'آخري'
    WHEN tickets.tireason = 'm10' then 'أدوات مكتبية'   
    ELSE 'Maybe'                                 
END AS reason ,    
  Sum(tickets.tiamount) AS amount                 
From tickets
Where tickets.titype in ('$id') 
Group By tickets.titype,
  tickets.tireason");
    return $result;
}

function summary_all_aid () {
    include "php/connection.php";
    $result = mysqli_query($con,"SELECT 
CASE 
    WHEN tickets.tireason = 'm0' then 'دعم'   
    ELSE 'Maybe'                                 
END AS reason ,    
  Sum(tickets.tiamount)  AS amount,
  CASE 
    WHEN students.styear = '1' then 'First'   
    WHEN students.styear = '2' then 'Second'   
    WHEN students.styear = '3' then 'Third'   
    WHEN students.styear = '4' then 'Fourth'   
    ELSE 'Maybe'                                 
END AS year                  
From tickets
  Inner Join students On students.stid = tickets.tirecipient
Where tickets.tireason = 'm0' 
Group By tickets.titype,
  tickets.tireason,
  students.styear");
    return $result;
}

function sumincome($styear) {
    include "php/connection.php";
    $result = mysqli_query($con,"Select Sum(students.stbalance) As stbalance
				From students
				Where students.sttype2 != 'E' And students.styear = '$styear'");
    $row = mysqli_fetch_assoc($result);
    $sum = $row['stbalance'];
    $sum=abs($sum);
    echo $sum;
}
function sumallincome($titype) {
    include "php/connection.php";
    $result = mysqli_query($con,"Select Sum(students.stbalance) As stbalance
				From students
				Where students.sttype2 != 'E' And students.styear != '5'");
    $row = mysqli_fetch_assoc($result);
    $sum = $row['stbalance'];
    if (is_null($row['stbalance']))
    {echo "No data!";};
    $sum=abs($sum);
    echo $sum;
};