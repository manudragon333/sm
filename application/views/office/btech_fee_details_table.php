<style>
    table.sample td {
        padding: 0px;
    }
    table.sample td input{
        border:1px dashed #ccc;
        padding: 4px 1px;
    }
    .showTtOptions{
        display:none;
    }
</style>
<?php // echo '<pre>'; print_r($data); echo '</pre>'; 
if(count($data)){
?>
<div class="clr"></div>
<form id="appl_form" action="/office/save_fee_details">
    <input type="hidden" name="id" value="<?php if(isset($data[0]['id'])) echo $data[0]['id']; else echo 0;?>"/>
    <input type="hidden" name="user_id" value="<?php if(isset($data[0]['user_id'])) echo $data[0]['user_id']; else echo 0;?>"/>
    <ol>
        <li>
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
					<?php
$fee1='';					
$fee2='';
$fee3='';
$fee4='';
					if(isset($data[0]['fee1']))
						  {
						  $fee1=$data[0]['fee1'];
						  }
						  if($fee1=="")
						  {
						  $fee1=0;
						  }
						  if(isset($data[0]['fee2']))
						   {
						   $fee2=$data[0]['fee2'];
						   }
						  if($fee2=="")
						  {
						  $fee2=0;
						  } 
						  if(isset($data[0]['fee3']))
						{ 
						$fee3= $data[0]['fee3']; 
						}
						if($fee3=="")
						{
						$fee3=0;
						}
						if(isset($data[0]['fee4']))
						 {
						 $fee4=$data[0]['fee4'];
						 }
						 if($fee4=="")
						 {
						 $fee4=0;
						 }

					?>
                    <td><input type="text" name="fee1" value="<?echo $fee1;?>" <?if($fee1!=0) echo "disabled";?>/></td>
                    <td><input type="text" name="fee2" value="<?echo $fee2;?>" <?if($fee2!=0) echo "disabled";?>/></td>
                    <td><input type="text" name="fee3" value="<?echo $fee3;?>" <?if($fee3!=0) echo "disabled";?>/></td>
                    <td><input type="text" name="fee4" value="<?echo $fee4;?>" <?if($fee4!=0) echo "disabled";?>/></td>
                </tr>
            </table>
        </li>
        <li>
            <br/>
            <input type="button" name="imageField" id="imageField" class="button j_gen_form_submit" value="Save Details"/>
        </li>
    </ol>
</form>
<?php }else{ ?>
<br/>
<div class="error">No Details found. please check the student number.</div>
<?php } ?>