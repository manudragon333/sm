<?php 
if(!empty($students)){
    foreach($students as $k=>$val){
        $v=(array) $val;
         ?>

<div class="cell fl">
    <label title="<?php echo $v['students_number']; ?> (<?php echo $v['name']; ?>)">
        <input type="checkbox" name="student_ids[]" class="required"  title="Please select a student" checked="checked" value="<?php echo $v['user_id']; ?>"/> <?php echo $v['students_number']; ?> (<?php echo $v['name']; ?>)
        <input type="hidden" name="student_phone_nos[<?php echo $v['user_id']; ?>]" value="<?php echo $v['mobile']; ?>" />
        <input type="hidden" name="student_emails[<?php echo $v['user_id']; ?>]" value="<?php echo $v['email']; ?>" />
    </label>
</div>
        <?php 
    } echo '<i>Total '.  count($students).' Students found.</i>';
} else{ echo showBigInfo('No Studnets Found..!!!');
?>
<input type="hidden" name="student_ids[]" class="required"  title="Please select a student"/>
<?php } ?>
<div class="clearboth clear"></div>