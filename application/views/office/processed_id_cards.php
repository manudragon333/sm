<h2><span>Processed Id cards</span></h2>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<div class="clr"></div>
<form id="appl_form" action="/office/processed_id_cards">
    <input id="" name="rel" class="text" type="hidden" value="proc_id_certi"/>
    <div>
        <ol>
            <li>
                <label for="student_number">Student Number:*</label>
                <input id="student_number" name="student_number" class="text"/>
            </li>
            <li>
                <input type="button" name="imageField" id="imageField" class="button j_gen_form_submit" value="Search"/>
            </li>
        </ol>
    </div><br/>
</form>

<div class="hide">
    <h2 ><span>Id card Request.</span></h2>
    <div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
    <div class="clr"></div>
    <form id="appl_formx" suc_msg="Submited Successfully.">
        <input id="" name="rel" class="text" type="hidden" value="proc_icard"/>
        <ol>
            <li>
                <label for="name">Student Name:*</label>
                <input id="name" name="name" class="text"/>
            </li><li>
                <label for="stu_num">Student Number:*</label>
                <input id="stu_num" name="stu_num" class="text"/>
            </li><li>
                <label for="course">Course:*</label>
                <input id="course" name="course" class="text"/>
            </li><li>
                <label for="branch">Branch:*</label>
                <input id="branch" name="branch" class="text"/>
            </li><li>
                <label for="Picture">Photo:*</label>
                <input type='file' name='Picture' /><br />
            </li>
            <li>
                <br/>
                <input type="button" name="imageField" id="imageField" class="generate button j_gen_form_submit" value="Generate ID Card"style="margin-left: 700px;"/>
            </li>
        </ol>
    </form>

</div>