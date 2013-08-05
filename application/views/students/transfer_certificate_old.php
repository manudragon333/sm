<?php
if($this->session->userdata('preview_tc'))
    $s_data=$this->session->userdata('preview_tc');
else if($this->session->userdata('student_data')){
    $student_data=$this->session->userdata('student_data');
    $s_data=(array) $student_data[0];
}// print_r($s_data);
?>
<h2><span>Apply for Transfer Certificate.</span></h2>
<div class="clr"></div>
<div class="user_instructions">
<!--    <p style="width:200px; float:left;">Please enter your details below.</p>-->
<!--    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>-->
    <div class="clr"></div>
</div>
<form id="appl_form" action="/students/preview_tc" suc_msg="TC Request Submited Successfully." err_msg="You already applied for Transfer Certificate.  Please contact the office for further reference. ">
    <input id="" name="rel" class="text" type="hidden" value="tc_certi"/>
    <ol>
        <li>
            <label for="students_number">Student Number:*</label>
            <input id="students_number" name="students_number" class="text" value="<?php if(isset($s_data['students_number'])) echo $s_data['students_number']; ?>"/>
        </li>
        <li>
            <label for="fathers_name">Father or Guardian:*</label>
            <input id="fathers_name" name="fathers_name" class="text" value="<?php if(isset($s_data['fathers_name'])) echo $s_data['fathers_name']; ?>"/>
        </li>

        <li>
            <label for="class_studying">Class Studying at the time of leaving:*</label>
            <input id="class_studying" name="class_studying" class="text" value="<?php if(isset($s_data['class_studying'])) echo $s_data['class_studying']; ?>"/>
        </li>
        <li>
            <label for="identification_marks">Personal identification marks:*</label>
            <input id="identification_marks" name="identification_marks" class="text" value="<?php if(isset($s_data['identification_marks'])) echo $s_data['identification_marks']; ?>"/>
        </li>
        <li>
            <label for="qualified_for">Qualified for promotion to higher class:*</label>
            <input id="qualified_for" name="qualified_for" class="text" value="<?php if(isset($s_data['qualified_for'])) echo $s_data['qualified_for']; ?>"/>
        </li>
        <li>
            <label for="conduct">General progress and conduct:*</label>
            <input id="conduct" name="conduct" class="text" value="<?php if(isset($s_data['conduct'])) echo $s_data['conduct']; ?>"/>
        </li>
        <li>
            <label for="reason_of_leaving">Reasons for leaving:*</label>
            <input id="reason_of_leaving" name="reason_of_leaving" class="text" value="<?php if(isset($s_data['reason_of_leaving'])) echo $s_data['reason_of_leaving']; ?>"/>
        </li>
        <li>
            <input type="button" name="imageField" class="upload button j_gen_form_submit" value="Submit"/>
        </li>
    </ol>

    
</form>