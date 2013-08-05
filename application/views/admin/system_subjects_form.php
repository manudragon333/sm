<h2 align="left"><span><?php if(isset($subject_edit_data[0]['id'])) echo 'Edit'; else echo 'Add'; ?> Exam</span></h2>
<pre><?php // print_r($subject_edit_data); ?></pre>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/admin/save_system_subjects" suc_msg="Subject Saved Succesfully..">
    <input id="" name="rel" class="text" type="hidden" value="sbject_grid_form"/>
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($subject_edit_data[0]['id'])) echo $subject_edit_data[0]['id']; ?>"/>
    <ol>
        <?php if(isset($subject_edit_data[0]['id'])){
            $s_data=$subject_edit_data[0];
        } ?>
        <li>
            <label for="branch_id">Subject name:* </label>
            <input class="text" type="text" name="name" value="<?php if(isset($s_data['name'])) echo $s_data['name']; ?>"/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Save Subject" />
            <div class="clr"></div>
        </li>
    </ol>
</form>