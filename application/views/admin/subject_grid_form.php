<h2 align="left"><span><?php if(isset($subject_edit_data[0]['id'])) echo 'Edit'; else echo 'Add'; ?> Exam</span></h2>
<pre><?php // print_r($subject_edit_data); ?></pre>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/admin/save_subject_grid">
    <input id="" name="rel" class="text" type="hidden" value="sbject_grid_form"/>
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($subject_edit_data[0]['id'])) echo $subject_edit_data[0]['id']; ?>"/>
    <ol>
        <?php if(isset($subject_edit_data[0]['id'])){
            $s_data=$subject_edit_data[0];
        } ?>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['branch_id'])) $branch_id_select=$s_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select); ?>
            </select>
        </li>
        <li>
            <label for="semister_id">Semester:* </label>
            <select id="semister_id" name="semister_id" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['semister_id'])) $semister_id_select=$s_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select); ?>
            </select>
        </li>
        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text">
                <option value="">Select</option>
                <?php if(isset($s_data['subject_id'])) $subject_id_select=$s_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select); ?>
            </select>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Save Exam" />
            <div class="clr"></div>
        </li>
    </ol>
</form>