<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/email/send_email">
    <input id="" name="rel" class="text" type="hidden" value="compose_email"/>
    <ol>
        <li>
            <label for="to">To:*</label>
            <input id="to" name="to" class="text"/>
        </li>
        <li>
            <label for="from">Your Email ID:*</label>
            <input id="from" name="from" class="text"/>
        </li>
<!--        <li>
            <label for="website">Attachment:*</label>
            <input name="file" class="myfile" value="" type="hidden" id="email_attach"/>
            <input type="hidden" name="file_name" id="file_name" value=""/>
            <input type="hidden" name="file_type" id="file_type" value=""/>
            <input type="hidden" name="file_size" id="file_size" value=""/>
        </li>-->
        <li>
            <label for="subject">Subject:*</label>
            <input id="subject" name="subject" class="text"/>
        </li>
        <li>
            <label for="message">Message:*</label>
            <textarea id="message" name="message" rows="8" cols="50"></textarea>
        </li>
        <li>
            <br/>
            <input type="button" name="imageField" class="upload button j_gen_form_submit gblue" value="Send Email"/>
<!--            <input type="button" name="imageField" id="get_button" class="get button" value="Get the id card"style="margin-left: 126px;"/>-->
        </li>
    </ol>
</form> 
