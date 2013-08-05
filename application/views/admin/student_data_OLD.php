<div>
    <h2 align="center"><span> Add Details </span></h2>
    <div class="user_instructions">
        <p style="width:200px; float:left;">Please enter details below.</p>
        <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="clr"></div>
    <form action="/students/conduct_certificate" id="appl_form" suc_msg="Submited Successfully." err_msg="">
        <input id="" name="rel" class="text" type="hidden" value="add_stu_details"/>
        <div align="right" style="position: relative;">
            <img src="pic/logo.png" id="photo" width="100" height="100" align="center" title="pic" style="position: absolute; top:0px; right:-20px;"/>
            <div class="clr"></div>
        </div>
        <ol><li>

                <label for="name">Student Name:*</label>
                <input id="name" name="name" class="text"/>
            </li><li>
                <label for="student_number">Student Number:* </label>
                <input id="student_number" name="student_number" class="text"/>
            </li><li>
                <label for="uname">User Name:* </label>
                <input id="uname" name="uname" class="text"/>
            </li><li>
                <label for="pwd"> Password:* </label>
                <input type="password" id="pwd" name="pwd" class="text"/>
            </li><li>
                <label for="fname">Father Name: </label>
                <input id="fname" name="fname" class="text"/>
            </li><li>
            <label for="branch">Branch:*</label>
                <select id="branch" name="branch" class="text">
                    <option value="">Select</option>
                    <?php echo load_select('branches'); ?>
                </select>
        <!--        <input id="course" name="course" class="text"/>-->
            </li><li>
                <label for="course">Course:*</label>
                <select id="course" name="course" class="text">
                    <option value="">Select</option>
                    <?php echo load_select('courses'); ?>
                </select>
        <!--        <input id="course" name="course" class="text"/>-->
            </li><li>
                <label for="doj">Date of Join:</label>
                <input id="doj" name="doj" class="text apply_datepicker" readonly="readonly"/>
            </li><li>
                <label for="doc">Date of Completion:</label>
                <input id="doc" name="doc" class="text apply_datepicker" readonly="readonly"/>
            </li><li>
                <label for="dob">Date of Birth:* </label>
                <input id="dob" name="dob" class="text apply_datepicker" readonly="readonly"/>
            </li><li>
                <label for="mobile">Mobile:* </label>
                <input id="mobile" name="mobile" class="text"/>
            </li><li>
                <label for="email">Email:* </label>
                <input id="email" name="email" class="text"/>
            </li><li>
                <label for="bus">Bus Pass: </label>
                <input id="bus" name="bus" class="text"/>
            </li><li>
                <label for="idc">Id Card: </label>
                <input id="idc" name="idc" class="text"/>
            </li><li>
                <label for="addr">Address: </label>
                <textarea id="addr" name="addr" rows="8" cols="50"></textarea>
            </li><li>
                <label for="pyear">Present Studying Year: </label>
                <input id="pyear" name="pyear" class="text"/>
            </li><li>
                <label for="fee">Fee Details: </label>
                <input id="fee" name="fee" class="text"/>
            </li><li>
                <label for="account">Account Status: </label>
                <input id="account" name="account" class="text"/>
            </li><li>
                <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Save"/>
                <div class="clr"></div>
            </li></ol>
    </form>
</div>
