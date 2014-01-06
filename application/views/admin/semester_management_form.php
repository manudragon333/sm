<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="admin/save_semester">
    <input id="" name="rel" class="text" type="hidden" value="branch_management"/>
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($college_data[0]['id'])) echo $college_data[0]['id']; ?>"/>
    <ol>
        <?php if(isset($college_data[0]['id'])){
            $s_data=$college_data[0];
        } ?>
        <li>
            <label for="college_id"><?php echo $this->lang->line('institute_type'); ?>:* </label>
            <select id="college_id" name="college_id" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id"><?php echo $this->lang->line('institute_course'); ?>:* </label>
            <select id="course_id" name="course_id" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id"><?php echo $this->lang->line('institute_branch'); ?>:* </label>
            <select id="branch_id" name="branch_id" class="text required">
                <option value="">Select</option>
                <?php if(isset($s_data['branch_id'])) $branch_id_select=$s_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>
        <?php if(isset($college_data[0]['id']) && !empty($college_data[0]['id'])){ // This is a Update Process ?>
        <li>
            <label for="semester_names"><?php echo $this->lang->line('institute_sem'); ?> Name:* </label>
            <input id="name" name="semester_names[]" class="text required" title="Please enter a <?php echo $this->lang->line('institute_sem'); ?> name" value="<?php if(isset($college_data[0]['name'])) echo $college_data[0]['name']; ?>">
        </li>
        <li class="hide_imp">
            <label for="sem_numbers"><?php echo $this->lang->line('institute_sem'); ?> Number :* </label>
            <input id="sem_numbers" name="sem_numbers[]" class="text digits required" title="Please enter a semester number(ex. 1 for 1st sem, 2 for 2nd sem)" value="<?php if(isset($college_data[0]['sem_number'])) echo $college_data[0]['sem_number']; else echo '0'; ?>">
        </li>
        <?php }else{ // This is a Adding Process  
            for($i=1;$i<=10;$i++){
            ?>
            <li>
                <label for="semester_names"><?php echo $this->lang->line('institute_sem'); ?> Name <?php echo $i;  ?>:* </label>
                <input id="semester_names" name="semester_names[]" class="text required" title="Please enter a <?php echo $this->lang->line('institute_sem'); ?> name" value="">
            </li>
            <li class="hide_imp">
                <label for="sem_numbers<?php echo $i;  ?>"><?php echo $this->lang->line('institute_sem'); ?> Number <?php echo $i;  ?>:* </label>
                <input id="sem_numbers<?php echo $i;  ?>" name="sem_numbers[]" class="text digits required" title="Please enter a semester number(ex. 1 for 1st sem, 2 for 2nd sem)" value="0">
            </li>
        <?php
            }
        }
        ?>
        <li>
            <label for="year">Year:* </label>
            <select id="year" name="year" class="text required" title="Please select the Year of Semester">
                <option value="">Select</option>
                <?php
                    if(isset($s_data['year'])) $year_select=$s_data['year']; else $year_select=0;
                    for($i=1;$i<=5; $i++){
                ?>
                <option value="<?php echo $i;  ?>" <?php if($year_select==$i){ echo 'selected="selected"'; }  ?>><?php echo $i;  ?></option>
                <?php }  ?>
            </select>
        </li>
        <li>
            <label for="status">Status:* </label>
            <select id="status" name="status" class="text">
                <option value="1" <?php if(isset($college_data[0]['status']) && $college_data[0]['status']=='1') echo ' selected="selected" ' ?>>Active</option>
                <option value="0" <?php if(isset($college_data[0]['status']) && $college_data[0]['status']=='0') echo ' selected="selected" ' ?>>InActive</option>
            </select>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class=" button gblue j_gen_form_submit" value="Save <?php echo $this->lang->line('institute_sem'); ?>" />
            <div class="clr"></div>
        </li>
    </ol>
</form>