<?php
if($this->session->userdata('preview_conduct_certificate'))
    $s_data=$this->session->userdata('preview_conduct_certificate');

else if($this->session->userdata('student_data')){
    $student_data=$this->session->userdata('student_data');
    $s_data=(array) $student_data[0];
    $s_data['stu_number']=$s_data['students_number'];
    $s_data['course']=$s_data['course_id'];
    $s_data['co']=$s_data['fathers_name'];
    $s_data['date_of_join']=dateFormat($s_data['doj'],'Y');
//    print_r($s_data);
}
?>

<div class="f_r f_b m_r_10">* required fields</div>
<form action="/students/preview_conduct_certificate" id="appl_form" suc_msg="Conduct Certificate Request Submited Successfully." err_msg="You already applied for Conduct Certificate.  Please contact the office for further reference.">
    <input id="" name="rel" class="text" type="hidden" value="cond_certi"/>
    <ol>
        <li>
            <label for="stu_number">Student Number:*</label>
            <input id="stu_number" name="stu_number" class="text" value="<?php if(isset($s_data['stu_number'])) echo $s_data['stu_number']; ?>"/>
        </li><li>
            <label for="name">Student Name:*</label>
            <input id="name" name="name" class="text" value="<?php if(isset($s_data['name'])) echo $s_data['name']; ?>"/>
        </li><li>
            <label for="co">S/o:</label>
            <input id="co" name="co" class="text" value="<?php if(isset($s_data['co'])) echo $s_data['co']; ?>"/>
        </li><li>
            <label for="title">Bonafied Student of:</label>
            <input id="title" name="title" class="text" value="<?php if(isset($s_data['title'])) echo $s_data['title']; else echo 'MY College';?>" readonly="readonly"/>
        </li><li>
            <label for="course">Course:*</label>
            <select id="course" name="course" class="text" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($s_data['course'])) $course_select=$s_data['course']; else $course_select=0;  echo load_select('courses',$course_select); ?>
            </select>
            <input type="hidden" name="course" class="" value="<?php echo $course_select; ?>" />
    <!--        <input id="course" name="course" class="text"/>-->
        </li><li>
            <label for="from_date">From:*</label>
            <input id="from_date" name="from_date" class="text apply_datepicker" readonly="readonly" value="<?php if(isset($s_data['from_date'])) echo $s_data['from_date']; ?>"/>
        <li>
            <label for="to_date">To:*</label>
            <input id="to_date" name="to_date" class="text apply_datepicker" readonly="readonly" value="<?php if(isset($s_data['to_date'])) echo $s_data['to_date']; ?>"/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="button gblue j_gen_form_submit" value="Submit"/>
            <input type="button" name="imageField" id="imageField" class="clear m_l_20 grey button" value="Clear" />
            <div class="clr"></div>
        </li>
    </ol>
</form>