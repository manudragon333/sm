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

if(!empty($weekdays) && !empty($cycle_periods) && !empty($staff_periods)){
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

<?
$one=$wd_v['name'];
//$one=strtolower($one);
$tday=date('D');
$two='';
switch($tday)
{
case 'Mon': $two="Monday";break;
case 'Tue': $two="Tuesday";break;
case 'Wed': $two="Wednesday";break;
case 'Thu': $two="Thursday";break;
case 'Fri': $two="Friday";break;
case 'Sat': $two="Saturday";break;

}
if(strcmp($one,$two))
$str="disabled";
else
$str="";
?>

            <?php foreach($cycle_periods as $cp_k=>$cp_v){ ?>
            <td>
                <?php
                if(isset($cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['subject_name'])){
                    echo $cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['course_name'],' - ',$cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['branch_name'],' - ',$cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['sem_name'],' - ',$cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['subject_name'];
                ?>
                <form action="<?php echo site_url('staff/add_edit_attendance'); ?>" id="appl_form2<?php echo $v['id']; ?>" method="post" style="white-space: normal; " >
                    <input name="cycle_id"  type="hidden" value="<?php echo $cycle_id; ?>"/>
                    <input name="weekday_id"  type="hidden" value="<?php echo $wd_v['id']; ?>"/>
                    <input name="period_id"  type="hidden" value="<?php echo $cp_v['id']; ?>"/>
                    <input name="subject_id"  type="hidden" value="<?php echo $cycleWeekdayPeriods[$wd_v['id']][$cp_v['id']]['subject_id']; ?>"/>
                    <input type="submit"  <? echo $str; ?> value="Add/Edit Attendance" weekday_id="<?php echo $wd_v['id'];  ?>" period_id="<?php echo $cp_v['id'];  ?>" cycle_id="<?php echo $cycle_id;  ?>" class="text putAttendance" />
                </form>
                <?php }else{ ?>
                    <i>-Not Alloted-</i><br/>
                <?php }?>
            </td>
            <?php }  ?>
            
        </tr>
        <?php } ?>
    </table>
<?php } else { ?>
    <div class="error">
        <p>No Periods are Scheduled in this Cycle for You.</p>
    </div>
<?php }  ?>

    <br/><br/>
    <a href="<?php echo site_url('staff/attendance');  ?>" > <br> &lt;&lt; Back</a>