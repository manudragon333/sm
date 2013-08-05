<div class="f_r f_b m_r_10">* required fields </div>
<form id="appl_form" action="/staff/send_msg" suc_msg="Message Submited Successfully." err_msg="Problem submitting.">
    <input id="" name="rel" class="text" type="hidden" value="send_msg"/>
    <ol id="staff_send_msg">
        <li>
            <p>Select type of message.</p>
            <label><input type="radio" name="choice" value="1" /> Email</label><br style="clear:both;"/>
            <label><input type="radio" name="choice" value="2" /> Mobile</label><br style="clear:both;"/>
        </li>
        <li id="choice2_li" class="hide">
            <p>Select Sending Preference.</p>
            <label><input type="radio" name="choice2" value="1" /> Group Message</label><br style="clear:both;"/>
            <label><input type="radio" name="choice2" value="2" /> Individual Message</label><br style="clear:both;"/>
        </li>
        <li id="choice3_li" class="hide">
            <br/>
                <label for="website"><b>Send Message to:*</b></label>
            <br style="clear: both;"/>
                <label for="college_id">College:* </label>
                <select id="college_id" name="college_id" class="text required">
                    <option value="">Select</option>
                    <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
                </select>
            <br/>
            <br/>
                <label for="course_id">Course:* </label>
                <select id="course_id" name="course_id" class="text required">
                    <option value="">Select</option>
                    <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
                </select>
            <br/>
            <br/>
                <label for="branch_id">Branch:* </label>
                <select id="branch_id" name="branch_id" class="text required">
                    <option value="">Select</option>
                    <?php if(isset($s_data['branch_id'])) $branch_id_select=$s_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
                </select>
            <br/>
            <br/>
                <label for="semister_id">Semester:* </label>
                <select id="semister_id" name="semister_id" class="text required" title="Please select a Semester">
                    <option value="">Select</option>
                    <?php if(isset($s_data['semister_id'])) $semister_id_select=$s_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
                </select>
                 <br/>
            <br/>
            <label for="semister_id">Sections:* </label>
            <select id="section_id" name="section_id" class="text" title="Please select a Section">
                <option value="">Select</option>
                <?php if(isset($s_data['section_id'])) $section_id_select=$s_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
       
            <br/>

<!--            <label for="website">Send Message to:*</label>
            <select name='choice3' class="text">
                
            </select>-->
        </li>
        <li id="student_number_li" class="hide">
            <label for="student_number">Student Number:*</label>
            <input id="student_number" name="student_number" class="text"/>
        </li>
        <li id="message_li" class="hide">
            <label for="message">Message:*</label>
            <textarea cols="10" rows="8" name="message"></textarea>
        </li>
        <li id="submit_button" class="hide">
            <input type="button" name="imageField" id="imageField" class="generate button j_gen_form_submit gblue" value="  Send  " />
        </li>
        
    </ol>
</form>
