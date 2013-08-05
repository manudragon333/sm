
<?php if(isset($show_admin_back) && $show_admin_back){ ?>
    <br/> <a href="<?php echo site_url('admin/adduser_marks'); ?>"><< Back to Exam Marks</a>
<?php } ?>

<pre><?php  // print_r($student_marks); ?></pre>
<pre><?php //print_r($student_data); ?></pre>
<?php
$markTypeIds=array();
$displayData=array();
$semIds=array();
$semisterWiseDisplayData=array();
if(!empty($student_marks) && count($student_marks)){

    foreach ($student_marks as $key => $value) {
        $temp=array();
        if(in_array($value->sem_id, $semIds)){
            $semisterWiseDisplayData[$value->sem_id]['sem_data'][]=$value;
            // $displayData[$value->marks_type_id]['marks']=array_merge($temp, $displayData[$value->marks_type_id]['marks']);
        }else{
            $temp['sem_name']=$value->sname;
            $temp['sem_data'][]=$value;
            
            $semisterWiseDisplayData[$value->sem_id]=$temp;
            $semIds[]=$value->sem_id;
        }
    }

    // echo '<pre>'; print_r($semisterWiseDisplayData); echo '</pre>';

    $semisterWiseDisplayDataCopy=$semisterWiseDisplayData;

//    foreach ($semisterWiseDisplayData as $k => $v) {
//        $displayData=array();
//        $markTypeIds=array();
//        foreach($v['sem_data'] as $key=>$value){
//            $temp=array();
//            if(in_array($value->marks_type_id, $markTypeIds)){
//                $temp=array(
//                            $value->subjects_name,
//                            $value->marks,
//                            $value->max_marks,
//                            $value->sem_id
//                            );
//                array_push($displayData[$value->marks_type_id]['marks'], $temp);
//                // $displayData[$value->marks_type_id]['marks']=array_merge($temp, $displayData[$value->marks_type_id]['marks']);
//            }else{
//                $temp['exam_name']=$value->marks_type_name;
//                $temp['marks']=array(
//                                array(
//                                    $value->subjects_name,
//                                    $value->marks,
//                                    $value->max_marks,
//                                    $value->sem_id
//                                )
//                               );
//                $displayData[$value->marks_type_id]=$temp;
//                $markTypeIds[]=$value->marks_type_id;
//            }
//        }
//        $semisterWiseDisplayData[$k]['sem_data']=$displayData;
//    }

    ?>
    <pre><?php // print_r($displayData); ?></pre>
    <pre><?php // print_r($semisterWiseDisplayDataCopy); ?></pre>

<?php // foreach($semisterWiseDisplayData as $k=>$v)
    {
    // $displayData=$v['sem_data'];
?>
    <h2><?php // echo $v['sem_name']; ?></h2>
    <?php if(!empty($semisterWiseDisplayDataCopy)) foreach ($semisterWiseDisplayDataCopy as $key => $value) { ?>
    <br/>
    <h4><?php echo $value['sem_name']; ?></h4>
    <table class="sample table_view">
        <tr>
            <th>Subject name</th>
            <th>External</th>
            <th>Internal 1</th>
            <th>Internal 2</th>
            <th>Internal 3</th>
            <th>Max marks</th>
			<th>Total marks</th>
			<th>Average of Internal marks</th>
            <th>Year Conducted</th>
			<th>Edit Marks</th>
        </tr>
        <?php if(!empty($value['sem_data'])) foreach($value['sem_data'] as $k=>$v){ ?>
        <tr>
            <th><?php echo $v->subjects_name; ?></th>
            <th><?php echo $v->marks/1; ?></th>
            <th><?php echo $v->internal_1/1; ?></th>
            <th><?php echo $v->internal_2/1; ?></th>
            <th><?php echo $v->internal_3/1; ?></th>
            <th><?php echo $v->max_marks; ?></th>
			 <th><?php echo $v->tot_marks/1; ?></th>
			  <th><?php echo $v->avg_marks/1; ?></th>
            <th><?php echo $v->marks_year; ?></th>
			<th><a target="_blank" href="<?php echo site_url('admin/edit_marks/'.$v->sm_id."/".$v->uid); ?>">Edit marks</a></th>
        </tr>
        <?php } ?>
    </table>

    <?php } ?>
    <br/>
    <hr/>
    
<?php } ?>
<?php }else{ ?>

    <br/><p>No data to display.</p>

<?php } ?>
