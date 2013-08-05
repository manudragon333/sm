
<h2 align="left"><span><?php if(isset($form_data[0]->id)) echo ''; else echo ''; ?>Edit Calendar Items</span></h2>
<pre><?php // print_r($form_data); ?></pre>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<form id="edit_academic_calendar_items_form" action="" method="POST">
    <?php 
    if(empty($form_data)){
        $form_data=array(array()); // For ADDING - One Empty Record to loop foreach once
    }
        foreach($form_data as $k=>$v){
        ?>
    <ol class="form_box">
        <input id="" name="post_data[<?php echo $k; ?>][id]" data-name="post_data[{key}][id]" class="text" type="hidden" value="<?php if(isset($form_data[$k]->id)) echo $form_data[$k]->id; ?>"/>
        <li>
            <a class="delete_calendar_item fr" href="javascript:void(0)" onclick="javascript:delete_calendar_item(<?php if(isset($form_data[$k]->id)) echo $form_data[$k]->id; ?>,this);" >Remove</a>
            <div class="clr"></div>
        </li>
        <li>
            <label for="from_<?php echo $k; ?>">From:* </label>
            <input id="from_<?php echo $k; ?>" name="post_data[<?php echo $k; ?>][from]" data-name="post_data[{key}][from]" class="text required from" title="Please enter the From date" value="<?php if(isset($form_data[$k]->from)) echo dateFormat ($form_data[$k]->from,'Y-m-d'); ?>">
        </li>
        <li>
            <label for="to_<?php echo $k; ?>">To:* </label>
            <input id="to_<?php echo $k; ?>" name="post_data[<?php echo $k; ?>][to]" data-name="post_data[{key}][to]" class="text required to" title="Please enter the To date" value="<?php if(isset($form_data[$k]->to)) echo dateFormat ($form_data[$k]->to,'Y-m-d'); ?>">
        </li>
        <li>
            <label for="item_id_<?php echo $k; ?>">Item:* </label>
            <select name="post_data[<?php echo $k; ?>][item_id]" data-name="post_data[{key}][item_id]" id='item_id_<?php echo $k; ?>' class="text required" title="Please select a Item">
                <?php
                    $selected_item_id=(isset($form_data[$k]->item_id))?$form_data[$k]->item_id:'';
                    echo selectBox('Select','items','id,name','status="1"',$selected_item_id);
                ?>
            </select>
        </li>
        <li>
            <label for="attendance_<?php echo $k; ?>">Attendance:* </label>
            <select id="attendance_<?php echo $k; ?>" name="post_data[<?php echo $k; ?>][attendance]" data-name="post_data[{key}][attendance]" class="text required" title="Please select a Attendance">
                <option value="1" <?php if(isset($form_data[$k]->status) && $form_data[$k]->status=='1') echo ' selected="selected" ' ?>>Yes</option>
                <option value="0" <?php if(isset($form_data[$k]->status) && $form_data[$k]->status=='0') echo ' selected="selected" ' ?>>No</option>
            </select>
        </li>
        <li>
            <label for="status_<?php echo $k; ?>">Status:* </label>
            <select id="status_<?php echo $k; ?>" name="post_data[<?php echo $k; ?>][status]" data-name="post_data[{key}][status]" class="text required" title="Please select a Status">
                <option value="1" <?php if(isset($form_data[$k]->status) && $form_data[$k]->status=='1') echo ' selected="selected" ' ?>>Active</option>
                <option value="0" <?php if(isset($form_data[$k]->status) && $form_data[$k]->status=='0') echo ' selected="selected" ' ?>>InActive</option>
            </select>
        </li>
        
        <li>
            <div class="clr"></div>
        </li>
    </ol>
    <?php } ?>
    
    <ol id="add_another_button_box">
        <li>
            <input type="button" name="" id="add_new_form_box" class=" button green" value="Add Another Academic Calendar Item" />
            <div class="clr"></div>
        </li>
    </ol>
    <ol>
        <li>
            <br/><br/>
            <input type="submit" name="imageField" id="imageField" class=" button gblue" value="Save Academic Calendar " />
            <input type="button" name="" id="" class="send button grey" value=" Cancel " style="margin-left: 20px;" onclick="javascript:window.location='<?php echo site_url('admin/academic_calendar'); ?>'"/>
            <div class="clr"></div>
        </li>
    </ol>
    
</form>


<style type="text/css">
    table.sample td {
        padding: 2px;
    }
    table.sample td input{
        width: 100px;
    }
    .form_box{
        margin: 10px 0;
        border: 1px solid #999;
        box-shadow: 1px 1px 1px #ccc;
        padding: 10px;
    }
</style>

<script type="text/javascript">
    $(function(){
        $('#edit_academic_calendar_items_form').validate();
        
        formBoxHtml=$('<div></div>').html($('.form_box:first').clone()).html();
        
        $('#add_new_form_box').live('click',function(){
            $('#add_another_button_box').before(formBoxHtml);
            $('.form_box:last input, .form_box:last select').each(function(){
                if($(this).attr('data-name')){
                    $(this).attr('name',$(this).attr('data-name').replace('{key}',($('.form_box').length-1)));
                }
                thisId=$(this).attr('id')+'_'+($('.form_box').length-1);
                $(this).attr('id',thisId);
                $(this).prev('label').attr('for',thisId);
                $(this).val('');
            });
            applyDatePickers();
        });
        
        applyDatePickers();
    });
    
    
    function delete_calendar_item(id,thisObj){
        
        if(confirm('Are you sure you want to Delete this Calendar Item?')){
            dataP='id='+id+' ';
            boxToRemove=$(thisObj).parents('.form_box:first');
            $.ajax({
                url:site_url+'/admin/delete_academic_calendar_items',
                data:dataP,
                type:'POST',
                dataType:'',
                beforeSend:function(){

                },
                success:function(dataR){
                    boxToRemove.remove();
                }
            });
        }
    }
    
    function applyDatePickers(){
        $('.form_box input.from').datepicker({
            beforeShow: function(input) {	
                return {maxDate: ($(input).hasClass('from') ? $(input).parents('.form_box:first').find('.to').datepicker("getDate") : null),minDate:(new Date())};	
            },
            dateFormat:'yy-mm-dd'
        });
        $('.form_box input.to').datepicker({
            beforeShow: function(input) {
                return {minDate: ($(input).hasClass('to') ? $(input).parents('.form_box:first').find('.from').datepicker("getDate") : null)};
            },
            dateFormat:'yy-mm-dd'
        });
    }
    
</script>