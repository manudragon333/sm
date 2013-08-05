<?php // print_r($student_data);
if($this->session->userdata('preview_tc')){
    $data[0]=$student_data;
    $s_data=$this->session->userdata('preview_tc');
    foreach($s_data as $k=>$v){
        $data[0][$k]=$v;
    }
}else{
    $data=0;
}
if(count($data) && $data){
    foreach($data as $k=>$v){ ?>
<form id="appl_form" action="/students/transfer_certificate" >
    <input type="hidden" name="preview" value="1"/>
    <div style="border:2px solid; height:850px; width:750px;position:relative;">
        <h3 align=center>LAQSHYA COLLEGE</h3>
        <h5 align=center>Jaladhija Educational Society's </h5>
        <div align=right align=right style="margin-left:15px;margin-top: 30px;margin-right:15px">
            <h5 >Date: <?php echo date('d-m-Y'); ?></h5>
            <h5 >Unique Number: <?php echo $v['students_number']; ?></h5>
        </div>
        <div style="margin-left:10px;position: absolute;top: 20px;left: 0;">
            <img src="<?php echo base_url() . 'css/images/college_logo.png'; ?>" height="60"/>
        </div>
        <div style="margin-left:15px;margin-top: 30px;margin-right:15px">
            <h3 align=center> <u>TRANSFER CERTIFICATE</u></h3>
            <pre>Name of the Student				:<?php echo $v['name']; ?></pre>
            <pre>Name of the Father or Guardian			:<?php echo $v['fathers_name']; ?></pre>
    <!--        <pre>Nationality- religion				:<?php // echo $v['']; ?></pre>
            <pre>Caste(if SC,ST,BC)				:<?php //echo $v['']; ?></pre>-->
            <pre>Date of birth at the time of registration	:<?php echo dateFormat($v['dob'],'Y-m-d'); ?></pre>
            <pre>Class in which Studying at the time of leaving	:<?php echo $v['class_studying']; ?></pre>
            <pre>Personal identification marks			:<?php echo $v['identification_marks']; ?></pre>
            <pre>Qualified for promotion to higher class		:<?php echo $v['qualified_for']; ?></pre>
            <pre>Fee dues					:<?php echo $v['fee_details']; ?></pre>
            <pre>General progress and conduct			:<?php echo $v['conduct']; ?></pre>
            <pre>Date of leaving the college			:<?php echo date('d-m-Y'); ?></pre>
            <pre>Reasons for leaving				:<?php echo $v['reason_of_leaving']; ?></pre>
            <br/><br/>
            <h4 align=right>PRINCIPAL</h4>

        </div>
    </div>
    <br/>
    <input type="button" name="imageField" id="imageField" class=" button  grey" value="Back" onclick="javascript:window.location.reload();"/>
    <input type="button" name="imageField" id="imageField" class="gblue button  j_gen_form_submit" value="Confirm"/>
</form>
<?php } }else{?>
<br/>
<p>No Certificate found.!</p>
<?php } ?>