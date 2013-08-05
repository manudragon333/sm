<html>
<head>


<script>


function showCourses(str)
{
var resetbranch="<select id='branch' name='branch' onchange='getTableData()'><option value=''>All</option></select>";
var resetcourse="<select id='course' name='course' onchange='getTableData()'><option value=''>All</option></select>";
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
    document.getElementById("course_span").innerHTML=xmlhttp.responseText;
 document.getElementById("branch_span").innerHTML=resetbranch;
getTableData();

    }else if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading") {
            document.getElementById(layer).innerHTML="loading"
        }
  }
xmlhttp.open("GET",'<?php echo site_url('office/getAjaxCourses')."?q="; ?>'+str,true);
xmlhttp.send();
}



function getBranches()
{
getTableData();
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
    document.getElementById("branch_span").innerHTML=xmlhttp.responseText;
getTableData();
    }else if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading") {
            document.getElementById(layer).innerHTML="loading"
        }

  }
xmlhttp.open("GET",'<?php echo site_url('office/getAjaxBranches1')."?coll="; ?>'+coll+'&course='+course,true);
xmlhttp.send();

//document.forms[0].ptype.style.display="block";
}

function getTableData()
{
//alert(form.coll);
var college=document.forms[0].coll.value;
var course=document.forms[0].course.value;
var branch=document.forms[0].branch.value;
var ffy=document.forms[0].ffy.value;

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
document.getElementById("data_div").innerHTML=xmlhttp.responseText;
page();

    }else if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading") {
            document.getElementById(layer).innerHTML="loading"
        }

  }
var url=college+"&course="+course+"&branch="+branch+"&ffy="+ffy;
xmlhttp.open("GET",'<?php echo site_url('office/getDueGrid')."?college="; ?>'+url,true);
xmlhttp.send();

return false;
}

</script>
<style>
body{color:#666;}
.hover{background-color:#106166;color:#fff;cursor:pointer;}
.page{margin:5px;}
</style>
</head>
<body>

 
<form>
<table>
<tr>
<td>College
<select id="coll" name="coll" onchange="showCourses(this.value)">
<option value="0">All</option>
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
<td>Course
<span id="course_span">
<select id="course" name="course">
<option value="">All</option>
</select></span>
</td>
<td>Branch<span id="branch_span"><select id="branch" name="branch" onchange="getTableData()">
<option value="">All</option>
</select></span>
</td>
<td>

<select id="ffy" name="ffy" onchange="getTableData()" style="display:none">
<option value="">All</option>
<option value="I Year">I Year</option>
<option value="II Year">II Year</option>
<option value="III Year">III Year</option>
<option value="IV Year">IV Year</option>
</select>
</td>

</tr></table>

<center>
<input type="button" value="search" onClick="getTableData()">
</center>
</form>
<div id="data_div"></div>
</body>
</html>