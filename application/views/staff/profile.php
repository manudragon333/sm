<?php //echo '<pre>'; print_r($data); echo '</pre>'; ;?>

<div class="f_r f_b m_r_10">* required fields</div>

<form id="appl_form" action="/staff/profile">
    <input id="" name="rel" class="text" type="hidden" value="staff_profile"/>
    <input type="hidden" name="id" value="<?php if(isset($data[0]->id)) echo $data[0]->id; ?>" />
    <ol>
        <li>
            <label for="name">Name:*</label>
            <input id="name" name="name" class="text" readonly="readonly" value="<?php if(isset($data[0]->name )) echo $data[0]->name; ?>"/>
        </li>
        <li>
            <label for="code">Code:*</label>
            <input id="code" name="code" class="text" readonly="readonly" value="<?php if(isset($data[0]->code)) echo $data[0]->code; ?>"/>
        </li>
        <li>
            <label for="designation_id">Designation:*</label>
            <select id="designation_id" name="designation_id" class="text" disabled="disabled">
                <option value="">Select</option>
                <?php $designation_selected=(isset($data[0]->designation_id))?$data[0]->designation_id:''; echo load_select('designation',$designation_selected); ?>
            </select>
<!--            <input id="designation" name="designation" class="text" readonly="readonly" value="<?php if(isset($data[0]->designation)) echo $data[0]->designation; ?>"/>-->
        </li>
        <li>
            <label for="branch_id">Branch:*</label>
            <select id="branch_id" name="branch_id" class="text" disabled="disabled">
                <option value="">Select</option>
                <?php $branch_selected=(isset($data[0]->branch_id))?$data[0]->branch_id:''; echo load_select('branches',$branch_selected); ?>
            </select>
    <!--        <input id="course" name="course" class="text"/>-->
        </li>
        <li>
            <label for="dob">Date of Birth:*</label>
            <input id="dob" name="dob" class="text " readonly="readonly" value="<?php if(isset($data[0]->dob)) echo dateFormat($data[0]->dob); ?>"/>
        </li><li>
            <label for="sex">Sex:*</label>
<!--            <select id="sex" name="sex" class="text" disabled="disabled">
                    <option value="">Select</option>
                    <?php $selected=(isset($data[0]->sex))?$data[0]->sex:''; echo load_select('sex',$selected);?>
            </select>-->
            <input type="radio" name="sex" class="" value="1" <?php if (isset($data[0]->sex) && $data[0]->sex=='1') echo 'checked="checked"'; ?>/> Male
            <input type="radio" name="sex" class="" value="2" <?php if (isset($data[0]->sex) && $data[0]->sex=='2') echo 'checked="checked"'; ?>/> Female
        </li><li>
            <label for="doj">Date of Join :</label>
            <input id="doj" name="doj" class="text" readonly="readonly" value="<?php if(isset($data[0]->doj)) echo dateFormat($data[0]->doj); ?>"/>
        </li><li>
            <label for="qualification">Qualification :</label>
            <input id="qualification" name="qualification" class="text" readonly="readonly" value="<?php if(isset($data[0]->qualification)) echo $data[0]->qualification; ?>"/>
        </li><li>
            <label for="email">Email:*</label>
            <input id="email1" name="email" class="text" readonly="readonly" value="<?php if(isset($data[0]->email)) echo $data[0]->email; ?>"/>
        </li>
<!--        <li>
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
<!--        <li>
            <label for="salary">Basic Salary:</label>
            <input id="salary" name="salary" class="text" readonly="readonly" value="<?php if(isset($data[0]->salary)) echo $data[0]->salary; ?>"/>
        </li>-->
        <li>
            <input type="button" name="imageField" id="imageField" class=" button j_gen_form_submit gblue" value="Save"/>
            <div class="clr"></div>
        </li>
    </ol>
</form>
