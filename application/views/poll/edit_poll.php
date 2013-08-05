<div>
    <h2 align="center"><span> Edit Poll </span></h2>
    <div class="user_instructions">
        <p style="width:200px; float:left;">Please enter details below.</p>
        <p style="width:200px; float:right;font-weight: bold;">*<i> required fields</i></p>
        <div class="clr"></div>
    </div>
    <div class="clr"></div>
    <div class="clr"></div>
    <form action="/admin/edit_poll<?php // echo site_url('admin/edit_poll');?>" id="appl_form" method="post" >
       <input id="" name="rel" class="text" type="hidden" value="edit_polls_form"/>
       <input id="id" name="id" class="text" type="hidden" value="<?php if(isset($data[0]['id'])) echo $data[0]['id'];  ?>"/>
        <ol>
            <li>
                <label for="name">Question :*</label>
                <input type="text" name="question" id="question" value="<?php if(isset($data[0]['question'])) echo $data[0]['question'];  ?>" class="text"/>
            </li>
            <li>
                <label for="name">Start date:*</label>
                <input type="text" name="start_date" id="start_date" value="<?php if(isset($data[0]['start_date'])) echo $data[0]['start_date'];  ?>" class="text apply_datepicker"/>
            </li>
            <li>
                <label for="name">End date:*</label>
                <input type="text" name="end_date" id="end_date" value="<?php if(isset($data[0]['end_date'])) echo $data[0]['end_date'];  ?>" class="text apply_datepicker"/>
            </li>
            <li>
                <label for="name">Access for:*</label>
                Student:<input type="radio" name="access" id="access" value="1" <?php if(isset($data[0]['access']) && $data[0]['access']=='1') echo 'checked="checked"';  ?> />&nbsp;Teacher:<input type="radio" name="access" id="access" value="2" <?php if(isset($data[0]['access']) && $data[0]['access']=='2') echo 'checked="checked"';  ?>/>&nbsp;Both:<input type="radio" name="access" id="access" value="3" <?php if(isset($data[0]['access']) && $data[0]['access']=='3') echo 'checked="checked"';  ?> />
            </li>

            <li>
                <input type="hidden" name="submit"  value="Save"/>
                <input type="button" name="submit2"  class="gblue button j_gen_form_submit" value="Save"/>
                <div class="clr"></div>
            </li>
        </ol>
    </form>
</div>
