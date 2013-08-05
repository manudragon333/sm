

<br/>
<br/>
<?php if(isset($external_marks) && isset($internal_marks)){  ?>

<ol>
        <?php if(empty($external_marks) && empty($internal_marks)){  ?>
        <li>
            <h4>No Records Found.</h4>
        </li>
        <?php }else{  ?>
        <?php
            /*
             * Format MARKS
             */
             $student_internal_marks=array();
             if(!empty($internal_marks)){
                 foreach($internal_marks as $k=>$v){
//                         if(isset($student_internal_marks[$v->subject_id])){
//                             $average_marks_total=$student_internal_marks[$v->subject_id]['average_marks_total'];
//                         }else{
//                             $average_marks_total=0;
//                         }
//                         $average_marks_total+=$v->objective+$v->descriptive+$v->assignment;
                     $this_average_marks=$v->objective+$v->descriptive+$v->assignment;
                     if(isset($v->avg_marks) && !empty($v->avg_marks)){
                         $average_marks=$v->avg_marks;
                     }else if(isset($student_internal_marks[$v->subject_id]) && $student_internal_marks[$v->subject_id]['average_marks']>$this_average_marks){
                         $average_marks=$student_internal_marks[$v->subject_id]['average_marks'];
                     }else{
                         $average_marks=$this_average_marks;
                     }

                     /*
                      * Special Case for 1st Year. - Dont take best of like above. take Average of all 3 internals
                      */
                     if($v->is_first_year=='1'){
                         $totalMarksForAverageCalculation=0;
                         if(isset($student_internal_marks[$v->subject_id]['internal_1'])){
                             $totalMarksForAverageCalculation+=$student_internal_marks[$v->subject_id]['internal_1'];
                         }
                         if(isset($student_internal_marks[$v->subject_id]['internal_2'])){
                             $totalMarksForAverageCalculation+=$student_internal_marks[$v->subject_id]['internal_2'];
                         }
                         if(isset($student_internal_marks[$v->subject_id]['internal_3'])){
                             $totalMarksForAverageCalculation+=$student_internal_marks[$v->subject_id]['internal_3'];
                         }
                         $totalMarksForAverageCalculation+=$this_average_marks;
                         $average_marks=round($totalMarksForAverageCalculation/3);
                     }

                     /* Copying Prev internal Marks!!! :X */
                     $internal_1=$internal_1=0;
                     if(isset($student_internal_marks[$v->subject_id]['internal_1'])){
                         $internal_1=$student_internal_marks[$v->subject_id]['internal_1'];
                     }
                     if(isset($student_internal_marks[$v->subject_id]['internal_2'])){
                         $internal_2=$student_internal_marks[$v->subject_id]['internal_2'];
                     }

                     $student_internal_marks[$v->subject_id]=array(
                         'average_marks'=>$average_marks,
                         'subject_name'=>$v->subject_name,
                         'subject_type_id'=>$v->subject_type_id,
                         'max_credits'=>$v->credits,
                         'max_marks'=>(($form_data['is_mba']=='1')?60:(($v->subject_type_id=='1')?75:60))
                     );

                     /* Copying Prev internal Marks!!! :X */
                     if(!empty($internal_1)){
                         $student_internal_marks[$v->subject_id]['internal_1']=$internal_1;
                     }
                     if(!empty($internal_2)){
                         $student_internal_marks[$v->subject_id]['internal_2']=$internal_2;
                     }

                     $student_internal_marks[$v->subject_id]['internal_'.$v->internal_number]=$v->objective+$v->descriptive+$v->assignment;

                 }
             }
             $numberOfBacklogs=0; $subjectsBacklog=array();
             if(!empty($external_marks)){
                 foreach($external_marks as $k=>$v){
                     if(array_key_exists($v->subject_id, $student_internal_marks)){
                         $student_internal_marks[$v->subject_id]['external_marks']=$v->external_marks;
                         $student_internal_marks[$v->subject_id]['final_marks']=$v->final_marks; //($student_internal_marks[$v->subject_id]['average_marks_total']/2)+$v->external_marks;
                         $student_internal_marks[$v->subject_id]['credits']=$v->credits;
                         $student_internal_marks[$v->subject_id]['pass']=($v->pass=='1')?'Pass':'Fail';
                         $student_internal_marks[$v->subject_id]['this_db_id']=((!empty($v->id))?$v->id:0);
                         $student_internal_marks[$v->subject_id]['mode_of_exam_id']=((!empty($v->mode_of_exam_id))?$v->mode_of_exam_id:0);
                     }
                     if(isset($v->pass) && $v->pass=='0' && !in_array($v->subject_id, $subjectsBacklog)){
                         $numberOfBacklogs++;
                         $subjectsBacklog[]=$v->subject_id;
                     }
                 }
             }

        ?>
        <li id="student_marks_li">
            <h4>Result of: <?php if(isset($form_data['student_number'])){ echo $form_data['student_number']; }  ?></h4>
            <h4>Date of Join: <?php if(isset($student_data->doj)){ echo dateFormat($student_data->doj, 'd-m-Y'); }  ?></h4>
            <h4>Present Semester: <?php if(isset($student_data->sem_id)){ echo generalId('name','semisters','id',$student_data->sem_id); }  ?></h4>
            <h4>No. of Backlogs: <?php if(isset($numberOfBacklogs)){ echo $numberOfBacklogs; }  ?></h4>
            <br/>
            <table class="sample table_view">
                <tr>
                    <th>Subject</th>
                    <th>Internal 1</th>
                    <th>Internal 2</th>
                    <?php if(isset($student_internal_marks[key($student_internal_marks)]['internal_3'])){ $internal_3_exists=true; ?>
                    <th>Internal 3</th>
                    <?php }  ?>
                    <th>Average Marks</th>
                    <th>Marks Awarded</th>
                    <th>Final Marks</th>
                    <th>Credits</th>
                    <th>Pass</th>
                </tr>
                <?php
                if(!empty($student_internal_marks)){
                foreach($student_internal_marks as $k=>$v){
                    $avg_marks=0;
                    ?>
                <tr>
                    <td><?php echo $v['subject_name'];  ?>:</td>
                    <td <?php if(isset($internal_3_exists) && $internal_3_exists && $v['subject_type_id']=='2'){ echo 'colspan="3" '; } else if($v['subject_type_id']=='2'){ echo 'colspan="2" '; } ?> ><?php  if(!empty($v['internal_1'])) echo $v['internal_1'];?></td>
                    <?php if($v['subject_type_id']!='2'){  ?>
                    <td><?php  if(!empty($v['internal_2'])) echo $v['internal_2'];  ?></td>
                    <?php if(isset($internal_3_exists) && $internal_3_exists){  ?>
                    <td><?php  if(!empty($v['internal_3'])) echo $v['internal_3'];  ?></td>
                    <?php }  ?>
                    <?php }  ?>
                    <td>
                        <?php echo $v['average_marks'];  ?>
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][this_db_id]" value="<?php if(!empty($v['this_db_id'])) echo $v['this_db_id'];  ?>" />
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][average_marks]" value="<?php echo $v['average_marks'];  ?>" />
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][subject_type_id]" value="<?php echo $v['subject_type_id'];  ?>" />
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][max_credits]" value="<?php echo $v['max_credits'];  ?>" />
                    </td>
                    <td>
                        <?php if(isset($form_data['view_only'])){  ?>
                            <?php if(isset($v['external_marks'])){  echo $v['external_marks']; }
                                  if(!empty($v['mode_of_exam_id']) && $v['mode_of_exam_id']=='2'){ echo '<b> *</b>'; }  ?>
                        <?php }else{  ?>
                        <input id="student_marks_<?php echo $k;  ?>" name="student_marks[<?php echo $k;  ?>][external_marks]" class="text required ip_external" max_marks="<?php if(isset($v['max_marks'])){ echo $v['max_marks']; }  ?>" title="Please enter Marks" <?php if(isset($v['external_marks'])){  echo 'value="',$v['external_marks'],'"'; if($form_data['mode_of_exam_id']!='2') echo ' readonly="readonly" '; }  ?> />
                        <?php if(!empty($v['mode_of_exam_id']) && $v['mode_of_exam_id']=='2'){ echo '<b> *</b>'; }  ?>
                        <?php }  ?>
                    </td>
                    <td>
                        <?php if(isset($v['final_marks'])){ echo $v['final_marks']; }  ?>
                    </td>
                    <td>
                        <?php if(isset($v['credits'])){ echo $v['credits']; }  ?>
                    </td>
                    <td>
                        <?php if(isset($v['pass'])){ echo $v['pass']; }  ?>
                    </td>
                </tr>
                <?php }
                }
                ?>
            </table>
        </li>
        <?php }  ?>
</ol>
<br/>
<br/>
<br/>
<br/>
<b>*</b> :<i> Represents Supplementary/Re-sitted Marks. </i>


<?php }  ?>
