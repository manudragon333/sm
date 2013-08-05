<div class="user_instructions">
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/students/submit_assignment/<?php echo urlencode($enc_id); ?>">
    <input id="" name="rel" class="text" type="hidden" value="submit_assignments"/>
    <ol>
        <li>
            <label for="student_replies">Message:*</label>
            <textarea id="student_replies" cols="8" rows="5" name="student_replies" class="text"></textarea>
        </li>
        <li>
            <label for="photo">Upload the Paper*</label>
            <input type="file" name="photo" size="100" class="" id="doc_upload"/>
            <input name="doc_link" class="myfile" value="" type="hidden" id="doc_link"/>
        </li>
        
        <li>
            <br/>
            <input type="button" name="imageField" id="imageField" class="upload button j_gen_form_submit gblue" value="Submit"/>
        </li>
    </ol>
</form>
<script type="text/javascript">
       $(function(){ updateHeader('Submit Assignment'); });
</script>