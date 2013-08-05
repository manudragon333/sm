<style>
    table.sample td {
        padding: 0px;
    }
    table.sample td input{
        border:1px dashed #ccc;
        padding: 4px 1px;
    }
    .showTtOptions{
        display:none;
    }
</style>
<?php  // echo '<pre>'; print_r($data); echo '</pre>';
if(count($data)){
?>
<h2 align="left"><span>Cycle <?php if(isset($cycles_name)) echo ' - '.$cycles_name; ?></span></h2>
<pre><?php // print_r($college_data); ?></pre>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter your details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<div class="clr"></div>
<form id="appl_form" action="/admin/edit_periods/<?php echo $cycles_id;  ?>" method="post">
    <input type="hidden" name="cycles_id" value="<?php if(isset($cycles_id)) echo $cycles_id; else echo 0;?>"/>
    <input type="hidden" name="user_id" value="<?php if(isset($user_id)) echo $user_id; else echo 0;?>"/>
    <ol>
        <li>
            <table class="sample table_view">
                <tr>
                    <th> Time</th>
                    <th> Period</th>
                    <th> Period Details</th>
                </tr>
                <?php foreach($data as $k=>$v){  ?>
                <tr>
                    <td><input type="text" name="periods[<?php echo $v['id'];  ?>][time_label]" value="<?php if(isset($v['time_label']))echo $v['time_label']; ?>" readonly="readonly" /></td>
                    <td><input type="text" name="periods[<?php echo $v['id'];  ?>][period_label]" value="<?php if(isset($v['period_label']))echo $v['period_label']; ?>" readonly="readonly" /></td>
                    <td><input type="text" name="periods[<?php echo $v['id'];  ?>][details]" value="<?php if(isset($v['details']))echo $v['details']; ?>" /></td>
                </tr>
                <?php }  ?>
            </table>
        </li>
        <li>
            <br/>
            <input type="button" name="imageField" id="imageField" class="button j_gen_form_submit" value=" Save Details "/>
        </li>
    </ol>
</form>
<?php }else{ ?>
<br/>
<div class="error">No Details found. Please try again.</div>
<?php } ?>