<h2><span>Details of the Exam Marks.</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/students/preview_bus_pass" suc_msg="">
    <input id="" name="rel" class="text" type="hidden" value="buss_pass"/>
    <ol>
        <li>
            <label for="semester">Semester:*</label>
            <select id="semisters" name="semisters" class="text" >
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
