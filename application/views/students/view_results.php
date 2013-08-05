<div class="f_r f_b m_r_10">* required fields</div>

<form id="report_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <ol>

        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text required" title="Please select College" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($form_data['college_id'])) $college_id_select=$form_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
            <input id="college_id" name="college_id" class="hide" type="hidden" value="<?php echo $college_id_select;  ?>"/>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text "  title="Please select Course" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($form_data['course_id'])) $course_id_select=$form_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
            <input id="course_id" name="course_id" class="hide" type="hidden" value="<?php echo $course_id_select;  ?>"/>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text "  title="Please select Branch" disabled="disabled">
                <option value="">Select</option>
                <?php if(isset($form_data['branch_id'])) $branch_id_select=$form_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
            <input id="branch_id" name="branch_id" class="hide" type="hidden" value="<?php echo $branch_id_select;  ?>"/>
        </li>
        <li>
            <label for="semister_id">Semester:* </label>
            <select id="semister_id" name="semister_id" class="text required" title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($form_data['semister_id'])) $semister_id_select=$form_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="section_id">Sections:* </label>
            <select id="section_id" name="section_id" class="text required" title="Please select a Section">
                <option value="">Select</option>
                <?php if(isset($s_data['section_id'])) $section_id_select=$s_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
        </li>
<!--        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text " title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($form_data['subject_id'])) $subject_id_select=$form_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','semister_id'=>$semister_id_select)); ?>
            </select>
        </li>-->

        <li>
            <br/>
            <input type="submit" name="imageField" id="imageField" class="upload gblue button j_gen_form_submit" value="Submit"/>
        </li>
        
    </ol>
</form>


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
                     if(isset($student_internal_marks[$v->subject_id]) && $student_internal_marks[$v->subject_id]['average_marks']>$this_average_marks){
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
                 }
             }

        ?>
        <li id="student_marks_li">
            <h4>Student Number: <?php if(isset($form_data['student_number'])){ echo $form_data['student_number']; }  ?></h4>
            <br/>
            <?php if(false && !empty($student_internal_marks)){  ?>
            <p style="text-align:right;"><?php echo anchor('students/downloadReport','Download Excel',array('target'=>'_blank'));  ?></p>
            <?php }  ?>

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
                    $excelData=array(array(
                        'Subject','Internal 1','Internal 2'
                    ));
                    if(isset($internal_3_exists) && $internal_3_exists){
                        $excelData[0][]='Internal 3';
                    }
                    $excelData[0][]='Average Marks';
                    $excelData[0][]='Marks Awarded';
                    $excelData[0][]='Final Marks';
                    $excelData[0][]='Credits';
                    $excelData[0][]='Pass';
                ?>
                <?php
                if(!empty($student_internal_marks)){
                foreach($student_internal_marks as $k=>$v){ $excelDataRow=array();
                    $avg_marks=0;
                    ?>
                <tr>
                    <td><?php echo $v['subject_name']; $excelDataRow[]=$v['subject_name']; ?>:</td>
                    <td <?php if(isset($internal_3_exists) && $internal_3_exists && $v['subject_type_id']=='2'){ echo 'colspan="3" '; } else if($v['subject_type_id']=='2'){ echo 'colspan="2" '; } ?> ><?php  if(isset($v['internal_1'])){ echo $v['internal_1']; $excelDataRow[]=$v['internal_1']; }else{ echo '0'; $excelDataRow[]='0'; } ?></td>
                <?php if($v['subject_type_id']!='2'){  ?>
                    <td><?php  if(isset($v['internal_2'])){ echo $v['internal_2'];  $excelDataRow[]=$v['internal_2']; }else{ echo '0'; $excelDataRow[]='0'; }  ?></td>
                    <?php if(isset($internal_3_exists) && $internal_3_exists){  ?>
                    <td><?php  if(isset($v['internal_3'])){ echo $v['internal_3'];   $excelDataRow[]=$v['internal_3']; }else{ echo '0'; $excelDataRow[]='0'; } ?></td>
                    <?php }  ?>
                <?php }  ?>
                    <td>
                        <?php echo $v['average_marks'];   $excelDataRow[]=$v['average_marks'];  ?>
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][this_db_id]" value="<?php if(!empty($v['this_db_id'])) echo $v['this_db_id'];  ?>" />
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][average_marks]" value="<?php echo $v['average_marks'];  ?>" />
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][subject_type_id]" value="<?php echo $v['subject_type_id'];  ?>" />
                        <input type="hidden" name="student_marks[<?php echo $k;  ?>][max_credits]" value="<?php echo $v['max_credits'];  ?>" />
                    </td>
                    <td>
                        <?php if(isset($form_data['view_only'])){  ?>
                            <?php if(isset($v['external_marks'])){  echo $v['external_marks'];  $excelDataRow[]=$v['external_marks']; }
                                  if(!empty($v['mode_of_exam_id']) && $v['mode_of_exam_id']=='2'){ echo '<b> *</b>'; }  ?>
                        <?php }else{  ?>
                        <input id="student_marks_<?php echo $k;  ?>" name="student_marks[<?php echo $k;  ?>][external_marks]" class="text required ip_external" max_marks="<?php if(isset($v['max_marks'])){ echo $v['max_marks']; }  ?>" title="Please enter Marks" <?php if(isset($v['external_marks'])){  echo 'value="',$v['external_marks'],'"'; if($form_data['mode_of_exam_id']!='2') echo ' readonly="readonly" '; }  ?> />
                        <?php if(!empty($v['mode_of_exam_id']) && $v['mode_of_exam_id']=='2'){ echo '<b> *</b>'; }  ?>
                        <?php }  ?>
                    </td>
                    <td>
                        <?php if(isset($v['final_marks'])){ echo $v['final_marks']; $excelDataRow[]=$v['final_marks']; }  ?>
                    </td>
                    <td>
                        <?php if(isset($v['credits'])){ echo $v['credits']; $excelDataRow[]=$v['credits']; }  ?>
                    </td>
                    <td>
                        <?php if(isset($v['pass'])){ echo $v['pass']; $excelDataRow[]=$v['pass']; }  ?>
                    </td>
                </tr>
                <?php 
                        array_push($excelData, $excelDataRow);
                    }
                    // print_r($excelData);
                    $this->session->set_userdata('excelData',$excelData);
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

<script type="text/javascript">
    $(function(){
        $('#report_form').validate();

        $('#report_form select').change(function(){
            $('#report_li').html('');
        });


        $('select[name=branch_id]').live('change',function(){
           if($('select[name=semister_id]').length>0){
            $.post(site_url+'/students/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
                $('select[name=semister_id]').html(dataR);
            })
           }
           if($('select[name=sem_id]').length>0){
            $.post(site_url+'/students/getCollegeSemesters/'+$('select[name=college_id]').val(),'branch_id='+$('select[name=branch_id]').val(),function(dataR){
                $('select[name=sem_id]').html(dataR);
            })
           }
        });
        $('select[name=semister_id]').live('change',function(){
           if($(this).hasClass('getStaffSubjects') && $('select[name=subject_id]').length>0){
                $.post(site_url+'/staff/getStaffSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
                    $('select[name=subject_id]').html(dataR);
                });
           }else  if($('select[name=subject_id]').length>0){
            $.post(site_url+'/students/getCollegeSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
                $('select[name=subject_id]').html(dataR);
            })
           }
        });
        $('select[name=sem_id]').live('change',function(){
           if($('select[name=subject_id]').length>0){
            $.post(site_url+'/students/getCollegeSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=sem_id]').val(),function(dataR){
                $('select[name=subject_id]').html(dataR);
            })
           }
        });

        /*
        * NEW..!!
        */
        $('select[name=semister_id]').live('change',function(){
            if($('select[name=section_id]').length>0){
                $.post(site_url+'/staff/getCollegeSections/'+$('select[name=college_id]').val(),'sem_id='+$('select[name=semister_id]').val(),function(dataR){
                    $('select[name=section_id]').html(dataR);
                })
            }
        });

    });
</script>


