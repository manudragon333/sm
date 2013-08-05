
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1" />
<title>Fee Receipt</title>
<script language=javascript>

function fun()
{
if(window.event.keyCode==116)
{
alert("Page can not be refreshed");
return false;
}

}
</script>
</head>
<body onKeyDown="return fun()" style="margin:0px 0px 0px 0px;background:url(../css/images/table_background.jpg) no-repeat; height:650px; ">
<table width="1000px" border="0" bordercolor="#FF33CC" cellspacing="0" cellpadding="0" style=" padding:30px;;background:url(images/table_background.jpg) no-repeat; height:647px;" align="center">
<tr>
<td width="20%"><img src="../css/images/logo.jpg" style="padding:20px;" alt=""/></td>
<td width="23%">&nbsp;</td>
<td width="59%">
<p style="font-weight:bold; font-family:Arial, Helvetica, sans-serif; font-size:16px; padding-left:100px;">Tanikella (V),<br/>
Konijerla (M),<br/>
Khammam Dist<br/>
A.P PIN - 507 305.<br>08742-211306</p></td>
</tr>
<tr>
<td><p style="font-size:16px; font-weight:bold; font-family:Arial, Helvetica, sans-serif; padding-left:30px;">
Receipt Number:&nbsp;<? echo $receipt_no; ?></p></td>
</tr>
<tr>
<td colspan="3" >
<h2 align="center"><U>Fee Payment Receipt</U></h2>
<table border="0" style="padding-left:30px">
<tr><td>Name</td><td><? echo $info['sname']; ?></td></tr>
<tr><td>Father Name</td><td><? echo $info['fname']; ?></td></tr>
<tr><td>College</td><td><? echo $info['college']; ?></td></tr>
<tr><td>Course</td><td><? echo $info['course']; ?></td></tr>
<tr><td>Branch</td><td><? echo $info['branch']; ?></td></tr>
<tr><td>Fee for Year</td><td><? echo $info['ffy']; ?></td></tr>
<tr><td>HT number</td><td><? echo $info['htnum']; ?></td></tr>
</table>
<div style="border:2px solid #4AA02c; margin:.5cm 4cm;padding:.2 cm .2cm" >
<table border="0" style="padding-left:30px">
<tr><td>Type of Fee</td><td><? echo $info['tof']; ?></td></tr>
<tr><td>Amount Received</td><td><? echo $info['amount']; ?></td></tr>
<tr><td>Payment Type</td><td><? echo $info['ptype']; ?></td></tr>
<tr><td>Fee Balance for the Year</td><td><? echo $info['remarks']; ?></td></tr>
</table>
</div>
</td>
</tr>
<tr>
<td><h3 style="padding-left:20px;">Date:<? echo $date; ?></h3></td>
<td><input type="button" onclick="javascript:window.print();" value="Print"/><a href="javascript:history.back()">Back</a></td>
<td><h2 style="padding-left:30px;"><i>Received By:<? echo $info['uby']; ?></i></h2></td>
</tr>
</table>

</body>
</html>