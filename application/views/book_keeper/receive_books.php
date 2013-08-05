<h2><span>Receive Books.</span></h2>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter details below.</p>
    <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
    <div class="clr"></div>
</div>
<div class="clr"></div>

<div>
    <form id="appl_form" action="/book_keeper/receive_books">
        <input id="" name="rel" class="text" type="hidden" value="receive_book"/>
           <ol>
        <li>
            <label for="student_number">Student Number:*</label>
            <input id="student_number" name="student_number" class="text"/>
        </li>
        <li>( OR )</li>
        <li>
            <label for="teacher_number">Teacher Number:*</label>
            <input id="teacher_number" name="teacher_number" class="text"/>
        </li>
        <li>
            <span id="error_placement"></span>
        </li>
        <li>
            <input type="button" class="gblue button j_gen_form_submit" value="Search"/><br />
        </li>
    </ol>
    </form>
    <br/>
</div>

<div class="hide">
    
    <div class="clr"></div>
    <p style="width:200px; float:left; font-size: 14px;">Book Details:</p>
    <div class="clr"></div>

    <ol>
        <li>
            <label for="name">Book Name:</label>
            <input id="name" name="name" class="text"/>
        </li>
        <li>
            <label for="email">Dispatched on:</label>
            <input id="email" name="email" class="text"/>
        </li>
        <li>
            <label for="website">Fine:</label>
            <input id="website" name="website" class="text"/>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="button" value="Take back"/><br />
        </li>
    </ol>
</div>