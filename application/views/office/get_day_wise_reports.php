<html>
<head>


<script type="text/javascript">

function val()
{
var day=document.getElementById('sdate').value;
if(day=="")
{alert('Select Date');return ;
}
getReports(day);
}  

function getReports(val)
{
var xmlhttp;
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
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
 document.getElementById("myDiv").innerHTML=xmlhttp.responseText;

    }
  }
xmlhttp.open("GET",'<?php echo site_url('office/dayWiseReports')."?val="; ?>'+val,true);
xmlhttp.send();
}

function clearPage()
{
 document.getElementById("myDiv").innerHTML="";

}
</script>
</head>
<body>
<p>Date:     <input id="sdate" name="" class="text apply_datepicker" readonly="readonly" onclick="clearPage()"/>
<input type="button" onclick="val()" value="Retrieve"/></p>
<div id="myDiv"> </div>
</body>
</html>