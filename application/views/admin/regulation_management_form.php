<h2 align="left"><span><?php if(isset($college_data[0]['id'])) echo 'Edit'; else echo 'Add'; ?> Regulation</span></h2>
<pre><?php // print_r($college_data); ?></pre>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/admin/save_regulation">
    <input id="" name="rel" class="text" type="hidden" value="college_management"/>
    <input id="" name="id" class="text" type="hidden" value="<?php if(isset($college_data[0]['id'])) echo $college_data[0]['id']; ?>"/>
    <ol>
       
        
       
        <li>
            <label for="estd">Regulation:* </label>
            <input id="name" name="name" heigth="20" class="text required" title="" value="">
        </li>
        <li>
            <label for="status">Status:* </label>
            <select id="status" name="status" class="text">
                <option value="1" >Active</option>
                <option value="0" >InActive</option>
            </select>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value="Save Regulation" />
            <div class="clr"></div>
        </li>
    </ol>
</form>