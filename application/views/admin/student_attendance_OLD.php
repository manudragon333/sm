<?php
if (empty($attendance_details)) {
    echo showBigInfo('No Attendance records found for this student.');
} else {
    
    
    echo '<pre>'; print_r($attendance_details); echo '</pre>';
    
    /* Grouping according to the subjects  */
    $attendanceArr=array();
    foreach($attendance_details as $k=>$v){
        if(empty($attendanceArr[$v->subject_id]['total_classes'])){
            $attendanceArr[$v->subject_id]['total_classes']=0;
        }
        $attendanceArr[$v->subject_id][$v->attendance_id]=$v;
        $attendanceArr[$v->subject_id]['total_classes']+=$v->attendance_count;
    }
    echo '<pre>'; print_r($attendanceArr); echo '</pre>';
    ?>
    
    <div style="padding:5px;" class="">
        <table class="sample table_view">
            <tr>
                <th>Semester</th>
                <th>Course</th>
                <th>Branch</th>
                <th>Subject</th>
                <th>Attendance</th>
                <th>Number of Classes</th>
            </tr>
    <?php foreach ($attendance_details as $k => $v) { ?>
                <tr>
                    <td><?php if (!empty($v->semister_name)) echo $v->semister_name; ?> </td>
                    <td><?php if (!empty($v->course_name)) echo $v->course_name; ?> </td>
                    <td><?php if (!empty($v->branch_name)) echo $v->branch_name; ?> </td>
                    <td><?php if (!empty($v->subject_name)) echo $v->subject_name; ?> </td>
                    <td><?php if (!empty($v->attendance_type)) echo $v->attendance_type; ?> </td>
                    <td><?php if (!empty($v->attendance_count)) echo $v->attendance_count; ?> </td>
                </tr>
    <?php } ?>
        </table>
    </div>

<?php } ?>