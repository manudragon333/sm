<?php
if($this->session->userdata('preview_study_certificate'))
    $s_data=$this->session->userdata('preview_study_certificate');
else if($this->session->userdata('student_data')){
    $student_data=$this->session->userdata('student_data');
    $s_data=(array) $student_data[0];
    $s_data['stu_number']=$s_data['students_number'];
    $s_data['course']=$s_data['course_id'];
    $s_data['son_of']=$s_data['fathers_name'];
    $s_data['date_of_join']=dateFormat($s_data['doj'],'Y');
//    print_r($s_data);
}
//print_r($student_data);
?>
<script> var doj=<?php if(isset($student_data[0]->doj)) echo "new Date('".dateFormat($student_data[0]->doj)."');"; else echo 'null'; ?></script>
<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/students/preview_study_certificate">
<input id="" name="rel" class="text" type="hidden" value="study_certi"/>
<ol>
    <li>
        <label for="stu_number">Student Number:*</label>
        <input id="stu_number" name="stu_number" class="text" value="<?php if(isset($s_data['stu_number'])) echo $s_data['stu_number']; ?>"/>
    </li>
    <li>
        <label for="name">Student Name:*</label>
        <input id="name" name="name" class="text" value="<?php if(isset($s_data['name'])) echo $s_data['name']; ?>"/>
    </li>
    <li>
        <label for="son_of">S/o:</label>
        <input id="son_of" name="son_of" class="text" value="<?php if(isset($s_data['son_of'])) echo $s_data['son_of']; ?>"/>
    </li><li>
        <label for="course">Course:*</label>
        <select id="course" name="course" class="text" disabled="disabled">
            <option value="">Select</option>
            <?php if(isset($s_data['course'])) $course_select=$s_data['course']; else $course_select=0;  echo load_select('courses',$course_select);?>
        </select>
        <input type="hidden" name="course" class="" value="<?php echo $course_select; ?>" />
<!--        <input id="course" name="course" class="text"/>-->
    </li><li>
        <label for="from">From:*</label>
        <input id="from" name="from" class="text study_certi_from" readonly="readonly" value="<?php if(isset($s_data['from'])) echo $s_data['from']; ?>"/>
    </li><li>
        <label for="to">To:*</label>
        <input id="to" name="to" class="text study_certi_to" readonly="readonly" value="<?php if(isset($s_data['to'])) echo $s_data['to']; ?>"/>
    </li>
    <li>
        <input type="button" name="imageField" id="imageField" class="button gblue j_gen_form_submit" value="Submit"/>
        <input type="button" name="imageField" id="imageField" class="clear grey button m_l_20" value="Clear"/>
    </li>
</ol>
</form>
