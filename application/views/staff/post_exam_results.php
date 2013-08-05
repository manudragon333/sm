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
            <select id="semister_id" name="semister_id" class="text getStaffSubjects required" title="Please select a Semester">
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
        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text  required" title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($s_data['subject_id'])) $subject_id_select=$s_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','id'=>$subject_id_select)); ?>
            </select>
        </li>
<!--        <li>
            <label for="academic_year_id">Academic year:* </label>
            <select id="academic_year_id" name="academic_year_id" class="text required" title="Please select a Academic Year">
                <option value="">Select</option>
                <?php if(isset($s_data['academic_year_id'])) $academic_year_select=$s_data['academic_year_id']; else $academic_year_select=0; echo load_select('academic_years',$academic_year_select,array('status'=>'1')); ?>
            </select>
        </li>-->
        <li style="display:none;">
            <label for="regulation_id">Regulation:* </label>
            <select id="regulation_id" name="regulation_id" class="text " title="Please select a Regulation">
                <option value="">Select</option>
                <?php if(isset($s_data['regulation_id'])) $regulation_id_select=$s_data['regulation_id']; else $regulation_id_select=0; echo load_select('regulation',$regulation_id_select,array('status'=>'1')); ?>
            </select>
        </li>
        <li style="display:none;">
            <label for="mode_of_exam_id">Mode of Exam:* </label>
            <select id="mode_of_exam_id" name="mode_of_exam_id" class="text " title="Please select a Mode of the Exam">
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
        
<!--        <li style="">
            <label for="is_first_year">Is B.tech First Year?:* </label>
            <?php  if(isset($s_data['is_first_year'])){ $is_first_year_select=$s_data['is_first_year']; }else{ $is_first_year_select=''; } ?>
            <label ><input id="is_first_year_1" type="radio" name="is_first_year" value="1" class="required" title="Please Select If First year or not." <?php if($is_first_year_select=='1'){ echo ' checked="checked" '; }  ?>/> Yes </label>
            <label ><input id="is_first_year_2" type="radio" name="is_first_year" value="0" class="required" title="Please Select If First year or not." <?php if($is_first_year_select=='0'){ echo ' checked="checked" '; }  ?>/> No </label>
        </li>-->


        <li style="display:none;">
            <label for="comment">Comment:</label>
            <textarea id="comment" cols="8" rows="5" name="comment" class="text"><?php echo ((isset($s_data['comment'])?$s_data['comment']:''));  ?></textarea>
        </li>

        <li>
            <br/>
        </li>

        <?php if(isset($students_data) && !empty($students_data)){
            /*
             * Show the Students List based upon the above form submit
             */
            if($s_data['is_mba']=='1'){
                /*
                 * MBA PATTERN FORM
                 */
            ?>
            <li id="student_marks_li">
                <br/>
                <table class="sample table_view" >
                    <tr>
                        <th>Student</th>
                        <th>Subject</th>
                        <th>Internal 1</th>
                        <th>Internal 2</th>
                        <th>Avg marks</th>
                    </tr>
                    <?php
                    $subject_name='';
                    $subject_name=generalId('name','subjects','id',$subject_id_select);
                    $subject_type_id=generalId('subject_type_id','subjects','id',$subject_id_select);
                    foreach($students_data as $k=>$v){
                        $avg_marks=$total_marks=0;
                        ?>
                    <tr>
                        <td><?php echo $v->students_number;  ?>:</td>
                        <td><?php echo $subject_name;  ?>:</td>
                        <td <?php if($subject_type_id=='2'){ echo 'colspan="2" '; } ?> >
                            <input id="" type="text" name="student_marks[<?php echo $v->user_id;  ?>][1][objective]" class="ip_objective required ip1" <?php if(isset($student_marks[$v->user_id][1]['objective'])){ echo 'value="',$student_marks[$v->user_id][1]['objective'],'"'; $avg_marks=$student_marks[$v->user_id][1]['objective'];  ?> disabled="disabled" <?php }  ?> />
                            <input id="" type="hidden" name="student_marks[<?php echo $v->user_id;  ?>][1][descriptive]" class="hide" value="0" <?php if(isset($student_marks[$v->user_id][1]['objective'])){?> disabled="disabled" <?php }  ?> />
                            <input id="" type="hidden" name="student_marks[<?php echo $v->user_id;  ?>][1][assignment]" class="hide" value="0" <?php if(isset($student_marks[$v->user_id][1]['objective'])){?> disabled="disabled" <?php }  ?> />
                        </td>
                        <?php if($subject_type_id!='2'){  ?>
                        <td>
                            <input id="" type="text" name="student_marks[<?php echo $v->user_id;  ?>][2][objective]" class="ip_objective ip2 <?php if(!empty($student_marks[$v->user_id][1]['objective'])){  ?>required <?php }  ?>" <?php if(isset($student_marks[$v->user_id][2]['objective'])){ echo 'value="',$student_marks[$v->user_id][2]['objective'],'"'; $avg_marks=($student_marks[$v->user_id][2]['objective']>$avg_marks)?$student_marks[$v->user_id][2]['objective']:$avg_marks;   ?> disabled="disabled" <?php }  ?> />
                            <input id="" type="hidden" name="student_marks[<?php echo $v->user_id;  ?>][2][descriptive]" class="hide" value="0" <?php if(isset($student_marks[$v->user_id][2]['objective'])){?> disabled="disabled" <?php }  ?> />
                            <input id="" type="hidden" name="student_marks[<?php echo $v->user_id;  ?>][2][assignment]" class="hide" value="0" <?php if(isset($student_marks[$v->user_id][2]['objective'])){?> disabled="disabled" <?php }  ?> />
                        </td>
                        <?php }  ?>
                        <td>
                            <span class="avg_marks"><?php echo $avg_marks; ?></span>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </li>
            <?php }else{  ?>
            <li id="student_marks_li">
                <table class="sample table_view">
                    <tr>
                        <th>Student</th>
                        <th>Subject</th>
                        <th colspan="3">Internal 1</th>
                        <th >Total Marks</th>
                        <th colspan="3">Internal 2</th>
                        <th >Total Marks</th>
                    <?php if(!empty($s_data['is_first_year']) && $s_data['is_first_year']=='1'){  ?>
                        <th colspan="3">Internal 3</th>
                        <th >Total Marks</th>
                    <?php }  ?>
                        <th>Avg marks</th>
                    </tr>
                    <?php
                    $subject_name='';
                    $subject_name=generalId('name','subjects','id',$subject_id_select);
                    foreach($students_data as $k=>$v){
                        $avg_marks=$total_marks1=$total_marks2=$total_marks3=0;
                        ?>
                    <tr>
                        <td><?php echo $v->students_number;  ?>:</td>
                        <td><?php echo $subject_name;  ?>:</td>
                        <td>
                            OBJ <input id="" name="student_marks[<?php echo $v->user_id;  ?>][1][objective]" class="ip_objective required ip1" <?php if(isset($student_marks[$v->user_id][1]['objective'])){ echo 'value="',$student_marks[$v->user_id][1]['objective'],'"'; $total_marks1=$avg_marks+=$student_marks[$v->user_id][1]['objective'];  ?> disabled="disabled" <?php }  ?> />
                        </td>
                        <td>
                            DES <input id="" name="student_marks[<?php echo $v->user_id;  ?>][1][descriptive]" class="ip_descriptive required ip1" <?php if(isset($student_marks[$v->user_id][1]['descriptive'])){ echo 'value="',$student_marks[$v->user_id][1]['descriptive'],'"'; $total_marks1=$avg_marks+=$student_marks[$v->user_id][1]['descriptive'];  ?> disabled="disabled" <?php }  ?> />
                        </td>
                        <td>
                            ASS <input id="" name="student_marks[<?php echo $v->user_id;  ?>][1][assignment]" class="ip_assignment required ip1" <?php if(isset($student_marks[$v->user_id][1]['assignment'])){ echo 'value="',$student_marks[$v->user_id][1]['assignment'],'"'; $total_marks1=$avg_marks+=$student_marks[$v->user_id][1]['assignment'];  ?> disabled="disabled" <?php }  ?> />
                        </td>
                        <td>
                            <span class="avg_marks ip1"><?php echo $total_marks1; ?></span>
                        </td>
                        <td>
                            OBJ <input id="" name="student_marks[<?php echo $v->user_id;  ?>][2][objective]" class="ip_objective ip2 <?php if(!empty($student_marks[$v->user_id][1]['objective'])){  ?>required <?php }  ?>" <?php if(isset($student_marks[$v->user_id][2]['objective'])){ echo 'value="',$student_marks[$v->user_id][2]['objective'],'"'; $total_marks2+=$student_marks[$v->user_id][2]['objective']; $avg_marks+=$student_marks[$v->user_id][2]['objective'];   ?> disabled="disabled" <?php }  ?> />
                        </td>
                        <td>
                            DES <input id="" name="student_marks[<?php echo $v->user_id;  ?>][2][descriptive]" class="ip_descriptive ip2 <?php if(!empty($student_marks[$v->user_id][1]['objective'])){  ?>required <?php }  ?>" <?php if(isset($student_marks[$v->user_id][2]['descriptive'])){ echo 'value="',$student_marks[$v->user_id][2]['descriptive'],'"'; $total_marks2+=$student_marks[$v->user_id][2]['descriptive']; $avg_marks+=$student_marks[$v->user_id][2]['descriptive']; ?> disabled="disabled" <?php }  ?> />
                        </td>
                        <td>
                            ASS <input id="" name="student_marks[<?php echo $v->user_id;  ?>][2][assignment]" class="ip_assignment ip2 <?php if(!empty($student_marks[$v->user_id][1]['objective'])){  ?>required <?php }  ?>" <?php if(isset($student_marks[$v->user_id][2]['assignment'])){ echo 'value="',$student_marks[$v->user_id][2]['assignment'],'"'; $total_marks2+=$student_marks[$v->user_id][2]['assignment']; $avg_marks+=$student_marks[$v->user_id][2]['assignment'];  ?> disabled="disabled" <?php }  ?> />
                        </td>
                        <td>
                            <span class="avg_marks ip2"><?php echo $total_marks2; ?></span>
                        </td>
                    <?php if(!empty($s_data['is_first_year']) && $s_data['is_first_year']=='1'){  ?>
                        <td>
                            OBJ <input id="" name="student_marks[<?php echo $v->user_id;  ?>][3][objective]" class="ip_objective ip3 <?php if(!empty($student_marks[$v->user_id][2]['objective'])){  ?>required <?php }  ?>" <?php if(isset($student_marks[$v->user_id][3]['objective'])){ echo 'value="',$student_marks[$v->user_id][3]['objective'],'"'; $total_marks3+=$student_marks[$v->user_id][3]['objective']; $avg_marks+=$student_marks[$v->user_id][3]['objective'];   ?> disabled="disabled" <?php }  ?> />
                        </td>
                        <td>
                            DES <input id="" name="student_marks[<?php echo $v->user_id;  ?>][3][descriptive]" class="ip_descriptive ip3 <?php if(!empty($student_marks[$v->user_id][2]['objective'])){  ?>required <?php }  ?>" <?php if(isset($student_marks[$v->user_id][3]['descriptive'])){ echo 'value="',$student_marks[$v->user_id][3]['descriptive'],'"'; $total_marks3+=$student_marks[$v->user_id][3]['descriptive']; $avg_marks+=$student_marks[$v->user_id][3]['descriptive']; ?> disabled="disabled" <?php }  ?> />
                        </td>
                        <td>
                            ASS <input id="" name="student_marks[<?php echo $v->user_id;  ?>][3][assignment]" class="ip_assignment ip3 <?php if(!empty($student_marks[$v->user_id][2]['objective'])){  ?>required <?php }  ?>" <?php if(isset($student_marks[$v->user_id][3]['assignment'])){ echo 'value="',$student_marks[$v->user_id][3]['assignment'],'"'; $total_marks3+=$student_marks[$v->user_id][3]['assignment']; $avg_marks+=$student_marks[$v->user_id][3]['assignment'];  ?> disabled="disabled" <?php }  ?> />
                        </td>
                        <td>
                            <span class="avg_marks ip3"><?php echo $total_marks3; ?></span>
                        </td>
                    <?php }  ?>
                        <?php
                            if($avg_marks>0)
                            $avg_marks=$avg_marks/2;

                            $best_of_2=($total_marks1>$total_marks2)?$total_marks1:$total_marks2;
                            if(!empty($s_data['is_first_year']) && $s_data['is_first_year']=='1'){
                                if($total_marks1 && $total_marks2 && $total_marks3){
                                    $best_of_2=round(($total_marks1+$total_marks2+$total_marks3)/3);
                                }else{
                                    $best_of_2='';
                                }
                            }

                        ?>
                        <td><span class="avg_marks"><?php echo $best_of_2; ?></span></td>
                    </tr>
                    <?php } ?>
                </table>
            </li>
        <?php }
        }
        ?>
        <?php if(isset($students_data) && empty($students_data)){ ?>
            <li>
                <br/>
                <b>No Students Found.</b>
            </li>
        <?php }  ?>
        <li>
            <br/>
            <input type="submit" name="imageField" id="imageField" class="upload button j_gen_form_submit" value="Submit"/>
        </li>
    </ol>
</form>
<style type="text/css">
    table.sample td {
        padding: 2px;
    }
    table.sample td input{
        width: 50px;
        padding: 3px 1px;
    }
</style>

<script type="text/javascript">
    $(function(){
        $('#post_exam_results_form').validate();

//        $('select[name=semister_id]').unbind();
//        $('select[name=semister_id]').live('change',function(){
//           if($('select[name=subject_id]').length>0){
//                $.post(site_url+'/staff/getStaffSubjects/'+$('select[name=college_id]').val(),'semister_id='+$('select[name=semister_id]').val(),function(dataR){
//                    $('select[name=subject_id]').html(dataR);
//                });
//           }
//        });

        $('#post_exam_results_form select').change(function(){
            $('#student_marks_li').html('');
        });
        
        <?php
            $internalMaxMarks=0;
            if(!empty($s_data['is_mba']) && $s_data['is_mba']=='1'){
                $internalMaxMarks=40;
            }else{
                $internalMaxMarks=10;
            }
        ?>

        $('.ip_objective').keyup(function(){
            if($(this).val()><?php echo $internalMaxMarks;  ?>){
                $(this).val('')
                return false;
            }
        });
        $('.ip_descriptive').keyup(function(){
            if($(this).val()>10){
                $(this).val('')
                return false;
            }
        });
        $('.ip_assignment').keyup(function(){
            if($(this).val()>5){
                $(this).val('')
                return false;
            }
        });

        $('#student_marks_li input').keyup(function(){
            // console.log($(this).parents('tr').find('.avg_marks'));
            if(isNaN($(this).val())){
                $(this).val('');
            }
            
            if($(this).hasClass('ip1')){
                totalMarks=0;
                $.each($(this).parents('tr').find('input.ip1'),function(k,v){
                    if($(v).val())
                        totalMarks+=parseInt($(v).val());
                });
                $(this).parents('tr').find('.avg_marks.ip1').html(totalMarks);
            }else if($(this).hasClass('ip2')){
                totalMarks=0;
                $.each($(this).parents('tr').find('input.ip2'),function(k,v){
                    if($(v).val())
                        totalMarks+=parseInt($(v).val());
                });
                $(this).parents('tr').find('.avg_marks.ip2').html(totalMarks);
            }else if($(this).hasClass('ip3')){
                totalMarks=0;
                $.each($(this).parents('tr').find('input.ip3'),function(k,v){
                    if($(v).val())
                        totalMarks+=parseInt($(v).val());
                });
                $(this).parents('tr').find('.avg_marks.ip3').html(totalMarks);
            }

//            avgMarks=0;
//            $.each($(this).parents('tr').find('input[type="text"]'),function(k,v){
//                if($(v).val())
//                    avgMarks+=parseInt($(v).val());
//            });
//            avgMarks=avgMarks/2;

            bestOf2='-',totalMarks1=totalMarks2=totalMarks3=0;
            $.each($(this).parents('tr').find('input.ip1'),function(k,v){
                if($(v).val())
                    totalMarks1+=parseInt($(v).val());
            });
            $.each($(this).parents('tr').find('input.ip2'),function(k,v){
                if($(v).val())
                    totalMarks2+=parseInt($(v).val());
            });


        <?php if(!empty($s_data['is_first_year']) && $s_data['is_first_year']=='1'){ }else{ ?>
            if(totalMarks1 && totalMarks2){
                bestOf2=((totalMarks1>totalMarks2)?totalMarks1:totalMarks2);
                $(this).parents('tr').find('.avg_marks:last').html(bestOf2);
            }
        <?php }  ?>

        <?php if(!empty($s_data['is_first_year']) && $s_data['is_first_year']=='1'){  ?>

            $.each($(this).parents('tr').find('input.ip3'),function(k,v){
                if($(v).val())
                    totalMarks3+=parseInt($(v).val());
            });
            allTotalMarks=totalMarks1+totalMarks2+totalMarks3;
            if(bestOf2 && totalMarks3){
//                bestOf3=((bestOf2>totalMarks3)?bestOf2:totalMarks3);
                if(totalMarks1 && totalMarks2 && totalMarks3)
                    $(this).parents('tr').find('.avg_marks:last').html(Math.round((allTotalMarks/3)*100)/100);
            }
            
        <?php }  ?>

        });
    });
</script>