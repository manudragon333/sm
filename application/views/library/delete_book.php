<h2><span>Delete the Book</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter details below.</p>
    <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="appl_form" action="/library/delete_book">
    <input id="" name="rel" class="text" type="hidden" value="delete_book"/>
    <ol>
        <li>
            <label for="unique_number">Book Unique Number:*</label>
            <input id="unique_number" name="unique_number" class="text"/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="button j_gen_form_submit" value="Get this Book"/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="delete button j_gen_form_submit hide" value="delete"/>
            <div class="clr"></div>
        </li>
    </ol>
</form>

