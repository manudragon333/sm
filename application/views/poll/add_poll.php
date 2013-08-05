
 <div class="f_r f_b m_r_10">* required fields</div>

    <form action="<?php echo site_url('admin/addpoll');?>" id="appl_form" method="post" >
       <input id="" name="rel" class="text" type="hidden" value="polls_form"/>
        <ol>
            <li>

                <label for="name">Question :*</label>
                <input type="text" name="question" id="question" value="" class="text"/>
            </li>
			<li>
			 <label for="name">Start date:*</label>
            <input type="text" name="start_date" id="start_date" value="" class="text apply_datepicker"/>
            </li>
			<li>
			 <label for="name">End date:*</label>
            <input type="text" name="end_date" id="end_date" value="" class="text apply_datepicker"/>
            </li>
            <li>
			 <label for="name">Access for:*</label>
                         Student:<input type="radio" name="access" id="access" value="1" checked="checked" />&nbsp;Teacher:<input type="radio" name="access" id="access" value="2" />&nbsp;Both:<input type="radio" name="access" id="access" value="3" />
            </li>
            <li>
			 <label for="name">Option 1:*</label>
                        <input type="text" name="option[]" id="option[]" value="" class="text"/>
            </li><li>
			 <label for="name">Option 2:*</label>
            <input type="text" name="option[]" id="option[]" value="" class="text"/>
            </li><li>
			 <label for="name">Option 3:</label>
            <input type="text" name="option[]" id="option[]" value="" class="text"/>
            </li><li>
			 <label for="name">Option 4:</label>
            <input type="text" name="option[]" id="option[]" value="" class="text"/>
            </li><li>
			 <label for="name">Option 5:</label>
            <input type="text" name="option[]" id="option[]" value="" class="text"/>
            </li><li>
			 <label for="name">Option 6:</label>
            <input type="text" name="option[]" id="option[]" value="" class="text"/>
            </li><li>
			 <label for="name">Option 7:</label>
            <input type="text" name="option[]" id="option[]" value="" class="text"/>
            </li><li>
			 <label for="name">Option 8:</label>
            <input type="text" name="option[]" id="option[]" value="" class="text"/>
            </li>
			<li>
			 <label for="name">Option 9:</label>
            <input type="text" name="option[]" id="option[]" value="" class="text"/>
            </li>
			<li>
			 <label for="name">Option 10:</label>
            <input type="text" name="option[]" id="option[]" value="" class="text" />
            </li>
			<li>
                <input type="submit" name="submit"  class=" button gblue j_gen_form_submit" value="Save"/>
                <div class="clr"></div>
            </li></ol>
    </form>

