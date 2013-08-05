<?php //print_r($student_details);
?>
<h2 align='center'><span>MY PROFILE</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" suc_msg="Profile saved Successfully.">
    <input id="" name="rel" class="text" type="hidden" value="my_rec"/>
    <input id="" name="id" class="text" type="hidden" value="<?php if (isset($student_details[0]->id))
    echo $student_details[0]->id; ?>"/>
<ol>
    <li>
        <label for="name">Name of the Student:*</label>
        <input id="name" name="name" class="text" value="<?php if (isset($student_details[0]->name))
    echo $student_details[0]->name; ?>" readonly="readonly"/>
    </li>
    <li>
        <label for="fathers_name">Father Name:*</label>
        <input id="fathers_name" name="fathers_name" class="text" value="<?php if (isset($student_details[0]->fathers_name))
                   echo $student_details[0]->fathers_name; ?>" readonly="readonly"/>
    </li>
    <li>
        <label for="students_number">Student Number:*</label>
        <input id="students_number" name="students_number" class="text" value="<?php if (isset($student_details[0]->students_number))
                   echo $student_details[0]->students_number; ?>" readonly="readonly"/>
    </li>
    <li>
        <label for="sex">Sex:*</label>
        <input type="radio" name="sex" class="" value="1" <?php if (isset($student_details[0]->sex) && $student_details[0]->sex=='1') echo 'checked="checked"'; ?> readonly="readonly"/> Male
        <input type="radio" name="sex" class="" value="2" <?php if (isset($student_details[0]->sex) && $student_details[0]->sex=='2') echo 'checked="checked"'; ?> readonly="readonly"/> Female
    </li>
    <li>
        <label for="dob">Date of Birth:*</label>
        <input id="dob" name="dob" class="text " readonly="readonly" value="<?php if (isset($student_details[0]->dob))
                   echo dateFormat($student_details[0]->dob); ?>"/>
    </li>
    <li>
        <label for="doj">Date of Join:*</label>
        <input id="doj" name="doj" class="text " readonly="readonly" value="<?php if (isset($student_details[0]->doj))
                   echo dateFormat($student_details[0]->doj); ?>"/>
    </li>
    
    <li>
                    <label for="admission_type_id">Admission Type :* </label>
                    <select id="admission_type_id" name="admission_type_id" class="text" disabled="disabled">
                        <option value="">Select</option>
                        <?php if(isset($student_details[0]->admission_type_id)) $admission_type_id_select=$student_details[0]->admission_type_id; else $admission_type_id_select=0; echo load_select('admission_types',$admission_type_id_select); ?>
                    </select>
                </li>
                
                <li>
                    <label for="caste_id">Caste :* </label>
                    <select id="caste_id" name="caste_id" class="text" disabled="disabled">
                        <option value="">Select</option>
                        <?php if(isset($student_details[0]->caste_id)) $caste_id_select=$student_details[0]->caste_id; else $caste_id_select=0; echo load_select('castes',$caste_id_select); ?>
                    </select>
                </li>
                
                <li>
                    <label for="scholarship">Scholarship :* </label>
                    <input type="checkbox" name="scholarship" value="1" disabled="disabled"  <?php if(isset($student_details[0]->scholarship)){ ?> checked="yes" <?php } ?> >

                </li>
                
                
    <li>
        <label for="course_id">Course:*</label>
        <select id="course_id" name="course_id" class="text" disabled="disabled">
            <option value="">Select</option>
            <?php $selected=(isset($student_details[0]->course_id))?$student_details[0]->course_id:0 ;echo load_select('courses',$selected);?>
        </select>
<!--        <input id="course_id" name="course_id" class="text" value="<?php if (isset($student_details[0]->course_id))
                   echo $student_details[0]->course_id; ?>"/>-->
    </li>
    <li>
        <label for="branch_id">Branch:*</label>
        <select id="branch_id" name="branch_id" class="text" disabled="disabled">
            <option value="">Select</option>
            <?php $selected=(isset($student_details[0]->branch_id))?$student_details[0]->branch_id:0 ;echo load_select('branches',$selected);?>
        </select>
<!--        <input id="branch_id" name="branch_id" class="text" value="<?php if (isset($student_details[0]->branch_id))
                   echo $student_details[0]->branch_id; ?>"/>-->
    </li>
<!--    <li>
        <label for="degree">Degree:*</label>
        <input id="degree" name="degree" class="text " readonly="readonly" value="<?php if (isset($student_details[0]->degree))
                   echo $student_details[0]->degree; ?>"/>
    </li>-->
    <li style="display:none;">
        <label for="present_year">Present Year:*</label>
        <select id="present_year" name="present_year" class="text" disabled="disabled">
            <option value="">Select</option>
            <?php // $selected=(isset($student_details[0]->present_year))?$student_details[0]->present_year:0 ;echo year_select($selected);?>
            <?php
            $selected=(isset($student_details[0]->present_year))?$student_details[0]->present_year:0 ;
            for($i=1;$i<=4;$i++){ ?>
                <option value="<?php echo $i; ?>" <?php if($i==$selected){ echo 'selected="selected"'; } ?>><?php echo $i; ?></option>
            <?php } ?>
        </select>
<!--        <input id="present_year" name="present_year" class="text apply_datepickerx" readonly="readonly" value="<?php if (isset($student_details[0]->present_year))
                   echo $student_details[0]->present_year; ?>"/>-->
    </li>
    <li>
        <label for="sem_id">Present Year/Sem:*</label>
        <select name='sem_id' id='sem_id' class="text" disabled="disabled">
         <?php
            $sem_selected=(isset($student_details[0]->sem_id))?$student_details[0]->sem_id:1 ;
            echo selectBox('Select','semisters','id,name','status="1"',$sem_selected);
         ?>
        </select>
    </li>
    <li>
        <label for="semister_id">Sections:* </label>
        <select id="section_id" name="section_id" class="text required" disabled="disabled">
            <option value="">Select</option>
            <?php
                if(isset($student_details[0]->section_id)) $section_id_select=$student_details[0]->section_id; else $section_id_select=0;
                echo load_select_section('sections',$section_id_select,array('semister_id'=>$sem_selected));
            ?>
        </select>
    </li>
    <li>
        <label for="completing_year">Estimated Year of Completion:*</label>
        <select id="completing_year" name="completing_year" class="text" disabled="disabled">
            <option value="">Select</option>
            <?php $selected=(isset($student_details[0]->completing_year))?$student_details[0]->completing_year:0 ;echo year_select($selected);?>
        </select>
<!--        <input id="completing_year" name="completing_year" class="text apply_datepickerx" readonly="readonly" value="<?php if (isset($student_details[0]->completing_year))
                   echo $student_details[0]->completing_year; ?>"/>-->
    </li>
    <li>
        <label for="fee_details">Fee Details:*</label>
<!--        <input id="fee_details" name="fee_details" class="text" value="<?php if (isset($student_details[0]->fee_details))
                   echo $student_details[0]->fee_details; ?>"/>-->
                   <span style="padding:5px; padding-left: 0;" class="fl">
                   <table class="sample table_view">
                        <tr>
                            <th>Year</th>
                            <th>1<sup>st</sup>Year</th>
                            <th>2<sup>nd</sup>Year</th>
                            <th>3<sup>rd</sup>Year</th>
                            <th>4<sup>th</sup>Year</th>
                        </tr>
                        <tr>
                            <th>Fee Status</th>
                            <td><?php if(isset($student_details[0]->fee1))echo $student_details[0]->fee1; ?></td>
                            <td><?php if(isset($student_details[0]->fee2))echo $student_details[0]->fee2; ?></td>
                            <td><?php if(isset($student_details[0]->fee3))echo $student_details[0]->fee3; ?></td>
                            <td><?php if(isset($student_details[0]->fee4))echo $student_details[0]->fee4; ?></td>
                        </tr>
                    </table>
                   </span>
    </li>
    <li>
        <label for="address">Mailing Address:*</label>
        <textarea id="address" name="address" rows="8" cols="50" readonly="readonly"><?php if (isset($student_details[0]->address))
                   echo $student_details[0]->address; ?></textarea>
   </li>
   <li>
       <label for="mobile">Mobile Number:*</label>
       <input id="mobile" name="mobile" class="text" value="<?php if (isset($student_details[0]->mobile))
               echo $student_details[0]->mobile; ?>" readonly="readonly"/>
    </li>
    <li>
        <label for="email">Email:*</label>
        <input id="email" name="email" class="text" value="<?php if (isset($student_details[0]->email))
                   echo $student_details[0]->email; ?>" readonly="readonly"/>
    </li>
    <li>
<!--        <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Submit"/>-->
        <div class="clr"></div>
    </li>
</ol>
</form>