<div>
    <form action="/admin/add_account">
    <ol>
        <input type="hidden" name="users_id" value="0" />
        <li>
            <label for="user_type_<?php echo $select_id; ?>">Select User Type: </label>
            <select name="users_type_id" id="user_type_<?php echo $select_id; ?>" class="text">
                <option value="">Select </option>
                <?php foreach($user_types as $k=>$v){ ?>
                <option value="<?php echo $v['id']; ?>"> <?php echo $v['name']; ?> </option>
                <?php } ?>
            </select>
        </li>
        <li>
            <input type="button" name="imageField" id="imageField" class="send button" value="Back" onclick="javascript:window.location.reload();"/>
            <input type="button" name="imageField" id="imageField" class="gblue button j_gen_form_submit" value=" Next "/>
            <div class="clr"></div>
        </li>
    </ol>
    </form>
</div>



<div id="user_details">
    
</div>