<? ob_start();
//echo $user_id;
?>
<?if(isset($fee1)&&$fee1!="")
 $f1=$fee1;
 else
 $f1=0;
if(isset($fee2)&&$fee2!="")
 $f2=$fee2;
 else
 $f2=0;
if(isset($fee3)&&$fee3!="")
 $f3=$fee3;
 else
 $f3=0;
if(isset($fee4)&&$fee4!="")
 $f4=$fee4;
 else
 $f4=0;
 
 if(isset($paid1))
 $p1=$paid1;
 else
 $p1=0;
  if(isset($paid2))
 $p2=$paid2;
 else
 $p2=0;
  if(isset($paid3))
 $p3=$paid3;
 else
 $p3=0;
  if(isset($paid4))
 $p4=$paid4;
 else
 $p4=0;

 if(isset($disc1))
 $d1=$disc1;
 else 
 $d1=0;
 if(isset($disc2))
 $d2=$disc2;
 else 
 $d2=0;
  if(isset($disc3))
 $d3=$disc3;
 else 
 $d3=0;
  if(isset($disc4))
 $d4=$disc4;
 else 
 $d4=0;
 
 $x1=$f1-$d1;
 $x2=$f2-$d2;
 $x3=$f3-$d3;
 $x4=$f4-$d4;
if($p1==$f1)
$dE1="disabled";
else
$dE1="";
if($p2==$f2)
$dE2="disabled";
else
$dE2="";
if($p3==$f3)
$dE3="disabled";
else
$dE3="";
if($p4==$f4)
$dE4="disabled";
else
$dE4="";
 ?>
<style>
input{color:red;}
</style>
<script>
function validate()
{
var l1=parseInt(document.getElementById("l1").value);
var l2=parseInt(document.getElementById("l2").value);
//var l3=parseInt(document.getElementById("l3").value);
//var l4=parseInt(document.getElementById("l4").value);
var d1=parseInt(document.getElementById("d1").value);
var f1=document.getElementById("f1").value;
var f2=document.getElementById("f2").value;
//var f3=document.getElementById("f3").value;
//var f4=document.getElementById("f4").value;
if(d1>l1){
alert("Discount Limit Exceeded.");
document.getElementById('d1').focus();
document.getElementById("d1").style.border="solid 2px #0000FF";
return false;
}
else
document.getElementById("d1").style.border="";

var d2=parseInt(document.getElementById("d2").value);
if(d2>l2){
alert("Discount Limit Exceeded.");
document.getElementById('d2').focus();
document.getElementById("d2").style.border="solid 2px #0000FF";
return false;
}
else
document.getElementById("d2").style.border="";

/*var d3=parseInt(document.getElementById("d3").value);
if(d3>l3){
alert("Discount Limit Exceeded.");
document.getElementById('d3').focus();
document.getElementById("d3").style.border="solid 2px #0000FF";
return false;
}
else
document.getElementById("d3").style.border="";

var d4=parseInt(document.getElementById("d4").value);
if(d4>l4){
alert("Discount Limit Exceeded.");
document.getElementById('d4').focus();
document.getElementById("d4").style.border="solid 2px #0000FF";
return false;
}
else
document.getElementById("d4").style.border="";
*/
if((f1=='-')&&(d1<=0))
{
alert("Set the Fee First");
return false;
}
if((f2=='-')&&(d2<=0))
{
alert("Set the Fee First");
return false;
}
/*if((f3=='-')&&(d3<=0))
{
alert("Set the Fee First");
return false;
}
if((f4=='-')&&(d4<=0))
{
alert("Set the Fee First");
return false;
}*/
}

function update()
{
var f1=parseInt(document.getElementById("f1").value);
var f2=parseInt(document.getElementById("f2").value);
//var f3=parseInt(document.getElementById("f3").value);
//var f4=parseInt(document.getElementById("f4").value);
var d1=parseInt(document.getElementById("d1").value);
var d2=parseInt(document.getElementById("d2").value);
//var d3=parseInt(document.getElementById("d3").value);
//var d4=parseInt(document.getElementById("d4").value);
var p1=parseInt(document.getElementById("p1").value);
var p2=parseInt(document.getElementById("p2").value);
//var p3=parseInt(document.getElementById("p3").value);
//var p4=parseInt(document.getElementById("p4").value);
var x1=f1-d1;
var x2=f2-d2;
//var x3=f3-d3;
//var x4=f4-d4;
document.getElementById("x1").value=x1;
document.getElementById("x2").value=x2;
//document.getElementById("x3").value=x3;
//document.getElementById("x4").value=x4;
}
</script>
<input type="hidden" name="l1" id="l1" value="<?echo $f1-$p1;?>"/>
<input type="hidden" name="l2" id="l2" value="<?echo $f2-$p2;?>"/>
<!-- <input type="hidden" name="l3" id="l3" value="<?//echo $f3-$p3;?>"/>
<input type="hidden" name="l4" id="l4" value="<?//echo $f4-$p4;?>"/> -->
<input type="hidden" name="p1" id="p1" value="<?echo $p1;?>"/>
<input type="hidden" name="p2" id="p2" value="<?echo $p2;?>"/>
<!-- <input type="hidden" name="p3" id="p3" value="<?//echo $p3;?>"/>
<input type="hidden" name="p4" id="p4" value="<?//echo $p4;?>"/> -->
<input type="hidden" name="f1" id="f1" value="<?echo $f1;?>"/>
<input type="hidden" name="f2" id="f2" value="<?echo $f2;?>"/>
<!-- <input type="hidden" name="f3" id="f3" value="<?//echo $f3;?>"/>
<input type="hidden" name="f4" id="f4" value="<?//echo $f4;?>"/> -->
<form name="form1" method="post" action="<?php echo site_url('office/post_discounts'); ?>" onsubmit="return validate()">
<table width="860" height="169" border="0">
  <tr>
    <td width="159" height="31">Year</td>
    <td width="169">I Year </td>
    <td width="165">II Year </td>
    <!--<td width="169">III Sem </td>
    <td width="164">IV Sem </td> -->
  </tr>
  <tr>
    <td height="31">Fees Assigned </td>
    <td><input type="text" name="textfield" value="<?echo  $f1;?>" disabled></td>
    <td><input type="text" name="textfield2" value="<?echo $f2;?>" disabled></td>
    <!--<td><input type="text" name="textfield3" value="<?//echo $f3;?>" disabled></td>
    <td><input type="text" name="textfield4" value="<?//echo $f4;?>" disabled></td> -->
  </tr>
  <tr>
    <td height="30">Fee Paid</td>
    <td><input type="text" name="textfield16" value="<?echo $p1;?>" disabled></td>
    <td><input type="text" name="textfield11" value="<?echo $p2;?>" disabled></td>
    <!--<td><input type="text" name="textfield10" value="<?//echo $p3;?>" disabled></td>
    <td><input type="text" name="textfield5" value="<?//echo $p4;?>" disabled></td> -->
  </tr>
  <tr>
    <td height="31">Discount</td>
    <td><input type="text" name="d1" id="d1" value="<?if((isset($d1))||$d1!='') echo $d1; else echo "0";?>" <?echo $dE1;?> onKeyUp="update()"
    onkeydown="return (event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )"></td>
    <td><input type="text" name="d2" id="d2" value="<?if((isset($d2))||$d2!='') echo $d2; else echo "0";?>" <?echo $dE2;?> onKeyUp="update()"
    onkeydown="return (event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )"></td>
					<!--
    <td><input type="text" name="d3" id="d3" value="<?//if((isset($d3))||$d3!='') echo $d3; else echo "0";?>" <?echo $dE3;?> onKeyUp="update()"
    onkeydown="return (event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )"></td>
    <td><input type="text" name="d4" id="d4" value="<?//if((isset($d4))||$d4!='') echo $d4; else echo "0";?>" <?echo $dE4;?> onKeyUp="update()"
    onkeydown="return (event.ctrlKey || event.altKey 
                    || (47<event.keyCode && event.keyCode<58 && event.shiftKey==false) 
                    || (95<event.keyCode && event.keyCode<106)
                    || (event.keyCode==8) || (event.keyCode==9) 
                    || (event.keyCode>34 && event.keyCode<40) 
                    || (event.keyCode==46) )"></td> -->
					<input type="hidden" id="userid" name="userid" value="<?echo $user_id;?>"/>
  </tr>
  <tr>
    <td height="32">Final Fee</td>
    <td><input type="text" name="x1" id="x1" value="<?echo $x1;?>" disabled></td>
    <td><input type="text" name="x2" id="x2" value="<?echo $x2;?>" disabled></td>
    <!--<td><input type="text" name="x3" id="x3" value="<?//echo $x3;?>" disabled></td>
    <td><input type="text" name="x4" id="x4" value="<?//echo $x4;?>" disabled></td> -->
  </tr>
</table>
<input type="submit">

</form>
