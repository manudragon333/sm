<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/admin/save_notice">
    <input id="" name="rel" class="text" type="hidden" value="notice_form"/>
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($notice_data[0]['id'])) echo $notice_data[0]['id']; ?>"/>
    <ol>
        <li>
            <label for="message">Message:* </label>
            <textarea cols="10" rows="5" name="message" id="message"><?php if(isset($notice_data[0]['message'])) echo $notice_data[0]['message']; ?></textarea>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class=" button gblue j_gen_form_submit" value="Save Message" />
            <div class="clr"></div>
        </li>
    </ol>
</form>