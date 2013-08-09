<?php // echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
?>
<div>
<!--    <form id="appl_form" action="/library/save_book">-->
        <input id="rel" name="rel" class="text" type="hidden" value="add_book"/>
        <ol>
            <li>
                <label for="name">Name of Book:*</label>
                <input id="name" name="name" class="text" readonly="readonly" value="<?php echo $data[0]['name']; ?>"/>
            </li>
            <li>
                <label for="author">Author:*</label>
                <input id="author" name="author" class="text" readonly="readonly" value="<?php echo $data[0]['author']; ?>"/>
            </li>
            <li>
                <label for="version">Version:*</label>
                <input id="version" name="version" class="text" readonly="readonly" value="<?php echo $data[0]['version']; ?>"/>
            </li>
            <li>
                <label for="branch_id">Branch:*</label>
                <select id="branch_id" name="branch_id" class="text" disabled="disabled">
                        <option value="">Select</option>
                        <?php echo load_select('branches',$data[0]['branch_id']);?>
                </select>
            </li>
            <li>
                <label for="year">Published in Year:*</label>
                <select id="year" name="year" class="text" disabled="disabled">
                    <option value="">Select</option>
                    <?php for($i=1980;$i<=date('Y');$i++){ ?>
                    <option value="<?php echo $i; ?>" <?php if($i==$data[0]['year'])echo 'selected="selected"' ?>><?php echo $i; ?></option>
                    <?php } ?>
                </select>
            </li>
            <li>
                <label for="unique_number">Unique Number:*</label>
                <input id="unique_number" name="unique_number" class="text" readonly="readonly" value="<?php echo $data[0]['unique_number']; ?>"/>
            </li>
            <li>
                <input type="button" class="send button grey" value="Delete the Book" onclick="javascript:delete_book('<?php echo $data[0]['id']; ?>')"/><br />
            </li>
        </ol>
<!--    </form>-->
    <div class="clr"></div>
</div>

<?php }else{ ?>
    <br/>
    <p>No Book Found. </p>

<?php } ?>