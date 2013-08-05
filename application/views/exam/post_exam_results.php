<h2><span>Select to post the results</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>

<form id="post_exam_results_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <ol>
        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text required" title="Please select College">
                <option value="">Select</option>
                <?php if(isset($s_data['college_id'])) $college_id_select=$s_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text required"  title="Please select Course">
                <option value="">Select</option>
                <?php if(isset($s_data['course_id'])) $course_id_select=$s_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text required"  title="Please select Branch">
                <option value="">Select</option>
                <?php if(isset($s_data['branch_id'])) $branch_id_select=$s_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="semister_id">Semester:* </label>
            <select id="semister_id" name="semister_id" class="text required" title="Please select a Semester">
                <option value="">Select</option>
                <?php if(isset($s_data['semister_id'])) $semister_id_select=$s_data['semister_id']; else $semister_id_select=0; echo load_select('semisters',$semister_id_select,array('status'=>'1','branch_id'=>$branch_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="section_id">Sections:* </label>
            <select id="section_id" name="section_id" class="text" title="Please select a Section">
                <option value="">Select</option>
                <?php if(isset($s_data['section_id'])) $section_id_select=$s_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
        </li>
<!--        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text required" title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($s_data['subject_id'])) $subject_id_select=$s_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','id'=>$subject_id_select)); ?>
            </select>
        </li>-->
<!--        <li>
            <label for="academic_year_id">Academic year:* </label>
            <select id="academic_year_id" name="academic_year_id" class="text required" title="Please select a Academic Year">
                <option value="">Select</option>
                <?php if(isset($s_data['academic_year_id'])) $academic_year_select=$s_data['academic_year_id']; else $academic_year_select=0; echo load_select('academic_years',$academic_year_select,array('status'=>'1')); ?>
            </select>
        </li>-->
        <li style="display:none;">
            <label for="regulation_id">Regulation: </label>
            <select id="regulation_id" name="regulation_id" class="text " title="Please select a Regulation">
                <option value="">Select</option>
                <?php if(isset($s_data['regulation_id'])) $regulation_id_select=$s_data['regulation_id']; else $regulation_id_select=0; echo load_select('regulation',$regulation_id_select,array('status'=>'1')); ?>
            </select>
        </li>
        <li style="">
            <label for="mode_of_exam_id">Mode of Exam:* </label>
            <select id="mode_of_exam_id" name="mode_of_exam_id" class="text required" title="Please select a Mode of the Exam">
                <option value="">Select</option>
                <?php if(isset($s_data['mode_of_exam_id'])) $mode_of_exam_select=$s_data['mode_of_exam_id']; else $mode_of_exam_select=0; echo load_select('mode_of_exam',$mode_of_exam_select,array('status'=>'1')); ?>
            </select>
        </li>

        <li style="">
            <label for="is_mba">Course Type:* </label>
            <?php  if(isset($s_data['is_mba'])){ $is_mba_select=$s_data['is_mba']; }else{ $is_mba_select=0; } ?>
            <label ><input id="is_mba_1" type="radio" name="is_mba" value="1" class="required" title="Please Select a Course Type" <?php if($is_mba_select=='1'){ echo ' checked="checked" '; }  ?>/> M.B.A </label>
            <label ><input id="is_mba_2" type="radio" name="is_mba" value="0" class="required" title="Please Select a Course Type" <?php if($is_mba_select=='0'){ echo ' checked="checked" '; }  ?>/> B.Tech/ Others </label>
        </li>

        

        <li style="display:none;">
            <label for="comment">Comment:</label>
            <textarea id="comment" cols="8" rows="5" name="comment" class="text"><?php echo ((isset($s_data['comment'])?$s_data['comment']:''));  ?></textarea>
        </li>


        
        
        <li>
            <br/>
            <input type="submit" name="imageField" id="imageField" class="upload button j_gen_form_submit" value="Submit"/>
        </li>
    </ol>
</form>

<ol>
    <?php if(!isset($external_marks) && !isset($internal_marks) && isset($students_data) && !empty($students_data)){
            /*
             * Show the Students List based upon the above form submit
             */
            ?>
            <li>
                <h4>Students: </h4>
            </li>
            <li id="student_marks_li">
                <table class="sample table_view" style="margin: 0 auto;">
                    <tr>
                        <th>Student</th>
                        <th>Add/Edit marks</th>
                        <th>View marks</th>
                    </tr>
                    <?php foreach($students_data as $k=>$v){
                        $avg_marks=0;
                        ?>
                    <tr>
                        <td><?php echo $v->students_number;  ?>:</td>
                        <td>
                            <form method="POST" action="" target="_blank">
                                <input type="hidden" name="user_id" value="<?php if(isset($v->user_id)){ echo $v->user_id; }  ?>"/>
                                <input type="hidden" name="student_number" value="<?php if(isset($v->students_number)){ echo $v->students_number; }  ?>"/>
                                <input type="hidden" name="college_id" value="<?php if(isset($s_data['college_id'])){ echo $s_data['college_id']; }  ?>"/>
                                <input type="hidden" name="course_id" value="<?php if(isset($s_data['course_id'])){ echo $s_data['course_id']; }  ?>"/>
                                <input type="hidden" name="branch_id" value="<?php if(isset($s_data['branch_id'])){ echo $s_data['branch_id']; }  ?>"/>
                                <input type="hidden" name="semister_id" value="<?php if(isset($s_data['semister_id'])){ echo $s_data['semister_id']; }  ?>"/>
                                <input type="hidden" name="section_id" value="<?php if(isset($s_data['section_id'])){ echo $s_data['section_id']; }  ?>"/>
                                <input type="hidden" name="academic_year_id" value="<?php if(isset($s_data['academic_year_id'])){ echo $s_data['academic_year_id']; }  ?>"/>
                                <input type="hidden" name="section_id" value="<?php if(isset($s_data['section_id'])){ echo $s_data['section_id']; }  ?>"/>
                                <input type="hidden" name="regulation_id" value="<?php if(isset($s_data['regulation_id'])){ echo $s_data['regulation_id']; }  ?>"/>
                                <input type="hidden" name="mode_of_exam_id" value="<?php if(isset($s_data['mode_of_exam_id'])){ echo $s_data['mode_of_exam_id']; }  ?>"/>
                                <input type="hidden" name="is_mba" value="<?php if(isset($s_data['is_mba'])){ echo $s_data['is_mba']; }  ?>"/>

                                <input type="submit" value="Add/Edit Marks" class="button"/>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="" target="_blank">
                                <input type="hidden" name="user_id" value="<?php if(isset($v->user_id)){ echo $v->user_id; }  ?>"/>
                                <input type="hidden" name="student_number" value="<?php if(isset($v->students_number)){ echo $v->students_number; }  ?>"/>
                                <input type="hidden" name="college_id" value="<?php if(isset($s_data['college_id'])){ echo $s_data['college_id']; }  ?>"/>
                                <input type="hidden" name="course_id" value="<?php if(isset($s_data['course_id'])){ echo $s_data['course_id']; }  ?>"/>
                                <input type="hidden" name="branch_id" value="<?php if(isset($s_data['branch_id'])){ echo $s_data['branch_id']; }  ?>"/>
                                <input type="hidden" name="semister_id" value="<?php if(isset($s_data['semister_id'])){ echo $s_data['semister_id']; }  ?>"/>
                                <input type="hidden" name="section_id" value="<?php if(isset($s_data['section_id'])){ echo $s_data['section_id']; }  ?>"/>
                                <input type="hidden" name="academic_year_id" value="<?php if(isset($s_data['academic_year_id'])){ echo $s_data['academic_year_id']; }  ?>"/>
                                <input type="hidden" name="section_id" value="<?php if(isset($s_data['section_id'])){ echo $s_data['section_id']; }  ?>"/>
                                <input type="hidden" name="regulation_id" value="<?php if(isset($s_data['regulation_id'])){ echo $s_data['regulation_id']; }  ?>"/>
                                <input type="hidden" name="mode_of_exam_id" value="<?php if(isset($s_data['mode_of_exam_id'])){ echo $s_data['mode_of_exam_id']; }  ?>"/>
                                <input type="hidden" name="is_mba" value="<?php if(isset($s_data['is_mba'])){ echo $s_data['is_mba']; }  ?>"/>
                                <input type="hidden" name="view_only" value="true"/>

                                <input type="submit" value="View Marks" class="button"/>
                            </form>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </li>
        <?php }else if(isset($external_marks) && isset($internal_marks)){
                /*
                 * Show the Student Marks Edit Form
                 * STUDENT MARKS FORM
                 */
//                 echo '<pre>'; print_r($internal_marks); echo '</pre>';
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
                             'max_marks'=>(($s_data['is_mba']=='1')?60:(($v->subject_type_id=='1')?75:60))
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
                <h4>Marks For Student: <?php if(isset($s_data['student_number'])){ echo $s_data['student_number']; }  ?></h4>
                <br/>
                <form method="POST" action="">
                                <input type="hidden" name="user_id" value="<?php if(isset($v->user_id)){ echo $v->user_id; }  ?>"/>
                                <input type="hidden" name="college_id" value="<?php if(isset($s_data['college_id'])){ echo $s_data['college_id']; }  ?>"/>
                                <input type="hidden" name="course_id" value="<?php if(isset($s_data['course_id'])){ echo $s_data['course_id']; }  ?>"/>
                                <input type="hidden" name="branch_id" value="<?php if(isset($s_data['branch_id'])){ echo $s_data['branch_id']; }  ?>"/>
                                <input type="hidden" name="semister_id" value="<?php if(isset($s_data['semister_id'])){ echo $s_data['semister_id']; }  ?>"/>
                                <input type="hidden" name="section_id" value="<?php if(isset($s_data['section_id'])){ echo $s_data['section_id']; }  ?>"/>
                                <input type="hidden" name="academic_year_id" value="<?php if(isset($s_data['academic_year_id'])){ echo $s_data['academic_year_id']; }  ?>"/>
                                <input type="hidden" name="section_id" value="<?php if(isset($s_data['section_id'])){ echo $s_data['section_id']; }  ?>"/>
                                <input type="hidden" name="regulation_id" value="<?php if(isset($s_data['regulation_id'])){ echo $s_data['regulation_id']; }  ?>"/>
                                <input type="hidden" name="mode_of_exam_id" value="<?php if(isset($s_data['mode_of_exam_id'])){ echo $s_data['mode_of_exam_id']; }  ?>"/>
                                <input type="hidden" name="is_mba" value="<?php if(isset($s_data['is_mba'])){ echo $s_data['is_mba']; }  ?>"/>
                <table class="sample table_view">
                    <tr>
                        <th>Subject</th>
                        <?php if($s_data['is_mba']=='1'){  ?>
                        <th>Internal 1</th>
                        <th>Internal 2</th>
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
                    <?php if($s_data['is_mba']=='1'){  ?>
                        <td <?php if($v['subject_type_id']=='2'){ echo 'colspan="2" '; } ?> ><?php  if(!empty($v['internal_1'])) echo $v['internal_1'];?></td>
                        <?php if($v['subject_type_id']!='2'){  ?>
                        <td><?php  if(!empty($v['internal_2'])) echo $v['internal_2'];  ?></td>
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
                            <?php if(isset($s_data['view_only'])){  ?>
                                <?php if(isset($v['external_marks'])){  echo $v['external_marks']; }  
                                      if(!empty($v['mode_of_exam_id']) && $v['mode_of_exam_id']=='2'){ echo '<b> *</b>'; }  ?>
                            <?php }else{  ?>
                            <input id="student_marks_<?php echo $k;  ?>" name="student_marks[<?php echo $k;  ?>][external_marks]" class="text required ip_external" max_marks="<?php if(isset($v['max_marks'])){ echo $v['max_marks']; }  ?>" title="Please enter Marks" <?php if(isset($v['external_marks'])){  echo 'value="',$v['external_marks'],'"'; if($s_data['mode_of_exam_id']!='2') echo ' readonly="readonly" '; }  ?> />
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
                                
                    <br/>
                    <?php if(!isset($s_data['view_only'])){  ?>
                    <input type="submit" value="Save Marks" class="button"/>
                    <?php }  ?>
                </form>
            </li>


        <?php }  ?>

        <?php if(!isset($external_marks) && !isset($internal_marks) && isset($students_data) && empty($students_data)){  ?>
            <li>
                <h4>No Students Found.</h4>
            </li>
        <?php }  ?>

</ol>
<br/>
<br/>
<b>*</b> :<i> Represents Supplementary/Re-sitted Marks. </i>

<style type="text/css">
    table.sample td {
        padding: 2px 10px;
        width:auto;
    }
    table.sample td input.text{
        width:100px;
        padding: 10px 2px;
    }
</style>

<script type="text/javascript">
    $(function(){
        $('#post_exam_results_form').validate();

        $('#post_exam_results_form select').change(function(){
            $('#student_marks_li').html('');
        });

        $('.ip_external').keyup(function(){
            if(isNaN($(this).val())){
                $(this).val('');
            }
            // console.log($(this).attr('max_marks'), $(this).val(), parseInt($(this).val())>parseInt($(this).attr('max_marks')))
            if($(this).attr('max_marks')!='' && parseInt($(this).val())>parseInt($(this).attr('max_marks'))){
                $(this).val('')
                return false;
            }
        });
        

    });
</script>