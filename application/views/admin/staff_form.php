<form id="appl_form" action="/admin/save_user_account" class="m_t_10">
    <input id="rel" name="rel" type="hidden" class="text" value="user_form"/>
    <input id="id" name="id" type="hidden" class="text" value="<?php if (isset($user_details[0]->id)) echo $user_details[0]->id; ?>"/>
    <input id="users_type_id" type="hidden"  name="users_type_id" class="text" value="<?php if (isset($user_details[0]->users_type_id)) echo $user_details[0]->users_type_id; ?>"/>
    <input id="staff_rec_id" type="hidden" name="staff_rec_id" class="text" value="<?php if (isset($data[0]->id)) echo $data[0]->id; ?>"/>
<ol>
    <li>
        <label for="name">Name:*</label>
        <input id="name" name="name" class="text"  value="<?php if(isset($data[0]->name )) echo $data[0]->name; ?>"/>
    </li>
    <li>
        <label for="code">Code:*</label>
        <input id="code" name="code" class="text" value="<?php if(isset($data[0]->code)) echo $data[0]->code; ?>"/>
    </li>
    <li>
        <label for="designation_id">Designation:*</label>
        <select id="designation_id" name="designation_id" class="text">
            <option value="">Select</option>
            <?php $designation_selected=(isset($data[0]->designation_id))?$data[0]->designation_id:''; echo load_select('designation',$designation_selected); ?>
        </select>
<!--        <input id="designation" name="designation" class="text" value="<?php if(isset($data[0]->designation)) echo $data[0]->designation; ?>"/>-->
    </li>
<!--    <li>
        <label for="branch_id">Branch:*</label>
        <select id="branch_id" name="branch_id" class="text">
            <option value="">Select</option>
            <?php $branch_selected=(isset($data[0]->branch_id))?$data[0]->branch_id:''; echo load_select('branches',$branch_selected); ?>
        </select>
        <input id="course" name="course" class="text"/>
    </li>-->


    <li>
        <label for="college_id">College:* </label>
        <select id="college_id" name="college_id" class="text">
            <option value="">Select</option>
            <?php if(isset($data[0]->college_id)) $college_id_select=$data[0]->college_id; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
        </select>
    </li>
    <li>
        <label for="course_id">Course:* </label>
        <select id="course_id" name="course_id" class="text">
<!--                        <option value="">Select</option>-->
            <?php if(isset($data[0]->course_id)) $course_id_select=$data[0]->course_id; else $course_id_select=0; // echo load_select('courses',$course_id_select); ?>
            <?php echo selectBox('Select','courses','id,name',' college_id="'.$college_id_select.'" ',$course_id_select);  ?>
        </select>
    </li>
    <li>
        <label for="branch_id">Branch:* </label>
        <select id="branch_id" name="branch_id" class="text required">
<!--                        <option value="">Select</option>-->
            <?php if(isset($data[0]->branch_id)) $branch_id_select=$data[0]->branch_id; else $branch_id_select=0; // echo load_select('branches',$branch_id_select); ?>
            <?php echo selectBox('Select','branches','id,name',' course_id="'.$course_id_select.'" ',$branch_id_select);  ?>
        </select>
    </li>


    <li>
        <label for="dob">Date of Birth:*</label>
        <input id="dob" name="dob" class="text apply_datepicker" readonly="readonly"  value="<?php if(isset($data[0]->dob)) echo dateFormat($data[0]->dob); ?>"/>
    </li><li>
        <label for="sex">Sex:*</label>
<!--        <select id="sex" name="sex" class="text" >
                <option value="">Select</option>
                <?php $selected=(isset($data[0]->sex))?$data[0]->sex:''; echo load_select('sex',$selected);?>
        </select>-->
        <input type="radio" name="sex" class="" value="1" <?php if (isset($data[0]->sex) && $data[0]->sex=='1') echo 'checked="checked"'; ?>/> Male
        <input type="radio" name="sex" class="" value="2" <?php if (isset($data[0]->sex) && $data[0]->sex=='2') echo 'checked="checked"'; ?>/> Female
    </li><li>
        <label for="doj">Date of Join :</label>
        <input id="doj" name="doj" class="text apply_datepicker" readonly="readonly" value="<?php if(isset($data[0]->doj)) echo dateFormat($data[0]->doj); ?>"/>
    </li><li>
        <label for="qualification">Qualification :</label>
        <input id="qualification" name="qualification" class="text " value="<?php if(isset($data[0]->qualification)) echo $data[0]->qualification; ?>"/>
    </li><li>
        <label for="email">Email:*</label>
        <input id="email1" name="email" class="text"  value="<?php if(isset($data[0]->email)) echo $data[0]->email; ?>"/>
    </li>
<!--    <li>
        <label for="email2">Secondary Email:</label>
        <input id="email2" name="email2" class="text" value="<?php if(isset($data[0]->email2)) echo $data[0]->email2; ?>"/>
    </li>-->
    <li>
        <label for="mobile">Mobile Number:*</label>
        <input id="mobile" name="mobile" class="text" value="<?php if(isset($data[0]->mobile)) echo $data[0]->mobile; ?>"/>
    </li><li>
        <label for="address">Address:</label>
        <textarea id="address" name="address" rows="8" cols="50"><?php if(isset($data[0]->address)) echo $data[0]->address; ?></textarea>
    </li>
<!--    <li>
        <label for="salary">Basic Salary:</label>
        <input id="salary" name="salary" class="text"  value="<?php if(isset($data[0]->salary)) echo $data[0]->salary; ?>"/>
    </li>-->
    <div class="clr"></div>
</ol>
<br/>
<ol>
    <li>
        <label for="username">Username:*</label>
        <input id="username" name="username" class="text" value="<?php if (isset($user_details[0]->username))
                   echo $user_details[0]->username; ?>"/>
    </li>
    <li>
        <label for="password">Password:*</label>
        <input id="password" name="password" class="text" value="<?php if (isset($user_details[0]->password))
                   echo $user_details[0]->password; ?>" type="password"/>
    </li>
    <div class="clr"></div>
</ol>
<br/>
<ol>
    <li>
        <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Save"/>
        <input type="button" name="imageField" id="imageField" class="m_l_20 grey button" value="Back" onclick="javascript:window.location.reload();"/>
        <div class="clr"></div>
    </li>
</ol>
</form>
<script type="text/javascript">
    if($('.apply_datepicker').length>0){
        $('.apply_datepicker').datepicker({dateFormat:'yy-mm-dd', changeMonth: true, changeYear: true});
    }
</script>