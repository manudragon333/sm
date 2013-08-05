<div>
    <ol>
        <li>
            <label for="user_<?php echo $select_id; ?>">Select User: </label>
            <select name="id" id="user_<?php echo $select_id; ?>" class="text">
                <option value="">Select </option>
                <?php foreach($users_data as $k=>$v){ ?>
                <option value="<?php echo $v['id']; ?>"> <?php echo $v['username']; ?> </option>
                <?php } ?>
            </select>
        </li>
        <li id="user_select_li"></li>
    </ol>
</div>
<div id="user_details">
    
</div>