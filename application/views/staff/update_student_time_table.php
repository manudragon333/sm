<?php  // echo '<pre>'; print_r($branches);print_r($days); echo '</pre>'; die; ?>

<form id="appl_form" action="/staff/update_student_time_table">

<ol>


    <li>
        <label for="college_id">College:* </label>
        <select id="college_id" name="college_id" class="text required" title="Please select College">
            <option value="">Select</option>
            <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
        </select>
    </li>
    <li>
        <label for="course_id">Course:* </label>
        <select id="course_id" name="course_id" class="text required"  title="Please select Course">
            <option value="">Select</option>
            <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
        </select>
    </li>




    <li>
        <label for="from_month">Select Branch:* </label>
        <select id="branch_select" class="text" name="branch_id" id="branch_id">
            <option value="">Select</option>
            <?php foreach($branches as $k=>$v){ ?>
            <option value="<?php echo $v['id']; ?>"><?php echo $v['name']; ?></option>
            <?php } ?>
        </select>
    </li>
    <li>
        <label for="sem_id">Semester:* </label>
        <select id="year_select" name="sem_id" class="text required" title="Please select a Semester">
            <option value="">Select</option>
            <?php if(isset($s_data['semister_id'])) $semister_id_select=$s_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
        </select>
    </li>
<!--    <li>
        <label for="from_month">Select Year:* </label>
        <select id="year_select" class="text" name="year" id="year">
            <option value="">Select</option>
            <?php for($i=1;$i<=4;$i++){ ?>
            <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
            <?php } ?>
        </select>
    </li>-->
    <li class="showTtOptions time_table_lab">
        <table  class="sample table_view">
            <tr>
                <th>Day/Period</th>
                <?php for($i=1;$i<=7;$i++){ ?>
                <th>Subject <?php echo $i; ?></th>
                <?php } ?>
                <th>Lab 1</th>
                <th>Lab 2</th>
            </tr>
            <?php foreach($days as $kd=>$vd){ ?>
            <tr>
                <th><?php echo $vd['day']; ?><input type="hidden" name="rows[<?php echo $vd['id']; ?>][id]" value="0"/><input type="hidden" name="rows[<?php echo $vd['id']; ?>][day_id]" value="<?php echo $vd['id']; ?>"/></th>
                <?php for($i=1;$i<=7;$i++){ ?>
                <td><input type="text" name="rows[<?php echo $vd['id']; ?>][sub<?php echo $i; ?>]" value=""/></td>
                <?php } ?>
                <td><input type="text" name="rows[<?php echo $vd['id']; ?>][lab1]" value=""/></td>
                <td><input type="text" name="rows[<?php echo $vd['id']; ?>][lab2]" value=""/></td>
            </tr>
            <?php } ?>
        </table>
    </li>
</ol>
<input type="button" name="imageField" id="imageField" class="m_t_10 button showTtOptions j_gen_form_submit gblue " value="Save Time Table"/>
</form>