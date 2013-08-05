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
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text required" title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($s_data['subject_id'])) $subject_id_select=$s_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','id'=>$subject_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="academic_year_id">Academic year:* </label>
            <select id="academic_year_id" name="academic_year_id" class="text required" title="Please select a Academic Year">
                <option value="">Select</option>
                <?php if(isset($s_data['academic_year_id'])) $academic_year_select=$s_data['academic_year_id']; else $academic_year_select=0; echo load_select('academic_years',$semister_id_select,array('status'=>'1')); ?>
            </select>
        </li>
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
    <?php if(isset($students_data) && !empty($students_data)){
            /*
             * Show the Students List based upon the above form submit
             */
            ?>
            <li>
                <h4>Students: </h4>
            </li>
            <li id="student_marks_li">
                <table class="sample table_view">
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
                            <form method="POST" action="<?php echo site_url('exam/edit_student_marks');  ?>" target="_blank">
                                <input type="hidden" name="college_id" value="<?php if(isset($s_data['college_id'])){ echo $s_data['college_id']; }  ?>"/>
                                <input type="hidden" name="course_id" value="<?php if(isset($s_data['course_id'])){ echo $s_data['course_id']; }  ?>"/>
                                <input type="hidden" name="branch_id" value="<?php if(isset($s_data['branch_id'])){ echo $s_data['branch_id']; }  ?>"/>
                                <input type="hidden" name="semister_id" value="<?php if(isset($s_data['semister_id'])){ echo $s_data['semister_id']; }  ?>"/>
                                <input type="hidden" name="subject_id" value="<?php if(isset($s_data['subject_id'])){ echo $s_data['subject_id']; }  ?>"/>
                                <input type="hidden" name="academic_year_id" value="<?php if(isset($s_data['academic_year_id'])){ echo $s_data['academic_year_id']; }  ?>"/>
                                <input type="hidden" name="regulation_id" value="<?php if(isset($s_data['regulation_id'])){ echo $s_data['regulation_id']; }  ?>"/>
                                <input type="hidden" name="mode_of_exam_id" value="<?php if(isset($s_data['mode_of_exam_id'])){ echo $s_data['mode_of_exam_id']; }  ?>"/>

                                <input type="submit" value="Add/Edit Marks" class="button"/>
                            </form>
                        </td>
                        <td>
                            <input type="button" value="View Marks" class="button"/>
                        </td>
                    </tr>
                    <?php } ?>
                </table>
            </li>
        <?php }  ?>
</ol>


<style type="text/css">
    table.sample td {
        padding: 2px 10px;
        width:auto;
    }
    table.sample td input{
        
    }
</style>

<script type="text/javascript">
    $(function(){
        $('#post_exam_results_form').validate();

        $('#post_exam_results_form select').change(function(){
            $('#student_marks_li').html('');
        });

        $('.ip_objective').keyup(function(){
            if($(this).val()>10){
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

    });
</script>