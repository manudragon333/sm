<div class="f_r f_b m_r_10">* required fields</div>
<form id="appl_form" action="/students/no_due" suc_msg="No Due Request Submited Successfully." err_msg="You already applied for No-Due. Please check the status.">
    <input id="" name="rel" class="text" type="hidden" value="nodue"/>
    <ol>
        <li>
            <label><input type="radio" name="no_due" value="1" /> Apply for no due certificate.</label><br style="clear:both;"/>
            <label><input type="radio" name="no_due" value="0" /> Check the status.</label>
        </li>
        <li>
            <br/>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Submit"/>
            <div class="clr"></div>
        </li>
    </ol>
</form>