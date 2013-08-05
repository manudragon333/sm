<h2><span>Send a Message to Student.</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/exam/sendmsg" suc_msg="Message Submited Successfully." err_msg="Problem submitting.">
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
            <label for="website">Send Message to:*</label>
            <select name='choice3' class="text">
                <option value>Select</option>
                <option value="1">1st Year Students</option>
                <option value="2">2nd Year Students</option>
                <option value="3">3rd Year Students</option>
                <option value="4">4th Year Students</option>
            </select>
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
            <input type="button" name="imageField" id="imageField" class="generate button j_gen_form_submit" value="  Send  " />
        </li>
        
    </ol>
</form>
