<h2 align="left"><span id="att_title"><?php if(isset($subject_edit_data[0]['id'])) echo 'Update'; else echo 'Add'; ?> Attendance</span></h2>
<pre><?php // print_r($subject_edit_data); ?></pre>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/admin/save_attendance" suc_msg="Attendance Saved Succesfully..">
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($subject_edit_data[0]['id'])) echo $subject_edit_data[0]['id']; ?>"/>
    <input id="" name="user_id" class="text" type="hidden" value="<?php if(isset($subject_edit_data[0]['user_id'])) echo $subject_edit_data[0]['user_id']; ?>"/>
    <input id="" name="semister_idXX" class="text" type="hidden" value="<?php if(isset($subject_edit_data[0]['semister_id'])) echo $subject_edit_data[0]['semister_id']; ?>"/>
    <ol>
        <?php if(isset($subject_edit_data[0]['id'])){
            $s_data=$subject_edit_data[0];
        } ?>

        <li>
            <label for="add_attendance_sem_id">Semester:*</label>
            <select name='semister_id' id='add_attendance_sem_id' class="text">
                <?php
                    $selected_sem_id=(isset($subject_edit_data[0]['semister_id']))?$subject_edit_data[0]['semister_id']:'1';
                    echo selectBox('Select','semisters','id,name','status="1"',$selected_sem_id);
                ?>
            </select>
        </li>
        <li>
            <label for="attend_days">Attended Days:* </label>
            <input class="text" type="text" name="attend_days" value="<?php if(isset($s_data['attend_days'])) echo $s_data['attend_days']; ?>"/>
        </li>
        <li>
            <label for="tot_days">Total Days:* </label>
            <input class="text" type="text" name="tot_days" value="<?php if(isset($s_data['tot_days'])) echo $s_data['tot_days']; ?>"/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="<?php if(isset($subject_edit_data[0]['id'])) echo 'Update'; else echo 'Add'; ?> Attendance" />
            <div class="clr"></div>
        </li>
    </ol>
</form>