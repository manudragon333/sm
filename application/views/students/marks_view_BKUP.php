
<?php if(isset($show_admin_back) && $show_admin_back){ ?>
    <br/> <a href="<?php echo site_url('admin/adduser_marks'); ?>"><< Back to Exam Marks</a>
<?php } ?>

<pre><?php //print_r($student_marks); ?></pre>
<pre><?php //print_r($student_data); ?></pre>
<?php
$markTypeIds=array();
$displayData=array();
if(!empty($student_marks) && count($student_marks)){
    foreach ($student_marks as $key => $value) {
        $temp=array();
        if(in_array($value->marks_type_id, $markTypeIds)){
            $temp=array(
                            $value->subjects_name,
                            $value->marks,
                            $value->max_marks
                            );
            array_push($displayData[$value->marks_type_id]['marks'], $temp);
            // $displayData[$value->marks_type_id]['marks']=array_merge($temp, $displayData[$value->marks_type_id]['marks']);
        }else{
            $temp['exam_name']=$value->marks_type_name;
            $temp['marks']=array(
                            array(
                                $value->subjects_name,
                                $value->marks,
                                $value->max_marks
                            )
                           );
            $displayData[$value->marks_type_id]=$temp;
            $markTypeIds[]=$value->marks_type_id;
        }
    }

    ?>
    <pre><?php // print_r($displayData); ?></pre>


    <?php if(!empty($displayData)) foreach ($displayData as $key => $value) { ?>
    <br/>
    <h4><?php echo $value['exam_name']; ?></h4>
    <table class="sample table_view">
        <tr>
            <th>Subject name</th>
            <th>Marks Scored</th>
            <th>Max Marks</th>
        </tr>
        <?php if(!empty($value['marks'])) foreach($value['marks'] as $k=>$v){ ?>
        <tr>
            <th><?php echo $v[0]; ?></th>
            <td><?php echo $v[1]; ?></td>
            <td><?php echo $v[2]; ?></td>
        </tr>
        <?php } ?>
    </table>

    <?php } ?>
<?php }else{ ?>

    <br/><p>No data to display.</p>

<?php } ?>
