<h2><span>Pass on books.</span></h2>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter details below.</p>
    <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
    <div class="clr"></div>
</div>
<div class="clr"></div>
<div>
    <form id="appl_form" action="/book_keeper/pass_on_books">
        <input id="" name="rel" class="text" type="hidden" value="pass_on_book"/>
        <ol>
            <li>
                <label for="student_number">Student Number:*</label>
                <input id="student_number" name="student_number" class="text"/><br />
            </li>
<!--            <li>
                ( Pass th book: )
            </li>-->
            <li>
                <label for="book_number">Book Unique Number:*</label>
                <input id="book_number" name="book_number" class="text"/>
            </li>
            <li>
                <br/>
                <input type="button" name="imageField" id="imageField" class="button j_gen_form_submit" value=" Search "/>
                <input type="button" name="imageField" id="imageField" class="button clear" value=" Reset "/>
            </li>
        </ol>
    </form>
</div>



<div class="hide">
    <h2><span></span></h2>
    <div class="clr"></div>
    <div class="user_instructions">
        <p style="width:200px; float:left;"></p>
        <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
        <div class="clr"></div>
    </div>
    <ol>
        <li>
            <label for="bname">Book name</label>
            <input id="bname" name="bname" class="text"/>
        </li>
        <li>
            <label for="unum">Unique number</label>
            <input id="unum" name="unum" class="text"/>
        </li>
        <li>
            <label for="reserve">Reserved By</label>
            <input id="reserve" name="reserve" class="text"/>
        </li>
        <li>
            <label for="reserveon">Reserved On</label>
            <input id="reserveon" name="reserveon" class="text"/>
        </li>
    </ol>

</div>