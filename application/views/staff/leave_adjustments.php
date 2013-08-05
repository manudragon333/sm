<pre><?php // print_r($staff_periods);  ?></pre>
<?php if(empty($staff_periods)){  ?>
<h4>No Work adjustments.!</h4>
<?php }else{  ?>
<h4>Work adjustments:</h4>

<table class="sample table_view">
    <tr>
        <th width="30%">Subject</th>
        <th width="15%">Cycle</th>
        <th  width="15%">Time</th>
        <th width="30%">Work Adjusted To</th>
    </tr>
    <?php  
    $fromCopy=$from;
    while (strtotime($from) <= strtotime($to)) {
    ?>
    <tr>
        <th colspan="4">
            Leave Adjustments for the date: <?php echo $from;  ?>
        </th>
    </tr>
    <?php
        $adjustmentsExistsForDate=false;
        foreach($staff_periods as $sp_k=>$sp_v){
            if($sp_v['weekday_id']==date('N', strtotime($from))){
            $adjustmentsExistsForDate=true;
            ?>
    <tr>
        <td>
            <?php echo $sp_v['course_name'].'<br/>'.$sp_v['branch_name'].'<br/>'.$sp_v['branch_name'].'<br/>'.$sp_v['subject_name'].'<br/>'; ?>
        </td>
        <td>
            <?php echo $sp_v['cycle_name'];  ?>
        </td>
        <td>
            <?php echo $sp_v['time_label'];  ?>
        </td>
        <td>
            <select name='work_adjustments[<?php echo strtotime($from);  ?>][<?php echo $sp_v['id'];  ?>]' id='work_adjustment<?php echo $sp_v['id'];  ?>' class="text required" title="Please select the Teacher." style="width: 260px;">
                 <?php // echo selectBox('Select','staff_records','user_id,name','status="1"','0'); ?>
                <option value="">Select</option>
                 <?php if(isset($teachersOptions) && !empty($teachersOptions)){
                    foreach ($teachersOptions as $key => $value) {
                        if($this_staff_id!=$value['user_id']){
                      ?>
                    <option value="<?php echo $value['user_id'];  ?>"><?php echo $value['name'];  ?></option>
                 <?php
                        }
                    }
                 }  ?>
            </select>
        </td>
    </tr>
    <?php 
            }
    } ?>

    <?php if(!$adjustmentsExistsForDate){  ?>
        <tr>
            <td colspan="4">
                No Adjustments For this Day.
            </td>
        </tr>
    <?php }  ?>
    <?php
    $fromTS = strtotime($from . ' +1 day');
    $from = date('Y-m-d', $fromTS);

    } ?>
</table>
<?php } ?>