<pre><?php // print_r($student_attendance); ?></pre>
<pre><?php //print_r($student_data); ?></pre>
<?php
$markTypeIds=array();
$displayData=array();
if(!empty($student_attendance) && count($student_attendance)){
    ?>

    <br/>
    <h4>Attendance</h4>
    <table class="sample table_view">
        <tr>
            <th>#</th>
            <th>Attended Days</th>
            <th>Total Days</th>
            <th>Attendance %</th>
        </tr>
        <?php foreach($student_attendance as $k=>$v){ ?>
        <tr>
            <td><?php echo $k+1; ?></td>
            <th><?php echo $v->attend_days; ?></th>
            <td><?php echo $v->tot_days; ?></td>
            <?php
                $percent=0;
                $percent=($v->attend_days*100)/$v->tot_days;
            ?>
            <td><?php echo round($percent,2); ?></td>
        </tr>
        <?php } ?>
    </table>

<?php }else{ ?>

    <p>No data to display.</p>

<?php } ?>