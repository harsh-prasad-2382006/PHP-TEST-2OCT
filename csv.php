<?php 

include 'db.php';
header('Content-type:text/csv');
header("Content-disposition:attachment;filename=Student.csv");
$output=fopen("php://output","w");
fputcsv($output,array('ID','Name','Class','Batch','Email','Salary'));
$result =  $conn->query('select * from student');
while($row=$result->fetch_assoc()){
    fputcsv($output,$row);
}

?> 