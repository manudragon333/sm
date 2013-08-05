<style type="text/css" rel="stylesheet">
    table.sample td {
        padding: 5px;
        text-align: center;
    }
</style>
<pre><?php //print_r($weekdays); ?></pre>
<pre><?php //print_r($cycle_periods); ?></pre>
<pre><?php //print_r($staff_periods); ?></pre>
<?php


$cycleWeekdayPeriods=array();

if(!empty($staff_periods)){
    foreach($staff_periods as $k=>$v){
        $cycleWeekdayPeriods[$v['weekday_id']][$v['period_id']]=$v;
    }
}

if(!empty($weekdays) && !empty($cycle_periods)){
    ?>

    <br/>
    <h4>Schedule</h4>
    <table class="sample table_view">
        <tr>
            <th>#</th>
            <?php foreach($cycle_periods as $cp_k=>$cp_v){ ?>
            <th><?php echo $cp_v['period_label'],' (',$cp_v['time_label'],')'; ?></th>
            <?php }  ?>
        </tr>
        <?php foreach($weekdays as $wd_k=>$wd_v){ ?>
        <tr>
            <td><?php echo $wd_v['name']; ?></td>

            <?php foreach($cycle_periods as $cp_k=>$cp_v){ ?>
            <td>
                <?php
                if(isset($cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['subject_name'])){
                    echo $cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['course_name'],' - ',$cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['branch_name'],' - ',$cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['sem_name'],' - ',$cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['subject_name'];
                }else{ ?>
                    <i>-Not Alloted-</i><br/>
                <?php }?>
                <input type="button" value="Edit" weekday_id="<?php echo $wd_v['id'];  ?>" period_id="<?php echo $cp_v['id'];  ?>" staff_id="<?php echo $staff_id;  ?>" cycle_id="<?php echo $cycle_id;  ?>" academic_year_id="<?php echo $academic_year_id;  ?>" class="text editStaffPeriods" />
            </td>
            <?php }  ?>
            
        </tr>
        <?php } ?>
    </table>
<?php }  ?>

    <br/><br/>
    <a href="<?php echo site_url('admin/attendance_management');  ?>" > <br> &lt;&lt; Back To List</a>
