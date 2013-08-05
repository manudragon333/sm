<?php
if($this->session->userdata('preview_bus_pass'))
    $s_data=$this->session->userdata('preview_bus_pass');

else if($this->session->userdata('student_data')){
    $student_data=$this->session->userdata('student_data');
    $s_data=(array) $student_data[0];
    $s_data['student_number']=$s_data['students_number'];
    $s_data['course']=$s_data['course_id'];
    $s_data['branch']=$s_data['branch_id'];
    $s_data['co']=$s_data['fathers_name'];
    $s_data['date_of_join']=dateFormat($s_data['doj'],'Y');
//    print_r($s_data);
}
?>

<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/students/preview_bus_pass" suc_msg="Bus Pass Request Submited Successfully.">
    <input id="" name="rel" class="text" type="hidden" value="buss_pass"/>
    <ol>
        <li>
            <label for="student_number">Student Number:*</label>
            <input id="student_number" name="student_number" class="text" value="<?php if(isset($s_data['student_number'])) echo $s_data['student_number']; ?>"/>
        </li><li>
            <label for="name">Student Name:*</label>
            <input id="name" name="name" class="text" value="<?php if(isset($s_data['name'])) echo $s_data['name']; ?>"/>
        </li><li>
            <label for="start_from">Start From:*</label>
            <select id="start_from" name="start_from" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['start_from'])) $start_from_select=$s_data['start_from']; else $start_from_select=0; echo load_select('boarding_points',$start_from_select); ?>
            </select>
<!--            <input id="start_from" name="start_from" class="text"/>-->
        </li>
        <li>
            <label for="course">Course:*</label>
    <!--        <input id="course" name="course" class="text"/>-->
            <select id="course" name="course" class="text" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($s_data['course'])) $course_select=$s_data['course']; else $course_select=0; echo load_select('courses',$course_select); ?>
            </select>
            <input type="hidden" name="course" class="" value="<?php echo $course_select; ?>" />
        </li>
        <li>
            <label for="branch">Branch:*</label>
    <!--        <input id="branch" name="branch" class="text"/>-->
            <select id="branch" name="branch" class="text" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($s_data['branch'])) $branch_select=$s_data['branch']; else $branch_select=0; echo load_select('branches',$branch_select); ?>
            </select>
            <input type="hidden" name="branch" class="" value="<?php echo $branch_select; ?>" />
        </li>
        <li>
            <label for="website">Upload the Photo:*</label>
<!--            <input type="file" name="photo" size="100" class="" id="id_card_upload"/>-->
            <input name="photo" class="myfile" value="" type="hidden" id="id_card_upload"/>
            <input name="MAX_FILE_SIZE" value="10000" type="hidden" />
        </li>
        <li id="uploaded_image"></li>
        <li>
            <br/>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Submit"/>
            <div class="clr"></div>
        </li>
    </ol>
</form>
