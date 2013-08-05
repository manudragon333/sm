<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/students/preview_bus_pass" suc_msg="">
    <input id="" name="rel" class="text" type="hidden" value="buss_pass"/>
    <ol>
        <li>
            <label for="semester">Semester:*</label>
            <select id="semisters_attendance" name="semisters" class="text" >
                <option value="">Select</option>
                <?php foreach($student_semesters as $k=>$v){ ?>
                <option value="<?php echo $v->id; ?>"><?php echo $v->sname; ?></option>
                <?php } ?>
            </select>
        </li>
        <li id="semister_next_view">

        </li>
    </ol>
</form>
