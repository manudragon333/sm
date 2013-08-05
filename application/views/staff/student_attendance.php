<pre><?php // print_r($students);  ?></pre>
<?php
if(!empty($students)){
?>

    <br/>
    <h4>Student Attendance for Day: <?php echo date('d M Y');  ?></h4>
    <form action="<?php echo site_url('staff/save_student_attendance'); ?>" id="appl_form2" method="post" >
        <input name="cycle_id"  type="hidden" value="<?php echo $cycle_id; ?>"/>
        <input name="weekday_id"  type="hidden" value="<?php echo $weekday_id; ?>"/>
        <input name="subject_id"  type="hidden" value="<?php echo $subject_id; ?>"/>
        <input name="period_id"  type="hidden" value="<?php echo $period_id; ?>"/>
        <table class="sample table_view">
            <tr>
                <th>Student Number</th>
                <th>Student Name</th>
                <th>Student Attendance</th>
            </tr>
            <?php foreach($students as $s_k=>$s_v){ ?>
            <tr>
                <td><?php echo $s_v['students_number']; ?></td>
                <td><?php echo $s_v['name']; ?></td>
                <td>
                    <input name="attendance[<?php echo $s_v['user_id'];  ?>][id]"  type="hidden" value="<?php if(isset($s_v['attendance_record_id']) && !empty($s_v['attendance_record_id'])) echo $s_v['attendance_record_id']; ?>"/>
                    <select name='attendance[<?php echo $s_v['user_id'];  ?>][attendance_id]' id='attendance' class="text">
                     <?php
                        $att_selected=(isset($s_v['attendance_record_id']) && !empty($s_v['attendance_record_id']))?$s_v['attendance_id']:1 ;
                        echo selectBox('Select','attendance_types','id,name',' status="1"',$att_selected);
                     ?>
                    </select>
                </td>
            </tr>
            <?php } ?>
            <tr>
                <td colspan="3">
                    <input type="submit" value="Save Attendance" class="text putAttendance" />
                </td>
            </tr>
        </table>
    </form>
<?php }else{  ?>
    <div class="error">
        <p>No students found in this semester. !!</p>
    </div>
<?php }  ?>

<br/><br/>
<a href="<?php echo site_url('staff/attendance');  ?>" > <br> &lt;&lt; Back To List</a>