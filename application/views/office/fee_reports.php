<html>
<head>
<script type="text/javascript">
function showCourses(str)
{
if (str.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
//alert(xmlhttp.status);
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
//alert(xmlhttp.status);
    document.getElementById("course").innerHTML=xmlhttp.responseText;
    }else if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading") {
            document.getElementById(layer).innerHTML="loading"
        }
  }
xmlhttp.open("GET",'<?php echo site_url('office/getAjaxCourses')."?q="; ?>'+str,true);
xmlhttp.send();
}



function getBranches()
{

var course=document.forms[0].course.value;
//alert(course);
var coll=document.forms[0].coll.value;
//alert(coll);

if (coll.length==0 || course.length==0)
  { 
  document.getElementById("txtHint").innerHTML="";
  return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
//alert(xmlhttp.status);
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
//alert(xmlhttp.status);
    document.getElementById("branch").innerHTML=xmlhttp.responseText;
    }else if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading") {
            document.getElementById(layer).innerHTML="loading"
        }

  }
xmlhttp.open("GET",'<?php echo site_url('office/getAjaxBranches')."?coll="; ?>'+coll+'&course='+course,true);
xmlhttp.send();

//document.forms[0].ptype.style.display="block";
}

</script>
</head>
<body>

 
<form action="<?php echo site_url('office/load_coll_reports'); ?>" method="post">
<table width="70%" align="center" style="border: 2px solid green;padding:20px">
<tr>
<td>College</td>
<td><select id="coll" name="coll" onchange="showCourses(this.value)">
<option>Select</option>
<? 
$j=count($colleges);
for ($i=1;$i<=$j;$i++)
{
echo "<option value=".$colleges[$i-1]->id.">";
echo $colleges[$i-1]->name;
echo "</option>";
}
?>
</select></td>
</tr>
<tr>
<td>Course</td>
<td><span id="course"></span></td>
</tr>
<tr>
<td>Branch</td>
<td><span id="branch"></span></td>
</tr>
<tr>
<td>Year</td>
<td><select id="ffy" name="ffy" style="display:none" onchange="javascript:document.forms[0].ptype.style.display='block'">
<option value="">Select</option>
<option value="I Year">I Year</option>
<option value="II Year">II Year</option>
<option value="III Year">III Year</option>
<option value="IV Year">IV Year</option>
</select></td>
</tr>
<tr>
<td>Payment Type</td>
<td><select id="ptype" name="ptype" style="display:none" onchange="javascript:document.forms[0].tof.style.display='block'">
<option value="">Select</option>
<option value="Cash">Cash</option>
<option value="Cheque">Cheque</option>
<option value="DD">DD</option>
<option value="RSCcorp">Reimbursement SC Corp</option>
<option value="RSTcorp">Reimbursement ST Corp</option>
<option value="RBCcorp">Reimbursement BC Corp</option>
<option value="Scholarship">Scholarship</option></select></td>
</tr>
<tr>
<td>Type of fee</td>
<td><select style="display:none" id="tof" name="tof">
<option value="">Select</option>
<option value="Tution Fee">Tution fee</option>
<option value="Bus Fee">Bus fee</option>
<option value="University Fee">University fee</option>
<option value="Special Fee">Special fee</option>
<option value="ULD">ULD fee</option>
</select></td>
</tr>

</table>
<center>
<input type="submit" value="search">
</center>
</form>

</body>
</html>