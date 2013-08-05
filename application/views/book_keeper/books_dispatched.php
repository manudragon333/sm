<h2><span>Books Dispatched</span></h2>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter details below.</p>
    <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
    <div class="clr"></div>
</div>
<div class="clr"></div>
<form action="/book_keeper/books_dispatched" id="appl_form" >
    <input id="" name="rel" class="text" type="hidden" value="booksdispatch"/>
    <ol>
        <li>
            <label for="student_number">Search by Student Number* :</label>
            <input id="student_number" name="student_number" class="text"/><br />
        </li>
        <li>
            ( OR )
        </li>
        <li>
            <label for="book_number">Search by Unique Number* :</label>
            <input id="book_number" name="book_number" class="text"/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="button j_gen_form_submit" value=" Search "/>
        </li>
    </ol>
</form>