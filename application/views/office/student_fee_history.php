<?php
ob_start();
ob_flush();
flush();
 //print_r($student_details);
?>
<html>
<head>


<style type="text/css" media="screen">
   body {background-color: white;}
   input.required {background-color:#dfedf9;border:2px}
   input:focus {background-color: white; ; color: red;outline:none;border-color:#990066;box-shadow:0 0 10px #5da7e1;}
select:focus {background-color: white; ; color: red;outline:none;border-color:#990066;box-shadow:0 0 10px #5da7e1;}
   label {font-weight: bold;}
   input.bun{-moz-box-shadow:0px 0px 10 px Green; -webkit-box-shadow: 0px 0px 10px Green; box-shadow: 0px 0px 10px Green; }
</style>
</head>
<body>
<div class="clr"></div>
<div style="border:2px solid #4AA02c; margin:10px;padding:10px" >
<ol>

    <li>
        <label for="name">Name:</label>
<?	if (isset($student_details[0]->name))
    echo $student_details[0]->name;  ?>
    </li>
	<li>
        <label for="fathers_name">Father Name:*</label>
        <?php if (isset($student_details[0]->fathers_name))
                   echo $student_details[0]->fathers_name; ?>
    	</li>
    
    <li>
        <label for="students_number">HT Number:*</label>
        <?php if (isset($student_details[0]->students_number))
                   echo $student_details[0]->students_number; ?>
    </li>
<li>
        <label for="students_number">Course Name:*</label>
        <?php if (isset($student_details[0]->course_name))
                   echo $student_details[0]->course_name; ?>
    </li>

<li>
<label for="name">College Name:</label>
<?php if(isset($student_details[0]->college_name)) echo $student_details[0]->college_name; ?>
</li>
    
    
    <li>
        <label for="branch_id">Branch:*</label>
       <?php if (isset($student_details[0]->branch_name))
                   echo $student_details[0]->branch_name; ?>

</li>
<li>
        <label for="student_number">Scholarship:*</label>
       <?php if (isset($student_details[0]->scholarship))
                  // echo $student_details[0]->scholarship; 
		echo "Yes"; ?>

</li>
<li>
        <label for="student_number">Caste:*</label>
       <?php if (isset($student_details[0]->caste))
                   echo $student_details[0]->caste; ?>

</li>
<li>
        <label for="student_number">Fee for:*</label>
       <?php if (isset($ffy))
                   echo $ffy; ?>

</li>
 
   <li>
        <div class="clr"></div>
    </li>
</ol>
</div>
<div>
<table style="border:2px solid #4AA02c; margin:10px;padding:10px;width:98%">
<tr align="center">
<th>Date</th>
<th>Receipt No</th>
<th>Type of Fee</th>
<th>Received Amount</th>
<th>Payment Type</th>
<th>Balance as of day</th>
<th>Updated by</th>


</tr>

<?
if(count($payment_details)>=1)
{
foreach($payment_details as $row)
{
print "<tr align='center'><td>";
print $row->date;
print "</td><td>";
echo "<a href='";
echo site_url('office/pdfReceipt')."?id=".$row->receipt_no;
echo "'>";
print $row->receipt_no;
print "</a></td><td>";
print $row->typeoffee;
print "</td><td>";
print $row->amount;
print "</td><td>";
print $row->paymenttype;
print "</td><td>";
print $row->remarks;
print "</td><td>";
print $row->updatedby;
print "</td></tr>";
}
echo "</table>";
}
else
{
echo "</table>";
echo "<br>No Records Found";
}
?>






<div>
<a href="javascript:history.go(-1)">Go Back</a>
</center>
<div align="center">
<input type="button" onclick="javascript:document.forms['pdf'].submit()" value="pdf">
</div>
<form id="pdf" name="pdf" action="<?php echo site_url('office/fee_ledger_pdf'); ?>" method="post">
<input type="hidden" id="number" name="number" value="<?echo $student_details[0]->students_number; ?>">
<input type="hidden" id="ffyear" name="ffyear" value="<?echo $ffy ?>">

</form>

<div align="right">
<a href="javascript:window.print()">Print</a>
</div>
</body>