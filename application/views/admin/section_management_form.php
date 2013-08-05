<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/admin/save_section">
    
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($college_data[0]['id'])) echo $college_data[0]['id']; ?>"/>
    <ol>
        <?php if(isset($college_data[0]['id'])){
            $s_data=$college_data[0];
        } ?>
        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text required">
                <option value="">Select</option>
                <?php if(isset($s_data['branch_id'])) $branch_id_select=$s_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="semister_id">Semester:* </label>
            <select id="semister_id" name="semister_id" class="text required" title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($s_data['semister_id'])) $semister_id_select=$s_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
 <!--       <li>
            <label for="subject_names">Start Number:* </label>
            <select id="start_number" name="start_number" class="text required" title="Please select a Start Number">
                <option value="">Select</option>
                <?php// if(isset($s_data['start_number'])) $startnum_id_select=$s_data['start_number']; else $startnum_id_select=0; echo load_select_numbers('student_records',$startnum_id_select,array('student_semisters.semister_id'=>$semister_id_select)); ?>
            </select>
            <!--<input id="start_number" name="start_number" class="text required" title="Please enter a Starting Number" value="<?php if(isset($s_data['start_number'])) echo $s_data['start_number']; ?>">-->
<!--        </li>
         <li>
            <label for="subject_names">End Number:* </label>
            <select id="end_number" name="end_number" class="text required" title="Please select a End Number">
                <option value="">Select</option>
                <?php// if(isset($s_data['end_number'])) $endnum_id_select=$s_data['end_number']; else $endnum_id_select=0; echo load_select_numbers('student_records',$endnum_id_select,array('student_semisters.semister_id'=>$semister_id_select)); ?>
            </select>
            <!--<input id="end_number" name="end_number" class="text required" title="Please enter a End Number" value="<?php if(isset($s_data['end_number'])) echo $s_data['end_number']; ?>">-->
<!--        </li> -->
         <li>
            <label for="subject_names">Section:* </label>
            <input id="section" name="section" class="text required" title="Please enter a Section" value="<?php if(isset($s_data['section'])) echo $s_data['section']; ?>">
        </li>
<!--
        <?php if(isset($college_data[0]['id']) && !empty($college_data[0]['id'])){ // This is a Update Process ?>
        <li>
            <label for="subject_names">Subject Name:* </label>
            <input id="subject_names" name="subject_names[]" class="text required" title="Please enter a Subject name" value="<?php if(isset($college_data[0]['name'])) echo $college_data[0]['name']; ?>">
        </li>
        <?php }else{ // This is a Adding Process  
            for($i=1;$i<=10;$i++){
            ?>
            <li>
                <label for="subject_names">Subject Name <?php echo $i;  ?>:* </label>
                <input id="subject_names" name="subject_names[]" class="text required" title="Please enter a Subject name" value="">
            </li>
        <?php
            }
        }
        ?>
        <li>
            <label for="status">Status:* </label>
            <select id="status" name="status" class="text">
                <option value="1" <?php if(isset($college_data[0]['status']) && $college_data[0]['status']=='1') echo ' selected="selected" ' ?>>Active</option>
                <option value="0" <?php if(isset($college_data[0]['status']) && $college_data[0]['status']=='0') echo ' selected="selected" ' ?>>InActive</option>
            </select>
        </li>
-->
        <li>
            <input type="button" name="imageField" id="imageField" class=" button gblue j_gen_form_submit" value="Save Section" />
            <div class="clr"></div>
        </li>
    </ol>
</form>