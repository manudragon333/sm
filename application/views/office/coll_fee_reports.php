<html>
<head>
<script type="text/javascript">
function showData(str)
{
if (str.length==0)
  { 
  document.getElementById("data").innerHTML="";
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
    document.getElementById("data").innerHTML=xmlhttp.responseText;
    }else if (xmlHttp.readyState==1 || xmlHttp.readyState=="loading") {
            document.getElementById(layer).innerHTML="loading"
        }
  }
xmlhttp.open("GET",'<?php echo site_url('office/getCollReportsData')."?q="; ?>'+str,true);
xmlhttp.send();


}
</script>
</head>
<body>

College:<select id="coll" name="coll" onchange="showData(this.value)">
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
</select>
<div id="data" name="data">
</div>
</body>
