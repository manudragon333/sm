<?php // echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
    foreach($data as $k=>$v){ ?>
<h5 style="width:300px; padding: 3px; margin: 0;"> Application ID: TC<?php echo (isset($v['id']))?str_pad($v['id'], 7, "0", STR_PAD_LEFT):''; ?></h5>
<div style="border:2px solid; height:850px; width:750px;position:relative;">
    <h3 align=center style="margin: 20px 0 0">Laqshya Institute of Technology & Science</h3>
    <h5 align=center style="margin: 0">Jaladhija Educational Society's  </h5>
    <div align=right align=right style="margin-left:15px;margin-top: 30px;margin-right:15px">
        <h5 >Date: <?php echo date('d-m-Y'); ?></h5>
        <h5 >Unique Number: <?php echo $v['students_number']; ?></h5>
    </div>
    <div style="position:absolute;top: 10px;left: 10px;">
        <img src=<?php echo base_url() . 'css/images/college_logo.png'; ?>  height="60">
    </div>
    <div style="margin-left:15px;margin-top: 30px;margin-right:15px">
        <h3 align=center> <u>TRANSFER CERTIFICATE</u></h3>
        <pre>Name of the Student				:<?php echo $v['name']; ?></pre>
        <pre>Name of the Father or Guardian			:<?php echo $v['fathers_name']; ?></pre>
<!--        <pre>Nationality- religion				:<?php // echo $v['']; ?></pre>
        <pre>Caste(if SC,ST,BC)				:<?php //echo $v['']; ?></pre>-->
        <pre>Date of birth at the time of registration	:<?php echo $v['dob']; ?></pre>
        <pre>Class in which Studying at the time of leaving	:<?php // echo $v['']; ?></pre>
        <pre>Personal identification marks			:<?php // echo $v['']; ?></pre>
        <pre>Qualified for promotion to higher class		:<?php // echo $v['']; ?></pre>
        <pre>Fee dues					:<?php echo $v['fee_details']; ?></pre>
        <pre>General progress and conduct			:<?php // echo $v['']; ?></pre>
        <pre>Date of leaving the college			:<?php echo date('d-m-Y'); ?></pre>
        <pre>Reasons for leaving				:<?php // echo $v['']; ?></pre>
        <br/><br/>
        <h4 align=right>PRINCIPAL</h4>
        
    </div>
</div>
<br/>
<div>
    <input type="button" name="imageField" id="imageField" class="gblue button  " value="Print" onclick="this.style.display='none'; window.print();">
    <!--<input type="button" name="imageField" id="imageField" class="send button  " value="Generate Card">-->
</div>
<?php } }else{?>
<br/>
<p>No Certificate found.!</p>
<?php } ?>