<?php //echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
foreach($data as $k=>$v){?>
<h5 style="width:300px; padding: 3px; margin: 0;"> Application ID: PS<?php echo (isset($v['id']))?str_pad($v['id'], 7, "0", STR_PAD_LEFT):''; ?></h5>
<div style="border:2px solid; width:600px;position:relative;">
    <h4 style="width:115px; margin:0 auto;">MY COLLEGE</h4>
    <h4 style="width:300px; margin:0 auto; text-align: center;">PAY SLIP CERTIFICATE</h4>
<!--    <div>
        <img src="logo.png" width="50" height="50" style="position: absolute; top:60px; left:510px;">
    </div>-->
    <img src="<?php echo base_url(); ?>css/images/college_logo.png" width="60" height="60" style="position: absolute; top:15px; left:510px;">
    <div style="margin-left:50px;margin-top: 45px;">

        <pre>STAFF NAME         	:	<?php echo $v['name']; ?></pre>
        <pre>STAFF NUMBER		:	<?php echo $v['code']; ?></pre>
        <pre>EMAIL			:	<?php echo $v['email']; ?></pre>
        <pre>FROM MONTH		:	<?php echo $v['from_month']; ?></pre>
        <pre>TO MONTH                :	<?php echo $v['to_month']; ?></pre>
        <pre>YEAR                    :	<?php echo $v['year']; ?></pre>
        <pre>SALARY                  :	<?php echo $v['salary']; ?></pre>
        <br/>
        <input type="button" name="imageField" id="imageField" class="gblue button  " value="Print" onclick="this.style.display='none'; window.print();">
<!--        <input type="button" name="imageField" id="imageField" class="send button  " value="Generate Card">-->
    </div>
    <div style="clear:both;"></div>
</div>
<?php } }else{?>
<br/>
<p>No Pay Slip found.!</p>
<?php } ?>