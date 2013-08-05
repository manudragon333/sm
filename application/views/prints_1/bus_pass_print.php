<?php // echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
foreach($data as $k=>$v){?>
<h5 style="width:300px; padding: 3px; margin: 0;"> Application ID: BP<?php echo (isset($v['id']))?str_pad($v['id'], 7, "0", STR_PAD_LEFT):''; ?></h5>
<div style="border:2px solid; width:600px;position:relative;">
    <h4 style="width:115px; margin:0 auto;">MY COLLEGE</h4>
<!--    <div>
        <img src="logo.png" width="50" height="50" style="position: absolute; top:60px; left:510px;">
    </div>-->
    <img src="<?php echo base_url(); ?>css/images/college_logo.png" width="60" height="60" style="position: absolute; top:15px; left:510px;">
    <img src="<?php echo base_url(); echo (isset($v['photo']) && !empty($v['photo']))?'uploads/'.$v['photo']:'css/images/no_photo.png'; ?>" id="photo" width="100" height="120" title="pic" style="position: absolute; top:80px; left:15px;">
    <div style="margin-left:160px;margin-top: 45px;">

        <pre>STUDENT NAME		:	<?php echo $v['name']; ?></pre>
        <pre>STUDENT NUMBER		:	<?php echo $v['student_number']; ?></pre>
        <pre>BRANCH			:	<?php echo $v['branch_name']; ?></pre>
        <pre>COURSE		        :	<?php echo $v['course_name']; ?></pre>
        <pre>PICK UP POINT		:	<?php echo $v['boarding_point']; ?></pre>
        <pre>ISSUED ON  		:	<?php echo date('d-m-Y'); ?></pre>
        <br/>
        <input type="button" name="imageField" id="imageField" class="send button  " value="Print" onclick="this.style.display='none'; window.print();">
<!--        <input type="button" name="imageField" id="imageField" class="send button  " value="Generate Card">-->
    </div>
    <div style="clear:both;"></div>
</div>
<?php } }else{?>
<br/>
<p>No Card found.!</p>
<?php } ?>