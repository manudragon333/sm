<style type="text/css" rel="stylesheet">
    .certi_text i{
        text-decoration: underline;
        padding: 0 5px;
    }
</style>
<?php // echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
    foreach($data as $k=>$v){ ?>
<h5 style="width:300px; padding: 3px; margin: 0;"> Application ID: SC<?php echo (isset($v['id']))?str_pad($v['id'], 7, "0", STR_PAD_LEFT):''; ?></h5>
<div style="border:2px solid black; height:578px; width:893px;position:relative;background: none;">
    <img src="<?php echo base_url();  ?>/css/images/certi_study_college_<?php if(isset($college_id)){ echo $college_id; }else{ echo '1';} ?>.jpg" style="position: absolute; left: 0; top:0; z-index: 0;" alt=""/>
    <h5 style="position:absolute; top: 118px; right: 75px;z-index: 10;margin: 0;">Date: <?php echo date('d-m-Y'); ?></h5>
    <h5 style="position:absolute; top: 205px; left:165px;z-index: 10;margin: 0;"> <?php echo $v['stu_number']; ?></h5>
    <div class="certi_text" style="font-family: 'Tempus Sans ITC', 'Pristina', 'Kristen ITC',  'Tekton Pro';position:absolute; top: 315px; z-index: 10; left: 95px;width: 710px;">
        <p align=justify>This is to certify that Mr/Miss:<i><?php echo $v['name']; ?></i>,
            Son/Daughter of Sri <i><?php echo $v['son_of']; ?></i>,  is a Student of this Institute, is/was Studying/Studied <i><?php echo $v['course_name']; ?></i>
            during the academic year <i><?php echo dateFormat($v['from'],'Y'); ?> to <?php echo dateFormat($v['to'],'Y'); ?></i>. His/Her Conduct is/was <i><?php if(isset($student_conduct)) echo $student_conduct; else echo 'Satifactory';  ?></i> during that period.
        </p>
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