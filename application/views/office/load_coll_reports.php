<h3>Fee Related Records</h3>
<?
//echo "College".$college."<br>Course".$course."<br>Branch".$branch."<br>FFY".$ffy."<br>PType".$ptype."<br>TofFee".$tof;
//$data=array("college"=>$college,"course"=>$course,"branch"=>$branch,"ffy"=>$ffy,"ptype"=>$ptype,"tof"=>$tof);
?>

<?

echo "<br>Total Records found:".count($result);
echo "<table border='1'><tr><th>Receipt No</th><th>Name</th><th>HT Number</th><th>Branch</th><th>Fee for Year</th><th>Date</th><th>Amount</th><th>Payment Type</th><th>Type of Fee</th></tr>";


for($i=1;$i<=count($result);$i++)
{

echo "<tr><td>".$result[$i-1]->receipt_no."</td><td>".$result[$i-1]->name."</td><td>".$result[$i-1]->students_number."</td><td>".$result[$i-1]->branch_name."</td><td>".$result[$i-1]->feeforyear."</td><td>".
$result[$i-1]->date."</td><td>".$result[$i-1]->amount."</td><td>".$result[$i-1]->paymenttype."</td><td>".
$result[$i-1]->typeoffee."</td></tr>";
}
echo "</table>";

?>
