<br/>
<?php
if (empty($attendance_details)) {
    echo showBigInfo('No Attendance records found for this student.');
} else {
    
    
    // echo '<pre>'; print_r($attendance_details); echo '</pre>';
    
    /* Grouping according to the subjects  */
    $monthlyAttendanceArr=$attendanceArr=array();
    foreach($attendance_details as $k=>$v){
        if(empty($attendanceArr[$v->subject_id]['total_classes'])){
            $attendanceArr[$v->subject_id]['total_classes']=0;
        }
        $attendanceArr[$v->subject_id]['total_classes']+=$v->attendance_count;
        $attendanceArr[$v->subject_id]['subject_name']=$v->subject_name;
        if($v->attendance_id=='1'){ /* Present Classses count */
            $attendanceArr[$v->subject_id]['attendance_count']=$v->attendance_count;
        }
        
        $monthlyAttendanceArr[dateFormat($v->create_date, 'Y-m')][$v->subject_id]=$attendanceArr[$v->subject_id];
    }
    // echo '<pre>'; print_r($attendanceArr); echo '</pre>';
    // echo '<pre>'; print_r($monthlyAttendanceArr); echo '</pre>';
    ?>
    
    <?php if(!empty($monthlyAttendanceArr)) foreach ($monthlyAttendanceArr as $ma_k => $ma_v) { 
            $attendedClasses=$totalClasses=0;
        ?>
    <div style="padding:5px;" class="">
        <table class="sample table_view">
            <tr>
                <td colspan="3">
                    <?php echo dateFormat($ma_k.'-01','M'); ?> Attendance:
                </td>
            </tr>
            <tr>
                <th>Subject Name</th>
                <th>Number Of classes assigned</th>
                <th>No of Presented Classes</th>
            </tr>
    <?php if(!empty($ma_v)) foreach ($ma_v as $k => $v) { ?>
                <tr>
                    <td><?php if (!empty($v['subject_name'])) echo $v['subject_name']; ?> </td>
                    <td><?php if (!empty($v['total_classes'])){ echo $v['total_classes']; $totalClasses+=$v['total_classes']; } ?> </td>
                    <td><?php if (!empty($v['attendance_count'])){ echo $v['attendance_count']; $attendedClasses+=$v['attendance_count']; } ?> </td>
                </tr>
    <?php } ?>
            <tr>
                <td colspan="3">
                    Attendance Percentage : <?php if(!empty($totalClasses)){ echo ($attendedClasses/$totalClasses)*100; }else{ 'N/A'; } ?>
                </td>
            </tr>
        </table>
    </div>
    <?php } ?>

<?php } ?>