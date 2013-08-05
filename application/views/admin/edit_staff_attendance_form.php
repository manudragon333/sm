<h2 align="left"><span><?php if(isset($subjects[0]['id'])) echo 'Edit'; else echo 'Add'; ?> Subject </span></h2>
<pre><?php //  print_r($subjects); ?></pre>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/admin/save_edit_staff_attendance">
    <input id="" name="rel" class="text" type="hidden" value="course_management"/>
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($subjects[0]['id'])) echo $subjects[0]['id']; ?>"/>
    <input id="" name="user_id" class="text" type="hidden" value="<?php if(isset($staff_id)) echo $staff_id; ?>"/>
    <input id="" name="cycle_id" class="text" type="hidden" value="<?php if(isset($cycle_id)) echo $cycle_id; ?>"/>
    <input id="" name="weekday_id" class="text" type="hidden" value="<?php if(isset($weekday_id)) echo $weekday_id; ?>"/>
    <input id="" name="period_id" class="text" type="hidden" value="<?php if(isset($period_id)) echo $period_id; ?>"/>
	 <input id="" name="academic_year_id" class="text" type="hidden" value="<?php if(isset($academic_year_id)) echo $academic_year_id; ?>"/>
    <ol>
        <?php //print_r($subjects[0]); ?>
        <?php
            if(isset($subjects[0]['id'])) {
                $s_data = $subjects[0];
                $this_academic_year_id = $subjects[0]['academic_year_id'];
                if (isset($subject_details[0])) {
                    $s_data = array_merge($s_data, $subject_details[0]);
                }
            }
            // echo '<pre>'; print_r($subject_details); echo '</pre>';
        ?>
        <br/>
        <?php //print_r($s_data); ?>
        <li>
            <label style="width: 600px; font-weight: bold;">Add Subject to <?php if(isset($weekdays[$weekday_id]))  echo $weekdays[$weekday_id]['name']; ?> - <?php if(isset($period_details[0]['time_label']))  echo $period_details[0]['time_label']; ?> ::</label>
            <br/><br/>
        </li>
        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text required" title="Please select a Course">
                <option value="">Select</option>
                <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; if($course_id_select) echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text required" title="Please select a Branch">
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
        <li>
            <label for="semister_id">Sections:* </label>
            <select id="section_id" name="section_id" class="text" title="Please select a Section">
                <option value="">Select</option>
                <?php if(isset($s_data['section_id'])) $section_id_select=$s_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text required" title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($s_data['subject_id'])) $subject_id_select=$s_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','semister_id'=>$semister_id_select)); ?>
            </select>
        </li>
<!--        <li>
            <label for="academic_year_id">Academic Year:*</label>
            <select name='academic_year_id' id='academic_year_id' class="text required" title="Please select the Academic Year.">
                <option value="">Select</option>
                <?php // if(isset($s_data['academic_year_id'])) $academic_year_id_select=$s_data['academic_year_id']; else $academic_year_id_select=0; echo load_select('academic_years',$academic_year_id_select,array('status'=>'1')); ?>
                <?php if(isset($this_academic_year_id)) $academic_year_id_select=$this_academic_year_id; else $academic_year_id_select=0; echo load_select('academic_years',$academic_year_id_select,array('status'=>'1')); ?>
            </select>
        </li>-->
        <li>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Save Period Subject" />
            <div class="clr"></div>
        </li>
    </ol>
</form>