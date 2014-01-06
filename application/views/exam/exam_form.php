<h2><span>Fill the form to <?php  if(isset($form_data['id'])){ echo 'edit'; } else{ echo 'add'; } ?> a exam.</span></h2>
<div class="clr"></div>
<div class="user_instructions">
    <p style="width:200px; float:left;">Please enter the details below.</p>
    <p style="width:200px; float:right;font-weight: bold;"><i><b>*</b> required fields</i></p>
    <div class="clr"></div>
</div>
<br/>
<br/>
<form id="post_exam_results_form" action="" method="POST">
    <input id="" name="rel" class="text" type="hidden" value="upload_assignments"/>
    <input id="" name="id" class="text" type="hidden" value="<?php  if(isset($form_data['id'])){ echo $form_data['id']; } ?>"/>
    <ol>
        <li>
            <label for="name">Exam Name:* </label>
            <input id="name" name="name" class="text required" title="Please enter a name" value="<?php  if(isset($form_data['name'])){ echo $form_data['name']; } ?>" />
        </li>
        <li style="">
            <label for="exam_type_id">Exam Type:* </label>
            <select id="exam_type_id" name="exam_type_id" class="text required" title="Please select a Exam Type">
                <option value="">Select</option>
                <?php if(isset($form_data['exam_type_id'])) $exam_type_id_select=$form_data['exam_type_id']; else $exam_type_id_select=0; echo load_select('exam_types',$mode_of_exam_select,array('status'=>'1')); ?>
            </select>
        </li>
        <li style="">
            <label for="mode_of_exam_id">Mode of Exam:* </label>
            <select id="mode_of_exam_id" name="mode_of_exam_id" class="text required" title="Please select a Mode of the Exam">
                <option value="">Select</option>
                <?php if(isset($form_data['mode_of_exam_id'])) $mode_of_exam_select=$form_data['mode_of_exam_id']; else $mode_of_exam_select=0; echo load_select('mode_of_exam',$mode_of_exam_select,array('status'=>'1')); ?>
            </select>
        </li>
        <li>
            <label for="maximum_marks">Maximum Marks:* </label>
            <input id="maximum_marks" name="maximum_marks" class="text digits required" title="Please enter a Maximum marks" value="<?php  if(isset($form_data['maximum_marks'])){ echo $form_data['maximum_marks']; } ?>" />
        </li>
        <li>
            <label for="pass_marks">Pass Marks:* </label>
            <input id="pass_marks" name="pass_marks" class="text digits required" title="Please enter a Pass marks" value="<?php  if(isset($form_data['pass_marks'])){ echo $form_data['pass_marks']; } ?>" />
        </li>
        <li>
            <label for="credits">Credits: </label>
            <input id="credits" name="credits" class="text digits " title="Please enter a Credits" value="<?php  if(isset($form_data['credits'])){ echo $form_data['credits']; } ?>" />
        </li>
        <li>
            <label for="college_id">College:* </label>
            <select id="college_id" name="college_id" class="text required" title="Please select College">
                <option value="">Select</option>
                <?php if(isset($form_data['college_id'])) $college_id_select=$form_data['college_id']; else $college_id_select=0; echo load_select('colleges',$college_id_select); ?>
            </select>
        </li>
        <li>
            <label for="course_id">Course:* </label>
            <select id="course_id" name="course_id" class="text required"  title="Please select Course">
                <option value="">Select</option>
                <?php if(isset($form_data['course_id'])) $course_id_select=$form_data['course_id']; else $course_id_select=0; echo load_select('courses',$course_id_select,array('status'=>'1','college_id'=>$college_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="branch_id">Branch:* </label>
            <select id="branch_id" name="branch_id" class="text required"  title="Please select Branch">
                <option value="">Select</option>
                <?php if(isset($form_data['branch_id'])) $branch_id_select=$form_data['branch_id']; else $branch_id_select=0; echo load_select('branches',$branch_id_select,array('status'=>'1','course_id'=>$course_id_select)); ?>
            </select>
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
            <select id="section_id" name="section_id" class="text" title="Please select a Section">
                <option value="">Select</option>
                <?php if(isset($form_data['section_id'])) $section_id_select=$form_data['section_id']; else $section_id_select=0; echo load_select_section('sections',$section_id_select,array('semister_id'=>$semister_id_select)); ?>
            </select>
        </li>
        <li>
            <label for="subject_id">Subject:* </label>
            <select id="subject_id" name="subject_id" class="text required" title="Please select a Subject">
                <option value="">Select</option>
                <?php if(isset($form_data['subject_id'])) $subject_id_select=$form_data['subject_id']; else $subject_id_select=0; echo load_select('subjects',$subject_id_select,array('status'=>'1','id'=>$subject_id_select)); ?>
            </select>
        </li>
        
<!--
        <li style="">
            <label for="is_mba">Course Type:* </label>
            <?php  if(isset($form_data['is_mba'])){ $is_mba_select=$form_data['is_mba']; }else{ $is_mba_select=0; } ?>
            <label ><input id="is_mba_1" type="radio" name="is_mba" value="1" class="required" title="Please Select a Course Type" <?php if($is_mba_select=='1'){ echo ' checked="checked" '; }  ?>/> M.B.A </label>
            <label ><input id="is_mba_2" type="radio" name="is_mba" value="0" class="required" title="Please Select a Course Type" <?php if($is_mba_select=='0'){ echo ' checked="checked" '; }  ?>/> B.Tech/ Others </label>
        </li>-->

        
        <li style="display:none;">
            <label for="comment">Comment:</label>
            <textarea id="comment" cols="8" rows="5" name="comment" class="text"><?php echo ((isset($form_data['comment'])?$form_data['comment']:''));  ?></textarea>
        </li>
        
        <li>
            <br/>
            <input type="submit" name="imageField" id="imageField" class="upload button gblue j_gen_form_submit" value="Submit"/>
        </li>
    </ol>
</form>

<div class="hide" id="header_txt"><?php  if(isset($form_data['id'])){ echo 'Edit'; } else{ echo 'Add'; } ?> Exam</div>

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
        $('#post_exam_results_form').validate({
            rules:{
                pass_marks:{
                    max:function(){ return $('#maximum_marks').val(); }
                }
            },
            messages:{
                maximum_marks:{
                    digits:'Please enter digits only.'
                },
                pass_marks:{
                    digits:'Please enter digits only.',
                    max:'Please enter pass marks within maximum marks'
                },
                credits:{
                    digits:'Please enter digits only.'
                }
            }
        });

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