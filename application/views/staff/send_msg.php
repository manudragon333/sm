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
                <label for="college_id"><?php echo $this->lang->line('institute_type'); ?>:* </label>
                <select id="college_id" name="college_id" class="text required" title="Please select a <?php echo $this->lang->line('institute_type'); ?>">
                    <option value="">Select</option>
                    <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
                </select>
            <br/>
            <br/>
                <label for="course_id"><?php echo $this->lang->line('institute_course'); ?>:* </label>
                <select id="course_id" name="course_id" class="text required" title="Please select a <?php echo $this->lang->line('institute_course'); ?>">
                    <option value="">Select</option>
                    <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
                </select>
            <br/>
            <br/>
                <label for="branch_id"><?php echo $this->lang->line('institute_branch'); ?>:* </label>
                <select id="branch_id" name="branch_id" class="text required" title="Please select a <?php echo $this->lang->line('institute_branch'); ?>">
                    <option value="">Select</option>
                    <?php if(isset($s_data['branch_id'])) $branch_id_select=$s_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
                </select>
            <br/>
            <br/>
                <label for="semister_id"><?php echo $this->lang->line('institute_sem'); ?>:* </label>
                <select id="semister_id" name="semister_id" class="text required" title="Please select a <?php echo $this->lang->line('institute_sem'); ?>">
                    <option value="">Select</option>
                    <?php if(isset($s_data['semister_id'])) $semister_id_select=$s_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
                </select>
                 <br/>
            <br/>
            <label for="semister_id"><?php echo $this->lang->line('institute_sec'); ?>:* </label>
            <select id="section_id" name="section_id" class="text" title="Please select a <?php echo $this->lang->line('institute_sec'); ?>">
                <option value="">Select</option>
                <?php if(isset($s_data['section_id'])) $section_id_select=$s_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
       
            <br/>
<br style="clear:both;"/>
            <label> <p>Religion:</p> </label>
		<select id="religion" name="religion" class="text" title="Please select a Religion">
		<option value="">All</option>
		<option value="Hindu">Hindu</option>
		<option value="Muslim">Muslim</option>
		<option value="Christian">Christian</option>
		<option value="Others">Others</option>           
		</select>
		<br style="clear:both;"/>
            <div id='sms_users_req'></div>		
		
        </li>
        <li>
		<br style="clear:both;"/>
            <label><p>Send to:</p></label>
            <input type="radio" name="smsto" checked value="parent" /> Parent
            <input type="radio" name="smsto" value="student" /> Student<br style="clear:both;"/>
        </li>
    	<li id="student_number_li" class="hide">
            <label for="student_number">Student Number:*</label>
            <input id="student_number" name="student_number" class="text"/>
        </li>
		
        <li id="sms_template_li" class="hide">
            <label for="sms_template">Select Template:*</label>            
			<select id="sms_template" name="sms_template" class="text required">
                 <option value="" desc="">Select</option>
                 <?php if(isset($s_data['sms_template'])) $sms_template_select=$s_data['sms_template']; else $sms_template_select=0; echo template_select('templates',$sms_template_select); ?>
            </select>
        </li>
		
        <li id="message_li" class="hide">
            <label for="message">Message:*</label>
            <textarea cols="10" rows="8" name="message" id="message"></textarea>
        </li>
        <li id="submit_button" class="hide">
            <input type="button" name="imageField" id="imageField" class="generate button j_gen_form_submit gblue" value="  Send  " />
        </li>
        
    </ol>
</form>
