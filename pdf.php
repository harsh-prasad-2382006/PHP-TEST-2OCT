<?php 

include 'db.php';
require 'vendor/autoload.php';

$result =  $conn->query('select * from student');
$pdf = new TCPDF();
$pdf->addpage();
$pdf->setFont('times','BI','12');
$html = '<table border="1" cellpadding="5">
<tr>
    <td>ID</td>
    <td>Name</td>
    <td>Class</td>
    <td>Batch</td>
    <td>Email</td>
    <td>City</td>
</tr>';
while($row=$result->fetch_assoc()){
    $html.= '
    <tr>
        <td>'.$row['id'].'</td>
        <td>'.$row['name'].'</td>
        <td>'.$row['class'].'</td>
        <td>'.$row['batch'].'</td>
        <td>'.$row['email'].'</td>
        <td>'.$row['city'].'</td>
    </tr>'
    ;
}
$html.='</table>';
$pdf->writehtml($html,true,false,true,false,'C');
$pdf->output("Student.pdf","D");

?>
