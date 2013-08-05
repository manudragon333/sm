<?php //echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
foreach($data as $k=>$v){?>
<div style="border:2px solid; width:600px;position:relative;">
    <h4 style="width:115px; margin:0 auto;">MY COLLEGE</h4>
<!--    <div>
        <img src="logo.png" width="50" height="50" style="position: absolute; top:60px; left:510px;">
    </div>-->
	<img src="" width="60" height="60" style="position: absolute; top:15px; left:510px;">
    <img src="<?php echo base_url().'uploads/'.$v['photo']; ?>" id="photo" width="100" height="120" title="pic" style="position: absolute; top:80px; left:15px;">
    <div style="margin-left:160px;margin-top: 45px;">

        <pre>STUDENT NAME		:	<?php echo $v['name']; ?></pre>
        <pre>STUDENT NUMBER		:	<?php echo $v['stu_number']; ?></pre>
        <pre>BRANCH			:	<?php echo $v['branch_name']; ?></pre>
        <pre>DATE OF JOIN		:	<?php echo $v['date_of_join']; ?></pre>
        <pre>ADDRESS			:	<?php echo $v['address']; ?></pre>
        <pre>MOBILE Number		:	<?php echo $v['mobile_no']; ?></pre>
        <br/>
        <input type="button" name="imageField" id="imageField" class="gblue button  j_gen_form_submit" value="Print" onclick="this.style.display='none'; window.print();">
<!--        <input type="button" name="imageField" id="imageField" class="send button  j_gen_form_submit" value="Generate Card">-->
    </div>
    <div style="clear:both;"></div>
</div>
<?php } }else{?>
<p>No ID Card to display.!</p>
<?php } ?>