<?php
ob_start();
ob_flush();
flush();
 //print_r($student_details);
$f1="";
$f2="";
$f3="";
$f4="";
$p1="";$p2="";$p3="";$p4="";
?>
<html>
<head>

<script type="text/javascript">
function cls()
{
//alert();
document.getElementById('amount').value='';
document.getElementById('remarks').value='';
}

function validate()
{
	var amt=document.getElementById('amount').value;
	var rmk=document.getElementById('remarks').value;
var ffy=document.getElementById('ffy').selectedIndex;
var tof=document.getElementById('tof').selectedIndex;
var p1=document.getElementById('p1').value;
var p2=document.getElementById('p2').value;
var p3=document.getElementById('p3').value;
var p4=document.getElementById('p4').value;

var f1=document.getElementById('f1').value;
var f2=document.getElementById('f2').value;
var f3=document.getElementById('f3').value;
var f4=document.getElementById('f4').value;


	if(amt==null||amt=="" || amt<=0)
	{alert("Enter proper amount");
	return false;
	}


if(tof==0)
{
if(ffy==0 && f1=='-')
{
alert("set fee first");
document.getElementById('amount').value="";
return false;
}
if(ffy==1 && f2=='-')
{
alert("set fee first");
document.getElementById('amount').value="";
return false;
}
if(ffy==2 && f3=='-')
{
alert("set fee first");
document.getElementById('amount').value="";
return false;
}
if(ffy==3 && f4=='-')
{
alert("set fee first");
document.getElementById('amount').value="";
return false;
}
}

if(tof==0)
{

if(ffy==0 && amt>parseInt(p1))
{
alert("Amount exceeded: Max Limit:"+p1);
document.getElementById('amount').value="";
return false;
}

if(ffy==1 && amt>parseInt(p2))
{
alert("Amount exceeded: Max Limit:"+p2);
document.getElementById('amount').value="";
return false;
}

if(ffy==2 && amt>parseInt(p3))
{
alert("Amount exceeded: Max Limit:"+p3);
document.getElementById('amount').value="";
return false;
}

if(ffy==3 && amt>parseInt(p4))
{
alert("Amount exceeded: Max Limit:"+p4);
document.getElementById('amount').value="";
return false;
}
}


return true;

}
function update(){
	var amt=document.getElementById('amount').value;
	var rmk=document.getElementById('remarks').value;
var ffy=document.getElementById('ffy').selectedIndex;
var tof=document.getElementById('tof').selectedIndex;
var p1=document.getElementById('p1').value;
var p2=document.getElementById('p2').value;
var p3=document.getElementById('p3').value;
var p4=document.getElementById('p4').value;

if(tof==0)
{
if(ffy==0 )
{
bal=parseInt(p1)-parseInt(amt);
document.getElementById('remarks').value=bal;
}

if(ffy==1)
{
bal=p2-parseInt(amt);
document.getElementById('remarks').value=bal;
}

if(ffy==2)
{
bal=p3-parseInt(amt);
document.getElementById('remarks').value=bal;
}

if(ffy==3)
{
bal=p4-parseInt(amt);
document.getElementById('remarks').value=bal;
}

}


    var bigNumArry = new Array('', ' Thousand', ' Million', ' Billion', ' Trillion', ' quadrillion', ' quintillion');

    var output = '';
    var numString =   document.getElementById('amount').value;
    var finlOutPut = new Array();

    if (numString == '0') {
        document.getElementById('container').innerHTML = 'Zero';
        return;
    }

    if (numString == 0) {
        document.getElementById('container').innerHTML = 'Enter only numbers';
        return;
    }

    var i = numString.length;
    i = i - 1;

    //cut the number to grups of three digits and add them to the Arry
    while (numString.length > 3) {
        var triDig = new Array(3);
        triDig[2] = numString.charAt(numString.length - 1);
        triDig[1] = numString.charAt(numString.length - 2);
        triDig[0] = numString.charAt(numString.length - 3);

        var varToAdd = triDig[0] + triDig[1] + triDig[2];
        finlOutPut.push(varToAdd);
        i--;
        numString = numString.substring(0, numString.length - 3);
    }
    finlOutPut.push(numString);
    finlOutPut.reverse();

    //conver each grup of three digits to english word
    //if all digits are zero the triConvert
    //function return the string "dontAddBigSufix"
    for (j = 0; j < finlOutPut.length; j++) {
        finlOutPut[j] = triConvert(parseInt(finlOutPut[j]));
    }

    var bigScalCntr = 0; //this int mark the million billion trillion... Arry

    for (b = finlOutPut.length - 1; b >= 0; b--) {
        if (finlOutPut[b] != "dontAddBigSufix") {
            finlOutPut[b] = finlOutPut[b] + bigNumArry[bigScalCntr];
            bigScalCntr++;
        }
        else {
            //replace the string at finlOP[b] from "dontAddBigSufix" to empty String.
            finlOutPut[b] = ' ';
            bigScalCntr++; //advance the counter  
        }
    }

        //convert The output Arry to , more printable string 
        for(n = 0; n<finlOutPut.length; n++){
            output +=finlOutPut[n];
        }

output=output+'  Rupees Only';
    document.getElementById('container').innerHTML = output;//print the output
}

//simple function to convert from numbers to words from 1 to 999
function triConvert(num){
    var ones = new Array('', ' One', ' Two', ' Three', ' Four', ' Five', ' Six', ' Seven', ' Eight', ' Nine', ' Ten', ' Eleven', ' Twelve', ' Thirteen', ' Fourteen', ' Fifteen', ' Sixteen', ' Seventeen', ' Eighteen', ' Nineteen');
    var tens = new Array('', '', ' Twenty', ' Thirty', ' Forty', ' Fifty', ' Sixty', ' Seventy', ' Eighty', ' Ninety');
    var hundred = ' Hundred';
    var output = '';
    var numString = num.toString();

    if (num == 0) {
        return 'dontAddBigSufix';
    }
    //the case of 10, 11, 12 ,13, .... 19 
    if (num < 20) {
        output = ones[num];
        return output;
    }

    //100 and more
    if (numString.length == 3) {
        output = ones[parseInt(numString.charAt(0))] + hundred;
        output += tens[parseInt(numString.charAt(1))];
        output += ones[parseInt(numString.charAt(2))];
        return output;
    }

    output += tens[parseInt(numString.charAt(0))];
    output += ones[parseInt(numString.charAt(1))];

    return output;
}
   
</script>

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
<!--<div>
<form id="appl_form" action="/office/fee_student_profile">
    <input id="" name="rel" class="text" type="hidden" value="check_stu_prof"/>
    <ol>
        <li>
            <label for="number">Student Number:* </label>
            <input id="number" name="number" class="text"/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="button j_gen_form_submit" value="Search"/>
        </li>
    </ol>
</form>
</div> -->
<div class="clr"></div>
<div style="border:2px solid #4AA02c; margin:10px;padding:10px" >
<ol>
<li><label>Date</label>
<?
echo date('d-m-y');
?>
</li>
    <li>
        <label for="name">Name:</label>
<?php 

ob_flush();
flush();

if (isset($student_details[0]->name))
    echo $student_details[0]->name;  ?>
    </li>
	
</li>
<li>
<label for="name">College Name:</label>
<?php if(isset($student_details[0]->college_name)) echo $student_details[0]->college_name; ?>
</li>
    <li>
        <label for="fathers_name">Father Name:*</label>
        <?php if (isset($student_details[0]->fathers_name))
                   echo $student_details[0]->fathers_name; ?>
    </li>
    <li>
        <label for="students_number">Student Number:*</label>
        <?php if (isset($student_details[0]->students_number))
                   echo $student_details[0]->students_number; ?>
    </li>
    <li>
        <label for="students_number">Course Name:*</label>
        <?php if (isset($student_details[0]->course_name))
                   echo $student_details[0]->course_name; ?>
    </li>
    
    <li>
        <label for="branch_id">Branch:*</label>
       <?php if (isset($student_details[0]->branch_name))
                   echo $student_details[0]->branch_name; ?>

    <li>
        <label for="fee_details">Fee Details:*</label>
                   <span style="padding:5px; padding-left: 0;" class="fl">
                   <table class="sample table_view">
                        <tr>
                            <th>Year</th>
                            <th>1<sup>st</sup>Year</th>
                            <th>2<sup>nd</sup>Year</th>
                            <th>3<sup>rd</sup>Year</th>
                            <th>4<sup>th</sup>Year</th>
                        </tr>
                        <tr>
                            <th>Fee Status</th>
                            <td>
<?php
$f1="";
 if(isset($student_details[0]->fee1))
 { 
if($student_details[0]->fee1=="")
$f1= "-"; 
else 
$f1= $student_details[0]->fee1; 
}
echo $f1;
?>
			</td>
                            
                           <td>
<?php 
$f2="";
if(isset($student_details[0]->fee2)) 
{ 
if($student_details[0]->fee2=="") 
$f2= "-"; 
else 
$f2= $student_details[0]->fee2; 
}
echo $f2;
?>			</td>

                           <td>
<?php
$f3="";
 if(isset($student_details[0]->fee3)) 
{ if($student_details[0]->fee3=="") $f3= "-";  else $f3=$student_details[0]->fee3; 
}
echo $f3;
?>			</td>

                           <td>
<?php $f4="";
if(isset($student_details[0]->fee4)) 
{
if($student_details[0]->fee4=="") $f4= "-";  else $f4= $student_details[0]->fee4; 
}
echo $f4;
?>			</td>

                        </tr>
						<tr>
<th>Discounts</th>
<td><?echo $disc1;?></td>
<td><?echo $disc2;?></td>
<td><?echo $disc3;?></td>
<td><?echo $disc4;?></td>
</tr>
<??>
<tr>
<th>Paid Amount</th>
<td><?if(isset($paid1))echo $paid1; else echo "0"?></td>
<td><?if(isset($paid2))echo $paid2; else echo "0"?></td>
<td><?if(isset($paid3))echo $paid3; else echo "0"?></td>
<td><?if(isset($paid4))echo $paid4; else echo "0"?></td>
</tr>
			<tr>
                            <th>Tution Fee Bal</th>
                            <td>
<?php
 if(isset($paid1))
$p1 =$student_details[0]->fee1-$paid1-$disc1;
else if($student_details[0]->fee1==''  ) 
$p1= "-"; 
else $p1=$student_details[0]->fee1; 
echo $p1;
?></td>
            <td>
<?php
 if(isset($paid2))
$p2 =$student_details[0]->fee2-$paid2-$disc2;
else if($student_details[0]->fee2==''  ) 
$p2= "-"; 
else $p2=$student_details[0]->fee2; 
echo $p2;
?></td>

            <td>
<?php
 if(isset($paid3))
$p3 =$student_details[0]->fee3-$paid3-$disc3;
else if($student_details[0]->fee3==''  ) 
$p3= "-"; 
else $p3=$student_details[0]->fee3; 
echo $p3;
?></td>


            <td><?php if(isset($paid4))
$p4= $student_details[0]->fee4-$paid4-$disc4;
else if($student_details[0]->fee4==''  )
 $p4="-"; else 
$p4= $student_details[0]->fee4; 
echo $p4;
?></td>                        </tr>
                    </table>
                   </span>
    </li>
    <li>
        <div class="clr"></div>
    </li>
</ol>
</div>
<form method="post" action="<?php echo site_url('office/collect_fee'); ?>">

<div style="border:2px solid #4AA02c; margin:10px;padding:10px" >

<table border="0" width="70%">
<tr>
<td>Fee for the Year</td>
<td>
<select onchange="cls();" style="width:220px;" id="ffy" name="ffy">

<option value="I Year">I Year</option>
<option value="II Year">II Year</option>
<option value="III Year">III Year</option>
<option value="IV Year">IV Year</option>

</select>
</td>
</tr>
<tr>
<td>Type of Fee</td>
<td>
<select  onchange="cls();" style="width:220px;" id="tof" name="tof">
<option value="Tution Fee">Tution Fee</option>
<option value="Bus Fee">Bus Fee</option>
<option value="University Fee">University Fee</option>
<option value="Special Fee">Special Fee</option>
<option value="ULD">ULD</option>
</select>
</td>
</tr>
<tr><td>Payment Type</td>
<td>
<select onchange="this.blur()"  style="width:220px;" id="ptype" name="ptype"> 
<option value="Cash">Cash</option>
<option value="Cheque">Cheque</option>
<option value="DD">DD</option>
<option value="RSCcorp">Reimbursement SC Corp</option>
<option value="RSTcorp">Reimbursement ST Corp</option>
<option value="RBCcorp">Reimbursement BC Corp</option>
<option value="Scholarship">Scholarship</option>
</select>
</td>
</tr>
<tr><td>Amount Received</td>
<td><input size="30" class="required" id="amount" name="amount" onKeyUp="update()"
    onkeydown="return (event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )"/>
</TD>
<tr><td>Fee Balance</td>
<td><input size="30" class="required" id="remarks" name="remarks" readonly></TD></tr>
<tr><td><b>Amount in Words</b></td>
<td><div id="container"> </div></td></tr>
</table>

</div>
<center>
	
<input type="hidden" value='<?php echo $f1; ?>' id="f1" name="f1"/>
<input type="hidden" value='<?php echo $f2; ?>' id="f2" name="f2"/>
<input type="hidden" value='<?php echo $f3; ?>' id="f3" name="f3"/>
<input type="hidden" value='<?php echo $f4; ?>' id="f4" name="f4"/>

<input type="hidden" value='<?php echo $p1; ?>' id="p1" name="p1"/>
<input type="hidden" value='<?php echo $p2; ?>' id="p2" name="p2"/>
<input type="hidden" value='<?php echo $p3; ?>' id="p3" name="p3"/>
<input type="hidden" value='<?php echo $p4; ?>' id="p4" name="p4"/>

<input type="hidden" value='<?php echo date('d-m-y'); ?>' id="date" name="date"/>

	<input type="hidden" value='<?	if (isset($student_details[0]->user_id)) echo $student_details[0]->user_id;  ?>' id="userid" name="userid"/>
	<input type="hidden" value='<? echo $student_details[0]->name;  ?>' id="sname" name="sname"/>
	<input type="hidden" value='<? echo $student_details[0]->fathers_name;  ?>' id="fname" name="fname"/>
	<input type="hidden" value='<? echo $student_details[0]->college_name; ?>' id="college" name="college"/>
	<input type="hidden" value='<? echo $student_details[0]->course_name; ?>' id="course" name="course"/>
	<input type="hidden" value='<? echo $student_details[0]->branch_name; ?>' id="branch" name="branch"/>
	<input type="hidden" value='<? echo $student_details[0]->students_number; ?>' id="htnum" name="htnum"/>
	 <?
	 $userData=$this->session->userdata('user_details');
	 $uname=$userData->username;
	 ?>
	<input type="hidden" value='<?php echo $uname; ?>' id="uby" name="uby"/>
<input type="submit" class="bn" value="Collect Fee" onclick="return validate()">
</form>
<a href="#">Go Back</a>
</center>
</body>