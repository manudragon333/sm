<div class="f_r f_b m_r_10">* required fields</div>
<form id="edit_items_form" action="" method="POST">
    
    <ol class="form_box">
        <input id="" name="id[]" class="text" type="hidden" value="<?php if(isset($form_data[0]->id)) echo $form_data[0]->id; ?>"/>
        <li>
            <label for="name">Item Name:* </label>
            <input id="name" name="name[]" class="text required" title="Please enter a name" value="<?php if(isset($form_data[0]->name)) echo $form_data[0]->name; ?>">
        </li>
        <li>
            <label for="status">Status:* </label>
            <select id="status" name="status[]" class="text required" title="Please select a Status">
                <option value="1" <?php if(isset($form_data[0]->status) && $form_data[0]->status=='1') echo ' selected="selected" ' ?>>Active</option>
                <option value="0" <?php if(isset($form_data[0]->status) && $form_data[0]->status=='0') echo ' selected="selected" ' ?>>InActive</option>
            </select>
        </li>
        
        <li>
            <div class="clr"></div>
        </li>
    </ol>
    
    <ol>
        <li>
            <input type="button" name="" id="add_new_form_box" class="send button grey" value="+ Add Another Item" />
            <div class="clr"></div>
        </li>
    </ol>
    <ol>
        <li>
            <input type="submit" name="imageField" id="imageField" class="send button gblue" value="Save Item" />
            <div class="clr"></div>
        </li>
    </ol>
</form>


<script type="text/javascript">
    $(function(){
        $('#edit_items_form').validate();
        
        formBoxHtml=$('<div></div>').html($('.form_box:first').clone()).html();
        
        $('#add_new_form_box').live('click',function(){
            $('.form_box:last').after(formBoxHtml);
        });
    });
</script>