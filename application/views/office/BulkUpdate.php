<html>
<head>
<script type="text/javascript">
function showCourses(str)
{
if(str==0)
{
//document.forms[0].course.style.display='none';
//document.forms[0].branch.style.display='none';
//document.forms[0].ffy.style.display='none';
//document.forms[0].amount.style.display='none';
//document.forms[0].save.style.display='none';
return false;
}
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
getFeeDiv();
var course=document.forms[0].course.value;
//alert(course);
var coll=document.forms[0].coll.value;
//alert(coll);
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
<script>
function validate()
{
var coll=document.getElementById('coll').value;
var course=document.forms[0].course.value;
var branch=document.forms[0].branch.value;
var ffy=document.forms[0].ffy.value;



if(coll==0)
{
alert("Select college");
return false;
}

if(branch==0)
{
alert("Select branch");
return false;
}
if(course==0)
{
alert("Select Course");
return false;
}


return true;
}

function getFeeDiv()
{
var course=document.forms[0].course.value;

document.forms[0].at.style.display='block';
document.forms[0].ffy.style.display='block';
document.getElementById("fee1").innerHTML = 'I Year';
document.getElementById("fee2").innerHTML = 'II Year';
document.getElementById("fee3").innerHTML = 'III Year';
document.getElementById("fee4").innerHTML = 'IV Year';
document.forms[0].save.style.display='block';
if(course==1)
{
document.forms[0].amount1.style.display='block';
document.forms[0].amount2.style.display='block';
document.forms[0].amount3.style.display='block';
document.forms[0].amount4.style.display='block';
document.getElementById("fee3").style.display='block';
document.getElementById("fee4").style.display='block';
}
if(course==2)
{
document.getElementById("fee1").innerHTML = 'I Semister';
document.getElementById("fee2").innerHTML = 'II Semister';
document.getElementById("fee3").innerHTML = 'III Semister';
document.getElementById("fee4").innerHTML = 'IV Semister';
document.forms[0].amount1.style.display='block';
document.forms[0].amount2.style.display='block';
document.forms[0].amount3.style.display='block';
document.forms[0].amount4.style.display='block';
document.getElementById("fee3").style.display='block';
document.getElementById("fee4").style.display='block';
}
if(course==3 || course==5)
{
document.getElementById("fee3").style.display='none';
document.getElementById("fee4").style.display='none';
document.forms[0].amount1.style.display='block';
document.forms[0].amount2.style.display='block';
document.forms[0].amount3.style.display='none';
document.forms[0].amount4.style.display='none';

}
if(course==4)
{
document.getElementById("fee4").style.display='none';
document.forms[0].amount1.style.display='block';
document.forms[0].amount2.style.display='block';
document.forms[0].amount3.style.display='block';
document.forms[0].amount4.style.display='none';
}
}
</script>
</head>
<body>

 
<form action="<?php echo site_url('office/feebulkupdate'); ?>" method="post" onsubmit="return validate()">
<table width="70%" align="center" style="border: 2px solid green;padding:20px">
<tr>
<td>College</td>
<td><select id="coll" name="coll" onchange="showCourses(this.value)">
<option value="0">Select</option>
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
<td>Join Year</td>
<td><select id="ffy" name="ffy" style="display:none" onchange="document.forms[0].at.style.display='block';">
<option value="2005">2005</option>
<option value="2006">2006</option>
<option value="2007">2007</option>
<option value="2008">2008</option>
<option value="2009">2009</option>
<option value="2010">2010</option>
<option value="2011">2011</option>
<option value="2012">2012</option>
<option value="2013">2013</option>
<option value="2014">2014</option>
<option value="2015">2015</option>
<option value="2016">2016</option>
<option value="2017">2017</option>
<option value="2018">2018</option>
<option value="2019">2019</option>


</select></td>
</tr>
<tr>
<td>Admission Type</td>
<td><select id="at" name="at" style="display:none" onchange="getFeeDiv()">
<option value="1">Management</option>
<option value="2">Counselling</option>
</select></td>
</tr>

<tr>
<td>Fee Amount</td>
<td>
<table width="100%" border="0">
<tr>
<td><label id="fee1" name="fee1"></label></td>
<td><input type='text' id='amount1' name='amount1' style="display:none" value="0" size="10"
onkeydown='return (event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )'>
</td>
<td>
<label id="fee2" name="fee2"></label>
</td><td>
<input type='text' id='amount2' name='amount2' style="display:none" value="0" size="10"
onkeydown='return (event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )'>
</td></tr><tr><td>
<label id="fee3" name="fee3"></label>
</td><td>
<input type='text' id='amount3' name='amount3' style="display:none" value="0" size="10"
onkeydown='return (event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )'>
</td><td>
<label id="fee4" name="fee4"></label>
</td><td>
<input type='text' id='amount4' name='amount4' style="display:none" value="0" size="10"
onkeydown='return (event.ctrlKey || event.altKey || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) || (95<event.keyCode && event.keyCode<106) || (event.keyCode==8) || (event.keyCode==9) || (event.keyCode>34 && event.keyCode<40) || (event.keyCode==46) )'>
</td></tr>
</table>
</td>
</tr>
</table>
<center>
<input type="submit" value="Set Fee" id="save" name="save" style="display:none">
</center>
</form>

</body>
</html>