<h2><span>Check the Data</span></h2>

<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter details below.</p>
    <p style="width:200px; float:right;font-weight: bold;" class="hide">*<i> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/library/check_data">
    <input id="" name="rel" class="text" type="hidden" value="check_Data"/>
    <ol>
        <li>
            <label for="student_number">Student Number:*</label>
            <input id="student_number" name="student_number" class="text"/>
        </li>
        <li>( OR )</li>
        <li>
            <label for="teacher_number">Teacher Number:*</label>
            <input id="teacher_number" name="teacher_number" class="text"/>
        </li>
        <li>
            <span id="error_placement"></span>
        </li>
        <li>
            <input type="button" class="gblue button j_gen_form_submit" value="Get Data"/><br />
        </li>
    </ol>
</form>

<div class="clr"></div>
