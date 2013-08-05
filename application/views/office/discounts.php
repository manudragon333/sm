

<h2><span>Student Data</span></h2>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="<? echo site_url('office/discounts');?>" method="post">
    <input id="" name="rel" class="text" type="hidden" value="discounts"/>
    <ol>
        <li>
            <label for="number">Student Number:* </label>
            <input id="number" name="number" class="text"/>
        </li>
        <li>
            <input type="submit" name="imageField" id="imageField" class="button j_gen_form_submit" value="Search"/>
        </li>
    </ol>
</form>
<br/>