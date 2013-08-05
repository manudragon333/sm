<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/admin/save_course">
    <input id="" name="rel" class="text" type="hidden" value="course_management"/>
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
        <?php if(isset($college_data[0]['id']) && !empty($college_data[0]['id'])){ // This is a Update Process ?>
        <li>
            <label for="course_names">Course Name:* </label>
            <input id="name" name="course_names[]" class="text required" value="<?php if(isset($college_data[0]['name'])) echo $college_data[0]['name']; ?>" title="Please enter a course name"/>
        </li>
        <?php }else{ // This is a Adding Process
            for($i=1;$i<=10;$i++){
            ?>
            <li>
                <label for="course_names">Course Name <?php echo $i;  ?>:* </label>
                <input id="name" name="course_names[]" class="text required" value=""  title="Please enter a course name" />
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
        <li>
            <input type="button" name="imageField" id="imageField" class="send button gblue j_gen_form_submit" value="Save Course" />
            <div class="clr"></div>
        </li>
    </ol>
</form>